<section
class="elementor-section elementor-top-section elementor-element elementor-element-13c60dea elementor-section-height-min-height elementor-section-stretched elementor-section-boxed elementor-section-height-default elementor-section-items-middle"
data-id="13c60dea" data-element_type="section" id="gallery"
data-settings="{&quot;background_background&quot;:&quot;classic&quot;,&quot;stretch_section&quot;:&quot;section-stretched&quot;}">
<div class="elementor-background-overlay"></div>
<div class="elementor-container elementor-column-gap-default">
  <div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-26a78cc5"
    data-id="26a78cc5" data-element_type="column">
    <div class="elementor-widget-wrap elementor-element-populated">
      <div class="elementor-element elementor-element-5ed80eb4 elementor-widget elementor-widget-heading"
        data-id="5ed80eb4" data-element_type="widget" data-widget_type="heading.default">
        <div class="elementor-widget-container">
          <h2 class="elementor-heading-title elementor-size-default">Gallery</h2>
        </div>
      </div>
      <div class="elementor-element elementor-element-130fbac6 elementor-widget elementor-widget-heading"
        data-id="130fbac6" data-element_type="widget" data-widget_type="heading.default">
        <div class="elementor-widget-container">
          @if(count($galleries) > 0)
            <p class="elementor-heading-title elementor-size-default">Temukan Keseruan Bersekolah di Disni</p>
          @else
            <p class="elementor-heading-title elementor-size-default"><strong>Tidak ada data artikel yang di publish</strong></p>
          @endif
        </div>
      </div>
      <div class="elementor-element elementor-element-5e6a1be3 elementor-widget elementor-widget-spacer"
        data-id="5e6a1be3" data-element_type="widget" data-widget_type="spacer.default">
        <div class="elementor-widget-container">
          <div class="elementor-spacer">
            <div class="elementor-spacer-inner"></div>
          </div>
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
      <div class="elementor-element elementor-element-3cf1749a elementor-widget elementor-widget-spacer"
        data-id="3cf1749a" data-element_type="widget" data-widget_type="spacer.default">
        <div class="elementor-widget-container">
          <div class="elementor-spacer">
            <div class="elementor-spacer-inner"></div>
          </div>
        </div>
      </div>
      <div class="elementor-element elementor-element-509b5130 elementor-align-center elementor-widget elementor-widget-button"
        data-id="509b5130" data-element_type="widget" data-widget_type="button.default">
        <div class="elementor-widget-container">
          <div class="elementor-button-wrapper">
            <a href="/gallery" class="elementor-button-link elementor-button elementor-size-lg"
              role="button">
              <span class="elementor-button-content-wrapper">
                <span class="elementor-button-icon elementor-align-icon-right">
                  <i aria-hidden="true" class="fas fa-arrow-alt-circle-right"></i>
                </span>
                <span class="elementor-button-text">Gallery Lainnya</span>
              </span>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</section>

@push("style")
  <style>
    .img-gallery {
      height: 12rem !important;
      width: 24rem !important;
      object-fit: cover;
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

  </script>
@endpush