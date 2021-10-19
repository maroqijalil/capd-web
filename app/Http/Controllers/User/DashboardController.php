<?php

namespace App\Http\Controllers\User;

use App\Actions\Replacement\GetAllReplacementDetail;
use App\Actions\Replacement\GetReplacementDatasForChart;
use App\Actions\Replacement\GetTodayReplacementDetail;
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
		$user_id = $id;
		$replacements = GetAllReplacementDetail::run($id, 5);
		$todays_replacement = GetTodayReplacementDetail::run($id);
		$chart_datas = GetReplacementDatasForChart::run($id);

		return view(
			'user.dashboard',
			compact([
				'replacements',
				'todays_replacement',
				'chart_datas',
				'user_id'
			])
		);
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
