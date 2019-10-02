<?php

namespace App\Http\Controllers\Admin\UserManagment;

use App\User;
use App\Models\Admin\UserManagment\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $user = User::paginate(10);
//        $user->load(['roles']);
//        return $user;
        return view('admin.user_managment.users.index', [
            'users' => User::paginate(10),
            'roles' => Role::get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user_managment.users.create', [
            'user' => [],
            'roles' => Role::get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

//        return $request;
        $validator = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phone'=>['required', 'string', 'max:255'],
        ]);

        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'phone' => $request['phone'],
            'password' => Hash::make($request['password']),
        ]);

        //Roles
        if ($request->input('roles')):
            $user->roles()->attach($request->input('roles'));
        endif;

        return redirect()->route('admin.user_managment.users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //return $user;
        return view('admin.user_managment.users.edit', [
            'user' => $user,
            'roles' => Role::get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $validator = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                \Illuminate\Validation\Rule::unique('users')->ignore($user->id),
            ],
            'phone'=>['required', 'string', 'max:255'],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ]);

        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->phone = $request['phone'];
        $request['password'] == null ?: $user->password = Hash::make($request['password']);
        $user->save();

        //Rples
        $user->roles()->detach();
        if ($request->input('roles')):
            $user->roles()->attach($request->input('roles'));
        endif;

        return redirect()->route('admin.user_managment.users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {

        $user->roles()->detach();
        $user->delete();
        return redirect()->route('admin.user_managment.users.index');
    }
}
