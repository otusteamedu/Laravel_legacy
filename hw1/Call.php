<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class Call extends Model
{
    use AppModelConfig;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->modelConfigString = 'app_config.model.call';
        $this->initModelconfig();
    }

    /**
     * Метод для рисования таблицы параметров в админке - нарушает SRP и вообще HTML надо вынести во view
     */
    public static function makeHtmlTableFromEvent($event, $childTable = false)
    {
        if (count($event) === 0) {
            return false;
        }

        $tableClass = $childTable ? 'subTableCallEvent' : 'tableCallEvent';

        ob_start();

        ?>
        <table class="<?php echo $tableClass; ?>">
            <?php if (!$childTable) : ?>
                <thead>
                <tr>
                    <th>Parameter</th>
                    <th>Data</th>
                </tr>
                </thead>
            <?php endif; ?>
            <tbody>
            <?php foreach ($event as $parameterName => $parameterValue): ?>
                <tr>
                    <td><?php echo $parameterName; ?></td>
                    <?php if (is_array($parameterValue)) : ?>
                        <td class="cellObject">
                            <?php echo self::makeHtmlTableFromEvent($parameterValue, true); ?>
                        </td>
                    <?php else : ?>
                        <td><?php echo $parameterValue; ?></td>
                    <?php endif; ?>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <?php

        return ob_get_clean();
    }

    /**
     * Массово обновляем длительность звонков через API оператора
     * Нарушает принцип DIP, т.к. зависит от конкретного класса, хотя звонки есть от 2 операторов
     * Нужно переписать через абстракцию CallProviderAccount
     */
    public static function bulkUpdateCallDurationFromTwilio(TwilioAccount $twilioAccount)
    {
        $callsWithDuration = Model::query()->whereNotNull('call_duration')->get();

        if (count($callsWithDuration) > 0) {
            foreach ($callsWithDuration as $call) {
                if ($call->getCallIntentLog()) {
                    $callSid = $call->getCallSid();

                    if ($callSid) {
                        // TODO make a check if getCallData() returns false with current $callSid
                        $updatedCallDuration = (int)$twilioAccount->client()->getCallData($callSid)->duration;

                        if ($call->call_duration !== $updatedCallDuration) {
                            $call->update([
                                    'call_duration' => $updatedCallDuration,
                            ]);
                        }
                    }
                }
            }
        }
    }

    /**
     * Методы не имеет отношения к самому звонку, только к ивентам во время звонка(инициализирован, гудки, ...)
     */
    public static function getCallEventsSequence()
    {
        return [
                'queued',
                'initiated',
                'cancelled failed',
                'ringing',
                'busy no-answer',
                'in-progress',
                'completed',
        ];
    }

    public static function getCallFailedEventsSequence()
    {
        return [
                'Failed',
                'No-answer',
                'Canceled',
                'Error (notFound)',
                'Error (cancel)',
                'Error (noAnswer)',
                'Error (congestion)',
                'Error (busy)',
                'Busy',
                'Failed to call',
                'cancelled failed',
                'Busy no-answer',
        ];
    }

    public static function getCallSuccessEventsSequence()
    {
        return [
                'Completed',
                'OK',
                'Initiated',
                'Queued',
                'In-progress',
        ];
    }
}
