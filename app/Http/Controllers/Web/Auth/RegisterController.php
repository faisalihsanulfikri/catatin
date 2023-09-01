<?php

namespace App\Http\Controllers\Web\Auth;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Web\Auth\RegisterRequest;
use App\Http\Requests\Web\Auth\RegisterPPDBRequest;

use App\Models\Summary\Summary;
use App\Models\User\User;
use App\Models\Parents;

use App\Http\Controllers\Controller;

class RegisterController extends Controller
{

	public function __construct()
	{
		// $this->middleware('guest')->except('auth.logout');
	}

	public function register()
	{
		return redirect()->route("auth.register-ppdb");
		// return view('auth.register');
	}

	public function registerPPDB()
	{
		return view('auth.register-ppdb');
	}

	public function connect(RegisterRequest $request)
	{
		DB::beginTransaction();
		try {
			$user = User::create([
				'name' => $request->get('name'),
				'email' => $request->get('email'),
				'password' => Hash::make($request->get('password')),
				'user_role_id' => 3,
			]);
			DB::commit();
			return redirect()->route("auth.login")
				->with("status", "success")
				->with("message", "Berhasil melakukan registrasi.");
    } catch (\Exception $e) {
      DB::rollback();
      return redirect()->back()
        ->with("status", "failed")
        ->with("message", "Gagal melakukan registrasi " . $e->getMessage());
    }
	}

	public function connectPPDB(RegisterPPDBRequest $request)
	{
		DB::beginTransaction();
		try {
			$user = User::create([
				'name' => $request->get('name'),
				'email' => $request->get('email'),
				'password' => Hash::make($request->get('password')),
				'user_role_id' => 3,
			]);

			Parents::create([
				'name' => $request->get('name'),
				'email' => $request->get('email'),
				'password' => $request->get('password'),
				'phone' => $request->get('phone'),
				'gender' => $request->get('gender'),
				'user_id' => $user->id
			]);

			DB::commit();
			return redirect()->route("auth.login")
				->with("new_register", "true")
				->with("user", $user)
				->with("status", "success")
				->with("message", "Berhasil melakukan registrasi.");
    } catch (\Exception $e) {
      DB::rollback();
      return redirect()->back()
        ->with("status", "failed")
        ->with("message", "Gagal melakukan registrasi " . $e->getMessage());
    }
	}

}
