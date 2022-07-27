<section id="portfolio" class="portfolio">
  <div class="container">

    <div class="section-title" data-aos="fade-up">
      <h2>Galeri</h2>
      <p>Potret berbagi kebahagiaan</p>
    </div>

    <div class="row" data-aos="fade-up" data-aos-delay="100">
      <div class="col-lg-12">
        <ul id="portfolio-flters">
          <li data-filter="*" class="filter-active">All</li>
        </ul>
      </div>
    </div>

    <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="200">

      @foreach($galleries as $gallery)
        <div class="col-lg-4 col-md-6 portfolio-item filter-app">
          <div class="portfolio-wrap">
            <img src="{{ asset($gallery->getPhoto()) }}" class="img-fluid" alt="">
            <div class="portfolio-links">
              <a href="{{ asset($gallery->getPhoto()) }}" data-gall="portfolioGallery" class="venobox" title="App 1"><i class="icofont-plus-circle"></i></a>
            </div>
          </div>
        </div>
      @endforeach

    </div>
  </div>
</section>