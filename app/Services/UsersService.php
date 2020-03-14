<?php


namespace App\Services;

use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;

class UsersService
{
    protected $userRepository;

    public function __construct
    (
        UserRepository $userRepository
    )
    {
        $this->userRepository = $userRepository;
    }

    /**
     * User registration
     *
     * @param $data
     * @return mixed
     */
    public function register($data)
    {
        return $this->userRepository->register([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);
    }

    /**
     * User password update
     *
     * @param $data
     * @return \Illuminate\Http\JsonResponse
     */
    public function passwordUpdate($data)
    {
        if (Hash::check($data['old_password'], auth()->user()->password)) {
            if($this->userRepository->passwordUpdate(auth()->user(), Hash::make($data['new_password']))){
                return response()->json(['message' => 'Password update success'], 200);
            };
        } else {
            return response()->json(['message' => 'Wrong password'], 422);
        }
    }
}