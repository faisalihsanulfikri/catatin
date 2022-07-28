<?php

namespace App\Http\Controllers\Web\Admin;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Expenditure;
use App\Models\Wealth;

use App\Http\Requests\Web\Admin\Expenditure\CreateRequest;
use App\Http\Requests\Web\Admin\Expenditure\UpdateRequest;

class ExpenditureController extends Controller
{
  public function index() 
  {
    return view("admin.expenditure.index");
  }

  public function new() 
  {
    return view("admin.expenditure.new");
  }

  public function create(CreateRequest $request)
  {
    try {     
      $expenditure = Expenditure::create([
        'date' => $request->get('date'),
        'description' => $request->get('description'),
        'amount' => $request->get('amount'),
        'user_id' => Auth::user()->getId()
      ]);

      return redirect()->route("admin.expenditure.edit", $expenditure->id)
      ->with("status", "success")
      ->with("message", "Berhasil menambahkan data");
    } catch (\Throwable $th) {
      Log::error($th->getMessage());
      Log::error($th->getTraceAsString());
      return redirect()->route("admin.expenditure.new")
      ->with("status", "danger")
      ->with("message", "Tidak berhasil menambahkan data");
    }
  }

  public function edit(Expenditure $expenditure)
  {
    if (isset($expenditure)) {
      $data['expenditure'] = $expenditure;
      return view("admin.expenditure.edit", $data);
    }

    return redirect()->route("admin.expenditure.index")
      ->with("status", "danger")
      ->with("message", "Pengeluaran tidak ditemukan.");
  }

  public function update(UpdateRequest $request, Expenditure $expenditure) 
  {
    DB::beginTransaction();
    try {
      $expenditureId = $expenditure->id;
      if (isset($expenditure)) {
        $expenditure->date = $request->get('date');
        $expenditure->description = $request->get('description');
        $expenditure->amount = $request->get('amount');
        $expenditure->save();
  
        DB::commit();
        return redirect()->route("admin.expenditure.edit", $expenditureId)
        ->with("status", "success")
        ->with("message", "Berhasil mengubah data");
      }

      return redirect()->route("admin.expenditure.index")
      ->with("status", "danger")
      ->with("message", "Pengeluaran tidak ditemukan");
    } catch (\Throwable $th) {
      DB::rollback();
      Log::error($th->getMessage());
      Log::error($th->getTraceAsString());
      return redirect()->route("admin.expenditure.index")
      ->with("status", "danger")
      ->with("message", "Tidak berhasil mengubah data");
    }
  }

}