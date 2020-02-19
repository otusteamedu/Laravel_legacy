<?php

namespace App\Http\Controllers;

use App\Http\Controllers\CMS\Users\Requests\UpdateProfileRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;

class PagesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view("pages.index");
    }

    /**
     * Покажи товарный каталог.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function katalog()
    {
        $message = "Пользователь зашёл в каталог.";
        Log::info($message);
        //Log::channel('daily')->info($message);
        return view("pages.katalog");
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function profile()
    {
        $user = Auth::user();
        //$userType = "рядовой пользователь";
        if ($user != null) {
            $userType = __('messages.users.levels.ordinary');
            if ($user->level == User::LEVEL_ADMIN) {
                $userType = __('messages.users.levels.admin');
            }
        }

        $data =
            [
                'user' => $user,
                'userType' => $userType,
            ];

        return view('pages/profile', $data);
    }

    /**
     * Show blank page.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function blank()
    {
        return view("pages.blank");
    }
}
