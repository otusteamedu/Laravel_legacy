<?php

namespace Sdav\ActivityLog\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Sdav\ActivityLog\Models\ActivityLog as Log;
use Illuminate\Http\Response;

/**
 * Посредник записывающий действия пользователя в базу(table activity_log)
 *
 * Class ActivityLog
 * @package Sdav\ActivityLog\Middleware
 */
class ActivityLog
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        return $next($request);
    }

    public function terminate(Request $request, $response)
    {
        $endTime = microtime(true);
        $log = new Log();
        $log->duration = number_format($endTime - LARAVEL_START, 3);
        $log->ip = $request->ip();
        $log->url = $request->fullUrl();
        $log->status = $response->getStatusCode();
        $log->user_id = \Auth::id();
        $log->method = $request->method();
        $log->agent = $request->header('user-agent');
        $log->params = $request->getContent();
        $log->save();

    }
}
