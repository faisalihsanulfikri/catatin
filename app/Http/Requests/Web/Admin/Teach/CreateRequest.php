<?php

namespace App\Http\Requests\Web\Admin\Teach;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

use App\Models\Teach\Teach;
use App\Models\Teach\TeachDetail;
use App\Models\Lesson;

class CreateRequest extends FormRequest
{
  protected $errorBag = "teach";

  public function authorize(): bool
  {
    return true;
  }

  public function rules(): array
  {
    return [
      "teacher_id" => [
        "required",
        "exists:teacher,id"
      ],
      "school_year_id" => [
        "required",
        "exists:school_year,id"
      ],
      "semester" => [
        "required",
        "in:odd,even"
      ],
      "class_id" => [
        "required",
        "exists:classes,id",
        function($attribute, $value, $fail) {
          $teacher_id = $this->request->get('teacher_id');
          $class_id = $this->request->get('class_id');
          $school_year_id = $this->request->get('school_year_id');
          $semester = $this->request->get('semester');

          $teach = Teach::where('teacher_id', $teacher_id)->where('class_id', $class_id)->where('school_year_id', $school_year_id)->where('semester', $semester)->first();
          if ($teach) {
            $fail("Guru sudah mengajar di kelas dengan tahun ajaran dan semester yang dipilih.");
          }
        },
      ],
      "lesson_id" => [
        "required",
      ],
      "lesson_id.*" => [
        "required",
        "exists:lesson,id",
        function($attribute, $value, $fail) {
          $teacher_id = $this->request->get('teacher_id');
          $class_id = $this->request->get('class_id');
          $school_year_id = $this->request->get('school_year_id');
          $semester = $this->request->get('semester');
          $lesson_id = $value;
          $lesson = Lesson::select('name')->where('id', $lesson_id)->first()->name;

          $teachDetail = TeachDetail::where('class_id', $class_id)->where('school_year_id', $school_year_id)->where('semester', $semester)->first();
          if ($teachDetail) {
            $fail("Mata pelajaran $lesson sudah digunakan pada tahun ajaran dan semester yang dipilih.");
          }
        },
      ]
		];
  }

  public function messages(): array 
  {
		return [
      'teacher_id.required' => 'Guru wajib diisi',
      'school_year_id.required' => 'Tahun ajaran wajib diisi',
      'semester.required' => 'Semester wajib diisi',
      'class_id.required' => 'Kelas wajib diisi',
      'lesson_id.required' => 'Mata pelajaran wajib diisi',
    ];
  }
  

}
