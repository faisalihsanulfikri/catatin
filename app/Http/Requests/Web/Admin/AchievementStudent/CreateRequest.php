<?php

namespace App\Http\Requests\Web\Admin\AchievementStudent;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use App\Models\AchievementStudent;

class CreateRequest extends FormRequest
{
  protected $errorBag = "achievement";

  public function authorize(): bool
  {
    return true;
  }

  public function rules(): array
  {
    return [
      "achievement_id" => [
        "required",
        'exists:achievement,id'
      ],
      "student_id" => [
        "required",
        'exists:student,id',
        function($attribute, $value, $fail) {
          $achievement = AchievementStudent::select('id')->where('achievement_id', $this->request->get('achievement_id'))->where('student_id', $value)->first();
          if ($achievement) $fail('Prestasi dengan siswa yang dipilih telah terdaftar di sistem.');
        },
      ],
      "score" => [
        "required",
        "string",
        "min:1",
      ],
		];
  }

  public function messages(): array 
  {
		return [
      'achievement_id.required' => 'Prestasi wajib diisi',
      'achievement_id.string' => 'Prestasi tidak ditemukan',

      'student_id.required' => 'Siswa wajib diisi',
      'student_id.string' => 'Siswa tidak ditemukan',

      'score.required' => 'Nilai atau peringkat wajib diisi',
      'score.string' => 'Nilai atau peringkat tidak valid',
      'score.string' => 'Nilai atau peringkat minimal 1 karakter',
    ];
  }
  

}
