<?php
/**
 * Description of ShareCommonData.php
 * @copyright Copyright (c) MISTER.AM, LLC
 * @author    Egor Gerasimchuk <egor@mister.am>
 */

namespace App\Http\Middleware;

use App\Services\Pages\PagesService;
use View;
use Illuminate\Http\Request;

class ShareCommonData
{
    private $pagesService;

    public function __construct(
        PagesService $pagesService
    ) {
        $this->pagesService = $pagesService;
    }

    public function handle(Request $request, \Closure $next, ?string $name)
    {
        View::share([
           'locale' => \App::getLocale(),
           'name' => $name,
           //'pages' => $this->pagesService->searchCountriesWithCities(),
        ]);
        return $next($request);
    }


    public function terminate()
    {
        \Log::debug('terminate');
    }
}