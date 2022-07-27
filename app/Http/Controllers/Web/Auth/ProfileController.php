<?php

namespace App\Http\Controllers\Web\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Log;

use App\Models\User\User;
use App\Models\Teacher;
use App\Models\Parents;
use App\Models\Student;

class ProfileController extends Controller
{
  public function password() 
  { 
    return view("auth.password");
  }

  public function updatePassword(Request $request) 
  { 
    DB::beginTransaction();
    try {
      User::where('id', Auth::user()->getId())->update(['password' => Hash::make($request->get('password'))]);
      
      if (Auth::user()->getRoleId() == 2) {
        Teacher::where('id', Auth::user()->getTeacherId())->update(['password' => $request->get('password')]);
      }
      elseif (Auth::user()->getRoleId() == 3) {
        Parents::where('id', Auth::user()->getParentId())->update(['password' => $request->get('password')]);
      }
      elseif (Auth::user()->getRoleId() == 4) {
        Student::where('id', Auth::user()->getStudentId())->update(['password' => $request->get('password')]);
      }
      
      DB::commit();
      return redirect()->route("auth.password-change")
      ->with("status", "success")
      ->with("message", "Berhasil mengubah password. Silahkan login kembali untuk menggunakan password baru.");
    } catch (\Throwable $th) {
      DB::rollback();
      Log::error($th->getMessage());
      Log::error($th->getTraceAsString());
      return redirect()->route("auth.password-change")
      ->with("status", "danger")
      ->with("message", "Artikel tidak ditemukan.");
    }

  }
}