<?php
/**
 * Description of ShareCommonData.php
 */

namespace App\Http\Middleware;

use View;
use Illuminate\Http\Request;

class ShareCommonData
{
    private $locales = [
        'en',
        'ru',
    ];

    public function handle(Request $request, \Closure $next)
    {
        $locale =  $request->route()->parameter('locale');
        if (in_array($locale, $this->locales)) {
            \App::setLocale($locale);
        }
        View::share([
           'locale' => \App::getLocale(),
        ]);
        return $next($request);
    }

}
