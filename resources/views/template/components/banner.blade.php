<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators bar-navigation-banner">
      <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
      @php
        $counter = 1;
      @endphp
      @foreach($sliders as $slider)
        <li data-target="#carouselExampleIndicators" data-slide-to="{{ $counter }}"></li>
        @php
          $counter++;
        @endphp
      @endforeach
  </ol>
  <div class="carousel-inner">
      <div class="carousel-item active">
        <section id="hero" class="d-flex align-items-center slider_area" style="margin-top: 72px; padding: 60px 0px; height: 720px;">
          <div class="container" style="margin-top: 72px; padding: 60px 0px; height: 720px;">
            <div class="row">
              <div class="col-lg-6 pt-5 pt-lg-0 order-2 order-lg-1">
                <h1>Baitul Maal PPTQ <br> Al-'Ashr Al-Madani</h1> <br>
                <a href="https://pesantrentahfidzashrmadani.com/" target="_blank">
                  <h4 style="color: #7a6960;">PONDOK PESANTREN TAHFIDZUL QUR'AN AL 'ASHR AL – MADANI</h4>
                </a>
            
              </div>
              <div class="col-lg-6 order-1 order-lg-2 hero-img">
                <a href="https://pesantrentahfidzashrmadani.com/" target="_blank">
                  <img src="assets/img/hero.jpg" class="img-fluid animated img-home" alt="">
                </a>
              </div>
            </div>
          </div>
        </section>  
      </div>

      @foreach($sliders as $slider)
        <div class="carousel-item">
          <div style="height: 720px;">
            <img class="d-block img-banner" src="{{ asset($slider->getPhoto()) }}" alt="First slide">
          </div>
        </div>
      @endforeach
  </div>
  <a class="carousel-control-prev top-640" href="#carouselExampleIndicators" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon btn-navigation-banner" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next top-640" href="#carouselExampleIndicators" role="button" data-slide="next">
      <span class="carousel-control-next-icon btn-navigation-banner" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
  </a>
</div>

@push("style")
  <style>
    .img-home {
      border-radius: 15px;
      border: 1px #b1a29a solid;
    }
    .bar-navigation-banner {
      background-color: #15141594;
      border-radius: 5px;
    }
    .btn-navigation-banner {
      background-color: black;
      padding: 15px;
      border: 10px solid;
      border-color: black;
      border-radius: 5px;
    }
    .img-banner {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }
    .top-640 {
      top : 640px !important;
    }
    .height-768 {
      height: 768px !important;
    }
  </style>
@endpush