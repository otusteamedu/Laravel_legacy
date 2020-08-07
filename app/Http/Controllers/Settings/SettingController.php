<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

/**
 * Class SettingController
 * @package App\Http\Controllers\Settings
 */
class SettingController extends Controller
{
    /**
     * @return View
     */
    public function passport(): View
    {
        return view('api/passport/index');
    }
}
