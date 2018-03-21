<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\User;

class UserController extends Controller
{

	public function __construct()
	{
		$this->middleware('auth');
	}

	public function edit(User $user)
	{
		$user = Auth::user();

		return view('auth.edit', compact('user'));
	}

	public function update(User $user)
	{

		$this->validate(request(), [
			'name' => 'required',
			'email' => 'required',
			'password' => 'required|min:6|confirmed'
		]);

		$user->name = request('name');
		$user->email = request('email');
		$user->gender = request('gender');
		$user->password = bcrypt(request('password'));

		$user->save();

		return back();
	}
}