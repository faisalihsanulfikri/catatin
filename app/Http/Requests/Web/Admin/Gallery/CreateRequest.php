<?php

namespace App\Http\Requests\Web\Admin\Gallery;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
{
  protected $errorBag = "gallery";
  private $imageMimes = ["jpg","jpeg","png","gif","svg"];

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
      ],
      "filename" => [
        "nullable",
        "file",
        "min:1",
        "max:2048",
        'mimes:'.implode(",",$this->imageMimes),
      ],
		];
  }

  public function messages(): array 
  {
		return [
      'name.required' => 'Nama wajib diisi',
      'name.string' => 'Nama tidak valid',
      'name.min' => 'Nama minimal 1 karakter',

      'photo.file' => 'Foto tidak valid',
      'photo.min' => 'Minimal ukuran foto tidak valid',
      'photo.max' => 'Maksimal ukuran foto adalah 2MB',
      'photo.mimes' => 'Foto tidak valid'
    ];
  }
  

}
