<?php

namespace App\Http\Controllers;

use App\Actions\User\GetAllUser;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
	public function index()
	{
		$users = GetAllUser::run();
		return view('dashboard', compact(['users']));
	}

	public function create()
	{
		//
	}

	public function store(Request $request)
	{
		//
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
