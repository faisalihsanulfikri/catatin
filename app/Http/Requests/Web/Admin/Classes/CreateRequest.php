<?php

namespace App\Http\Requests\Web\Admin\Classes;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
{
  protected $errorBag = "classes";

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
        'unique:classes'
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
      'name.unique' => "Kelas $name sudah terdaftar di sistem",
    ];
  }
  

}
