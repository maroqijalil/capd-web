<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
  use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

  public function makePagination(Request $request, $datas, $per_page)
  {
    $total = count($datas);
    $current_page = $request->input("page") ?? 1;
    $starting_point = ($current_page * $per_page) - $per_page;
    $array = array_slice($datas, $starting_point, $per_page, true);

    $array = new LengthAwarePaginator($array, $total, $per_page, $current_page, [
      'path' => $request->url(),
      'query' => $request->query(),
    ]);

    return $array;
  }
}
