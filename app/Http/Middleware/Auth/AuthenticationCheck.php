<?php

namespace App\Http\Middleware\Auth;

use Closure;
use Illuminate\Http\Request;

class AuthenticationCheck
{
	public function handle(Request $request, Closure $next)
	{
		$uid = $request->session()->get('user_id');
		
		if (!$uid) {
			return redirect()->route('admin.login');
		} else {
			return $next($request);
		}
	}
}
