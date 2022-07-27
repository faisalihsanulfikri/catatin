<?php

namespace App\Http\Requests\Web\Teacher\Evaluation;

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

use App\Models\Teach\Teach;
use App\Models\Teach\TeachDetail;
use App\Models\Lesson;

class CreateRequest extends FormRequest
{
  protected $errorBag = "evaluation";

  public function authorize(): bool
  {
    return true;
  }

  public function rules(): array
  {
    return [
      "semester" => [
        "required",
        "in:odd,even"
      ],
      "school_year_id" => [
        "required",
        "exists:school_year,id"
      ],
      "class_id" => [
        "required",
        "exists:classes,id",
        function($attribute, $value, $fail) {
          $teacher_id = Auth::user()->getTeacherId();
          $class = Teach::where('teacher_id', $teacher_id)->where('class_id', $value)->first();
          if (!$class) {
            $fail("Kelas belum terdaftar di sistem");
          }
        },
      ],
      "lesson_id" => [
        "required",
        "exists:lesson,id",
        function($attribute, $value, $fail) {
          
        },
      ],
      "students" => [
        "required",
      ],
      "students.*.id" => [
        "required",
      ],
      "students.*.name" => [
        "required",
      ],
      "students.*.score" => [
        "required",
      ],
		];
  }

  public function messages(): array 
  {
		return [
      'school_year_id.required' => 'Tahun ajaran wajib diisi',
      'semester.required' => 'Semester wajib diisi',
      'students.required' => 'Data siswa tidak ditemukan',
    ];
  }
  

}
