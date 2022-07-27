<?php

namespace App\Http\Requests\Web\Admin\Achievement;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

use App\Models\Achievement;

class UpdateRequest extends FormRequest
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
        function($attribute, $value, $fail) {
          $id = $this->route('achievement')->id;
          $achievement = Achievement::where('name', $value)->where('id', '!=', $id)->first();

          if ($achievement) {
            $fail("Prestasi $value sudah terdaftar di sistem");
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
