<?php

namespace App\Http\Requests\Web\Auth;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

use App\Utilities\Phone\IndonesiaPhoneValidator;

use App\Builders\School\Grade\SchoolGradeBuilder;

use App\Models\Admission;

class RegisterPPDBRequest extends FormRequest
{

  protected $errorBag = "register";

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
      "phone" => [
        "required",
        "string",
        "min:1",
      ],
      "gender" => [
        "required",
        "string",
        "in:male,female"
      ],
      "email" => [
        "required",
        "unique:user,email",
        "max:255",
        function($attribute, $value, $fail) {
          $admission = Admission::where('email', $value)->first();
          if ($admission) {
            $fail("Email sudah terdaftar di sistem");
          }
        },
      ],
      "password" => [
        "required",
        "min:6",
        "max:30",
      ],
      "c_password" => [
        "required",
        "min:6",
        "max:30",
      ]
    ];
  }

  public function messages(): array 
  {
		return [
      'name.required' => 'Nama wajib diisi',
      'name.string' => 'Nama tidak valid',
      'name.min' => 'Nama minimal 1 karakter',

      'phone.required' => 'No Telp/WA wajib diisi',
      'phone.string' => 'No Telp/WA tidak valid',
      'phone.min' => 'No Telp/WA minimal 1 karakter',

      'gender.required' => 'Jenis kelamin wajib diisi',
      'gender.string' => 'Jenis kelamin tidak valid',
      'gender.in' => 'Jenis kelamin harus laki - laki atau perempuan',

      'email.required' => 'Email wajib diisi',
      'email.string' => 'Email tidak valid',
      'email.min' => 'Email minimal 1 karakter',
      'email.unique' => 'Email sudah terdaftar di sistem',

      'password.required' => 'Password wajib diisi',
      'password.string' => 'Password tidak valid',
      'password.min' => 'Password minimal 1 karakter',

      'c_password.required' => 'Konfirmasi password wajib diisi',
      'c_password.string' => 'Konfirmasi password tidak valid',
      'c_password.min' => 'Konfirmasi password minimal 1 karakter',
		];
  }
  
}
