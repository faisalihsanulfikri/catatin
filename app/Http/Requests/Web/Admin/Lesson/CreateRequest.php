<?php

namespace App\Http\Requests\Web\Admin\Lesson;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
{
  protected $errorBag = "lesson";

  public function authorize(): bool
  {
    return true;
  }

  public function rules(): array
  {
		return [
      "name" => [
        "required",
        "string",
        "min:1",
        'unique:lesson'
      ]
		];
  }

  public function messages(): array 
  {
    $name = $this->request->get('name');
		return [
      'name.required' => 'Nama wajib diisi',
      'name.string' => 'Nama tidak valid',
      'name.min' => 'Nama minimal 1 karakter',
      'name.unique' => "Mata pelajaran $name sudah terdaftar di sistem",
    ];
  }
  

}
