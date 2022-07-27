<!DOCTYPE html>
<html lang="id">
  <head>
    @include("landing.template.meta")
    @stack("meta")
    <title>Sekolah Madrasah &#8211; @yield("subtitle")</title>
    @include("landing.template.head")
    @stack("style")
  </head>

  <body class="page-template page-template-elementor_canvas page page-id-2262 ast-single-post ast-inherit-site-logo-transparent ast-hfb-header ast-desktop ast-page-builder-template ast-no-sidebar astra-3.6.7 elementor-default elementor-template-canvas elementor-kit-69 elementor-page elementor-page-2262">
    <div data-elementor-type="wp-page" data-elementor-id="2262" class="elementor elementor-2262" data-elementor-settings="[]">
      <div class="elementor-section-wrap">
        @include("landing.template.header")
        @yield("content")
        @include("landing.template.footer")
      </div>
    </div>
    
    @include("landing.template.foot")
    @stack("script")
  </body>
</html>
