<?php

namespace App\Http\Requests\Web\Admin\Achievement;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
{
  protected $errorBag = "achievement";

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
        'unique:achievement'
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
      'name.unique' => "Prestasi $name sudah terdaftar di sistem",
    ];
  }
  

}
