<?php

namespace App\Http\Requests\Web\Admin\Article;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
  protected $errorBag = "article";
  private $imageMimes = ["jpg","jpeg","png","gif","svg"];

  public function authorize(): bool
  {
  	return true;
  }

  public function rules(): array
  {
		return [
      "title" => [
        "required",
        "string"
      ],
      // "status" => [
      //   "required",
      //   "in:active,inactive"
      // ],
      "thumbnail" => [
        "nullable",
        "file",
        "min:1",
        "max:2048",
        'mimes:'.implode(",",$this->imageMimes),
      ]
		];
  }

  public function messages(): array 
  {
		return [
      'title.required' => 'Judul wajib diisi',
      'title.string' => 'Judul tidak valid',
      // 'status.required' => 'Status wajib diisi',
      // 'status.in' => 'Status tidak valid',

      'thumbnail.file' => 'Thumbnail tidak valid',
      'thumbnail.min' => 'Minimal ukuran thumbnail tidak valid',
      'thumbnail.max' => 'Maksimal ukuran thumbnail adalah 2MB',
      'thumbnail.mimes' => 'Thumbnail tidak valid',
    ];
  }
  

}
