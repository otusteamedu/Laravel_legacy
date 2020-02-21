<?php

namespace App\Http\Middleware\SiteAccess;

use Closure;
use Illuminate\Support\Facades\Log;

class CheckIfAdminIP
{
    /**
     * Handle an incoming request.
     * Проверка : заход на сайт с админовского ip ? Если "Да", то "сообщи" следующим middleware, что не нужно выполнять
     * никаких проверок. Для этого назначь $request->checkNeeded = false
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $nextCheckNeeded = false;

        if(CheckResult::$passed)
        {
            // 1 Определи ip посетителя
            $ip = $_SERVER['REMOTE_ADDR'];

            // 2 Считай админовские ip
            $admin_ips = config('admin_ips.admin_ips');

            // 3 проверь : ip в списке админовских ?
            if (!in_array($ip, $admin_ips))
            {
                // Если нет
                $nextCheckNeeded = true;
            }
        }

        CheckResult::$passed = $nextCheckNeeded;

        return $next($request);
    }
}
