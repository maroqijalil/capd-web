<?php

namespace App\Http\Controllers\User;

use App\Actions\Replacement\GetAllReplacementDetail;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
	public function index()
	{
		//
	}

	public function create()
	{
		//
	}

	public function store(Request $request)
	{
		//
	}

	public function show(Request $request, $id)
	{
		$replacements = $this->makePagination($request, GetAllReplacementDetail::run($id), 10);
		return view('user.dashboard', compact(['replacements']));
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
