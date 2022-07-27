<?php

namespace App\Http\Requests\Web\Admin\Classes;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

use App\Models\Classes;

class UpdateRequest extends FormRequest
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
        function($attribute, $value, $fail) {
          $id = $this->route('classes')->id;
          $class = Classes::where('name', $value)->where('id', '!=', $id)->first();

          if ($class) {
            $fail("Kelas $value sudah terdaftar di sistem");
          }
        },
      ]
		];
  }

  public function messages(): array 
  {
		return [
      'name.required' => 'Nama wajib diisi',
      'name.string' => 'Nama tidak valid',
      'name.min' => 'Nama minimal 1 karakter',
    ];
  }
  

}
