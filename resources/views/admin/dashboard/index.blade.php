@extends("template.main") 

@section("subtitle", "Dashboard")

@section("breadcrumb")
  <li class="breadcrumb-item active"><a href="{{ route('admin.dashboard.index') }}">Dashboard</a></li>
@endsection

@section("content")
  <div class="container">
    <div class="container">
      
      <div class="row">
        <div class="col">
          <div class="widget-content-area br-4 mt-4">
            <div class="widget-one">
              <h5 class="title-page">Dashboard Admin</h5>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col mt-4">
          <div class="row widget-statistic">
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12 mb-1">
              <div class="widget widget-one_hybrid widget-followers">
                <div class="widget-heading">
                  <div class="w-icon">
                    <i data-feather="home"></i>
                  </div>
                  <p class="w-value">10</p>
                  <h5 class="">Total Kelas</h5>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12 mb-1">
              <div class="widget widget-one_hybrid widget-referral">
                <div class="widget-heading">
                  <div class="w-icon">
                    <i data-feather="database"></i>
                  </div>
                  <p class="w-value">10</p>
                  <h5 class="">Total Mata Pelajaran</h5>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12 mb-1">
              <div class="widget widget-one_hybrid widget-engagement">
                <div class="widget-heading">
                  <div class="w-icon">
                    <i data-feather="users"></i>
                  </div>
                  <p class="w-value">10</p>
                  <h5 class="">Total Guru</h5>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12 mb-1">
              <div class="widget widget-one_hybrid widget-followers">
                <div class="widget-heading">
                  <div class="w-icon">
                    <i data-feather="users"></i>
                  </div>
                  <p class="w-value">10</p>
                  <h5 class="">Total Siswa</h5>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  @component("components.ajax-request")
  @endcomponent
@endsection

@push("style")
  <link href="{{asset('plugins/apex/apexcharts.css')}}" rel="stylesheet" type="text/css">
  <link href="{{asset('assets/css/dashboard/dash_2.css')}}" rel="stylesheet" type="text/css" />
  <style>
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
  <script src="{{asset('plugins/apex/apexcharts.min.js')}}"></script>
  <script src="{{asset('assets/js/dashboard/dash_2.js')}}"></script>
@endpush
