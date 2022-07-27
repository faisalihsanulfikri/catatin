<div class="modal" role="dialog" id="loading" data-keyboard="false" data-backdrop="static" style="background-color: #00000040;">
  <div class="modal-dialog modal-m" role="document" style="margin-top: 300px; animation: inherit;">
    <div class="modal-content" style="padding: 20px 0; background-color: transparent; border: 0;">
      <div class="d-flex justify-content-center">
        <div class="spinner-border" role="status" style="width: 60px; height: 60px; font-size: 35px; color: white;">
        </div>
      </div>
    </div>
  </div>
</div>

@push("script")
  <script type="text/javascript">

  function _starLoading() {
    $('#loading.modal').modal("show");
  }

  function _stopLoading() {
    $('#loading.modal').modal("hide");
  }

  </script>
@endpush