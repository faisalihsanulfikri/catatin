<section id="services" class="services section-bg">
  <div class="container">

    <div class="section-title" data-aos="fade-up">
      <h2>Campaign</h2>
      <p>Pilih dan salurkan donasi untuk campaign yang berarti bagi Anda</p>
    </div>

    <div class="row">
      @foreach($campaigns as $campaign)
      <div class="col-md-4 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
        <div class="icon-box">
          <div class="icon">
            <img id="" src="{{ asset($campaign->getPhoto()) }}" class="campaign-img">
          </div>
          <h4 class="title"><a href="javascript:void(showCampaign({{ $campaign->id }}))">{{ $campaign->getTitle() }}</a></h4>
          <p class="description">{{ $campaign->getLimitContent() }}</p>
          <hr>
          <div>
            <table class="summary-campaign-table">
              <tr>
                <td>Donasi Terkumpul</td>
                <th>: {{ $campaign->getFormatedTotalDonations() }}</th>
              </tr>
              <tr>
                <td>Target</td>
                <th class="total-target-campaign">: {{ $campaign->getFormatedTargetDonations() }}</th>
              </tr>
            </table>
          </div>
        </div>
      </div>
      @endforeach
    </div>
    <div class="col-md-12 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
      <div style="width: 100%;">
        <a href="{{ route('user.campaign.index') }}" class="btn btn-success" style="width: 100%; border-radius: 20px;">Mulai Donasi</a>
      </div>
    </div>
  </div>

  <!--  DETAIL CAMPAIGN MODAL  -->
	@component('components.modal', ["modalIdentifier" => "campaignDetailModal"])
		@slot('modalTitle')
		 	Campaign
		@endslot
		@slot('modalSize', 'modal-xl')
		@slot('modalBody')
			<div id="container_campaign_detail">
        <div class="row">
          <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 col-12">
            <div>
              <h3 style="text-align: center;"> <span id="title"></span></h3>
            </div>
            <hr>
            <div>
                <img id="exists_photo" src="#" style="max-width: 100%; width: 100%;" alt="">
              </div>
            <hr>
            <div>
              <table class="summary-campaign-table">
                <tr>
                  <td>Donasi Terkumpul</td>
                  <th id="total_donations"></th>
                </tr>
                <tr>
                  <td>Target</td>
                  <th id="target_donations" class="total-target-campaign"></th>
                </tr>
              </table>
            </div>
            <hr>
            <div>
              <p id="description" style="text-align: justify;"></p>
            </div>
          </div>
        </div>
			</div>
		@endslot
	@endcomponent

</section>

@push("style")
<style>
  .campaign-img {
    width: 100%;
    height: auto;
    object-fit: cover;
  }
  .title {
    margin: 15px 0px;
  }
  .summary-campaign-table th {
    padding: 5px;
    text-align: left;
  }
  .summary-campaign-table td {
    padding: 5px;
    text-align: left;
  }
  .total-target-campaign {
    color: #eb5d1e;
  }

  .modal-width {
    width: 60%;
    max-width: 100%;
  }
</style>
@endpush

@push("script")
	<script type="text/javascript">
		function showCampaign(campaign_id) {
      let url = '{{ route("json.campaign.view", ["campaignId" => ":campaignId"]) }}';  
      url = url.replace(":campaignId", campaign_id);
			request({
        url: url,
        method: 'GET',
        data: {},
        dataType: 'json',
        success: function(response) {
					$("#campaignDetailModal").modal("show");

					/** mapping data */
					$('#container_campaign_detail #title').text(response.data.title);
					$('#container_campaign_detail #description').text(response.data.view_content);
					$('#container_campaign_detail #target_donations').text(`: ${response.data.formated_target_donations}`);
					$('#container_campaign_detail #total_donations').text(`: ${response.data.formated_total_donations}`);
					$('#container_campaign_detail #exists_photo').attr('src', response.data.photo);
				},
        error: function(error) {
					if (error.responseJSON.code == 404) {
            swal("Terjadi kesalahan", error.responseJSON.message, "warning");
          } else {
            swal("Terjadi kesalahan", "Gagal memuat data", "warning");
          }
				}
      });
    }

		function request(parameter) {
      let formatedParameter = {
				headers: {
					'X-CSRF-TOKEN': "{{ csrf_token() }}"
				},
				url: parameter.url,
				method: parameter.method,
				data: parameter.data,
				dataType: parameter.dataType,
				success: parameter.success,
				error: parameter.error,
			};
      if (parameter.beforeSend !== null) {
        formatedParameter.beforeSend = parameter.beforeSend;
      }
      if (parameter.complete !== null) {
        formatedParameter.complete = parameter.complete;
      }
      $.ajax(formatedParameter);
    }
  </script>
@endpush