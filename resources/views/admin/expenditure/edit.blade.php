@extends("template.main") 

@section("subtitle", "Detail Pendaftaran")

@section("breadcrumb")
  <li class="breadcrumb-item">PPDB</li>
  <li class="breadcrumb-item"><a href="{{ route('admin.admission.index') }}">Pendaftaran</a></li>
  <li class="breadcrumb-item active" aria-current="page"><span>Detail Pendaftaran</span></li>
@endsection

@section("content")
  <div class="container">
    <div class="container">

      <a href="{{ route('admin.admission.index') }}" class="btn btn-danger mt-4">
        Kembal
      </a> 

      <div class="widget-content-area br-4 mt-3">
        <div class="widget-one">
          <h5 class="title-page">Detail Pendaftaran</h5>
        </div>
      </div>        
      <div id="basic" class="row layout-spacing layout-top-spacing">
        <div class="col-lg-12">

          <!-- ERROR MESSAGE SECTION -->
          <!-- END ERROR MESSAGE SECTION -->


          @component("components.app-message")
          @endcomponent
          <div class="statbox widget box box-shadow">
            <div class="widget-header">
              <div class="row">
                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                  <h4> Detail Pendaftaran disini </h4>
                </div>
              </div>
            </div>
            <div class="widget-content widget-content-area">
              <form>
                <div class="row">
                  <div class="col-12">
                    
                  </div>
                </div>
                <div class="row">
                  <div class="col-8">
                    <table class="table">
                      <tr>
                        <td style="border-top: 1px solid #e2e6e9;">Nama</td>
                        <th>: {{ $admission->name }}</th>
                      </tr>
                      <tr>
                        <td>NISN</td>
                        <th>: {{ $admission->nisn }}</th>
                      </tr>
                      <tr>
                        <td>Jenis Kelamin</td>
                        <th>: @if($admission->gender == 'male')Laki - laki @else Perempuan @endif</th>
                      </tr>
                      <tr>
                        <td>Tempat, Tanggal Lahir</td>
                        <th>: {{ $admission->place_of_birth }}, {{ date('d-m-Y', strtotime($admission->date_of_birth)) }}</th>
                      </tr>
                      <tr>
                        <td>Email</td>
                        <th>: {{ $admission->email }}</th>
                      </tr>
                      <tr>
                        <th>Alamat</th>
                      </tr>  
                      <tr>
                        <td>Jalan</td>
                        <th>: {{ $admission->street }}</th>
                      </tr>  
                      <tr>
                        <td>Desa / Kelurahan</td>
                        <th>: {{ $admission->village }}</th>
                      </tr>  
                      <tr>
                        <td>Kecamatan</td>
                        <th>: {{ $admission->district }}</th>
                      </tr>  
                      <tr>
                        <td>Kabupaten / Kota</td>
                        <th>: {{ $admission->regency }}</th>
                      </tr>  
                      <tr>
                        <td>Provinsi</td>
                        <th>: {{ $admission->province }}</th>
                      </tr>  
                    </table>

                    <br><br>
                    <h6>Lampiran</h6>
                    <table class="table">
                      <tr>
                        <td class="vertical-initial" width="40%" style="border-top: 1px solid #e2e6e9;">1. Formulir Pendaftaran</td>
                        <th>
                          <a target="_blank" href="{{$admission->form}}" class="btn btn-success btn-download">Unduh</a>
                        </th>
                      </tr>
                      <tr>
                        <td class="vertical-initial" width="40%" style="border-top: 1px solid #e2e6e9;">2. Scan Ijazah Terakhir</td>
                        <th>
                          @if (substr($admission->ijazah,strlen($admission->ijazah) - 4,4) == '.pdf')
                            <a target="_blank" href="{{$admission->ijazah}}" class="btn btn-success btn-download">Unduh</a>
                          @else
                            <a target="_blank" href="{{$admission->ijazah}}">
                              <img src="{{ asset($admission->ijazah) }}" class="attachment-image" alt="">
                            </a>
                          @endif
                        </th>
                      </tr>
                      <tr>
                        <td class="vertical-initial">3. Scan Akta Kelahiran</td>
                        <th>
                          @if (substr($admission->akta,strlen($admission->akta) - 4,4) == '.pdf')
                            <a target="_blank" href="{{$admission->akta}}" class="btn btn-success btn-download">Unduh</a>
                          @else
                            <a target="_blank" href="{{$admission->akta}}">
                              <img src="{{ asset($admission->akta) }}" class="attachment-image" alt="">
                            </a>
                          @endif
                        </th>
                      </tr>
                      <tr>
                        <td class="vertical-initial">4. Scan Kartu Keluarga</td>
                        <th>
                          @if (substr($admission->family_card,strlen($admission->family_card) - 4,4) == '.pdf')
                            <a target="_blank" href="{{$admission->family_card}}" class="btn btn-success btn-download">Unduh</a>
                          @else
                            <a target="_blank" href="{{$admission->family_card}}">
                              <img src="{{ asset($admission->family_card) }}" class="attachment-image" alt="">
                            </a>
                          @endif
                        </th>
                      </tr>
                    </table>
                  </div>
                  <div class="col-4">
                    <div class="form-group">
                      <label for="exists_banner">Foto</label>
                      <div style="text-align: center;">
                        <img src="{{ asset($admission->photo) }}" class="image-blog" alt="">
                      </div>
                    </div>
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
    .btn-download {
      padding: 2px 10px;
    }
    .title-page {
      font-weight: bold;
      font-size: 19px;
      letter-spacing: 0px;
      margin-bottom: 0;
      color: #515365;
    }
    .image-blog {
      width: 30%; 
      border-radius: 10px;
      transition: transform .2s;
      margin: 0 auto;
    }
    .image-blog:hover {
      transform: scale(1.75);
      position: relative;
      z-index: 1;
    }
    .attachment-image {
      width: 100%;
    }
    .vertical-initial {
      vertical-align: initial;
    }
  </style>
@endpush

@push("script")
  <script type="text/javascript">
    $(document).ready(function() {
      var f1 = flatpickr(document.getElementById('date_of_birth'));
      new FileUploadWithPreview('uploadThumbnail');
    });

    $('#thumbnail').on('change', function(e) {
      validateThumbnail();
    });

    function validateThumbnail() {
      let thumbnails = $('#thumbnail')[0].files[0];
      let beyondMaxFile = false;
      let filesize = thumbnails.size / 1024 / 1024;
      if (filesize > 2 ) beyondMaxFile = true;

      if (beyondMaxFile) {
        swal('Peringatan', 'Maksimal ukuran thumbnail yang dapat diupload adalah 2MB', 'warning').then(function() {
          $('#thumbnail').val(null);
          $('#clear-file').trigger('click');
        });
      }
    }
  </script>
@endpush
