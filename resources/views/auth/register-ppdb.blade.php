<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>Register PPDB</title>
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico" />
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/plugins.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/authentication/form-2.css') }}" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/forms/theme-checkbox-radio.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/forms/switches.css') }}">
</head>

<body class="form">

    <div class="form-container outer">
        <div class="form-form">
            <div class="form-form-wrap" style="max-width: 100% !important;">
                <div class="form-container">
                    <div class="form-content">

                        <div class="app-message" style="text-align: left;">
                            @if ($errors->register->has('name') || $errors->register->has('email') || $errors->register->has('password') || $errors->register->has('c_password') || $errors->register->has('gender') || $errors->register->has('phone'))
                                <div class="alert alert-danger">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"
                                        style="margin-top: 0px;">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                    @if ($errors->register->has('name'))
                                        <i class="ti-info"></i> {{ $errors->register->first('name') }} <br>
                                    @endif
                                    @if ($errors->register->has('email'))
                                        <i class="ti-info"></i> {{ $errors->register->first('email') }} <br>
                                    @endif
                                    @if ($errors->register->has('password'))
                                        <i class="ti-info"></i> {{ $errors->register->first('password') }} <br>
                                    @endif
                                    @if ($errors->register->has('c_password'))
                                        <i class="ti-info"></i> {{ $errors->register->first('c_password') }}
                                        <br>
                                    @endif
                                    @if ($errors->register->has('gender'))
                                        <i class="ti-info"></i> {{ $errors->register->first('gender') }} <br>
                                    @endif
                                    @if ($errors->register->has('phone'))
                                        <i class="ti-info"></i> {{ $errors->register->first('phone') }}
                                    @endif
                                </div>
                            @endif

                            @include('components.app-message')
                        </div>

                        <h1 class="">Registrasi Wali</h1>
                        <p class="mb-0">Registrasi untuk melanjutkan pendaftaran peserta didik baru.</p>
                        <p class="">
                            Setelah Melakukan Registrasi Harap Login Ke akun anda untuk melengkapi
                            data ppdb, kemudian sertakan file formulir pendaftaran yang dapat diunduh 
                            <a target="_blank" href="/assets/file/formulir_pendaftaran.docx">di sini</a> 
                            atau pada di bawah.
                        </p>

                        <form class="text-left" action="{{ route('auth.register-ppdb.connect') }}"
                            method="POST">
                            {{ csrf_field() }}
                            <div class="form">
                                <div class="row">
                                    <div class="col">
                                        <div id="name-field" class="field-wrapper input">
                                            <label for="name">NAMA</label>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-user">
                                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                                <circle cx="12" cy="7" r="4"></circle>
                                            </svg>
                                            <input id="name" name="name" type="text" class="form-control"
                                                placeholder="name@example.com">
                                            @if ($errors->has('name'))
                                                <div class="form-control-feedback" type="error"
                                                    class="label label-danger" style="color: red;">
                                                    {{ $errors->first('name') }}
                                                </div>
                                            @endif
                                        </div>
                                        <div id="phone-field" class="field-wrapper input">
                                            <label for="phone">NO TELP/WA</label>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-user">
                                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                                <circle cx="12" cy="7" r="4"></circle>
                                            </svg>
                                            <input id="phone" name="phone" type="text" class="form-control"
                                                placeholder="0812">
                                            @if ($errors->has('phone'))
                                                <div class="form-control-feedback" type="error"
                                                    class="label label-danger" style="color: red;">
                                                    {{ $errors->first('phone') }}
                                                </div>
                                            @endif
                                        </div>
                                        <div id="gender-field" class="field-wrapper input">
                                            <label for="gender">JENIS KELAMIN</label>
                                            <select id="gender" class="selectpicker form-control form-control-sm"
                                                name="gender" required>
                                                <option value="male" selected>Laki - Laki</option>
                                                <option value="female">Perempuan</option>
                                            </select>
                                            @if ($errors->has('gender'))
                                                <div class="form-control-feedback" type="error"
                                                    class="label label-danger" style="color: red;">
                                                    {{ $errors->first('gender') }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div id="email-field" class="field-wrapper input">
                                            <label for="email">EMAIL</label>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-user">
                                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                                <circle cx="12" cy="7" r="4"></circle>
                                            </svg>
                                            <input id="email" name="email" type="text" class="form-control"
                                                placeholder="email@example.com">
                                            @if ($errors->has('email'))
                                                <div class="form-control-feedback" type="error"
                                                    class="label label-danger" style="color: red;">
                                                    {{ $errors->first('email') }}
                                                </div>
                                            @endif
                                        </div>
                                        <div id="password-field" class="field-wrapper input mb-2">
                                            <div class="d-flex justify-content-between">
                                                <label for="password">PASSWORD</label>
                                                <a class="forgot-pass-link">Tampilkan</a>
                                            </div>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-lock">
                                                <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                                <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                                            </svg>
                                            <input id="password" name="password" type="password" class="form-control"
                                                placeholder="Password">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round" id="toggle-password"
                                                class="feather feather-eye">
                                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                                <circle cx="12" cy="12" r="3"></circle>
                                            </svg>
                                            @if ($errors->has('password'))
                                                <div class="form-control-feedback" type="error"
                                                    class="label label-danger" style="color: red;">
                                                    {{ $errors->first('password') }}
                                                </div>
                                            @endif
                                        </div>
                                        <div id="c_password-field" class="field-wrapper input mb-2">
                                            <div class="d-flex justify-content-between">
                                                <label for="c_password">KONFIRMASI PASSWORD</label>
                                                <a class="forgot-pass-link">Tampilkan</a>
                                            </div>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-lock">
                                                <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                                <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                                            </svg>
                                            <input id="c_password" name="c_password" type="password"
                                                class="form-control" placeholder="Password">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round" id="toggle-password"
                                                class="feather feather-eye">
                                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                                <circle cx="12" cy="12" r="3"></circle>
                                            </svg>
                                            @if ($errors->has('password'))
                                                <div class="form-control-feedback" type="error"
                                                    class="label label-danger" style="color: red;">
                                                    {{ $errors->first('password') }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>


                                <div class="division"></div>

                                <div class="row">
                                    <div class="col-3">&nbsp;</div>
                                    <div class="col-6">
                                        <p class="text-inverse text-center">
                                            <a target="_blank" href="/assets/file/formulir_pendaftaran.docx" class="btn btn-primary">
                                                <strong>Download Fomulir Pendaftaran</strong>
                                            </a>
                                        </p>
                                    </div>
                                    <div class="col-3">&nbsp;</div>
                                </div>

                                <div class="division"></div>
                                
                                <div class="d-sm-flex justify-content-between">
                                    <div class="field-wrapper">
                                        <button id="btn_submit" type="submit" class="btn btn-primary" value=""
                                            disabled>Register</button>
                                    </div>
                                </div>
                                <div class="division"></div>
                                <div class="row">
                                    <div class="col">
                                        <p class="text-inverse text-center">
                                            <a href="{{ route('auth.login') }}" class="btn btn-success">
                                                <strong>Sudah punya akun ?</strong>
                                            </a>
                                        </p>
                                    </div>
                                    <div class="col">
                                        <p class="text-inverse text-center">
                                            <a href="{{ route('home.index') }}" class="btn btn-secondary">
                                                <strong>Kembali ke dashboard</strong>
                                            </a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="{{ asset('assets/js/libs/jquery-3.1.1.min.js') }}"></script>
    <script src="{{ asset('bootstrap/js/popper.min.js') }}"></script>
    <script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('plugins/select2/select2.min.js') }}"></script>

    <!-- END GLOBAL MANDATORY SCRIPTS -->
    <script src="{{ asset('assets/js/authentication/form-2.js') }}"></script>

    <script type="text/javascript">
        // $('#gender').select2();

        $("#password").keyup(function() {
            confirmValidation();
        });

        $("#c_password").keyup(function() {
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
