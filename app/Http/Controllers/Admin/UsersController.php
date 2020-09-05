<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserGroup;
use Illuminate\Http\Request;
use Illuminate\Contracts\Support\Renderable;

class UsersController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(User::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Renderable
     */
    public function index()
    {
        $userGroups = UserGroup::all(['id', 'title']);
        $groupList = [];
        foreach ($userGroups as $group) {
            $groupList[$group->id] = $group->title;
        }
        $users = User::orderByDesc('id')->paginate(20);

        return view('admin.users-list', ['users' => $users, 'groupList' => $groupList]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $userId = $request->id;
        try {
            $user = User::updateOrCreate(['id' => $userId], $data);
            \Session::flash('alert-success', sprintf('Пользователь #%d успешно %s', $user->id, $request->id ? 'отредактирован' : 'создан'));
        } catch (\Exception $e) {
            \Session::flash('alert-danger', sprintf('Возникла ошибка при %s пользователя: %s', $request->id ? 'редактировании': 'создании', $e->getMessage()));
        }
        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(User $user)
    {
        return response()->json($user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit(User $user)
    {
        return response()->json($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(User $user)
    {
        try {
            $id = $user->id;
            $user->delete();
            \Session::flash('alert-success', sprintf('Поьзователь #%d успешно удален', $id));
        } catch (\Exception $e) {
            \Session::flash('alert-danger', sprintf('Возникла ошибка при удалении пользователя #%d: %s', $id, $e->getMessage()));
        }
        return redirect()->route('users.index');
    }
}
