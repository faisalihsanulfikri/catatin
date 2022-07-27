<?php

namespace App\Http\Requests\Web\Admin\Lesson;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

use App\Models\Lesson;

class UpdateRequest extends FormRequest
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
        function($attribute, $value, $fail) {
          $id = $this->route('lesson')->id;
          $lesson = Lesson::where('name', $value)->where('id', '!=', $id)->first();

          if ($lesson) {
            $fail("Mata pelajaran $value sudah terdaftar di sistem");
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
