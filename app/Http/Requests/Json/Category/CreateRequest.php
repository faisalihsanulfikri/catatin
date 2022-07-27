<?php

namespace App\Http\Requests\Json\Category;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
{
  
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
        "max:65000"
      ]
    ];
  }

  public function messages(): array 
  {
		return [
			
		];
  }
  

}
