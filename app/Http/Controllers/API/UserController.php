<?php


namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\UsersService;
use App\Helpers\JsonResponseHelper;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;

class UserController extends Controller
{
    protected $usersService;

    public function __construct
    (
        UsersService $usersService
    )
    {
        $this->usersService = $usersService;
    }

    /**
     * User registration
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|unique:users,email|max:255',
            'password' => 'required|max:255|confirmed',
        ]);

        return JsonResponseHelper::getResponseWithHeaders($this->usersService->register($request->all()), 201);
    }

    /**
     * User logout
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->user()->token()->revoke();

        return JsonResponseHelper::getResponseWithHeaders(['message' => 'User logout success'], 200);
    }

    /**
     * Get user information
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUser()
    {
        return JsonResponseHelper::getResponseWithHeaders(new UserResource(auth()->user()), 200);
    }

    /**
     * User password update
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function passwordUpdate(Request $request)
    {
        $this->validate($request, [
            'old_password' => 'required|max:255',
            'new_password' => 'required|max:255',
        ]);

        $data = $request->all();

        if($data['old_password'] === $data['new_password']) {
            return response(['message'=> 'New password must be different from old'], 422);
        }

        return $this->usersService->passwordUpdate($data);
    }
}