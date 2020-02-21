<?php

namespace App\Http\Middleware\SiteAccess;

use Closure;
use Illuminate\Support\Facades\Log;

class CheckSiteSettings
{
    /**
     * Handle an incoming request.
     * Проверка : заход на сайт, в то время как он "в простое" Если "Да", то редиректни на страницу ошибки.
     * Если "Нет", т.е. сайт работает, "сообщи" следующим middleware, что они выполнили свои проверки.
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $nextCheckNeeded = false;

        if(CheckResult::$passed)
        {
            // 1 Считай настройки сайта из файла
            include 'readSiteSettingsFromFile.php';

            $site_settings = getSiteSettings();

            $request->site_settings = $site_settings;

            $ban = !$site_settings['siteIsOn'];

            if ($ban) {
                Log::info("CheckSiteSettings.php: Попытка зайти на сайт, во время его простоя.");
                return redirect()->route('blank');
            } else {
                $nextCheckNeeded = true;
            }
        }

        CheckResult::$passed = $nextCheckNeeded;

        return $next($request);
    }
}
