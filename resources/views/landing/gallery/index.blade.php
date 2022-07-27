@extends("landing.template.main") 

@section("subtitle", "Gallery")

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
            <h2 class="elementor-heading-title elementor-size-default">Gallery Sekolah</h2>
          </div>
        </div>
        <div class="elementor-element elementor-element-42b1d633 elementor-widget elementor-widget-text-editor"
          data-id="42b1d633" data-element_type="widget" data-widget_type="text-editor.default">
          <div id="nodata-article" class="elementor-widget-container">
            @if(count($galleries) > 0)
              <p><strong>Temukan Keseruan Bersekolah di Disni</strong></p>
            @else
              <p><strong>Tidak ada data gallery yang di publish</strong></p>
            @endif
          </div>
        </div>

        <div class="elementor-element elementor-element-585d46f3 elementor-widget elementor-widget-gallery"
          data-id="585d46f3" data-element_type="widget"
          data-settings="{&quot;columns_mobile&quot;:2,&quot;lazyload&quot;:&quot;yes&quot;,&quot;gallery_layout&quot;:&quot;grid&quot;,&quot;columns&quot;:4,&quot;columns_tablet&quot;:2,&quot;gap&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;size&quot;:10,&quot;sizes&quot;:[]},&quot;gap_tablet&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;size&quot;:10,&quot;sizes&quot;:[]},&quot;gap_mobile&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;size&quot;:10,&quot;sizes&quot;:[]},&quot;link_to&quot;:&quot;file&quot;,&quot;aspect_ratio&quot;:&quot;3:2&quot;,&quot;overlay_background&quot;:&quot;yes&quot;,&quot;content_hover_animation&quot;:&quot;fade-in&quot;}"
          data-widget_type="gallery.default">
          <div class="elementor-widget-container">
            <div class="row elementor-gallery__container">
              @foreach($galleries as $gallery)
                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-xs-12 col-6">
                  <div class="card">
                    <a href="{{ $gallery->filename }}">
                      <img class="img-gallery" src="{{ $gallery->filename }}" alt="">
                    </a>
                  </div>
                </div>
              @endforeach
            </div>
          </div>
        </div>

        <section class="elementor-section elementor-inner-section elementor-element elementor-element-2b2f9b8e elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="2b2f9b8e" data-element_type="section">
          <div class="page-number">
            <span><strong>Halaman : {{ $page }}</strong></span>
          </div>
          <div id="line-article">
            <div id="continer-article-1" class="elementor-container elementor-column-gap-default">
              <div id="more-gallery" class="more-gallery">
                <div class="elementor-element elementor-element-7a9ab80d elementor-align-left elementor-widget elementor-widget-button"
                data-id="7a9ab80d" data-element_type="widget" data-widget_type="button.default" style="text-align: center;">
                  <div class="elementor-widget-container">
                    <div class="elementor-button-wrapper">
                      @if (!$firstOfPage)    
                        <a href="/gallery?page={{ $page-1 }}" class="elementor-button-link elementor-button elementor-size-lg" role="button">
                          <span class="elementor-button-content-wrapper">
                            <span class="elementor-button-text">Sebelumnya</span>
                          </span>
                        </a>
                      @endif
                      
                      @if (!$endOfPage) 
                        <a href="/gallery?page={{ $page+1 }}" class="elementor-button-link elementor-button elementor-size-lg" role="button">
                          <span class="elementor-button-content-wrapper">
                            <span class="elementor-button-text">Selanjutnya</span>
                          </span>
                        </a>
                      @endif
                    </div>
                  </div>
                </div>
              </div>

            </div>
          </div>

        </section>
      </div>
    </div>
  </div>
</section>

@endsection


@push("style")
  <style>
    .more-gallery {
      text-align: center;
      margin-top: 30px;
    }
    .page-number {
      margin-top: 30px;
      float: right;
    }
    .img-gallery {
      height: 12rem !important;
      width: 24rem !important;
      object-fit: cover;
    }
    .card {
      text-align: center;
      margin-bottom: 1rem;
      border: 0;
    }
  </style>
@endpush

@push("script")
  <script>

  </script>
@endpush