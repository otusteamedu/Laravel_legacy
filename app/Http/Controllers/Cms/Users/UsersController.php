<?php

namespace App\Http\Controllers\Cms\Users;

use App\Services\Users\UsersService;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use App\Policies\Abilities;
use App\Models\User;
use App\Http\Controllers\Cms\Users\Requests\StoreUserRequest;
use App\Http\Controllers\Cms\Users\Requests\UpdateUserRequest;
use App\Http\Controllers\Cms\Users\Requests\DeleteUserRequest;
/**
 * Class CurrenciesController
 * @package App\Http\Controllers\Cms\Currencies
 */
class UsersController extends Controller
{

    protected $usersService;

    public function __construct(
        UsersService $usersService
    )
    {
        $this->usersService = $usersService;
    }

    /**
     * Вывод списка пользователей
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index(Request $request)
    {
        $this->getCurrentUser()->cant(Abilities::VIEW, User::class);
        $this->authorize(Abilities::VIEW, User::class);
        $search = $request->get('search', '');
        $user = Auth::user();
        if ($user->can('view','users')) {
            echo 111;
        }
        $users = $this->usersService->searchByNameOrEmail($search);
        $levels = $this->usersService->getUserLevels();
        return view('cms.users', ['users' => $users, 'levels' => $levels, 'search' => $search]);
    }

    /**
     * Сохранение страны
     *
     * @param Request $request
     * @return string
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(StoreUserRequest $request): string
    {
        $this->authorize(Abilities::CREATE, User::class);
        try {
            $user = $this->usersService->store($request->all());
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Store error',
                'errors' => [[ $e->getMessage() ]],
            ], 400)->send();
        }
        return response()->json($user,200)->send();
    }

    /**
     * Изменение страны
     *
     * @param Request $request
     * @return string
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(UpdateUserRequest $request): string
    {
        $this->authorize(Abilities::UPDATE, User::class);
        $id = (int)$request->get('id', 0);
        try {
            $user = $this->usersService->update($id, $request->all());
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Update error',
                'errors' => [[ $e->getMessage() ]],
            ], 400)->send();
        }
        return json_encode($user);
    }


    /**
     * Удаление страны
     *
     * @param Request $request
     * @return string
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function delete(DeleteUserRequest $request): string
    {
        $this->authorize(Abilities::DELETE, User::class);
        $id = $request->get('id');
        try {
            $this->usersService->delete($id);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Delete error',
                'errors' => [[ $e->getMessage() ]],
            ], 400)->send();
        }
        return json_encode([]);
    }

    /**
     * @return \App\Models\User|null
     */
    private function getCurrentUser()
    {
        return \Auth::user();
    }
}
