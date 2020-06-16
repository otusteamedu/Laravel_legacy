<?php

namespace App\Http\Middleware;

use App\Models\Group;
use App\Services\Locale\Data\LocaleData;
use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class ShareCommon
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
        view()->share([
            'currentPage' => $request->path() == '/' ? 'overview' : $request->path(),
            'currentUrl' => $request->getRequestUri(),
            'locales' => LocaleData::LOCALES,
            'currentLocale' => App::getLocale(),
            'user' => Auth::check() ? Auth::user()->toArray() : [],
            'isClient' => Auth::check() && in_array(Auth::user()->group_id, Group::CLIENTS),
            'isAdmin' => Auth::check() && Auth::user()->group_id === Group::STAFF_ADMIN,
        ]);
        return $next($request);
    }
}
