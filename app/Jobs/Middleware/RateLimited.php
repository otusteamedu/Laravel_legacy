<?php
/**
 * Description of RateLimited.php
 * @copyright Copyright (c) MISTER.AM, LLC
 * @author    Egor Gerasimchuk <egor@mister.am>
 */

namespace App\Jobs\Middleware;


use Illuminate\Support\Facades\Redis;

class RateLimited
{
    /**
     * Process the queued job.
     *
     * @param  mixed  $job
     * @param  callable  $next
     * @return mixed
     */
    public function handle($job, $next): void
    {
        Redis::throttle('key')
            ->block(0)
            ->allow(1)
            ->every(5)
            ->then(function () use ($job, $next) {
                $next($job);
            }, function () use ($job) {
                $job->release(5);
            });
    }
}