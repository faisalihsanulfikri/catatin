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
          <div class="widget-content-area br-4 mt-4 title-container">
            <div class="widget-one">
              <div class="row">
                <div class="col">
                  <h5 class="title-page pt-100">Summary</h5>
                </div>
                <div class="col">
                  <div class="row">
                    <div class="col-4">&nbsp;</div>
                    <div class="col-6">
                      <select class="form-control form-control-sm basic float-right title-page" id="month"></select>
                    </div>
                    <div class="col-2">
                      <h5 class="title-page float-right pt-100" id="year"></h5>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>



      <div class="row">
        <div class="col mt-4">
          <div class="row widget-statistic">
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12 mb-1">
              <div class="widget widget-one_hybrid widget-followers">
                <div class="widget-heading">
                  <div class="w-icon">
                    <i data-feather="codesandbox"></i>
                  </div>
                  <p class="w-value" id="totalIncome">10</p>
                  <h5 class="">Total Pemasukan</h5>
                </div>
              </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12 mb-1">
              <div class="widget widget-one_hybrid widget-referral">
                <div class="widget-heading">
                  <div class="w-icon">
                    <i data-feather="command"></i>
                  </div>
                  <p class="w-value" id="totalExpenditure">10</p>
                  <h5 class="">Total Pengeluaran</h5>
                </div>
              </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12 mb-1">
              <div class="widget widget-one_hybrid widget-engagement">
                <div class="widget-heading">
                  <div class="w-icon">
                    <i data-feather="database"></i>
                  </div>
                  <p class="w-value" id="totalWealth">10</p>
                  <h5 class="">Total Asset Per <span id="monthName"></span></h5>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      
      <div class="row">
        <div class="col">
          <div class="row widget-statistic">
            <div class="col-12 mb-4">
              <div class="widget widget-one_hybrid">
                <div class="widget-content-area br-4 mt-4">
                  <div class="widget-one">
                    <h5 class="title-page">Pengeluaran Bulan <span id="monthNameChart"></span></h5>
                  </div>
                  <div>
                    <div id="s-line-area" class=""></div>
                  </div>
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
    .select2 {
      margin-bottom: 0px !important;
    }
    .select2-selection__rendered {
      border: 0 !important;
      font-weight: bold;
      font-size: 19px !important;
      letter-spacing: 0px;
      margin-bottom: 0;
      color: #515365;
    }
    .select2-selection__arrow {
      padding-top: 2rem !important;
    }
    .pt-100 {
      padding-top: 1rem;
    }
    .title-container {
      padding: 0.1rem 1rem;
      border-radius: 5px;
    }
  </style>
@endpush

@push("script")
  <script src="{{asset('plugins/apex/apexcharts.min.js')}}"></script>
  <script src="{{asset('assets/js/dashboard/dash_2.js')}}"></script>

  <script type="text/javascript">

    let expenditureChart = null;
    let data = {
      month : moment().locale("id").format('MM'),
      expenditures: []
    }

    $("#month").select2({ tags: true });

    $(document).ready(function() {   
      generateSelectMonth($('#month'));
      setYear();
      setMonthName();
      fetchIncomeSummaryMonthly();
      fetchExpenditureSummaryMonthly();
      fetchWealthSummaryMonthly();
    });

    $('#month').on('change', function(e) {
      data.month = $(this).val();
      setMonthName();
      fetchIncomeSummaryMonthly();
      fetchExpenditureSummaryMonthly(true);
      fetchWealthSummaryMonthly();
    });

    function fetchIncomeSummaryMonthly() {
      request({
          url: `{{ route('json.admin.income.summary-monthly') }}`,
          method: 'GET',
          data: {
            month: data.month
          },
          success: function(response) {
            setTotalIncome(response.data.totalIncome);
          },
          error: function(error) {  
            fetchIncomeSummaryMonthly();
          }
        });
    }

    function fetchExpenditureSummaryMonthly(update = false) {
      request({
          url: `{{ route('json.admin.expenditure.summary-monthly') }}`,
          method: 'GET',
          data: {
            month: data.month
          },
          success: function(response) {
            setTotalExpenditure(response.data.totalExpenditure);
            
            if (update) {
              data.expenditures = response.data.expenditures;
              updateChart()
            } else {
              generateExpenditureChart(response.data.expenditures);
            }
          },
          error: function(error) {  
            fetchExpenditureSummaryMonthly()
          }
        });
    }

    function fetchWealthSummaryMonthly() {
      request({
          url: `{{ route('json.admin.wealth.summary-monthly') }}`,
          method: 'GET',
          data: {
            month: data.month
          },
          success: function(response) {
            setTotalWealth(response.data.totalAsset);
          },
          error: function(error) {  
            fetchWealthSummaryMonthly()
          }
        });
    }

    function generateExpenditureChart(data) {
      var sLineArea = {
        chart: {
          height: 350,
          type: 'area',
          toolbar: {
            show: false,
          }
        },
        dataLabels: {
          enabled: false
        },
        stroke: {
          curve: 'smooth'
        },
        series: [
          {
            name: 'Pengeluaran',
            data: data.map(expenditure => expenditure.total_amount)
          }
        ],
        xaxis: {
          categories: data.map(expenditure => moment(expenditure.date).locale("id").format('DD MMM')),                
        },
        tooltip: {
          x: {
            format: 'dd/MM/yy'
          },
        }
      }

      expenditureChart = new ApexCharts(document.querySelector("#s-line-area"), sLineArea);
      expenditureChart.render();
    }

    function generateSelectMonth(element) {
      let months = [
        { id: '01', name: 'Januari' },
        { id: '02', name: 'Februari' },
        { id: '03', name: 'Maret' },
        { id: '04', name: 'April' },
        { id: '05', name: 'Mei' },
        { id: '06', name: 'Juni' },
        { id: '07', name: 'Juli' },
        { id: '08', name: 'Agustus' },
        { id: '09', name: 'September' },
        { id: '10', name: 'Oktober' },
        { id: '11', name: 'November' },
        { id: '12', name: 'Desember' },
      ];

      element.html("");
      let html = '';

      months.forEach(month => {
        let selected = month.id == moment().locale("id").format('MM') ? 'selected' : '';
        html += `<option value="${month.id}" ${selected}>${month.name}</option>`;
      });

      element.html(html);
    }

    function setYear() {
      $('#year').text(moment().locale("id").format('YYYY'));
    }

    function setMonthName() {
      let date = getDate();
      $('#monthName').text(moment(date).locale("id").format('MMMM YYYY'));
      $('#monthNameChart').text(moment(date).locale("id").format('MMMM YYYY'));
    }
    
    function setTotalIncome(total) {
      $('#totalIncome').text(total);
    }
    
    function setTotalExpenditure(total) {
      $('#totalExpenditure').text(total);
    }

    function setTotalWealth(total) {
      $('#totalWealth').text(total);
    }

    function getDate() {
      return `${moment().locale("id").format('YYYY')}-${data.month}-01`;
    }

    function updateChart() {
      expenditureChart.updateOptions({
        series: [
          {
            name: 'Pengeluaran',
            data: data.expenditures.map(expenditure => expenditure.total_amount)
          }
        ],
        xaxis: {
          categories: data.expenditures.map(expenditure => moment(expenditure.date).locale("id").format('DD MMM')),                
        },
      });
    }

  </script>
@endpush
