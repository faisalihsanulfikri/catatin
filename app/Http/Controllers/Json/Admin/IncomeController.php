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
  public function summaryMonthly() 
  {
    $date = $this->getDate();
    $firstDate = Carbon::parse($date)->format("Y-m")."-01";
    $endDate = Carbon::parse($date)->endOfMonth()->format("Y-m-d");

    $incomes = Income::selectRaw('SUM(amount) as total_amount, date')
      ->where('user_id', Auth::user()->getId())
      ->wherebetween("date", [$firstDate, $endDate])
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