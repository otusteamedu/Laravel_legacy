<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;

class UserController extends Controller
{
    ////////////////////////// Добавил для паттерна Репозиторий
    protected $user;

    /**
     * UserController constructor.
     *
     * @param UserRepositoryInterface $user
     */
    public function __construct(UserRepositoryInterface $user)
    {
        $this->user = $user;
    }
    /////////////////////////////////////////////////////////////
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        // было
        // $users = User::all();
        // стало
        $users = $this->user->all();

        return view('pages.admin.index')->withUsers($users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        //dd("Готов показать форму создания нового пользователя.");
        return view('pages.admin.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param StoreUserRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(StoreUserRequest $request)
    {
        $data=$request->all();
        $data=Arr::except($data,['_token']);
        // было
        // User::create($data);
        // стало
        $users = $this->user->store($data);
        return redirect('/users/');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return Response
     */
    public function show(User $user)
    {
        // Использую model binding. Вместо id получаю сразу user'a.
        return view('pages.admin.show')->withUser($user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return Response
     */
    public function edit(User $user)
    {
        return view('pages.admin.edit')->withUser($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUserRequest  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        // входящий запрос валидный
        // $requestValidated = $request->validated();

        /* было
        $user->source = request('source');
        $user->type = request('type');
        $user->operator = request('operator');
        $user->name = request('name');
        $user->phone = request('phone');
        $user->email = request('email');
        $user->address = request('address');
        //dd( "комментарий : [".request('comments')."]");
        $user->comments = request('comments');
        $user->save();*/

        // стало
        $data = [
            'source' => request('source'),
            'type' => request('type'),
            'operator' => request('operator'),
            'name' => request('name'),
            'phone' => request('phone'),
            'email' => request('email'),
            'address' => request('address'),
            'comments' => request('comments'),
        ];
        $this->user->update($user->id,$data);
        return redirect('/users/'.$user->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\User $user
     * @return Response
     * @throws \Exception
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect('/users/');
    }
}
