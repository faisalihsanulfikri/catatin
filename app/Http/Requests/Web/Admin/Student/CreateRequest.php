<?php

namespace App\Http\Requests\Web\Admin\Student;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

use App\Models\Admission;

class CreateRequest extends FormRequest
{
  protected $errorBag = "student";
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
      "email" => [
        "required",
        "string",
        "min:1",
        'unique:user',
        function($attribute, $value, $fail) {
          $admission = Admission::where('email', $value)->first();
          if ($admission) {
            $fail("Email $value sudah terdaftar di sistem");
          }
        },
      ],
      "password" => [
        "required",
        "string",
        "min:6",
      ],
      "nis" => [
        "required",
        "string",
        "min:1",
        'unique:student'
      ],
      "nisn" => [
        "required",
        "string",
        "min:1",
        'unique:student'
      ],
      "gender" => [
        "required",
        "string",
        "in:male,female"
      ],
      "photo" => [
        "nullable",
        "file",
        "min:1",
        "max:2048",
        'mimes:'.implode(",",$this->imageMimes),
      ],
      "class_id" => [
        "nullable",
      ],
      "parent_id" => [
        "required",
        'exists:parent,id'
      ],
		];
  }

  public function messages(): array 
  {
		return [
      'name.required' => 'Nama wajib diisi',
      'name.string' => 'Nama tidak valid',
      'name.min' => 'Nama minimal 1 karakter',

      'email.required' => 'Email wajib diisi',
      'email.string' => 'Email tidak valid',
      'email.min' => 'Email minimal 1 karakter',
      'email.unique' => 'Email sudah terdaftar di sistem',

      'password.required' => 'Password wajib diisi',
      'password.string' => 'Password tidak valid',
      'password.min' => 'Password minimal 1 karakter',

      'nis.required' => 'NIS wajib diisi',
      'nis.string' => 'NIS tidak valid',
      'nis.min' => 'NIS minimal 1 karakter',
      'nis.unique' => 'NIS sudah terdaftar di sistem',

      'nisn.required' => 'NISN wajib diisi',
      'nisn.string' => 'NISN tidak valid',
      'nisn.min' => 'NISN minimal 1 karakter',
      'nisn.unique' => 'NISN sudah terdaftar di sistem',

      'gender.required' => 'Jenis kelamin wajib diisi',
      'gender.string' => 'Jenis kelamin tidak valid',
      'gender.in' => 'Jenis kelamin harus laki - laki atau perempuan',

      'parent_id.required' => 'Wali wajib diisi',
      'parent_id.exists' => 'Wali yang dipilih tidak terdaftar di sistem',

      'photo.file' => 'Foto tidak valid',
      'photo.min' => 'Minimal ukuran foto tidak valid',
      'photo.max' => 'Maksimal ukuran foto adalah 2MB',
      'photo.mimes' => 'Foto tidak valid'
    ];
  }
  

}
