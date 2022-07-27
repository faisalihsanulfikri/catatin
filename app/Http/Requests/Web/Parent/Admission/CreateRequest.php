<?php

namespace App\Http\Requests\Web\Parent\Admission;

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

use App\Models\Teach\Teach;
use App\Models\Teach\TeachDetail;
use App\Models\Lesson;

class CreateRequest extends FormRequest
{
  protected $errorBag = "admission";
  private $imageMimes = ["jpg","jpeg","png","gif","svg"];
  private $doscMimes = ["pdf"];
  private $formMimes = ["doc","docx"];

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
        'unique:user'
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
      "place_of_birth" => [
        "required",
      ],
      "date_of_birth" => [
        "required",
      ],
      "street" => [
        "required",
      ],
      "village" => [
        "required",
      ],
      "district" => [
        "required",
      ],
      "regency" => [
        "required",
      ],
      "province" => [
        "required",
      ],
      "photo" => [
        "required",
        "file",
        "min:1",
        "max:2048",
        'mimes:'.implode(",",$this->imageMimes),
      ],
      "form" => [
        "required",
        "file",
        "min:1",
        "max:2048",
        'mimes:'.implode(",",$this->formMimes),
      ],
      "ijazah" => [
        "required",
        "file",
        "min:1",
        "max:2048",
        'mimes:'.implode(",",$this->imageMimes).','.implode(",",$this->doscMimes),
      ],
      "akta" => [
        "required",
        "file",
        "min:1",
        "max:2048",
        'mimes:'.implode(",",$this->imageMimes).','.implode(",",$this->doscMimes),
      ],
      "family_card" => [
        "required",
        "file",
        "min:1",
        "max:2048",
        'mimes:'.implode(",",$this->imageMimes).','.implode(",",$this->doscMimes),
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

      'nisn.required' => 'NISN wajib diisi',
      'nisn.string' => 'NISN tidak valid',
      'nisn.min' => 'NISN minimal 1 karakter',
      'nisn.unique' => 'NISN sudah terdaftar di sistem',

      'gender.required' => 'Jenis kelamin wajib diisi',
      'gender.string' => 'Jenis kelamin tidak valid',
      'gender.in' => 'Jenis kelamin harus laki - laki atau perempuan',
      
      'place_of_birth.required' => 'Tempat lahir wajib diisi',
      'date_of_birth.required' => 'Tanggal lahir wajib diisi',

      'street.required' => 'Alamat jalan lahir wajib diisi',
      'village.required' => 'Desa / kelurahan lahir wajib diisi',
      'district.required' => 'Kecamatan lahir wajib diisi',
      'regency.required' => 'Kabupaten / kota lahir wajib diisi',
      'province.required' => 'Provinsi lahir wajib diisi',

      'photo.required' => 'Foto wajib diisi',
      'photo.file' => 'Foto tidak valid',
      'photo.min' => 'Minimal ukuran foto tidak valid',
      'photo.max' => 'Maksimal ukuran foto adalah 2MB',
      'photo.mimes' => 'Foto tidak valid',

      'form.required' => 'Formulir pendaftaran wajib diisi',
      'form.file' => 'Formulir pendaftaran tidak valid',
      'form.min' => 'Minimal ukuran formulir pendaftaran tidak valid',
      'form.max' => 'Maksimal ukuran formulir pendaftaran adalah 2MB',
      'form.mimes' => 'Formulir pendaftaran tidak valid',

      'ijazah.required' => 'Scan ijazah wajib diisi',
      'ijazah.file' => 'Scan ijazah tidak valid',
      'ijazah.min' => 'Minimal ukuran scan ijazah tidak valid',
      'ijazah.max' => 'Maksimal ukuran scan ijazah adalah 2MB',
      'ijazah.mimes' => 'Scan ijazah tidak valid',

      'akta.required' => 'Scan akta kelahiran wajib diisi',
      'akta.file' => 'Scan akta kelahiran tidak valid',
      'akta.min' => 'Minimal ukuran scan akta kelahiran tidak valid',
      'akta.max' => 'Maksimal ukuran scan akta kelahiran adalah 2MB',
      'akta.mimes' => 'Scan akta kelahiran tidak valid',

      'family_card.required' => 'Scan kartu keluarga wajib diisi',
      'family_card.file' => 'Scan kartu keluarga tidak valid',
      'family_card.min' => 'Minimal ukuran scan kartu keluarga tidak valid',
      'family_card.max' => 'Maksimal ukuran scan kartu keluarga adalah 2MB',
      'family_card.mimes' => 'Scan kartu keluarga tidak valid',

    ];
  }
  

}
