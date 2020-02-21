<?php

namespace App\Http\Middleware\SiteAccess;

use App\Services\MobileDetection\Mobile_Detect;
use Closure;
use Illuminate\Support\Facades\Log;
//use Mobile_Detect;

class CheckIfMobileDevice
{
    /**
     * Handle an incoming request.
     * Проверка : заход на сайт с планшета или с компьютера, в то время как сайту указано показываться только на мобильных экранах ?
     * Если "Да", то редиректни на страницу ошибки.
     * Если "Нет", т.е. сайт открыт на мобильном экране, "сообщи" следующим middleware, чтобы они выполнили свои проверки.
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $nextCheckNeeded = false;

        if(CheckResult::$passed)
        {
            // Определи тип браузера
            // См. app/Services/Mobile_Detection
            $detect = new Mobile_Detect();
            $isLargeDevice = !$detect->isMobile();
            $mobileOnly = $request->site_settings['mobileOnly'];

            $ban = $mobileOnly && $isLargeDevice;

            if ($ban) {
                Log::info("CheckIfMobileDevice.php : Попытка зайти на сайт с мобильного устройства, в то время, как это запрещено.");
                return redirect()->route('blank');
            } else {
                $nextCheckNeeded = true;
            }
        }

        CheckResult::$passed = $nextCheckNeeded;

        return $next($request);
    }
}
