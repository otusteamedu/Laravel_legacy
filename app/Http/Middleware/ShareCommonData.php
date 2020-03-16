<?php
/**
 * Description of ShareCommonData.php
 * @copyright Copyright (c) MISTER.AM, LLC
 * @author    Egor Gerasimchuk <egor@mister.am>
 */

namespace App\Http\Middleware;

use View;
use Illuminate\Http\Request;

class ShareCommonData
{

    public function handle(Request $request, \Closure $next)
    {
        View::share([
           'locale' => \App::getLocale(),
        ]);
        return $next($request);
    }

}
