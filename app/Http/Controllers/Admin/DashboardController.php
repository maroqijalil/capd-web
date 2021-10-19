<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Liquid\GetAllLiquid;
use App\Actions\User\GetAllUser;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
	public function index(Request $request)
	{
		$users = $this->makePagination($request, GetAllUser::run(), 15);
		$liquids = GetAllLiquid::run();
		return view('dashboard', compact(['users', 'liquids']));
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
