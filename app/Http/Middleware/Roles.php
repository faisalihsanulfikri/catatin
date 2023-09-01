<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Roles 
{

	public function handle($request, Closure $next, ...$roles) 
	{
		$userRoleId = Auth::user()->getRoleId();
		if (Auth::check() && in_array($userRoleId, $roles)) {
			if (in_array($userRoleId, [2,3,4])) {
				// $hasActive = Auth::user()->hasActive();
				// if ($hasActive) {
				// } 
				return $next($request);
			} else {
				return $next($request);
			}
		} 
		return abort(401);
	}

}