<?php

namespace App\Http\Controllers\Web\Admin;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File; 

use App\Models\Classes;
use App\Models\Lesson;
use App\Models\Teacher;
use App\Models\Student;
use App\Models\Evaluation\EvaluationDetail;
use App\Models\Setting;
use App\Models\SchoolYear;

class DashboardController extends Controller
{
  public function index() 
  {
    return view("admin.dashboard.index");
  }

}