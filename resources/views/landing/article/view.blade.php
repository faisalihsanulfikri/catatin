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
              <h2 class="elementor-heading-title elementor-size-default">{{ $article->title }}</h2>
            </div>
          </div>
          <div class="container-content">
            {!! $article->getDecodeContent()  !!}
          </div>
          <div style="margin-top: 3rem;">
            <div class="elementor-element elementor-element-7a9ab80d elementor-align-left elementor-widget elementor-widget-button"
            data-id="7a9ab80d" data-element_type="widget" data-widget_type="button.default" style="text-align: center;">
            <div class="elementor-widget-container">
              <div class="elementor-button-wrapper">
                <a href="/home" class="elementor-button-link elementor-button elementor-size-lg" role="button">
                  <span class="elementor-button-content-wrapper">
                    <span class="elementor-button-text">Home</span>
                  </span>
                </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  @component("components.ajax-request")
  @endcomponent
@endsection

@push("style")
  <style>
    .container-content {
      margin-top: 2.5rem;
      padding: 2rem;
      border-radius: 5px;
      box-shadow: 0px 0px 2px black;
    }
  </style>
@endpush