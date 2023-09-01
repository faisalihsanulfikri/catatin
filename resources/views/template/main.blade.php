<!DOCTYPE html>
<html lang="id">
<head>
  @include("template.meta")
  @stack("meta")
  <title>Backoffice - @yield("subtitle")</title>
  @include("template.head")
  @stack("style")
</head>

<body>
  <!-- BEGIN LOADER -->
  <div id="load_screen"> 
    <div class="loader"> 
      <div class="loader-content">
        <div class="spinner-grow align-self-center"></div>
      </div>
    </div>
  </div>
    <!--  END LOADER -->

  @include("template.header")
  @include("template.breadcrumb")
  
  <!--  BEGIN MAIN CONTAINER  -->
  <div class="main-container" id="container">
    
    <div class="overlay"></div>
    <div class="search-overlay"></div>
    @include("template.navigation")

    <!--  BEGIN CONTENT PART  -->
    <div id="content" class="main-content">
      @yield("content")

      @include('components.loading')
      {{-- @include("template.footer") --}}
    </div>
    <!--  END CONTENT PART  -->
    
  </div>
  <!-- END MAIN CONTAINER -->

  @include("template.foot")
  @stack("script")
</body>

</html>
