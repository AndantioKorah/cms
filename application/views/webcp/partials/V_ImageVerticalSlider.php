<style>
  .carousel-control{
    background-color: black;
    opacity: 0.5;
    transition: .2s;
    border-radius: 50px;
  }
</style>

<div id="heroCarousel" data-bs-interval="5000" class="carousel slide carousel-fade" data-bs-ride="carousel">

<div class="carousel-inner" role="listbox">

  <?php if($gambar) { $i = 0; foreach($gambar as $g){ ?>
    <div class="carousel-item <?= $i == 0 ? 'active' : ''; ?>">
      <div class="carousel-container">
        <div class="container">
          <img class="image-berita-detail" src="<?=$this->general_library->getBeritaImage($g)?>" alt="<?=$g?>" />
        </div>
      </div>
    </div>
  <?php $i++; } } ?>
</div>

<a class="carousel-control-prev" href="#heroCarousel" role="button" data-bs-slide="prev">
  <span class="carousel-control carousel-control-prev-icon" aria-hidden="true"></span>
</a>

<a class="carousel-control-next" href="#heroCarousel" role="button" data-bs-slide="next">
  <span class="carousel-control carousel-control-next-icon" aria-hidden="true"></span>
</a>

<ol class="carousel-indicators" id="hero-carousel-indicators"></ol>

</div>