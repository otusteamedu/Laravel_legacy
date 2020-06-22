<?php

namespace App\Http\Controllers\Api\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\Users\Requests\PasswordUpdateUserRequest;
use App\Http\Controllers\Api\Users\Requests\StoreUserRequest;
use App\Models\User;
use App\Services\Users\UsersService;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\Users\Requests\UpdateUserRequest;


class UsersController extends Controller
{
    protected $usersService;

    public function __construct(UsersService $usersService)
    {
        $this->usersService = $usersService;
    }

    public function getPassportToken(Request $request)
    {
        $email = $request->get('email') ?? '';
        $password = $request->get('password') ?? '';

        if (\Auth::guard('web')->attempt(['email' => $email, 'password' => $password])) {
            $user = User::where('email', $email)
                ->first();

            if (!empty($user)) {
                $token = $user->createToken('Passport token', ['event.read', 'event.write'])->accessToken;

                return response()->json(['api_token' => $token], 200);
            }
        }

        return response()->json('Invalid auth data', 400);
    }

    public function register(StoreUserRequest $request)
    {
        try {
            $storedResult = $this->usersService->storeUser($request->getFormData());
        } catch (\Exception $exception) {
            return response()->json($exception->getMessage(), 400);
        }

        if (empty($storedResult['errors'])) {
            return response()->json($storedResult, 201);
        } else {
            return response()->json($storedResult, 400);
        }
    }

    public function logout()
    {
        try {
            auth()->user()->token()->revoke();
        } catch (\Exception $exception) {
            return response()->json($exception->getMessage(), 400);
        }

        return response()->json(['message' => 'User logged out successfully'], 200);
    }

    public function show()
    {
        try {
            $user = auth()->user();
        } catch (\Exception $exception) {
            return response()->json($exception->getMessage(), 400);
        }

        return response()->json($user, 200);
    }

    public function getEmail()
    {
        try {
            $email = auth()->user()->email;
        } catch (\Exception $exception) {
            return response()->json($exception->getMessage(), 400);
        }

        return response()->json(['email' => $email], 200);
    }

    public function getPhone()
    {
        try {
            $phone = auth()->user()->phone;
        } catch (\Exception $exception) {
            return response()->json($exception->getMessage(), 400);
        }

        return response()->json(['phone' => $phone], 200);
    }

    public function update(UpdateUserRequest $request)
    {
        try {
            $user = auth()->user();
            $this->usersService->updateUser($user, $request->getFormData());
        } catch (\Exception $exception) {
            return response()->json($exception->getMessage(), 400);
        }

        return response()->json($user, 200);
    }
}
