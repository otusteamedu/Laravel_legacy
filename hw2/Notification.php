<?php

namespace App;

use App\Mail\AlertQueueStopped;
use App\Widget;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{

    /**
     * Проверяет таблицу с очередью и отсылает уведомления админам, если есть невыполненные задания старше 4 минут
     * Пример использования Return early
     */
    public static function alertIfCallJobIsWaiting(): void
    {
        $queueJobsCount = DB::table('jobs')->count();

        if ($queueJobsCount === 0) {
            return null;
        }

        $firstJob = DB::table('jobs')->first();

        if (!$firstJob) {
            return null;
        }

        $available        = Carbon::createFromTimestamp($firstJob->available_at);
        $now              = Carbon::now();
        $timeoutInMinutes = 4;

        if ($now->diffInMinutes($available) > $timeoutInMinutes) {
            $payload      = json_decode($firstJob->payload, true);
            $jobData      = unserialize($payload['data']['command']);
            $jobAvailable = $available->format('d.m.Y H:i:s');
            $appUrl       = App::make('url')->to('/');

            $alertData = [
                'appUrl'        => $appUrl,
                'totalJobs'     => $queueJobsCount,
                'jobAvailable'  => $jobAvailable,
                'passedMinutes' => $now->diffInMinutes($available),
                'widgetUrl'     => $jobData->rocket->domain,
            ];

            $subscriptionList = [];

            foreach ($subscriptionList as $email) {
                Mail::to($email)->send(new AlertQueueStopped($alertData));
            }
        }
    }
}