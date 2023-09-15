<div class="table-responsive mb-4 mt-4">
  <table id="tableSummaryExpenditure" class="mb-0 table" style="width:100%">
  <thead>
    <tr>
      <th width="5%">No</th>
      <th width="65%">Keterangan</th>
      <th width="30%">Total</th>
    </tr>
  </thead>
  </table>
</div>

@push("style")
  <style>
    .dataTables_paginate, 
    .dataTables_length, 
    .dataTables_filter, 
    .dataTables_info { display: none !important; }
  </style>
@endpush

@push("script")
  <script type="text/javascript">
    let dataX = {
      month : moment().locale("id").format('MM')
    }
    let templateDataX = {
      element: {
        tableSummaryExpenditure: $("#tableSummaryExpenditure"),
      },
      styles: {
        amount: function(row, type, data) {
          let html = `<div>`;
          html += `<span class="left">Rp.</span> `;
          html += `<span class="right">${data.formated_amount}</span>`;
          html += '</div>';
            return html;
        },
      }
    };

    templateDataX.element.tableSummaryExpenditure = templateDataX.element.tableSummaryExpenditure.DataTable({
      aLengthMenu: [
          [25, 50, 100, 200, -1],
          [25, 50, 100, 200, "All"]
      ],
      iDisplayLength: -1,
      order: [
				[0, "asc"],
			],
			ajax: {
				headers: {
					'X-CSRF-TOKEN': "{{ csrf_token() }}"
				},
        data : function ( q ) {
          q.month = dataX.month
        },
				url: '{{ route("datatable.admin.expenditure.summary") }}',
				type: 'GET',
			},
			columns: [
				{ data: 'DT_RowIndex' },
				{ data: 'limit_description', name: 'limit_description' },
				{ orderable: false, render: templateDataX.styles.amount },
			]
		});

    function reloadTableSummaryExpenditure(month = null) {
      if (month) {
        dataX.month = month
      }

      templateDataX.element.tableSummaryExpenditure.ajax.reload();
    }
  </script>
@endpush