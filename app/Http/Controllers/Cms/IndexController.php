<?php

namespace App\Http\Controllers\Cms;

use App\Policies\Abilities;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        if (\Auth::user()->cant(Abilities::CMS)) {
            abort(403);
        }

        return view('cms.index');
    }
}
