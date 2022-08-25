<style>
  .navbar .active-navbar {
    color: var(--primary);
  }
</style>

<header id="header" class="fixed-top d-flex align-items-center">
    <div class="container-fluid d-flex align-items-center">
      <a href="<?=base_url('')?>"><img id="logo-img-mobile" src="<?=base_url('assets/webcp/assets/img/logo-kemenkes-only.png')?>" alt="" class="img-fluid logo-img-mobile"></a>
      <h1 id="logo-text-mobile" class="logo-text-mobile me-auto"><a style="color: #4a5562 !important;" href="<?=base_url('')?>"><?=TITLES?></a></h1>

      <div class="row">
        <div class="col-lg-12 div-navbar-top" id="div-navbar-top">
          <a class="live_date_time"></a>
          <a href="<?=base_url('admin')?>" class="btn-primary-color login"><i class="fa fa-key"></i> &nbsp;Login</a>
        </div>
        <div class="col-lg-12 div-navbar-logo" id="div-navbar-logo">
          <div class="row">
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 text-right float-right">
              <img class="logo-img-navbar" src="<?=base_url('assets/webcp/assets/img/logo-kemenkes-only.png')?>" alt="" class="img-fluid">
              <center>
                <img class="logo-img-center" src="<?=base_url('assets/webcp/assets/img/logo-kemenkes-only.png')?>" alt="" class="img-fluid">
              </center>
            </div>
            <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10 header-text">
              <h5 class="logo-text-h5">KEMENTRIAN KESEHATAN RI</h5>
              <h5 class="logo-text-h5">Direktorat Jenderal Pencegahan dan Pengendalian Penyakit</h5>
              <h3 class="logo-text-h3">Balai Teknik Kesehatan Lingkungan Dan Pengendalian Penyakit (BTKLPP) Kelas I Manado</h3>
            </div>
          </div>
        </div>
        <div class="col-lg-12 div-navbar-menu">
          <nav id="navbar" class="navbar justify-content-center">
            <ul>
                <?php //if($menu){ foreach($menu as $m) { 
                  //$url = $_SERVER['REQUEST_URI'];
                  //$url = explode('/', $url);
                ?>
                    <!-- <li>
                        <a class="<?=$url[1] == $m['url'] ? 'active-navbar' : ''?>" href="<?=base_url($m['url'])?>"><?=$this->lang->line($m['site_lang'])?></a>
                    </li> -->
                <?php // } }  ?>
                <?php 
                  $url = $_SERVER['REQUEST_URI'];
                  $url = explode('/', $url);
                ?>
                <li>
                    <a class="<?=$url[1] == '' ? 'active-navbar' : ''?>" href="<?=base_url('')?>"><?=$this->lang->line('home')?></a>
                </li>

                <li>
                    <a class="<?=$url[1] == 'profile' ? 'active-navbar' : ''?>" href="<?=base_url('profile')?>"><?=$this->lang->line('profile')?></a>
                </li>

                <li>
                    <a class="<?=$url[1] == 'news' ? 'active-navbar' : ''?>" href="<?=base_url('news')?>"><?=$this->lang->line('news')?></a>
                </li>
                <li>
                    <a class="<?=$url[1] == 'agenda' ? 'active-navbar' : ''?>" href="<?=base_url('agenda')?>">Agenda</a>
                </li>
                <li class="dropdown">
                    <a class="<?=$url[1] == 'gallery' ? 'active-navbar' : ''?>" href="#"><?=$this->lang->line('gallery')?> <i class="fa fa-angle-down"></i></a>
                    <ul>
                      <li><a href="<?=base_url('gallery/image')?>">Gambar</a></li>
                      <li><a href="<?=base_url('gallery/video')?>">Video</a></li>
                    </ul>
                </li>

                <li class="dropdown">
                    <a class="<?=$url[1] == 'ppid' ? 'active-navbar' : ''?>" href="#"><?=$this->lang->line('ppid')?> <i class="fa fa-angle-down"></i></a>
                    <ul>
                      <li><a href="<?=base_url('ppid/berkala')?>">Informasi Berkala</a></li>
                      <li><a href="<?=base_url('ppid/setiap-saat')?>">Informasi Setiap Saat</a></li>
                      <li><a href="<?=base_url('ppid/serta-merta')?>">Informasi Serta Merta</a></li>
                    </ul>
                </li>

                <li class="dropdown">
                    <a class="<?=$url[1] == 'service' ? 'active-navbar' : ''?>" href="#"><?=$this->lang->line('service')?> <i class="fa fa-angle-down"></i></a>
                    <ul>
                      <li><a href="<?=base_url('service/jenis-pelayanan')?>">Jenis Pelayanan</a></li>
                      <li><a href="<?=base_url('service/jam-pelayanan')?>">Jam Pelayanan</a></li>
                      <li><a href="<?=base_url('service/pola-tarif')?>">Pola Tarif</a></li>
                    </ul>
                </li>

                <li>
                    <a class="<?=$url[1] == 'announcement' ? 'active-navbar' : ''?>" href="<?=base_url('announcement')?>"><?=$this->lang->line('announcement')?></a>
                </li>

                <li>
                    <a class="<?=$url[1] == 'akuntabilitas' ? 'active-navbar' : ''?>" href="<?=base_url('akuntabilitas')?>">Akuntabilitas</a>
                </li>

                <li>
                    <a class="<?=$url[1] == 'contact' ? 'active-navbar' : ''?>" href="<?=base_url('contact')?>"><?=$this->lang->line('contact')?></a>
                </li>

                <li>
                    <a class="<?=$url[1] == 'wbs' ? 'active-navbar' : ''?>" href="<?=base_url('wbs')?>"><?=$this->lang->line('wbs')?></a>
                </li>

                <li>
                    <a class="<?=$url[1] == 'ttg' ? 'active-navbar' : ''?>" href="<?=base_url('ttg')?>"><?=$this->lang->line('ttg')?></a>
                </li>

                <li>
                </li>

                <li class="dropdown">
                    <a class="<?=$url[1] == 'covid' ? 'active-navbar' : ''?>" href="#"><?=$this->lang->line('covid')?> <i class="fa fa-angle-down"></i></a>
                    <ul>
                      <li><a href="<?=base_url('covid/regulasi')?>">Regulasi</a></li>
                      <li><a href="<?=base_url('covid/infografis')?>">Infografis</a></li>
                      <li><a href="<?=base_url('covid/video')?>">Video</a></li>
                    </ul>
                </li>

                <!-- <li>
                  <li class="dropdown"><a href="#"><span><?=ucfirst($this->session->userdata('site_lang'))?></span> <i class="bi bi-chevron-right"></i></a>
                    <ul>
                      <?php
                        foreach(LANG_AVAIL as $l){
                      ?>
                        <li><a href="<?= base_url('language/switch/'.$l) ?>"><?=$l?></a></li>
                        <?php } ?>
                    </ul>
                  </li>
                </li> -->
              <!-- <li><a href="<?=base_url('')?>" class="active"><?=$this->lang->line('home')?></a></li>
              <li class="dropdown"><a href="#"><span>About</span> <i class="bi bi-chevron-down"></i></a>
                <ul>
                  <li><a href="about.html">About</a></li>
                  <li><a href="team.html">Team</a></li>
                  <li><a href="testimonials.html">Testimonials</a></li>

                  <li class="dropdown"><a href="#"><span>Deep Drop Down</span> <i class="bi bi-chevron-right"></i></a>
                    <ul>
                      <li><a href="#">Deep Drop Down 1</a></li>
                      <li><a href="#">Deep Drop Down 2</a></li>
                      <li><a href="#">Deep Drop Down 3</a></li>
                      <li><a href="#">Deep Drop Down 4</a></li>
                      <li><a href="#">Deep Drop Down 5</a></li>
                    </ul>
                  </li>
                </ul>
              </li>
              <li><a href="services.html">Services</a></li>
              <li><a href="portfolio.html">Portfolio</a></li>
              <li><a href="pricing.html">Pricing</a></li>
              <li><a href="blog.html">Blog</a></li>

              <li><a href="contact.html">Contact</a></li> -->
              <!-- <li><a href="index.html" class="getstarted">Get Started</a></li> -->
            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
          </nav>
      </div>
    </div>
</header>
<script>
  $(function(){
    setNavbarLogoHeight()
  })

  function setNavbarLogoHeight(){
    
  }
</script>