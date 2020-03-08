<?php

namespace App\Http\Controllers\Cms;

use App\Policies\Abilities;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class IndexController extends Controller
{
    use CurrentUser;
    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @return Factory|View
     */
    public function __invoke(Request $request)
    {
        if (\Auth::user()->cant(Abilities::CMS)) {
            Log::notice(
                __('log.notice.accessDeniedCMS'),
                [
                    'user' => $this->getCurrentUser()->id,
                    'name' => $this->getCurrentUser()->name,
                    'page' => $request->url(),
                ]
            );
            abort(404);
        }

        return view('cms.index');
    }
}
