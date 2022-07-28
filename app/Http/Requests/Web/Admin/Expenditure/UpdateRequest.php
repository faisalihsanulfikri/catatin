<?php

namespace App\Http\Requests\Web\Admin\Expenditure;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

use App\Models\Expenditure;

class UpdateRequest extends FormRequest
{
  protected $errorBag = "expenditure";
  protected $wealth = null;

  public function authorize(): bool
  {
    return true;
  }

  public function rules(): array
  {
    $expenditure = Expenditure::where('id', $this->route('expenditure'))->first();
    $this->wealth = app(\App\Http\Controllers\Web\Admin\WealthController::class)->getWealth() - $expenditure->amount + $this->request()->amount;

    return [
      "date" => [
        "required",
        "date"
      ],
      "description" => [
        "nullable",
        "string"
      ],
      "amount" => [
        "required",
        "integer",
        "min:1000",
        "max:".$this->wealth->amount,
      ],
		];
  }

  public function messages(): array 
  {
		return [
      'date.required' => 'Tanggal wajib diisi',
      'date.date' => 'Tanggal tidak valid',
      
      'description.string' => 'Keterangan tidak valid',

      'amount.required' => 'Total wajib diisi',
      'amount.integer' => 'Total tidak valid',
      'amount.min' => 'Minimal total adalah 1000',
      'amount.max' => 'Maksimal total adalah '.$this->wealth->amount,
    ];
  }
  

}
