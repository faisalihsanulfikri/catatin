<?php

namespace App\Http\Controllers\Web\Admin;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File; 

class SummaryController extends Controller
{
  public function index() 
  {
    return view("admin.summary.index");
  }

}