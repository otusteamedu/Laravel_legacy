<?php

namespace App\Console\Commands\Emails;

use App\Mail\BaseMail;
use App\Models\Email;
use App\Models\User;
use App\Services\Users\Repositories\UserRepositoryInterface;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use phpDocumentor\Reflection\Types\Boolean;

/**
 * Class SeedEmailsTable
 * Консольная команда, чтобы генерировать задания для email-рассылки.
 * Сгенерированное задание = строка в таблице emails, где указано какому пользователю какой шаблон письма отправить.
 * @package App\Console\Commands\Emails
 */
class SeedEmailsTable extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'emails:seed
                            { campaign : кампания/причина для email-рассылки }';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Сгенерируй данные для email-рассылки.';

    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;

    /**
     * Create a new command instance.
     *
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // получи параметры команды из консоли
        // кампания/причина для email-рассылки
        $campaign = $this->argument('campaign');

        if(!$this->validate($campaign))
        {
            // ошибка
            echo PHP_EOL;
            echo "Кампания указана неверно. Выберите что-то из : ".Email::TYPE_NEW_ACTION.", ".Email::TYPE_ORDER_ACCEPTED.", ".Email::TYPE_ORDER_SHIPPED;
            echo PHP_EOL;
            dd("Выполнение команды прервано.");
        }

        $users = $this->userRepository->all();

            /*$emails = Email::all()
                ->where('type',$campaign)
                ->where('need_to_send',true);*/

        $bar = $this->output->createProgressBar(count($users));
        $bar->start();

        foreach($users as $user)
        {
            if($campaign == Email::TYPE_NEW_ACTION && EmailRules::qualifiesForNewActionEmail($user))
            {
                $this->markUserForEmailing($user, $campaign);
            }
            if($campaign == Email::TYPE_ORDER_ACCEPTED && EmailRules::qualifiesForOrderAcceptedEmail($user))
            {
                $this->markUserForEmailing($user, $campaign);
            }
            if($campaign == Email::TYPE_ORDER_SHIPPED && EmailRules::qualifiesForOrderShippedEmail($user))
            {
                $this->markUserForEmailing($user, $campaign);
            }

           $bar->advance();
        }
         $bar->finish();
         echo PHP_EOL;
         echo "Email-рассылка сгенерирована.".PHP_EOL;
        return ;
    }

    private function validate(string $campaign):bool
    {
        $valid_campaigns = [Email::TYPE_NEW_ACTION, Email::TYPE_ORDER_ACCEPTED, Email::TYPE_ORDER_SHIPPED];
        $campaign_is_valid = in_array($campaign, $valid_campaigns);
        return $campaign_is_valid;
    }
    private function markUserForEmailing(User $user, string $campaign)
    {
        $email = factory(\App\Models\Email::class)->create([
            'user_id' => $user->id,
            'type' => $campaign,
            'need_to_send' => true
        ]);
        $email->save();
    }
    /**
     * Отправка письма пользователю
     * @param User $user пользователь - получатель письма
     * @param string $template_name шаблон письма
     */
    private function sendEmailToUser(User $user, $template_name)
    {
        Mail::to($user->email)
            ->send(new BaseMail($user, $template_name));
    }
}
