@component('components.modal', ["modalIdentifier" => "approveModal", "modalSize" => "modal-md"])
@slot('modalTitle')
  Penerimaan Pendaftaran
@endslot
@slot('modalBody')
  <div class="container">
    <div id="formApprove">
      <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 col-12">
          <div class="form-group">
            <label for="class_id">Kelas <strong class="text-danger">*</strong></label>
            <select id="class_id" class="selectpicker form-control form-control-sm" name="class_id" required>
              <option value="" selected>- Pilih Kelas -</option>
            </select>
            <input type="hidden" id="select_admission_id">
          </div>
        </div>
      </div>
      <div class="button-group" style="margin-top: 10px; text-align: right;">
        <button class="btn btn-primary btn-sm mr-1" onclick="approveConfirm()">
          <i class="far fa-save"></i> Lanjutkan
        </button>
      </div>
    </div>
  </div>
@endslot
@slot('modalFooter')
  <div class="container">&nbsp;</div>
@endslot
@endcomponent

@push("script")
<script type="text/javascript">
  $('#class_id').select2({ dropdownParent: $("#approveModal") });
  $(document).ready(function() {
    fetchClass($('#class_id'));
  });

  function showFormApprove(id) {
    $("#approveModal").modal("show");
    $("#approveModal #select_admission_id").val(id);
  }
  
  function hideFormApprove() {
    $("#approveModal").modal("hide");
    $("#approveModal #select_admission_id").val(null);
  }

  function fetchClass(element) {
    $.ajax({
      headers: {
        "Authorization": "{{ session('jwt_token') }}"
      },
      url: '{{ route("json.admin.classes.index") }}',
      type: 'GET',
      success: function(response) {
        element.html("");
        let html = '<option value="" selected>- Pilih Kelas -</option>';
        response.data.forEach(classes => {
          html += `<option value="${classes.id}">${classes.name}</option>`;
        });
        element.html(html);
      },
      error: function(error) {
        let title = 'Terjadi Kesalahan';
        let msg = 'Gagal memproses data';
        let type = 'error';

        if ([422, 403].includes(error.status)) {
          title = 'Peringatan';
          msg = error.responseJSON.message;
          type = 'warning';
        }
        swal(title, msg, type);
      }
    });
  }

  function approveConfirm() {
    swal({
      title: 'Terima Pendaftaran ?',
      text: "Anda yakin akan menerima pendaftaran ini ?",
      type: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Terima',
      padding: '2em'
    }).then(function(result) {
      if (result.value) {
        approve();
      }
    })
  }

  function approve() {
    let id = $("#approveModal #select_admission_id").val();

    _starLoading();
    let url = '{{ route("json.admin.admission.approve", ["admission_id" => ":admission_id"]) }}';
    url = url.replace(":admission_id", id);

    request({
      url: url,
      method: 'POST',
      data: {
        class_id: $('#class_id').val()
      },
      success: function(response) {
        _stopLoading();
        swal('Sukses', 'Berhasil menerima pendaftaran', 'success');
        templateData.element.tableCustom.ajax.reload();
        hideFormApprove();

        sendNotifApprovalAdmission(id, 'approve');
      },
      error: function(error) {
        _stopLoading();
        let title = 'Terjadi Kesalahan';
        let msg = 'Gagal memproses data';
        let type = 'error';

        if ([422, 403].includes(error.status)) {
          title = 'Peringatan';
          msg = error.responseJSON.message;
          type = 'warning';
        }
        swal(title, msg, type);
      }
    });
  }

</script>
@endpush