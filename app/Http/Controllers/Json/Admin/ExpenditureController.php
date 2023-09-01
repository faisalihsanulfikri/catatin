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
  public function summary() 
  {
    $totalExpenditure = Expenditure::selectRaw('SUM(amount) as total_amount')->where('user_id', $this->userId)->first()->total_amount;
    return (new Response())->setData([
      'totalExpenditure' => number_format($totalExpenditure ? $totalExpenditure : 0),
    ])->send();
  }

  public function summaryMonthly() 
  {
    $date = $this->getDate();
    $firstDate = Carbon::parse($date)->format("Y-m")."-01";
    $endDate = Carbon::parse($date)->endOfMonth()->format("Y-m-d");

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

  private function getDate()
  {
    $month = request()->month;
    return Carbon::parse(Carbon::now()->format("Y")."-$month-01")->format('Y-m-d');
  }

}