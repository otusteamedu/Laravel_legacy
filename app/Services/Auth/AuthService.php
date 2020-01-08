<?php


namespace App\Services\Auth;


use App\Services\Auth\Handlers\RegisterUserHandler;

/**
 * Class AuthService
 * @package App\Services\Auth
 */
class AuthService
{
    /**
     * @var RegisterUserHandler
     */
    private $registerUserHandler;

    /**
     * AuthService constructor.
     * @param RegisterUserHandler $registerUserHandler
     */
    public function __construct(RegisterUserHandler $registerUserHandler)
    {
        $this->registerUserHandler = $registerUserHandler;
    }


    /**
     * @param $data
     * @return \App\Models\User
     */
    public function registerNewUser($data)
    {
        return $this->registerUserHandler->handle($data);
    }

    /**
     * @param array $credentials
     * @return bool
     */
    public function getApiToken(array $credentials)
    {
        return auth()->attempt($credentials);
    }

    /**
     *
     */
    public function logout()
    {
        auth()->logout();
    }

    /**
     * @return mixed
     */
    public function refreshToken()
    {
        return auth()->refresh();
    }
}
