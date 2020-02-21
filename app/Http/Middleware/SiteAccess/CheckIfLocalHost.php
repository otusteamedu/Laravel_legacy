<?php

namespace App\Http\Middleware\SiteAccess;

use Closure;
use Illuminate\Support\Facades\Log;

class CheckIfLocalHost
{
    /**
     * Handle an incoming request.
     * Проверка: Если в .env указал, что на сайте нужно применять настройки,
     * и сайт НЕ используется в режиме локальной разработки, это значит, что
     * сайт в продакшене, и соот-но нужно запустить цепочку проверок входящих запросов.
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $siteFiltersOn = env('SITE_FILTERS_ON'); // фильтрация включена ?
        $isLocalHost = env('APP_ENV')=='local_ABC';  // среда локальная ?

        $nextCheckNeeded = $siteFiltersOn && (!$isLocalHost);
        // если true - нужно будет пройти проверку в следующем middleware
        // если false - следующий middleware не будет проверять и передаст следующему middleware,
        // которые тоже просто пропустят запрос дальше.
        // БЫЛО
        // $request->checkNeeded = $nextCheckNeeded;
        // СТАЛО
        // StoreValue::set($nextCheckNeeded);
        CheckResult::$passed = $nextCheckNeeded;
        return $next($request);
    }
}
