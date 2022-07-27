@extends("template.main") 

@section("subtitle", "PPDB")

@section("breadcrumb")
  <li class="breadcrumb-item">PPDB</li>
  <li class="breadcrumb-item active"><a href="{{ route('admin.admission.index') }}">Pendaftaran</a></li>
@endsection

@section("content")

  <div class="container">
    <div class="container">
      
      <div class="widget-content-area br-4 mt-4">
        <div class="widget-one">
            <h5 class="title-page">Pendaftaran</h5>
        </div>
      </div>

      <div id="basic" class="row layout-spacing layout-top-spacing">
        <div class="col-12">
          @component("components.app-message")
          @endcomponent
          <div class="widget-content widget-content-area br-6">
            <div class="row">
              <div class="col-6" style="text-align: left;">
                <span><strong>Tabel Pendaftaran</strong> </span>
              </div>
            </div>
            <div class="table-responsive mb-4 mt-4">
              <table id="tableCustom" class="mb-0 table" style="width:100%">
                <thead>
                  <tr>
                    <th width="5%">No</th>
                    <th width="20%">Foto</th>
                    <th width="25%">Nama</th>
                    <th width="10%">NISN</th>
                    <th width="20%">Tempat, Tanggal Lahir</th>
                    <th width="10%">Status</th>
                    <th width="10%">Aksi</th>
                  </tr>
                </thead>
              </table>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>

  @component("admin.admission.components.approve")
  @endcomponent
  @component("admin.admission.components.unapprove")
  @endcomponent

  @component("components.ajax-request")
  @endcomponent
@endsection

@push("style")
  <style>
    .action-btn {
      padding: 7px 10px;
    }
    .add-btn {
      font-size: 24px;
      padding: 0px 12px;
      font-weight: bold;
    }
    .title-page {
      font-weight: bold;
      font-size: 19px;
      letter-spacing: 0px;
      margin-bottom: 0;
      color: #515365;
    }
    .image-student {
      width: auto; 
      height:70px;
      border-radius: 10px;
      transition: transform .2s;
      margin: 0 auto;
    }
    .image-student:hover {
      transform: scale(1.5);
      position: relative;
      z-index: 1;
    }

    @media only screen and (min-width: 768px) {
      #tableCustom_length {
        position: absolute;
      }
    }

    .dt-buttons {
      text-align: end;
    }
  </style>
@endpush

@push("script")
  <script type="text/javascript">
    let templateData = {
      admissions: [],
			element: {
				tableCustom: $("#tableCustom"),
			},
			styles: {
        photo: function(row, type, data) {
					let html = '<div>';
					html += `
						<img 
							src="${data.photo}" 
							alt=""
              class="image-student"
						>
					`;
					html += '</div>';
					return html;
				},
        birth: function(row, type, data) {
          let date_of_birth = moment(data.date_of_birth).locale("id").format('DD-MM-YYYY');
					return `${data.place_of_birth}, ${date_of_birth}`;
				},
        status: function(row, type, data) {
          let badgeType = 'badge-secondary';
          if (data.status == 'pending') badgeType = `badge-warning`;
          else if (data.status == 'approve') badgeType = `badge-success`;
          else if (data.status == 'unapprove') badgeType = `badge-danger`;
          else badgeType = `badge-secondary`;
          
          let html = '';
          html += `<span class="badge ${badgeType}">${data.formated_status}</span>`;
					return html;
				},
				action: function(row, type, data) {
          let urlDetail = '{{ route("admin.admission.edit", ["admission_id" => ":admission_id"]) }}';
          urlDetail = urlDetail.replace(":admission_id", data.id);

          let html = '<div class="text-center" style="display: flex; place-content: center;">';

					detailBtn = `
						<a type="button" class="action-btn btn btn-sm btn-primary mr-1" 
							href="${urlDetail}">
							<i class="fas fa-eye"></i>
						</a>
					`;
					approveBtn = `
						<a type="button" class="action-btn btn btn-sm btn-success mr-1" 
							href="javascript:void(showFormApprove(${data.id}))">
							<i class="fas fa-check"></i>
						</a>
					`;
					unapproveBtn = `
            <a type="button" class="action-btn btn btn-sm btn-danger mr-1" 
							href="javascript:void(unapproveConfirm(${data.id}))">
							<i class="fas fa-times"></i>
						</a>
					`;


					html += detailBtn;
          if (data.status == 'pending') {
            html += approveBtn;
            html += unapproveBtn;
          }
          else if (data.status == 'unapprove') {
            html += approveBtn;
          }
					html += '</div>';
					return html;
				}
			}
		};

    templateData.element.tableCustom = templateData.element.tableCustom.DataTable({
      oLanguage: {
          oPaginate: { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
          sInfo: "Halaman _PAGE_ dari _PAGES_",
          sSearch: '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
          sSearchPlaceholder: "Search...",
          sLengthMenu: "Results :  _MENU_",
      },
      stripeClasses: [],
      lengthMenu: [5, 10, 20, 50],
      pageLength: 10,
			processing: true,
			serverSide: true,
			bSortable: false,
			bSearchable: false,
      searching: true,
      bLengthChange: false,
      stateSave: true,
			order: [
				[0, "asc"],
			],
			ajax: {
				headers: {
					'X-CSRF-TOKEN': "{{ csrf_token() }}"
				},
				url: '{{ route("datatable.admin.admission.index") }}',
				type: 'GET',
			},
			columns: [
				{ data: 'DT_RowIndex', name: 'DT_RowIndex' },
				{ orderable: false, sClass:"text-center", render: templateData.styles.photo },
				{ data: 'name', name: 'name' },
				{ data: 'nisn', name: 'nisn' },
				{ orderable: false, sClass:"text-center", render: templateData.styles.birth },
				{ orderable: false, sClass:"text-center", render: templateData.styles.status },
				{ orderable: false, sClass:"text-center", render: templateData.styles.action },
			],
      drawCallback: function( datatable ) {
        templateData.admissions = datatable.json.data;
      }
		});

    function sendNotifApprovalAdmission(id, status) {
      const admission = templateData.admissions.find((admission) => admission.id == id);
      const parentPhone = getParentPhone(admission);
      const msg = getMessage(admission, status);
      
      const wa_endpoint = `https://api.whatsapp.com/send?phone=${parentPhone}&text=${msg}`;
      window.open(wa_endpoint, '_blank');
    }

    function getParentPhone(admission) {
      let parentPhone = admission.parent_phone;
      if (parentPhone[0] == '0') {
        parentPhone = '+62' + parentPhone.substring(1);
      }

      return parentPhone;
    }

    function getMessage(admission, status) {
      return encodeURI(`Konfirmasi Pendaftaran Peserta Didik Baru
Nama : ${admission.name} 
NISN : ${admission.nisn} 
Status Penerimaan : ${getFormatStatus(status)} 
`);
    }

    function getFormatStatus(status) {
      let formatStatus = ''
      if (status == 'approve') formatStatus = 'Diterima';
      if (status == 'unapprove') formatStatus = 'Ditolak';
      return formatStatus;
    }

  </script>
@endpush