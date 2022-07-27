<?php

namespace App\Http\Controllers\Web\Admin;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Income;
use App\Models\Wealth;

use App\Http\Requests\Web\Admin\Income\CreateRequest;
use App\Http\Requests\Web\Admin\Income\UpdateRequest;

use Log;

class IncomeController extends Controller
{
  public function index() 
  {
    return view("admin.income.index");
  }

  public function new() 
  {
    return view("admin.income.new");
  }

  public function create(CreateRequest $request)
  {
    try {     
      $income = Income::create([
        'date' => $request->get('date'),
        'description' => $request->get('description'),
        'amount' => $request->get('amount'),
        'user_id' => Auth::user()->getId()
      ]);

      return redirect()->route("admin.income.edit", $income->id)
      ->with("status", "success")
      ->with("message", "Berhasil menambahkan data");
    } catch (\Throwable $th) {
      Log::error($th->getMessage());
      Log::error($th->getTraceAsString());
      return redirect()->route("admin.income.new")
      ->with("status", "danger")
      ->with("message", "Tidak berhasil menambahkan data");
    }
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

  public function update(UpdateRequest $request, Income $income) 
  {
    DB::beginTransaction();
    try {
      $incomeId = $income->id;
      if (isset($income)) {
        $income->date = $request->get('date');
        $income->description = $request->get('description');
        $income->amount = $request->get('amount');
        $income->save();
  
        DB::commit();
        return redirect()->route("admin.income.edit", $incomeId)
        ->with("status", "success")
        ->with("message", "Berhasil mengubah data");
      }

      return redirect()->route("admin.income.index")
      ->with("status", "danger")
      ->with("message", "Pemasukan tidak ditemukan");
    } catch (\Throwable $th) {
      DB::rollback();
      Log::error($th->getMessage());
      Log::error($th->getTraceAsString());
      return redirect()->route("admin.income.index")
      ->with("status", "danger")
      ->with("message", "Tidak berhasil mengubah data");
    }
  }

}