<?php

namespace App\Http\Middleware\Auth;

use App\Providers\RouteServiceProvider;
use Closure;

class RedirectIfAuthenticated
{
	public function handle($request, Closure $next)
	{
    $uid = $request->session()->get('user_id');

		if ($uid) {
			return redirect(RouteServiceProvider::HOME);
		} else {
			return $next($request);
		}
	}
}
