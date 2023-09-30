<div class="table-responsive mb-4 mt-4">
  <table id="tableSummaryIncome" class="mb-0 table" style="width:100%">
  <thead>
    <tr>
      <th width="5%">No</th>
      <th width="60%">Keterangan</th>
      <th width="5%">Qty</th>
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
    let dataI = {
      month : moment().locale("id").format('MM')
    }

    let templateDataI = {
      element: {
        tableSummaryIncome: $("#tableSummaryIncome"),
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

    templateDataI.element.tableSummaryIncome = templateDataI.element.tableSummaryIncome.DataTable({
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
          q.month = dataI.month
        },
				url: '{{ route("datatable.admin.income.summary") }}',
				type: 'GET',
			},
			columns: [
        { data: 'DT_RowIndex' },
				{ orderable: false, data: 'limit_description', name: 'limit_description' },
				{ data: 'qty', name: 'qty' },
				{ data: 'formated_amount', name: 'formated_amount' }
			]
		});

    function reloadTableSummaryIncome(month = null) {
      if (month) {
        dataI.month = month;
      }
      templateDataI.element.tableSummaryIncome.ajax.reload();
    }
  </script>
@endpush