<?php

namespace App\Http\Requests\Web\Auth;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{

  public function authorize(): bool
  {
  	return true;
  }

  public function rules(): array
  {
		return [
      "email" => [
        "required",
        "email",
        Rule::exists("user", "email")->where(function ($query) {
          $query->whereIn("user_role_id", [
            1,2,3,4
          ]);
        })
      ],
      "password" => [
        "required"
      ]
		];
  }

  public function messages(): array 
  {
		return [
			
		];
  }
  

}
