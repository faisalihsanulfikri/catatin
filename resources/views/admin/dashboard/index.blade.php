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
          <div class="widget-content-area br-4 mt-4">
            <div class="widget-one">
              <div class="row">
                <div class="col">
                  <h5 class="title-page">Summary</h5>
                </div>
                <div class="col">
                  <h5 class="title-page float-right" id="monthName"></h5>
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
                  <h5 class="">Total Asset</h5>
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
  </style>
@endpush

@push("script")
  <script src="{{asset('plugins/apex/apexcharts.min.js')}}"></script>
  <script src="{{asset('assets/js/dashboard/dash_2.js')}}"></script>

  <script type="text/javascript">
    let data = {
      month : moment().locale("id").format('MM')
    }

    $(document).ready(function() {
      setMonthName();

      fetchIncomeSummaryMonthly();
      fetchExpenditureSummaryMonthly();
      fetchWealthSummary();
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

    function fetchExpenditureSummaryMonthly() {
      request({
          url: `{{ route('json.admin.expenditure.summary-monthly') }}`,
          method: 'GET',
          data: {
            month: data.month
          },
          success: function(response) {
            generateExpenditureChart(response.data.expenditures);
            setTotalExpenditure(response.data.totalExpenditure);
          },
          error: function(error) {  
            fetchExpenditureSummaryMonthly()
          }
        });
    }

    function fetchWealthSummary() {
      request({
          url: `{{ route('json.admin.wealth.summary') }}`,
          method: 'GET',
          data: {
            month: data.month
          },
          success: function(response) {
            setTotalWealth(response.data.formated_amount);
          },
          error: function(error) {  
            fetchWealthSummary()
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

      var chart = new ApexCharts(document.querySelector("#s-line-area"),sLineArea);
      chart.render();
    }

    function setMonthName() {
      $('#monthName').text(moment().locale("id").format('MMMM YYYY'));
      $('#monthNameChart').text(moment().locale("id").format('MMMM YYYY'));
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


  </script>
@endpush
