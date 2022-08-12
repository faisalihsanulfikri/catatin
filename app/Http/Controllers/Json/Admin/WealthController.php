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
use App\Models\Expenditure;
use App\Models\Wealth;

class WealthController extends Controller
{
  public function summary() 
  {
    $wealth = Wealth::where('user_id', Auth::user()->getId())->first();
    if ($wealth) return (new Response())->setData($wealth)->send();
    return (new Response())->notFound()->send();
  }

  public function summaryMonthly() 
  {
    $date = $this->getDate();
    $firstDate = Carbon::parse($date)->format("Y-m")."-01";
    $endDate = Carbon::parse($date)->endOfMonth()->format("Y-m-d");

    $totalIncome = Income::selectRaw('SUM(amount) as total_amount')
      ->where('user_id', Auth::user()->getId())
      ->wherebetween("date", [$firstDate, $endDate])
      ->groupBy("date")
      ->orderBy("date")
      ->get()
      ->sum('total_amount');

    $totalExpenditure = Expenditure::selectRaw('SUM(amount) as total_amount, date')
      ->where('user_id', Auth::user()->getId())
      ->wherebetween("date", [$firstDate, $endDate])
      ->groupBy("date")
      ->orderBy("date")
      ->get()
      ->sum('total_amount');

    return (new Response())->setData([
      'totalIncome' => $totalIncome,
      'totalExpenditure' => $totalExpenditure,
      'totalAsset' => number_format($totalIncome - $totalExpenditure),
    ])->send();
  }

  private function getDate()
  {
    $month = request()->month;
    return Carbon::parse(Carbon::now()->format("Y")."-$month-01")->format('Y-m-d');
  }
}