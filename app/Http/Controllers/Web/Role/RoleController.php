<?php

namespace App\Http\Controllers\Web\Role;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{
  public function redirect() 
  {
    $role = Auth::user()->getRoleType();
    $hasActive = Auth::user()->hasActive();

    if ($role == "administrator") {
      return redirect()->route("admin.dashboard.index");
    }
    if ($role == "guru") {
      if ($hasActive) {
        return redirect()->route("teacher.dashboard.index");
      } else {
        return redirect()->route("auth.logout.user.not.active");
      }
    }
    if ($role == "wali") {
      if ($hasActive) {
        return redirect()->route("parent.dashboard.index");
      } else {
        return redirect()->route("auth.logout.user.not.active");
      }
    }
    if ($role == "siswa") {
      if ($hasActive) {
        return redirect()->route("student.dashboard.index");
      } else {
        return redirect()->route("auth.logout.user.not.active");
      }
    }
    return abort(401);
  }

}