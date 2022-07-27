<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Models\Income;

class IncomeController extends Controller
{
  public function index() 
  {
    return view("admin.income.index");
  }

  public function edit(Income $income)
  {
    if (isset($income)) {
      $data['income'] = $income;
      return view("admin.income.edit", $data);
    }

    return redirect()->route("admin.income.index")
      ->with("status", "danger")
      ->with("message", "Pemasukan tidak ditemukan.");
  }

}