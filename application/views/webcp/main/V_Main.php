<style>
  .img-pimpinan{
    width: 400px;
  }

  @media (max-width: 447px) {
    .img-pimpinan{
      width: 300px;
    }
  }
</style> 

<!-- ======= Hero Section ======= -->
<section id="hero">
  <div id="heroCarousel" data-bs-interval="5000" class="carousel slide carousel-fade" data-bs-ride="carousel">

    <ol class="carousel-indicators" id="hero-carousel-indicators"></ol>

    <div class="carousel-inner" role="listbox">

      <!-- Slide 1 -->
      <div class="carousel-item active" style="background-image: url('<?=base_url("assets/webcp/assets/img/slide/slide-1.jpg")?>')">
        <div class="carousel-container">
          <div class="container">
            <h2 class="animate__animated animate__fadeInDown">Welcome to <span>Sailor</span></h2>
            <p class="animate__animated animate__fadeInUp">Ut velit est quam dolor ad a aliquid qui aliquid. Sequi ea ut et est quaerat sequi nihil ut aliquam. Occaecati alias dolorem mollitia ut. Similique ea voluptatem. Esse doloremque accusamus repellendus deleniti vel. Minus et tempore modi architecto.</p>
            <a href="#about" class="btn-get-started animate__animated animate__fadeInUp scrollto">Read More</a>
          </div>
        </div>
      </div>

      <!-- Slide 2 -->
      <div class="carousel-item" style="background-image: url('<?=base_url("assets/webcp/assets/img/slide/slide-2.jpg")?>')">
        <div class="carousel-container">
          <div class="container">
            <h2 class="animate__animated animate__fadeInDown">Lorem Ipsum Dolor</h2>
            <p class="animate__animated animate__fadeInUp">Ut velit est quam dolor ad a aliquid qui aliquid. Sequi ea ut et est quaerat sequi nihil ut aliquam. Occaecati alias dolorem mollitia ut. Similique ea voluptatem. Esse doloremque accusamus repellendus deleniti vel. Minus et tempore modi architecto.</p>
            <a href="#about" class="btn-get-started animate__animated animate__fadeInUp scrollto">Read More</a>
          </div>
        </div>
      </div>

      <!-- Slide 3 -->
      <div class="carousel-item" style="background-image: url('<?=base_url("assets/webcp/assets/img/slide/slide-3.jpg")?>')">
        <div class="carousel-container">
          <div class="container">
            <h2 class="animate__animated animate__fadeInDown">Sequi ea ut et est quaerat</h2>
            <p class="animate__animated animate__fadeInUp">Ut velit est quam dolor ad a aliquid qui aliquid. Sequi ea ut et est quaerat sequi nihil ut aliquam. Occaecati alias dolorem mollitia ut. Similique ea voluptatem. Esse doloremque accusamus repellendus deleniti vel. Minus et tempore modi architecto.</p>
            <a href="#about" class="btn-get-started animate__animated animate__fadeInUp scrollto">Read More</a>
          </div>
        </div>
      </div>

    </div>

    <a class="carousel-control-prev" href="#heroCarousel" role="button" data-bs-slide="prev">
      <span class="carousel-control-prev-icon bi bi-chevron-left" aria-hidden="true"></span>
    </a>

    <a class="carousel-control-next" href="#heroCarousel" role="button" data-bs-slide="next">
      <span class="carousel-control-next-icon bi bi-chevron-right" aria-hidden="true"></span>
    </a>

  </div>
</section><!-- End Hero -->

<main id="main">
  <section id="pimpinan" class="pimpinan">
    <div class="container">
      <div class="row content">
        <div class="col-lg-6">
          <center>
            <img src="<?=base_url('assets/webcp/assets/img/foto-pimpinan.png')?>" class="img-pimpinan" alt="">
          </center>
          <h2>Dr. dr. Maxi Rein Rondonuwu, DHSM, MARS</h2>
          <h6>Direktur Jendral Pencegahan dan Pengendalian Penyakit KEMENKES RI</h6>
        </div>
        <div class="col-lg-6 pt-4 pt-lg-0">
          <p>
            Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate
            velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in
            culpa qui officia deserunt mollit anim id est laborum
          </p>
          <ul>
            <li><i class="ri-check-double-line"></i> Ullamco laboris nisi ut aliquip ex ea commodo consequa</li>
            <li><i class="ri-check-double-line"></i> Duis aute irure dolor in reprehenderit in voluptate velit</li>
            <li><i class="ri-check-double-line"></i> Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in</li>
          </ul>
          <p class="fst-italic">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore
            magna aliqua.
          </p>
        </div>
      </div>
    </div>
  </section>

  <section id="infografis" class="infografis section-bg">
    <div class="container">
      <h2 class="title-section">INFOGRAFIS</h2>
    </div>
  </section>

  <section id="berita" class="berita">
    <div class="container">
      <h2 class="title-section" onclick="openNews()">BERITA</h2>
      <div class="row">
        <?php
          $data['news'] = $news;
          $this->load->view('webcp/main/V_NewsMain', $data);
        ?>
      </div>
    </div>
  </section>
</main>

<script>
  function openNews(){
    location.href= "<?=base_url('news')?>";
  }
</script>