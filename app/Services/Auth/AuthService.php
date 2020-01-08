<?php


namespace App\Services\Auth;


use App\Services\Auth\Handlers\RegisterUserHandler;
use App\Services\Auth\Repositories\AuthRepository;
use Illuminate\Support\Facades\Auth;

/**
 * Class AuthService
 * @package App\Services\Auth
 */
class AuthService
{

    /**
     * @var AuthRepository
     */
    private $authRepository;
    /**
     * @var RegisterUserHandler
     */
    private $registerUserHandler;

    /**
     * AuthService constructor.
     * @param RegisterUserHandler $registerUserHandler
     */
    public function __construct(
        RegisterUserHandler $registerUserHandler,
        AuthRepository $authRepository
    )
    {
        $this->registerUserHandler = $registerUserHandler;
        $this->authRepository = $authRepository;
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

    /**
     * Для получения фронтом данных пользователя
     * todo возможно, стоит возвращать меньше данных
     *
     * @return \App\Models\User
     */
    public function getUser()
    {
        $id = Auth::user()->id;
        return $this->authRepository->getUser($id);
    }
}
