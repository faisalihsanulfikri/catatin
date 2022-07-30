<?php

namespace App\Http\Controllers\Json\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Utilities\Http\Response;
use Carbon\Carbon;
use Log;

use App\Models\Expenditure;
use App\Models\Wealth;

class ExpenditureController extends Controller
{
  public function summaryMonthly() 
  {
    $firstDate = Carbon::now()->format("Y-m")."-01";
    $endDate = Carbon::now()->endOfMonth()->format("Y-m-d");

    $expenditures = Expenditure::selectRaw('SUM(amount) as total_amount, date')
      ->where('user_id', Auth::user()->getId())
      ->wherebetween("date", [$firstDate, $endDate])
      ->groupBy("date")
      ->orderBy("date")
      ->get();

    $totalExpenditure = $expenditures->sum('total_amount');

    return (new Response())->setData([
      'expenditures' => $expenditures,
      'totalExpenditure' => number_format($totalExpenditure),
    ])->send();
  }

}