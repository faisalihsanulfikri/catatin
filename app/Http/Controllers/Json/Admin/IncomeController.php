<?php

namespace App\Http\Controllers\Json\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Utilities\Http\Response;
use Carbon\Carbon;
use Log;

use App\Models\Income;
use App\Models\Wealth;

class IncomeController extends Controller
{
  public function summary() 
  {
    $totalIncome = Income::selectRaw('SUM(amount) as total_amount')->where('user_id', $this->userId)->first()->total_amount;
    return (new Response())->setData([
      'totalIncome' => number_format($totalIncome ? $totalIncome : 0),
    ])->send();
  }
  
  public function summaryMonthly() 
  {
    $date = getDateFromMonth(request()->month);

    $incomes = Income::selectRaw('SUM(amount) as total_amount, date')
      ->where('user_id', Auth::user()->getId())
      ->wherebetween("date", [$date->start, $date->end])
      ->groupBy("date")
      ->orderBy("date")
      ->get();

    $totalIncome = $incomes->sum('total_amount');

    return (new Response())->setData([
      'incomes' => $incomes,
      'totalIncome' => number_format($totalIncome),
    ])->send();
  }

  private function getDate()
  {
    $month = request()->month;
    return Carbon::parse(Carbon::now()->format("Y")."-$month-01")->format('Y-m-d');
  }

}