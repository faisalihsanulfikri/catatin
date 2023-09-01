<!DOCTYPE html>
<html lang="id">
<head>
  @include("template.meta")
  @stack("meta")
  <title>Amaljariyahku - Register</title>
  @include("template.head")
  @stack("style")
</head>

<body>

    <section class="login p-fixed d-flex text-center bg-white">
        <!-- Container-fluid starts -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <!-- Authentication card start -->
                    <div class="signup-card card-block auth-body mr-auto ml-auto">
                        <form class="md-float-material" action="{{ route("auth.register.connect") }}" method="POST">
                            {{ csrf_field() }}
                            <div class="auth-box">
                                <div class="row m-b-20">
                                    <div class="col-md-12">
                                        <h3 class="text-center txt-primary">Mendaftar</h3>
                                    </div>
                                </div>
                                <hr/>
                                <div class="input-group">
                                    <input type="text" name="name" class="form-control" placeholder="Nama">
                                    <span class="md-line"></span>
                                </div>
                                @if ($errors->register->has("name"))
                                    <div id="field-error-name" type="error" class="label label-danger">
                                        {{ $errors->register->first("name") }}
                                    </div>
                                @endif
                                <div class="input-group">
                                    <input type="text" name="email" class="form-control" placeholder="Email">
                                    <span class="md-line"></span>
                                </div>
                                @if ($errors->register->has("email"))
                                    <div id="field-error-email" type="error" class="label label-danger" style="color: red;">
                                        {{ $errors->register->first("email") }}
                                    </div>
                                @endif
                                <div class="input-group">
                                    <input type="password" name="password" class="form-control" placeholder="Password">
                                    <span class="md-line"></span>
                                </div>
                                @if ($errors->register->has("password"))
                                    <div id="field-error-password" type="error" class="label label-danger">
                                        {{ $errors->register->first("password") }}
                                    </div>
                                @endif
                                <div class="input-group">
                                    <input type="password" name="c_password" class="form-control" placeholder="Konfirmasi Password">
                                    <span class="md-line"></span>
                                </div>
                                @if ($errors->register->has("c_password"))
                                    <div id="field-error-c_password" type="error" class="label label-danger">
                                        {{ $errors->register->first("c_password") }}
                                    </div>
                                @endif
                                <div class="row m-t-30">
                                    <div class="col-md-12">
                                        <button id="btn_submit" type="submit" class="btn btn-primary btn-md btn-block waves-effect text-center m-b-20">Sign up.</button>
                                    </div>
                                </div>
                                <hr/>
                                <div class="row">
                                    <div class="col-md-12">
                                        <p class="text-inverse text-center">
                                          <a href="{{ route('auth.login') }}" class="btn btn-secondary">
                                            <strong>Sudah punya akun ?</strong>
                                          </a>
                                        </p>
                                    </div>
                                    <div class="col-md-12">
                                        <p class="text-inverse text-center">
                                          <a href="{{ route('home.index') }}">
                                            <strong>Kembali ke dashboard</strong>
                                          </a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <!-- end of form -->
                    </div>
                    <!-- Authentication card end -->
                </div>
                <!-- end of col-sm-12 -->
            </div>
            <!-- end of row -->
        </div>
        <!-- end of container-fluid -->
    </section>

  @include("template.foot")
  @stack("script")

  <!-- END GLOBAL MANDATORY SCRIPTS -->
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
</body>

</html>
