<?php

namespace App\Http\Controllers\Datatable\Admin;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

use App\Models\Income;

class IncomeController extends Controller
{
  public function index(Request $request)
  {
    $incomes = Income::select('*')->where('user_id', Auth::user()->getId());

    if ($request->search && $request->search['value'] != '') {
      $incomes = $incomes->where('description', 'like', '%'.$request->search['value'].'%');
    }

    $incomes = $incomes->orderBy('date', 'DESC')->orderBy('id', 'DESC');
    $incomes = $incomes->get();
    return Datatables::of($incomes)
      ->addIndexColumn()
      ->editColumn("limit_description", function($income) {
        return $income->getLimitDescription();
      })
      ->editColumn("formated_amount", function($income) {
        return number_format($income->amount);
      })
      ->make(true);
  }
}