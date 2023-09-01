<?php

namespace App\Http\Requests\Web\Admin\Income;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

use App\Models\Income;

class UpdateRequest extends FormRequest
{
  protected $errorBag = "income";

  public function authorize(): bool
  {
    return true;
  }

  public function rules(): array
  {
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
    ];
  }
  

}
