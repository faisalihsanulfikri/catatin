@extends("template.main") 

@section("subtitle", "Detail Pemasukan")

@section("breadcrumb")
  <li class="breadcrumb-item"><a href="{{ route('admin.income.index') }}">Pemasukan</a></li>
  <li class="breadcrumb-item active" aria-current="page"><span>Detail Pemasukan</span></li>
@endsection

@section("content")
  <div class="container">
    <div class="container">

      <div class="row">
        <div class="col">
          <a href="{{ route('admin.income.index') }}" class="btn btn-danger mt-4">
            Kembal
          </a> 
        </div>
        <div class="col">
          <a href="{{ route('admin.income.new') }}" class="btn btn-primary mt-4 float-right">
            Tambah
          </a> 
        </div>
      </div>

      <div class="widget-content-area br-4 mt-3">
        <div class="widget-one">
          <h5 class="title-page">Detail Pemasukan</h5>
        </div>
      </div>        
      <div id="basic" class="row layout-spacing layout-top-spacing">
        <div class="col-lg-12">

          <!-- ERROR MESSAGE SECTION -->

          @if($errors->income->has("amount") ||
            $errors->income->has("date") ||
            $errors->income->has("description")
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
              @if($errors->income->has("amount")) 
                <i class="ti-info"></i> {{ $errors->income->first("amount") }}	<br>
              @endif
              @if($errors->income->has("date")) 
                <i class="ti-info"></i> {{ $errors->income->first("date") }}	<br>
              @endif
              @if($errors->income->has("description")) 
              <i class="ti-info"></i> {{ $errors->income->first("description") }}
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
                  <h4> Detail Pemasukan disini </h4>
                </div>
              </div>
            </div>
            <div class="widget-content widget-content-area">
              <form method="post" action="{{ route('admin.income.update', $income->id) }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="row">
                  <div class="col-12">
                    <div class="form-group">
                      <label for="date">Tanggal <strong class="text-danger">*</strong></label>
                      <input type="text" name="date" class="form-control" id="date" value="{{ $income->date }}" required>
                    </div>
                    <div class="form-group">
                      <label for="description">Keterangan <strong class="text-danger">*</strong></label>
                      <textarea type="text" name="description" class="form-control" id="description" rows="5" required> {{ $income->description }} </textarea>
                    </div>
                    
                    <div class="form-group">
                      <label for="amount">Total <strong class="text-danger">*</strong></label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text">Rp.</span>
                        </div>
                        <input type="text" name="amount" class="form-control" id="amount" value="{{ $income->amount }}" required>
                      </div>
                    </div>
                  </div>
                  <hr>
                  <div class="col-12 mt-4">
                    <button type="submit" class="btn btn-primary mt-3" style="width: 100%;">Ubah</button>
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
  </style>
@endpush

@push("script")
  <script type="text/javascript">
    $(document).ready(function() {
      var f1 = flatpickr(document.getElementById('date'));
    });
  </script>
@endpush
