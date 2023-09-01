@extends("template.main") 

@section("subtitle", "Ubah Password")

@section("breadcrumb")
  <li class="breadcrumb-item"><a href="{{ route('role.redirect') }}">Ubah Password</a></li>
@endsection

@section("content")
  <div class="container">
    <div class="container">

      <a href="{{ route('role.redirect') }}" class="btn btn-danger mt-4">
        Kembal
      </a> 

      <div class="widget-content-area br-4 mt-3">
        <div class="widget-one">
          <h5 class="title-page">Ubah Password</h5>
        </div>
      </div>        
      <div id="basic" class="row layout-spacing layout-top-spacing">
        <div class="col-lg-12">

          <!-- ERROR MESSAGE SECTION -->

          @if($errors->auth->has("password") || $errors->auth->has("c_password"))
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
              @if($errors->auth->has("password")) 
                <i class="ti-info"></i> {{ $errors->auth->first("password") }}	<br>
              @endif
              @if($errors->auth->has("c_password")) 
                <i class="ti-info"></i> {{ $errors->auth->first("c_password") }}	<br>
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
                  <h4> Ubah Password disini </h4>
                </div>
              </div>
            </div>
            <div class="widget-content widget-content-area">
              <form method="post" action="{{ route('auth.password-change.update') }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="row">
                  <div class="col-6">
                    <div class="form-group">
                      <label for="password">Password <strong class="text-danger">*</strong></label>
                      <input type="password" name="password" class="form-control" id="password" required>
                    </div>
                    <div class="form-group">
                      <label for="c_password">Konfirmasi Password <strong class="text-danger">*</strong></label>
                      <input type="c_password" name="c_password" class="form-control" id="c_password" required>
                    </div>
                  </div>
                  <div class="col-6">
                    &nbsp;
                  </div>
                  <hr>
                  <div class="col-6 mt-4">
                    <button id="btn_submit" type="submit" class="btn btn-primary mt-3" style="width: 100%;" disabled>Ubah</button>
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
    $("#password").keyup(function(){
      confirmValidation();
    });

    $("#c_password").keyup(function(){
      confirmValidation();
    });

    function confirmValidation() {
      let password = $("#password").val();
      let c_password = $("#c_password").val();

      if (password == c_password) {
        $('#c_password').css("border-color", "#d0d8e0");
        $('#btn_submit').prop('disabled', false);
      } else {
        $('#c_password').css("border-color", "red");
        $('#btn_submit').prop('disabled', true);
      }
    }

  </script>
@endpush
