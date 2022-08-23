<style>
  .img-pimpinan{
    width: 80%;
    border-radius: 10px;
    max-height: 80%
  }

  .img_aplikasi_publik{
    max-width:230px;
    max-height:95px;
    width: auto;
    height: auto;
    border-radius: 3px;
  }

  .img_aplikasi_publik:hover{
    background-color: var(--black-theme);
  }
  
  .img-banner{
    width: 100%;
    height: 300px;
  }

  #hero{
    width: 100%;
    height: calc(100vw / 5);
    box-shadow: 0 3px 9px 0px gray;
  }

  .carousel-item{
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
    position: relative;
  }

  .text-nama-pimpinan{
    font-size: 3vh;
    font-weight: bold;
  }

  .text-jabatan-pimpinan{
    font-size: 2.6vh;
  }

  .video-main{
    width: 100%;
    height: 50vh;
    border-radius: 5px;
}

</style> 

<div class="body-wrapper" style="padding-top: 70px;">
  <section id="hero">
    <div id="heroCarousel" data-bs-interval="5000" class="carousel slide carousel-fade" data-bs-ride="carousel">

      <ol class="carousel-indicators" id="hero-carousel-indicators"></ol>

      <div class="carousel-inner" role="listbox">

        <?php if($main_images) { $i = 0; foreach($main_images as $m){ ?>
          <div class="carousel-item <?=$i == 0 ? 'active' : ''?>" 
            style="background-image: url('<?=$this->general_library->getMainImages($m['gambar'])?>')">
          <!-- <div class="b-lazy carousel-item <?=$i == 0 ? 'active' : ''?>" 
            data-src="<?=base_url($this->general_library->getMainImages($m['gambar']))?>"> -->
            <!-- <img class="carousel-item <?=$i == 0 ? 'active' : ''?>" width="100%" height="100%" src="<?=base_url($this->general_library->getMainImages($m['gambar']))?>" /> -->
          </div>
        <?php $i++; } } ?>

      </div>

      <a class="carousel-control-prev" href="#heroCarousel" role="button" data-bs-slide="prev">
        <span class="carousel-control-prev-icon bi bi-chevron-left" aria-hidden="true"></span>
      </a>

      <a class="carousel-control-next" href="#heroCarousel" role="button" data-bs-slide="next">
        <span class="carousel-control-next-icon bi bi-chevron-right" aria-hidden="true"></span>
      </a>

    </div>
  </section>

  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-3 col-md-12 section-bg">
        <section style="padding-top: 50px !important; padding-bottom: 10px !important;" id="aplikasi-publik" class="aplikasi-publik">
          <div class="container">
            <h4 class="title-section-side">APLIKASI PUBLIK</h4>
            <div class="row">
              <?php if($aplikasi_publik) {  foreach($aplikasi_publik as $a){ ?>
                <div class="col-lg-6 col-md-6">
                  <a href="<?=$a['url']?>">
                    <img title="<?=$a['nama_aplikasi']?>" width="400" height="400" class="b-lazy img_aplikasi_publik" 
                    src="<?=$this->general_library->getAplikasiPublikLogo($a['logo'])?>" />
                  </a>
                </div>
              <?php } } ?>
            </div>
          </div>
          <hr>
        </section>

        <section style="padding-top: 10px !important; padding-bottom: 10px !important;" id="widget" class="widget">
          <div class="container">
            <!-- <h4 class="title-section-side">SOSIAL MEDIA</h4> -->
            <div
              loading="b-lazy"
              data-mc-src="12160b95-a228-4358-a7f2-ebd5d7f3b846#instagram"></div>
          </div>
          <hr>
        </section>

        <section style="padding-top: 10px !important; padding-bottom: 10px !important;" id="article-side" class="article-side">
          <div class="container">
            <h4 class="title-section-side">BERITA TERPOPULER</h4>
            <?php
              $data['news'] = $popular_news;
              $this->load->view('webcp/news/V_NewsPopularMainData', $data);
            ?>
          </div>
          <hr>
        </section>

        <section style="padding-top: 10px !important; padding-bottom: 10px !important;" id="statistics" class="statistics">
          <div class="container">
            <h4 class="title-section-side">STATISTIK</h4>
            <table style="width: 100%;">
              <tr>
                <td class="span_stats" style="width: 80%;">Total</td>
                <td class="span_stats" style="width: 20%; text-align: right;"><span id="stat_total"><i class="fa fa-spin fa-spinner"></i></span></td>
              </tr>
              <tr>
                <td class="span_stats" style="width: 80%;">Hari Ini</td>
                <td class="span_stats" style="width: 20%; text-align: right;"><span id="stat_hari_ini"><i class="fa fa-spin fa-spinner"></i></span></td>
              </tr>
              <tr>
                <td class="span_stats" style="width: 80%;">Minggu Ini</td>
                <td class="span_stats" style="width: 20%; text-align: right;"><span id="stat_minggu_ini"><i class="fa fa-spin fa-spinner"></i></span></td>
              </tr>
              <tr>
                <td class="span_stats" style="width: 80%;">Bulan Ini</td>
                <td class="span_stats" style="width: 20%; text-align: right;"><span id="stat_bulan_ini"><i class="fa fa-spin fa-spinner"></i></span></td>
              </tr>
              <tr>
                <td class="span_stats" style="width: 80%;">Tahun Ini</td>
                <td class="span_stats" style="width: 20%; text-align: right;"><span id="stat_tahun_ini"><i class="fa fa-spin fa-spinner"></i></span></td>
              </tr>
            </table>
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
                  <h1 class="text-nama-pimpinan"><?=getParams('PARAM_NAMA_KEPALA')?></h1>
                  <h4 class="text-jabatan-pimpinan"><?=getParams('PARAM_NAMA_JABATAN_KEPALA')?></h4>
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
</div>

<script>
  window.bLazy = new Blazy({
    container: '.container',
    success: function(element){
      console.log("Element loaded: ", element.nodeName);
    }
  });

  $(function(){
    getStatisticsData()
  }) 

  function getStatisticsData(){
    $.ajax({
      url: '<?=base_url("C_Main/getDataStatistic")?>',
      method: 'post',
      data: null,
      success: function(res){
        let data = JSON.parse(res)
        $('#stat_total').html(formatRupiah(data.total_hit))
        $('#stat_hari_ini').html(formatRupiah(data.hari_ini))
        $('#stat_minggu_ini').html(formatRupiah(data.minggu_ini))
        $('#stat_bulan_ini').html(formatRupiah(data.bulan_ini))
        $('#stat_tahun_ini').html(formatRupiah(data.tahun_ini))
      }, error: function(e){
        console.log(e)
      }
    })
  }

  function openNews(){
    location.href= "<?=base_url('news')?>";
  }
</script>