<section
class="elementor-section elementor-top-section elementor-element elementor-element-406b6153 elementor-section-boxed elementor-section-height-default elementor-section-height-default"
data-id="406b6153" data-element_type="section" id="artikel"
data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
  <div class="elementor-background-overlay"></div>
  <div class="elementor-container elementor-column-gap-default">
    <div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-321d985"
      data-id="321d985" data-element_type="column">
      <div class="elementor-widget-wrap elementor-element-populated">
        <div class="elementor-element elementor-element-4b85c098 elementor-widget elementor-widget-heading"
          data-id="4b85c098" data-element_type="widget" data-widget_type="heading.default">
          <div class="elementor-widget-container">
            <h2 class="elementor-heading-title elementor-size-default">Artikel Sekolah</h2>
          </div>
        </div>
        <div class="elementor-element elementor-element-42b1d633 elementor-widget elementor-widget-text-editor"
          data-id="42b1d633" data-element_type="widget" data-widget_type="text-editor.default">
          <div id="nodata-article" class="elementor-widget-container" hidden>
            <p><strong>Tidak ada data artikel yang di publish</strong></p>
          </div>
        </div>
        <section
          class="elementor-section elementor-inner-section elementor-element elementor-element-2b2f9b8e elementor-section-boxed elementor-section-height-default elementor-section-height-default"
          data-id="2b2f9b8e" data-element_type="section">
          <div id="continer-article" class="row elementor-container elementor-column-gap-default">
          </div>
          <div class="more-article">
            <div class="elementor-element elementor-element-7a9ab80d elementor-align-left elementor-widget elementor-widget-button"
            data-id="7a9ab80d" data-element_type="widget" data-widget_type="button.default" style="text-align: center;">
              <div class="elementor-widget-container">
                <div class="elementor-button-wrapper">
                  <a href="/article" class="elementor-button-link elementor-button elementor-size-lg"
                    role="button">
                    <span class="elementor-button-content-wrapper">
                      <span class="elementor-button-text">Selengkpanya</span>
                    </span>
                  </a>
                </div>
              </div>
            </div>
          </div>

        </section>
      </div>
    </div>
  </div>
</section>

@push("style")
  <style>
    .more-article {
      text-align: center;
      margin-top: 30px;
    }
    .img-article {
      height: 12rem !important;
      width: 16rem !important;

      object-fit: cover;
      margin-left: 1rem;
      margin-right: 1rem;
    }
    .card {
      text-align: center;
      margin-bottom: 1rem;
      border: 0;
      background-color: #fff0;
    }
  </style>
@endpush

@push("script")
  <script>
    $(document).ready(function() {
      fetchLatestArticle();
    });

    function mappingArticle(data) {
      let html = `<div id="continer-article" class="elementor-container elementor-column-gap-default">`;

      data.forEach(article => {
        html += `
          <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12" style="text-align: -webkit-center;">
            <div class="card" style="width: 18rem;">
              <a href="/article/${article.id}">
                <img class="img-article" src="${article.thumbnail}" title="FB_IMG_1492949363312" alt="FB_IMG_1492949363312" />
              </a>
              <div class="card-body">
                <h5 class="card-title text-center">${article.title}</h5>
              </div>
            </div>
          </div>


        `;
      });

      html += `</div>`;
      $('#continer-article').replaceWith(html);

      if (data.length == 0) {
        $('#nodata-article').prop('hidden', false)
      } else {
        $('#nodata-article').prop('hidden', true)
      }
    }

    function fetchLatestArticle() {
      let url = '{{ route("json.article.latest") }}';

      request({
        url: url,
        method: 'GET',
        data: {},
        dataType: 'json',
        success: function(response) {
          mappingArticle(response.data)
        },
        error: function(error) {
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