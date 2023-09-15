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
    $date = getDateFromMonth(request()->month);

    $expenditures = Expenditure::selectRaw('SUM(amount) as total_amount, date')
      ->where('user_id', Auth::user()->getId())
      ->wherebetween("date", [$date->start, $date->end])
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