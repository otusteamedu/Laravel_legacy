<?php

namespace App\Http\Controllers;

use App\User;

class SessionsController extends Controller
{
	public function __construct()
	{
		$this->middleware('guest', ['except' => 'destroy']);
	}

	public function create()
	{
		return view('sessions.create');
	}

	public function store()
	{
		if (! auth()->attempt(request(['email', 'password']))) {
			return back()->withErrors('Некорректный логин или пароль');
		}
		if ( auth()->user()->status != User::STATUS_ACCEPTED) {
			auth()->logout();
			return back()->withErrors('Пользователь не подтвержден');
		}
		return redirect()->home();
	}

	public function destroy()
	{
		auth()->logout();

		return redirect()->home();
	}
}
