<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
//use App\Services\Users\UsersService;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $usersService;

    public function __construct(/*UsersService $usersService*/)
    {
        //$this->usersService = $usersService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        \View::share([
            'userList' => User::paginate(),
        ]);

        return view('admin.users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //$data = $request->getFormData();
        //$this->usersService->storeUser($data);

        $user = new User();

        try {
            $user->fill($request->all())->save();
        } catch (\Throwable $exception) {
            return 'Произошла ошибка при сохранении:'
                . $exception->getMessage(); // @ToDo: прикрутить обработку ошибок и их вывод на экран
        }

        return redirect(route('admin.users.show', $user));
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(User $user)
    {
        return view('admin.users.show', [
            'user' => $user
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('admin.users.edit', [
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //$this->usersService->updateUser($user, $request->all());
        $user->update($request->all());

        return redirect(route('admin.users.show', $user));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        return view(
            'admin.users.destroy',
            [
                'user' => $user
            ]
        );
    }
}
