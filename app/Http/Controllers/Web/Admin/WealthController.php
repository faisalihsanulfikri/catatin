<?php

namespace App\Http\Controllers\Web\Admin;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File; 

use App\Models\Income;
use App\Models\Expenditure;
use App\Models\Wealth;

class WealthController extends Controller
{
  protected $wealth;

  public function __construct(Wealth $wealth)
  {
    $this->wealth = $wealth->where('user_id', Auth::user()->getId())->first();
  }

  public function getWealth()
  {
    return $this->wealth;
  }

  public function add($amount)
  {
    return $this->wealth->update(['amount' => DB::raw('amount+'.$amount)]);
  }

  public function reduce($amount)
  {
    if ($amount > $this->wealth->amount) return false;
    return $this->wealth->update(['amount' => DB::raw('amount-'.$amount)]);
  }

  public function updateIncome($oldAmount, $newAmount)
  {
    $current = $this->wealth->amount - $oldAmount;
    return $this->wealth->update(['amount' => $current + $newAmount]);
  }

  public function updateExpenditure($oldAmount, $newAmount)
  {
    $current = $this->wealth->amount + $oldAmount;
    if ($current < $newAmount) return false;
    return $this->wealth->update(['amount' => $current - $newAmount]);
  }

}