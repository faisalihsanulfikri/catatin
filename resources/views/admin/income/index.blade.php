@extends("template.main") 

@section("subtitle", "Pemasukan")

@section("breadcrumb")
  <li class="breadcrumb-item active"><a href="{{ route('admin.income.index') }}">Pemasukan</a></li>
@endsection

@section("content")

  <div class="container">
    <div class="container">
      
      <div class="widget-content-area br-4 mt-4">
        <div class="widget-one">
            <h5 class="title-page">Pemasukan</h5>
        </div>
      </div>

      <div id="basic" class="row layout-spacing layout-top-spacing">
        <div class="col-12">
          @component("components.app-message")
          @endcomponent
          <div class="widget-content widget-content-area br-6">
            <div class="row">
              <div class="col-6" style="text-align: left;">
                <span><strong>Tabel Pemasukan</strong> </span>
              </div>
              <div class="col-6" style="text-align: right;">
                <a href="{{ route('admin.income.new') }}" class="action-btn btn btn-primary pull-right">
                  <i class="fas fa-plus"></i>
                </a>
              </div>
            </div>
            <div class="table-responsive mb-4 mt-4">
              <table id="tableCustom" class="mb-0 table" style="width:100%">
                <thead>
                  <tr>
                    <th width="20%">Tanggal</th>
                    <th width="50%">Keterangan</th>
                    <th width="20%">Total</th>
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
    .right {
      float: right;
    }
    .left {
      float: left;
    }
  </style>
@endpush

@push("script")
  <script type="text/javascript">
    let templateData = {
			element: {
				tableCustom: $("#tableCustom"),
			},
			styles: {
        date: function(row, type, data) {
					return moment(data.date).locale("id").format('DD MMMM YYYY');
				},
        amount: function(row, type, data) {
          let html = `<div>`;
          
          html += `<span class="left">Rp.</span> `;
          html += `<span class="right">${data.formated_amount}</span>`;

          html += '</div>';
					return html;
				},
				action: function(row, type, data) {
          let urlDetail = '{{ route("admin.income.edit", ["income_id" => ":income_id"]) }}';
          urlDetail = urlDetail.replace(":income_id", data.id);

          let html = '<div class="text-center" style="display: flex; place-content: center;">';
					html += `
            <a type="button" class="action-btn btn btn-sm btn-primary mr-1" 
							href="${urlDetail}">
							<i class="fas fa-eye"></i>
						</a>
          `;
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
				url: '{{ route("datatable.admin.income.index") }}',
				type: 'GET',
			},
			columns: [
				{ orderable: false, sClass:"text-center", render: templateData.styles.date },
				{ data: 'limit_description', name: 'limit_description' },
				{ orderable: false, render: templateData.styles.amount },
				{ orderable: false, sClass:"text-center", render: templateData.styles.action },
			]
		});
  </script>
@endpush