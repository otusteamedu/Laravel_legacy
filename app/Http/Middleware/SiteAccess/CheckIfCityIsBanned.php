<?php

namespace App\Http\Middleware\SiteAccess;

use App\Services\CityByIpResolver\CityByIpResolver;
use Closure;
use Illuminate\Support\Facades\Log;

class CheckIfCityIsBanned
{
    /**
     * Handle an incoming request.
     * Проверка : заход на сайт c ip, который относится к списку запрещённых городов ?
     * Если "Да", то редиректни на страницу ошибки.
     * Если "Нет", т.е. заход на сайт из не запрещённого города, "сообщи" следующим middleware, чтобы они выполнили свои проверки.
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $nextCheckNeeded = false;

        if(CheckResult::$passed)
        {
            // фильтрация по ip локации

            // 1 Определи ip посетителя
            $ip = $_SERVER['REMOTE_ADDR'];

            // 2 определи город посетителя
            $city = CityByIpResolver::getCityFromIP($ip);

            $banned_cities = config('shop.banned_cities');

            $isBannedCity = in_array($city, $banned_cities);

            $filterIp = $request->site_settings['filterIp'];

            $ban = $filterIp && $isBannedCity;

            if ($ban) {
                Log::info("CheckIfCityIsBanned.php : Попытка зайти на сайт с запрещённого города.");
                return redirect()->route('blank');
            }
            else{
                $nextCheckNeeded = true;
            }
        }

        // если внутри предыдущих посредников, не будет редиректа на страницу ошибки,
        // значит все проверки пройдены и можно спокойно передавать запрос дальше,
        // уже Laravel'овским посредникам
        return $next($request);
    }
}
