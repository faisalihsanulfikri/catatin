<?php

namespace App\Http\Requests\Web\Admin\Expenditure;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

use App\Models\Expenditure;

class UpdateRequest extends FormRequest
{
  protected $errorBag = "expenditure";

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
        "integer"
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
      
    ];
  }
  

}
