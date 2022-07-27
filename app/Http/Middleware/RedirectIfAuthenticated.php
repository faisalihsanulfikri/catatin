<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            $role = Auth::user()->getRoleType();
            if ($role == "superadmin" || $role == "admin") {
                return redirect()->route("admin.dashboard.index");
            }
            return redirect()->route("auth.login");
        }

        return $next($request);
    }
}
