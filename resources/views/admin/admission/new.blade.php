@extends("template.main") 

@section("subtitle", "Pendaftaran Baru")

@section("breadcrumb")
  <li class="breadcrumb-item">PPDB</li>
  <li class="breadcrumb-item"><a href="{{ route('parent.admission.index') }}">Pendaftaran</a></li>
  <li class="breadcrumb-item active" aria-current="page"><span>Pendaftaran Baru</span></li>
@endsection

@section("content")
  <div class="container">
    <div class="container">

      <a href="{{ route('parent.admission.index') }}" class="btn btn-danger mt-4">
        Kembal
      </a>

      <div class="widget-content-area br-4 mt-3">
        <div class="widget-one">
          <h5 class="title-page">Pendaftaran Baru</h5>
        </div>
      </div>        
      <div id="basic" class="row layout-spacing layout-top-spacing">
        <div class="col-lg-12">

        <!-- ERROR MESSAGE SECTION -->

          @if($errors->admission->has("name") ||
            $errors->admission->has("email") ||
            $errors->admission->has("nisn") ||
            $errors->admission->has("gender") ||
            $errors->admission->has("place_of_birth") ||
            $errors->admission->has("date_of_birth") ||
            $errors->admission->has("photo")||
            $errors->admission->has("ijazah")||
            $errors->admission->has("akta")||
            $errors->admission->has("family_card")
          )
            <div class="alert alert-danger">
              <button
                type="button"
                class="close" 
                data-dismiss="alert"
                aria-label="Close"
                style="margin-top: 0px;"
                >
                <span aria-hidden="true">×</span>
              </button>
              @if($errors->admission->has("name")) 
                <i class="ti-info"></i> {{ $errors->admission->first("name") }}	<br>
              @endif
              @if($errors->admission->has("email")) 
                <i class="ti-info"></i> {{ $errors->admission->first("email") }}	<br>
              @endif
              @if($errors->admission->has("nisn")) 
              <i class="ti-info"></i> {{ $errors->admission->first("nisn") }}	<br>
              @endif
              @if($errors->admission->has("gender")) 
              <i class="ti-info"></i> {{ $errors->admission->first("gender") }}	<br>
              @endif
              @if($errors->admission->has("place_of_birth")) 
              <i class="ti-info"></i> {{ $errors->admission->first("place_of_birth") }} <br>
              @endif
              @if($errors->admission->has("date_of_birth")) 
              <i class="ti-info"></i> {{ $errors->admission->first("date_of_birth") }} <br>
              @endif
              @if($errors->admission->has("photo")) 
              <i class="ti-info"></i> {{ $errors->admission->first("photo") }} <br>
              @endif
              @if($errors->admission->has("ijazah")) 
                <i class="ti-info"></i> {{ $errors->admission->first("ijazah") }}	<br>
              @endif
              @if($errors->admission->has("akta")) 
                <i class="ti-info"></i> {{ $errors->admission->first("akta") }}	<br>
              @endif
              @if($errors->admission->has("family_card")) 
                <i class="ti-info"></i> {{ $errors->admission->first("family_card") }}
              @endif
            </div>
          @endif

          <!-- END ERROR MESSAGE SECTION -->

          @component("components.app-message")
          @endcomponent
          <div class="statbox widget box box-shadow">
            <div class="widget-header">
              <div class="row">
                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                  <h4> Buat Pendaftaran baru disini </h4>
                </div>
              </div>
            </div>
            <div class="widget-content widget-content-area">
              <form method="post" action="{{ route('parent.admission.create') }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="row">
                  <div class="col-6">
                    <div class="form-group">
                      <label for="name">Nama <strong class="text-danger">*</strong></label>
                      <input type="text" name="name" class="form-control" id="name" required>
                    </div>
                    <div class="form-group">
                      <label for="nisn">NISN <strong class="text-danger">*</strong></label>
                      <input type="text" name="nisn" class="form-control" id="nisn" required>
                    </div>
                    <div class="form-group">
                      <label for="gender">Jenis Kelamin <strong class="text-danger">*</strong></label>
                      <select id="gender" class="selectpicker form-control form-control-sm" name="gender" required>
                        <option value="" selected>- Pilih Jenis Kelamin -</option>
                        <option value="male">Laki - Laki</option>
                        <option value="female">Perempuan</option>
                      </select>
                    </div>
                    <div class="row">
                      <div class="col">
                        <div class="form-group">
                          <label for="place_of_birth">Tempat Lahir <strong class="text-danger">*</strong></label>
                          <input type="text" name="place_of_birth" class="form-control" id="place_of_birth">
                        </div>
                      </div>
                      <div class="col">
                        <div class="form-group">
                          <label for="date_of_birth">Tanggal Lahir <strong class="text-danger">*</strong></label>
                          <input type="text" name="date_of_birth" class="form-control" id="date_of_birth">
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="email">Email <strong class="text-danger">*</strong></label>
                      <input type="text" name="email" class="form-control" id="email" required>
                    </div>
                  </div>
                  

                  <div class="col-6">
                    <div class="form-group">
                      <div class="custom-file-container" data-upload-id="uploadPhoto">
                        <label>
                          Upload Foto 
                          <a 
                            href="javascript:void(0)" 
                            class="custom-file-container__image-clear" 
                            title="Clear Image"
                          >
                            <i class="fas fa-times" id="clear-file" style="font-size: 18px; color: #e7515a;"></i>
                          </a>
                        </label>
                        <label class="custom-file-container__custom-file" >
                          <input id="photo" name="photo" type="file" class="custom-file-container__custom-file__custom-file-input" accept=".jpg,.jpeg,.png,.gif,.svg"> 
                          <span class="custom-file-container__custom-file__custom-file-control"></span>
                        </label>
                        <br>
                        <span class="mt-2" style="position: absolute;">(Max. 2MB, .jpg/.jpeg/.png)</span>
                        <div class="custom-file-container__image-preview"></div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="ijazah">Scan Ijazah Terakhir <strong class="text-danger">*</strong></label>
                      <input type="file" name="ijazah" class="form-control" id="ijazah" required>
                    </div>
                    <div class="form-group">
                      <label for="akta">Scan Akta Kelahiran <strong class="text-danger">*</strong></label>
                      <input type="file" name="akta" class="form-control" id="akta" required>
                    </div>
                    <div class="form-group">
                      <label for="family_card">Scan Kartu Keluarga <strong class="text-danger">*</strong></label>
                      <input type="file" name="family_card" class="form-control" id="family_card" required>
                    </div>
                  </div>
                  <hr>
                  <div class="col-12 mt-4" style="text-align: center;">
                    <button type="submit" class="btn btn-primary mt-3" style="width: 80%;">Tambah</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@push("style")
  <style>
    .ck-editor__editable {
      min-height: 1024px;
    }
    .title-page {
      font-weight: bold;
      font-size: 19px;
      letter-spacing: 0px;
      margin-bottom: 0;
      color: #515365;
    }
  </style>
@endpush

@push("script")
  <script type="text/javascript">
    $(document).ready(function() {
      var f1 = flatpickr(document.getElementById('date_of_birth'));
      new FileUploadWithPreview('uploadPhoto');
    });

    $('#photo').on('change', function(e) {
      validatePhoto();
    });


    function validatePhoto() {
      let photo = $('#photo')[0].files[0];
      let beyondMaxFile = false;
      let filesize = photo.size / 1024 / 1024;
      if (filesize > 2 ) beyondMaxFile = true;

      if (beyondMaxFile) {
        swal('Peringatan', 'Maksimal ukuran photo yang dapat diupload adalah 2MB', 'warning').then(function() {
          $('#photo').val(null);
          $('#clear-file').trigger('click');
        });
      }
    }
  </script>
@endpush
