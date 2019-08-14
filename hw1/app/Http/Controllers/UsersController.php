<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Mail\UserStatusUpdated;

class UsersController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
		$this->middleware('manager');
	}

	public function index()
	{
		$users = User::latest()->get();
		return view('users.index', compact('users'));
	}

	public function show(User $user)
	{
		return view('users.show', compact('user'));
	}

	public function edit(User $user) {
		$statusList = User::statusList();
		return view('users.edit', compact('user', 'statusList'));
	}

	public function update(User $user, Request $request)
	{
		$this->validate(request(), [
			'name' => 'required',
			'phone' => 'required',
			'email' => 'required',
			'company' => 'required',
			'status' => 'required',
		]);

		/**
		 * update fields this way, so we know, which field is 'dirty'
		 */
		$user->name = request('name');
		$user->phone = request('phone');
		$user->email = request('email');
		$user->company = request('company');
		$user->status = request('status');

		// send email only if status was updated
		if ($user->isDirty('status')) {
			$password = '';
			if (request('status') == User::STATUS_ACCEPTED) {
				$password = substr(md5(rand()), 0, 7);
				$user->password = bcrypt($password);
			}

			if (request('status') != User::STATUS_NEW)
				\Mail::to($user)->send(new UserStatusUpdated($user, $password));
		}

		$user->save();

		session()->flash('flash_message', 'Данные пользователя обновлены!');

		return redirect('/users/' . $user->id);
	}

    public function destroy(User $user)
    {
        $user->delete();

        session()->flash('flash_message', 'Пользователь успешно удален!');

        return redirect('/users/');
    }
}
