<?php

namespace App\Http\Middleware\SiteAccess;

use Closure;
use Illuminate\Support\Facades\Log;

class CheckIfSearchBot
{
    /**
     * Handle an incoming request.
     * Проверь : на сайт зашёл поисковый бот ? Если "Да", то "сообщи" следующим middleware, что не нужно выполнять
     * никаких проверок. Для этого назначь $request->checkNeeded = false
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $nextCheckNeeded = false;

        if($request->checkNeeded)
        {
            // 1 Определи ip посетителя
            $ip = $_SERVER['REMOTE_ADDR'];

            // 2 Проверка : это бот или нет
            include 'isBotIP.php';

            $isBot = isBotIP($ip);

            if($isBot)
            {
                // это поисковый бот
                // последующие проверки не нужны
                $nextCheckNeeded = false;
                // но залогируй его визит в terminate() или сразу здесь
                Log::info("CheckIfSearchBot.php : На сайт зашёл поисковый бот.");
            }
            else
            {
                // это не поисковый бот
                $nextCheckNeeded = true;
            }
        }

        $request->checkNeeded = $nextCheckNeeded;
        return $next($request);
    }
}
