<?php

namespace App\Http\Controllers\Api\Users;

use App\Http\Controllers\Api\Users\Resources\UserResource;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

/**
 * Class UserController
 * @package App\Http\Controllers\Api\Users
 */
class UserController extends Controller
{
    /**
     * @return UserResource
     */
    public function userinfo(): UserResource
    {
        return new UserResource(Auth::user()->loadMissing('role'));
    }
}
