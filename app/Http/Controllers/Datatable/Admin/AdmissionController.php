<?php

namespace App\Http\Controllers\Datatable\Admin;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

use App\Models\Admission;

class AdmissionController extends Controller
{
  public function index(Request $request)
  {
    $admissions = Admission::select('*');

    if ($request->search && $request->search['value'] != '') {
      $admissions = $admissions->where('name', 'like', '%'.$request->search['value'].'%')
                              ->orWhere('nisn', 'like', '%'.$request->search['value'].'%')
                              ->orWhere('place_of_birth', 'like', '%'.$request->search['value'].'%')
                              ->orWhere('date_of_birth', 'like', '%'.$request->search['value'].'%');
    }

    $admissions = $admissions->orderBy('name');
    $admissions = $admissions->get();
    return Datatables::of($admissions)
      ->addIndexColumn()
      ->editColumn("formated_status", function($admission) {
        return $admission->formatStatus();
      })
      ->editColumn("parent_phone", function($admission) {
        return $admission->parents->phone;
      })
      ->make(true);
  }
}