<?php

namespace App\Http\Controllers\Web\Auth;

use Illuminate\Http\Request;
use App\Http\Requests\Web\Auth\LoginRequest;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use App\Models\Setting;

class LoginController extends Controller
{
	/*
	|--------------------------------------------------------------------------
	| Login Controller
	|--------------------------------------------------------------------------
	|
	| This controller handles authenticating users for the application and
	| redirecting them to your home screen. The controller uses a trait
	| to conveniently provide its functionality to your applications.
	|
	*/

	use AuthenticatesUsers;

	protected $redirectTo = "/role";

	public function __construct()
	{
		// $this->middleware('guest')->except('auth.logout');
	}

	public function login()
	{
		return view('auth.login');
	}

	public function connect(LoginRequest $request)
	{
		// $this->validateLogin($request);
		if (method_exists($this, 'hasTooManyLoginAttempts') &&
		$this->hasTooManyLoginAttempts($request)) {
			$this->fireLockoutEvent($request);
			return $this->sendLockoutResponse($request);
		}
		if ($this->attemptLogin($request)) {
			return $this->sendLoginResponse($request);
		}
		$this->incrementLoginAttempts($request);
		return $this->sendFailedLoginResponse($request);
	}

	public function logout(Request $request) 
	{
		$this->guard()->logout();
		$request->session()->invalidate();
		return redirect()->route("auth.login");
	}

	public function logoutUserNotActive(Request $request) 
	{
		$this->guard()->logout();
		$request->session()->invalidate();
		return redirect()->route("auth.login")
		->with("status", "danger")
		->with("message", "Akun anda belum aktif, silahkan hubungi admin.");
	}

}
