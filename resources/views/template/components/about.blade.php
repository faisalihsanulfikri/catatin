<section id="about" class="about">
  <div class="container">
    <div class="row justify-content-between">
      <div class="col-4 summary summary-total-campaign">
        <div>
          <h3>{{ $summaries['total_campaigns'] }}</h3>
        </div>
        <div>
          <h4>Campaign</h4>
        </div>
      </div>
      <div class="col-4 summary">
        <div>
          <h3>Rp. {{ number_format($summaries['total_donations']) }}</h3>
        </div>
        <div>
          <h4>Total Donasi</h4>
        </div>
      </div>
      <div class="col-4 summary summary-total-donatur">
        <div>
          <h3>{{ $summaries['total_donaturs'] }}</h3>
        </div>
        <div>
          <h4>Total Donatur</h4>
        </div>
      </div>
    </div>
    <br>
    <div class="row justify-content-between">
      <div class="col-12 summary summary-total-campaign border-radius-15">
        <div>
          <span style="color: #7a6960;">Kirimkan donasi anda melalui rekening dibawah ini.</span>
        </div>
        <div>
          <h4>{{ $configs['bank_name'] }} {{ $configs['bank_account_number'] }}</h4>
        </div>
        <div>
          <h4>An. {{ $configs['bank_account_name'] }}</h4>
        </div>
      </div>
    </div>
  </div>
</section>

@push("style")
  <style>
    .summary {
      text-align: center;
      padding: 15px;
      background-color: #fce9e0;
    }
    .summary-total-campaign {
      border-top-left-radius: 15px;
      border-bottom-left-radius: 15px;
    }
    .summary-total-donatur {
      border-top-right-radius: 15px;
      border-bottom-right-radius: 15px;
    }
    .border-radius-15 {
      border-radius: 15px;
    }
    .top-640 {
      top : 640px !important;
    }
  </style>
@endpush