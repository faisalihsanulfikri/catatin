
@push("script")
<script type="text/javascript">
  function unapproveConfirm(id) {
    swal({
      title: 'Tolak Pendaftaran ?',
      text: "Anda yakin akan menolak pendaftaran ini ?",
      type: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Tolak',
      padding: '2em'
    }).then(function(result) {
      if (result.value) {
        unapprove(id);
      }
    })
  }

  function unapprove(id) {
    _starLoading();
    let url = '{{ route("json.admin.admission.unapprove", ["admission" => ":admission"]) }}';
    url = url.replace(":admission", id);

    request({
      url: url,
      method: 'POST',
      data: {
        class_id: 1
      },
      success: function(response) {
        _stopLoading();
        swal('Sukses', 'Berhasil menolak pendaftaran', 'success');
        templateData.element.tableCustom.ajax.reload();

        sendNotifApprovalAdmission(id, 'unapprove');
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