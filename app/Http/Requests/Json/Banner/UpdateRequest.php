<?php

namespace App\Http\Requests\Json\Banner;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

use App\Models\Banner\Banner;

class UpdateRequest extends FormRequest
{
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
        "max:65000"
      ],
      "position" => [
        "required",
        "numeric",
        "min:1",
        "max:10000",
        function($attribute, $value, $fail) {
          $banner = Banner::select('id')->where('id', '!=', $this->route("banner")->getId())->where('position', $value)->first();
          if ($banner) $fail('Posisi telah digunakan');
        },
      ],
      "status" => [
        "required",
        "string",
        "in:active,inactive",
      ],
      'photo' => [
        'nullable',
        'file',
        'min:1',
        'max:2048',
        'mimes:'.implode(",",$this->imageMimes),
      ],
    ];
  }

  public function messages(): array 
  {
		return [
			
		];
  }
  

}
