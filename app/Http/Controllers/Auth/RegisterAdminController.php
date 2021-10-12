<?php

namespace App\Http\Controllers\Auth;

use Kreait\Firebase\Auth as FbAuth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Auth\RegisterRequest;

class RegisterAdminController extends Controller
{
	protected $auth;

	public function __construct(FbAuth $auth)
	{
		$this->auth = $auth;
	}

	public function create()
	{
		return view('auth.register');
	}

	public function store(RegisterRequest $request)
	{
		$result = $this->auth->signInWithEmailAndPassword(
			$request['email'],
			$request['password']
		);

		if ($result) {
			return redirect()->route('dashboard');
		}
	}

	public function show($id)
	{
		//
	}

	public function edit($id)
	{
		//
	}

	public function update(Request $request, $id)
	{
		//
	}

	public function destroy($id)
	{
		//
	}
}
