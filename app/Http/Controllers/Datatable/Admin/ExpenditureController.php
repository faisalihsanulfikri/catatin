<?php

namespace App\Http\Controllers\Datatable\Admin;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

use App\Models\Expenditure;

class ExpenditureController extends Controller
{
  public function index(Request $request)
  {
    $expenditures = Expenditure::select('*')->where('user_id', Auth::user()->getId());

    if ($request->search && $request->search['value'] != '') {
      $expenditures = $expenditures->where('description', 'like', '%'.$request->search['value'].'%');
    }

    $expenditures = $expenditures->orderBy('date', 'DESC')->orderBy('id', 'DESC');
    $expenditures = $expenditures->get();
    return Datatables::of($expenditures)
      ->addIndexColumn()
      ->editColumn("limit_description", function($expenditure) {
        return $expenditure->getLimitDescription();
      })
      ->editColumn("formated_amount", function($expenditure) {
        return number_format($expenditure->amount);
      })
      ->make(true);
  }

  public function summary()
  {
    $date = getDateFromMonth(request()->month);

    $expenditures = Expenditure::selectRaw('description, COUNT(id) as qty, SUM(amount) as total_amount')
                    ->where('user_id', Auth::user()->getId())
                    ->wherebetween("date", [$date->start, $date->end])
                    ->groupBy('description')
                    ->get()
                    ->sortByDesc('total_amount');

    return Datatables::of($expenditures)
      ->addIndexColumn()
      ->editColumn("limit_description", function($expenditure) {
        return $expenditure->getLimitDescription();
      })
      ->editColumn("formated_amount", function($expenditure) {
        return number_format($expenditure->total_amount);
      })
      ->make(true);
  }
}