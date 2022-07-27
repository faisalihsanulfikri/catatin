<?php

namespace App\Http\Requests\Web\Auth;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

use App\Utilities\Phone\IndonesiaPhoneValidator;

use App\Builders\School\Grade\SchoolGradeBuilder;

class RegisterRequest extends FormRequest
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
        "max:255",
      ],
      "email" => [
        "required",
        "unique:user,email",
        "max:255",
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
			
		];
  }
  
}
