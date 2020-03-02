<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Requests\CreateUserRequest;
use App\Http\Controllers\Admin\Requests\UpdateUserRequest;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\Admin\Users\UsersService;
use App\Services\Cache\Users\UsersCacheService;
use Illuminate\Http\Request;

/**
 * Class UsersController
 * @package App\Http\Controllers\Admin
 */
class UsersController extends Controller
{

    /**
     * @var UsersService
     */
    private $usersService;

    /**
     * @var UsersCacheService
     */
    private $usersCacheService;

    /**
     * Get user list
     *
     * UsersController constructor.
     * @param UsersService $usersService
     * @param UsersCacheService $usersCacheService
     */
    public function __construct(
        UsersService $usersService,
        UsersCacheService $usersCacheService
    )
    {
        $this->usersService = $usersService;
        $this->usersCacheService = $usersCacheService;
    }


    /**
     * Возвращает список пользователей в формате json с пагинацией
     *
     * @return string
     */
    public function index()
    {
        $cachedData = $this->usersCacheService->getUserListFromCache();
        if ($cachedData) {
            return $cachedData;
        }

        $data = $this->usersService->getUsersList();
        $this->usersCacheService->putUsersListToCache($data);
        return $data->toJson();
    }


    /**
     * @param int $id
     * @return mixed
     */
    public function getUser(int $id)
    {
        $cachedData = $this->usersCacheService->getUserDataFromCache($id);
        if ($cachedData) {
            return $cachedData;
        } else {
            $data = $this->usersService->getUserById($id);
            return $data->toJson();
        }
    }


    /**
     * @param CreateUserRequest $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function create(CreateUserRequest $request)
    {
        $data = $request->getData();
        $userId = $this->usersService->createUser($data);

        return response([
            'success' => true,
            'id' => $userId
        ], 200);
    }


    /**
     * @param UpdateUserRequest $request
     * @param User $user
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $data = $request->getData();
        $result = $this->usersService->updateUserData($user, $data);
        return $result ? response('Success', 200) : response('Unsuccess', 400);
    }
}
