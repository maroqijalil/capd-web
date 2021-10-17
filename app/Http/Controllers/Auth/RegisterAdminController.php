<?php

namespace App\Http\Controllers\Auth;

use App\Actions\Auth\RegisterAdmin;
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
		$response = RegisterAdmin::run($request->only([
			'email',
			'password',
			'name',
		]));

		if ($response) {
			return redirect()->route('admin.dashboard');
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
