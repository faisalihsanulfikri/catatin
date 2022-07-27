<?php

namespace App\Http\Requests\Web\Admin\Teacher;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

use App\Models\Teacher;
use App\Models\Admission;

class UpdateRequest extends FormRequest
{
  protected $errorBag = "teacher";
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
        function($attribute, $value, $fail) {
          $id = $this->route('teacher')->id;
          $teacher = Teacher::select(
                'teacher.id as id',
                'user.email as email'
              )
              ->join('user', 'user.id', 'teacher.user_id')
              ->where('user.email', $value)
              ->where('teacher.id', '!=', $id)
              ->first();

          if ($teacher) {
            $fail("Email $value sudah terdaftar di sistem");
          }

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
      "nip" => [
        "required",
        "string",
        "min:1",
        function($attribute, $value, $fail) {
          $id = $this->route('teacher')->id;
          $teacher = Teacher::where('nip', $value)->where('id', '!=', $id)->first();

          if ($teacher) {
            $fail("NIP $value sudah terdaftar di sistem");
          }
        },
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
      ]
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

      'nip.required' => 'NIP wajib diisi',
      'nip.string' => 'NIP tidak valid',
      'nip.min' => 'NIP minimal 1 karakter',

      'gender.required' => 'Jenis kelamin wajib diisi',
      'gender.string' => 'Jenis kelamin tidak valid',
      'gender.in' => 'Jenis kelamin harus laki - laki atau perempuan',

      'photo.required' => 'Foto wajib diisi',
      'photo.file' => 'Foto tidak valid',
      'photo.min' => 'Minimal ukuran foto tidak valid',
      'photo.max' => 'Maksimal ukuran foto adalah 2MB',
      'photo.mimes' => 'Foto tidak valid'
    ];
  }
  

}
