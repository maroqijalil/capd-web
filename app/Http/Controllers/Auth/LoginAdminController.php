<?php

namespace App\Http\Controllers\Auth;

use App\Actions\Auth\LoginAdmin;
use App\Http\Controllers\Controller;
use Kreait\Firebase\Auth as FbAuth;
use Kreait\Firebase\Firestore;
use Illuminate\Http\Request;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;

class LoginAdminController extends Controller
{
	public function create()
	{
		return view('auth.login');
	}

	public function store(LoginRequest $request)
	{
		$response = LoginAdmin::run(
			$request['email'], 
			$request['password']
		);

		if ($response) {
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
