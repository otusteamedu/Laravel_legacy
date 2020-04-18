<?php

namespace App\Http\Middleware;

use App\Http\Services\Localize\LocalizeFacade;
use Closure;
use Illuminate\Support\Facades\App;

class LocalizeMiddleware
{
    
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $localPrefix = LocalizeFacade::localizePrefix();
        if(!empty($localPrefix)){
            App::setLocale($localPrefix);
        }
        return $next($request);
    }
}
