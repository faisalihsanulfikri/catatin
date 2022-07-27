<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Models\Expenditure;

class ExpenditureController extends Controller
{
  public function index() 
  {
    return view("admin.expenditure.index");
  }

  public function edit(Expenditure $expenditure)
  {
    if (isset($expenditure)) {
      $data['expenditure'] = $expenditure;
      return view("admin.expenditure.edit", $data);
    }

    return redirect()->route("admin.expenditure.index")
      ->with("status", "danger")
      ->with("message", "Pemasukan tidak ditemukan.");
  }

}