@extends("landing.template.main") 

@section("subtitle", "Artikel")

@section("content")

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
        <section class="elementor-section elementor-inner-section elementor-element elementor-element-2b2f9b8e elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="2b2f9b8e" data-element_type="section">
          <div id="line-article">
            <div id="continer-article-1" class="elementor-container elementor-column-gap-default">
            </div>
          </div>
          

          <div id="more-article" class="more-article">
            <div class="elementor-element elementor-element-7a9ab80d elementor-align-left elementor-widget elementor-widget-button"
            data-id="7a9ab80d" data-element_type="widget" data-widget_type="button.default" style="text-align: center;">
              <div class="elementor-widget-container">
                <div class="elementor-button-wrapper">
                  <a onclick="loadMoreProduct()" class="elementor-button-link elementor-button elementor-size-lg"
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

  @component("components.ajax-request")
  @endcomponent
@endsection

@push("style")
  <style>
    .more-article {
      text-align: center;
      margin-top: 30px;
    }
  </style>
@endpush

@push("script")
  <script>
    let articleData = {
      page: 1,
      limit: 3,
      order: 'newest'
    }

    $(document).ready(function() {
      fetchArticle();
    });

    function loadMoreProduct() {
      articleData.page = articleData.page + 1;
      fetchArticle();
    }

    function disabledLoadMoreButton() {
      $('#more-article').prop('hidden', true);
    }

    function mappingArticle(data) {
      let containerArticle = `
        <div id="continer-article-${articleData.page}" class="elementor-container elementor-column-gap-default">
        </div>
      `;
      $('#line-article').append(containerArticle);

      for (let i = 0; i < data.length; i++) {
        let article = data[i];
        html = `
          <div class="elementor-column elementor-col-33 elementor-inner-column elementor-element elementor-element-726e0acb"
            data-id="726e0acb" data-element_type="column"
            data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
            <div class="elementor-widget-wrap elementor-element-populated">
              <div class="elementor-element elementor-element-57c6af3f elementor-widget elementor-widget-image"
                data-id="57c6af3f" data-element_type="widget"
                data-widget_type="image.default">
                <div class="elementor-widget-container">
                  <a href="/article/${article.id}">
                    <img src="${article.thumbnail}" title="FB_IMG_1492949363312" alt="FB_IMG_1492949363312" />
                  </a>
                </div>
              </div>
              <div class="elementor-element elementor-element-4175220d elementor-widget elementor-widget-heading"
                data-id="4175220d" data-element_type="widget"
                data-widget_type="heading.default">
                <div class="elementor-widget-container">
                  <h2 class="elementor-heading-title elementor-size-default">
                    ${article.title}
                  </h2>
                </div>
              </div>
            </div>
          </div>
        `;

        $(`#continer-article-${articleData.page}`).append(html);
      };

      if (data.length == 0) {
        $('#nodata-article').prop('hidden', false)
      } else {
        $('#nodata-article').prop('hidden', true)
      }
    }

    function fetchArticle() {
      let url = '{{ route("json.article.index") }}';

      request({
        url: url,
        method: 'GET',
        data: {
          page: articleData.page,
          limit: articleData.limit,
          order: articleData.order
        },
        dataType: 'json',
        success: function(response) {
          mappingArticle(response.data);

          if (response.data.length != articleData.limit) {
            disabledLoadMoreButton();
          }
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