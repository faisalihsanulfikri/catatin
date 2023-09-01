<section id="news" class="services section-bg">
  <div class="container">

    <div class="section-title" data-aos="fade-up">
      <h2>Berita Terbaru</h2>
      <p>Berita untuk anda</p>
    </div>

    <div class="row">
      @foreach($newses as $news)
        <div class="col-md-4 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
          <div class="icon-box">
            <div class="icon">
              <img id="" src="{{ asset($news->getPhoto()) }}" class="campaign-img">
            </div>
            <hr>
            <h4 class="title"><a href="javascript:void(showNews({{ $news->id }}))">{{ $news->getTitle() }}</a></h4>
            <p class="description">{{ $news->getLimitContent() }}</p>
          </div>
        </div>
      @endforeach
    </div>

  </div>

    <!--  DETAIL NEWS MODAL  -->
	@component('components.modal', ["modalIdentifier" => "newsDetailModal"])
		@slot('modalTitle')
		 	Berita
		@endslot
		@slot('modalSize', 'modal-xl')
		@slot('modalBody')
			<div id="container_news_detail">
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
    function showNews(news_id) {
      let url = '{{ route("json.news.view", ["newsId" => ":newsId"]) }}';  
      url = url.replace(":newsId", news_id);
      request({
        url: url,
        method: 'GET',
        data: {},
        dataType: 'json',
        success: function(response) {
          $("#newsDetailModal").modal("show");

					/** mapping data */
					$('#container_news_detail #title').text(response.data.title);
					$('#container_news_detail #description').text(response.data.content);
					$('#container_news_detail #exists_photo').attr('src', response.data.photo);
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