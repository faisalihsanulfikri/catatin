<?php

namespace App\Http\Requests\Web\Teacher\Evaluation;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
  protected $errorBag = "evaluation";

  public function authorize(): bool
  {
    return true;
  }

  public function rules(): array
  {
    return [
      "students" => [
        "required",
      ],
      "students.*.detail_id" => [
        "required",
      ],
      "students.*.score" => [
        "required",
      ],
		];
  }

  public function messages(): array 
  {
		return [
      'students.required' => 'Data siswa tidak ditemukan',
    ];
  }
  

}
