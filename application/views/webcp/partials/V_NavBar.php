<style>
  .navbar .active-navbar {
    color: var(--primary);
  }
</style>

<header id="header" class="fixed-top d-flex align-items-center">
    <div class="container-fluid d-flex align-items-center">

      <a href="<?=base_url('')?>" class="logo"><img src="<?=base_url('assets/webcp/assets/img/logo-kemenkes-only.png')?>" alt="" class="img-fluid"></a>
      <h1 class="logo me-auto"><a href="<?=base_url('')?>"><?=TITLES?></a></h1>
      <!-- Uncomment below if you prefer to use an image logo -->

      <nav id="navbar" class="navbar">
        <ul>
            <?php //if($menu){ foreach($menu as $m) { 
              //$url = $_SERVER['REQUEST_URI'];
              //$url = explode('/', $url);
            ?>
                <!-- <li>
                    <a class="<?=$url[2] == $m['url'] ? 'active-navbar' : ''?>" href="<?=base_url($m['url'])?>"><?=$this->lang->line($m['site_lang'])?></a>
                </li> -->
            <?php // } }  ?>
            <?php 
              $url = $_SERVER['REQUEST_URI'];
              $url = explode('/', $url);
            ?>
            <li>
                <a class="<?=$url[2] == '' ? 'active-navbar' : ''?>" href="<?=base_url('')?>"><?=$this->lang->line('home')?></a>
            </li>

            <li>
                <a class="<?=$url[2] == 'profile' ? 'active-navbar' : ''?>" href="<?=base_url('profile')?>"><?=$this->lang->line('profile')?></a>
            </li>

            <li>
                <a class="<?=$url[2] == 'news' ? 'active-navbar' : ''?>" href="<?=base_url('news')?>"><?=$this->lang->line('news')?></a>
            </li>
            <li>
                <a class="<?=$url[2] == 'agenda' ? 'active-navbar' : ''?>" href="<?=base_url('agenda')?>">Agenda</a>
            </li>
            <li class="dropdown">
                <a class="<?=$url[2] == 'gallery' ? 'active-navbar' : ''?>"><?=$this->lang->line('gallery')?></a>
                <ul>
                  <li><a href="<?=base_url('gallery/image')?>">Gambar</a></li>
                  <li><a href="<?=base_url('gallery/video')?>">Video</a></li>
                </ul>
            </li>

            <li class="dropdown">
                <a class="<?=$url[2] == 'ppid' ? 'active-navbar' : ''?>"><?=$this->lang->line('ppid')?></a>
                <ul>
                  <li><a href="<?=base_url('ppid/berkala')?>">Informasi Berkala</a></li>
                  <li><a href="<?=base_url('ppid/setiap-saat')?>">Informasi Setiap Saat</a></li>
                  <li><a href="<?=base_url('ppid/serta-merta')?>">Informasi Serta Merta</a></li>
                </ul>
            </li>

            <li class="dropdown">
                <a class="<?=$url[2] == 'service' ? 'active-navbar' : ''?>" href="#"><?=$this->lang->line('service')?></a>
                <ul>
                  <li><a href="#">Jenis Pelayanan</a></li>
                  <li><a href="#">Jam Pelayanan</a></li>
                  <li><a href="#">Pola Tarif</a></li>
                </ul>
            </li>

            <li>
                <a class="<?=$url[2] == 'announcement' ? 'active-navbar' : ''?>" href="<?=base_url('announcement')?>"><?=$this->lang->line('announcement')?></a>
            </li>

            <li>
                <a class="<?=$url[2] == 'contact' ? 'active-navbar' : ''?>" href="<?=base_url('contact')?>"><?=$this->lang->line('contact')?></a>
            </li>

            <li>
                <a class="<?=$url[2] == 'wbs' ? 'active-navbar' : ''?>" href="<?=base_url('wbs')?>"><?=$this->lang->line('wbs')?></a>
            </li>

            <li>
                <a class="<?=$url[2] == 'ttg' ? 'active-navbar' : ''?>" href="<?=base_url('ttg')?>"><?=$this->lang->line('ttg')?></a>
            </li>

            <li>
                <a class="<?=$url[2] == 'covid' ? 'active-navbar' : ''?>" href="<?=base_url('covid')?>"><?=$this->lang->line('covid')?></a>
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
</header>