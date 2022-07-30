<?php

namespace App\Http\Controllers\Json\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Utilities\Http\Response;
use Carbon\Carbon;
use Log;

use App\Models\Wealth;

class WealthController extends Controller
{
  public function summary() 
  {
    $wealth = Wealth::where('user_id', Auth::user()->getId())->first();
    if ($wealth) return (new Response())->setData($wealth)->send();
    return (new Response())->notFound()->send();
  }
}