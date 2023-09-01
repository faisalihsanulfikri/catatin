<?php

namespace App\Http\Controllers\Web\Admin;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File; 
use Illuminate\Support\Facades\Hash;
use Log;

use App\Models\Admission;
use App\Models\User\User;
use App\Models\Student;
use App\Models\Evaluation\EvaluationDetail;
use Illuminate\Support\Facades\DB;

class AdmissionController extends Controller
{
  public function index() 
  {
    return view("admin.admission.index");
  }

  public function edit(Admission $admission)
  {
    if (isset($admission)) {
      $data['admission'] = $admission;
      return view("admin.admission.edit", $data);
    }

    return redirect()->route("admin.admission.index")
    ->with("status", "danger")
    ->with("message", "Siswa tidak ditemukan.");
  }

}