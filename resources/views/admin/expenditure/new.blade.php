@extends("template.main") 

@section("subtitle", "Pengeluaran Baru")

@section("breadcrumb")
  <li class="breadcrumb-item"><a href="{{ route('admin.expenditure.index') }}">Pengeluaran</a></li>
  <li class="breadcrumb-item active" aria-current="page"><span>Pengeluaran Baru</span></li>
@endsection

@section("content")
  <div class="container">
    <div class="container">

      <a href="{{ route('admin.expenditure.index') }}" class="btn btn-danger mt-4">
        Kembal
      </a>

      <div class="widget-content-area br-4 mt-3">
        <div class="widget-one">
          <h5 class="title-page">Pengeluaran Baru</h5>
        </div>
      </div>        
      <div id="basic" class="row layout-spacing layout-top-spacing">
        <div class="col-lg-12">

        <!-- ERROR MESSAGE SECTION -->

          @if($errors->expenditure->has("amount") ||
            $errors->expenditure->has("date") ||
            $errors->expenditure->has("description")
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
              @if($errors->expenditure->has("amount")) 
                <i class="ti-info"></i> {{ $errors->expenditure->first("amount") }}	<br>
              @endif
              @if($errors->expenditure->has("date")) 
                <i class="ti-info"></i> {{ $errors->expenditure->first("date") }}	<br>
              @endif
              @if($errors->expenditure->has("description")) 
              <i class="ti-info"></i> {{ $errors->expenditure->first("description") }}
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
                  <h4> Buat Pengeluaran baru disini </h4>
                </div>
              </div>
            </div>
            <div class="widget-content widget-content-area">
              <form method="post" action="{{ route('admin.expenditure.create') }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="row">
                  <div class="col-6">
                    <div class="form-group">
                      <label for="date">Tanggal <strong class="text-danger">*</strong></label>
                      <input type="text" name="date" class="form-control" id="date" required>
                    </div>
                    <div class="form-group">
                      <label for="description">Keterangan <strong class="text-danger">*</strong></label>
                      <textarea type="text" name="description" class="form-control" id="description" rows="5" required> </textarea>
                    </div>
                    
                    <div class="form-group">
                      <label for="amount">Total <strong class="text-danger">*</strong></label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text">Rp.</span>
                        </div>
                        <input type="text" name="amount" class="form-control" id="amount" required>
                      </div>
                    </div>
                  </div>
                  <hr>
                  <div class="col-12 mt-4" style="text-align: center;">
                    <button type="submit" class="btn btn-primary mt-3" style="width: 100%;">Tambah</button>
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
      var f1 = flatpickr(document.getElementById('date'));
    });

  </script>
@endpush
