<header id="header" class="fixed-top d-flex align-items-center">
    <div class="container-fluid d-flex align-items-center">

      <a href="<?=base_url('')?>" class="logo"><img src="<?=base_url('assets/webcp/assets/img/logo-kemenkes-only.png')?>" alt="" class="img-fluid"></a>
      <h1 class="logo me-auto"><a href="<?=base_url('')?>"><?=TITLES?></a></h1>
      <!-- Uncomment below if you prefer to use an image logo -->

      <nav id="navbar" class="navbar">
        <ul>
            <?php if($menu){ foreach($menu as $m) { ?>
                <li>
                    <a href="<?=base_url($m['url'])?>"><?=$this->lang->line($m['site_lang'])?></a>
                </li>
            <?php } }  ?>
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
      </nav><!-- .navbar -->

    </div>
</header>