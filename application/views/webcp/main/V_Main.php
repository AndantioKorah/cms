<style>
  .img-pimpinan{
    width: 80%;
    border-radius: 10px;
    max-height: 80%
  }

  /* @media (max-width: 447px) {
    .img-pimpinan{
      width: 300px;
    }
  } */
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

<div class="container-fluid">
  <div class="row">
    <div class="col-lg-3 col-md-12 section-bg">
      <section style="padding-top: 50px !important; padding-bottom: 10px !important;" id="aplikasi-publik" class="aplikasi-publik">
        <div class="container">
          <h4 class="title-section-side">APLIKASI PUBLIK</h4>
        </div>
        <hr>
      </section>

      <section style="padding-top: 10px !important; padding-bottom: 10px !important;" id="widget" class="widget">
        <div class="container">
          <div
            loading="b-lazy"
            data-mc-src="12160b95-a228-4358-a7f2-ebd5d7f3b846#instagram"></div>
        </div>
        <hr>
      </section>

      <section style="padding-top: 10px !important; padding-bottom: 10px !important;" id="article-side" class="article-side">
        <div class="container">
          <h4 class="title-section-side">BERITA</h4>
        </div>
        <hr>
      </section>
    </div>
    <div class="col-lg-9 col-md-12">
      <div id="main">
        <section id="pimpinan" class="pimpinan">
          <div class="container">
            <div class="row content">
              <div class="col-lg-12">
                <iframe class="b-lazy video-main" 
                  data-src="<?=preg_replace("/\s*[a-zA-Z\/\/:\.]youtube.com\/watch\?v=([a-zA-Z0-9\-]+)([a-zA-Z0-9\/\*\-\\-\_\?\&\;\%\=\.]*)/i"
                  ,".youtube.com/embed/$1",getParams('PARAM_VIDEO_HOME'));?>" 
                  frameborder="0" 
                  allowfullscreen>
                </iframe>
                <hr>
              </div>
            <h2 class="title-section">PIMPINAN KAMI</h2>
              <div class="col-lg-6">
                <center>
                  <img src="<?=base_url('assets/admin/profil/foto-pimpinan-btkl.jfif')?>" class="img-pimpinan b-lazy" alt="">
                </center>
                <!-- <h6>Direktur Jendral Pencegahan dan Pengendalian Penyakit KEMENKES RI</h6> -->
              </div>
              <div class="col-lg-6 pt-4 pt-lg-0">
                <h1><?=getParams('PARAM_NAMA_KEPALA')?></h1>
                <h4><?=getParams('PARAM_NAMA_JABATAN_KEPALA')?></h4>
              </div>
              <!-- <div class="col-lg-6 pt-4 pt-lg-0">
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
              </div> -->
            </div>
          </div>
        </section>
        <section id="infografis" class="infografis">
          <div class="container">
            <h2 class="title-section">INFOGRAFIS</h2>
          </div>
        </section>
        <section id="berita" class="blog">
          <div class="container">
            <h2 class="title-section" onclick="openNews()">BERITA</h2>
            <div class="row content">
              <?php
                $data['news'] = $news;
                $this->load->view('webcp/main/V_NewsMain', $data);
              ?>
            </div>
          </div>
        </section>
      </div>
    </div>
  </div>
</div>

<script>
  function openNews(){
    location.href= "<?=base_url('news')?>";
  }

  window.bLazy = new Blazy({
    container: '.container',
    success: function(element){
      console.log("Element loaded: ", element.nodeName);
    }
  }); 
</script>