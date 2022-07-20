<style>
  .image-berita{
    width: 100%;
    position: relative;
  }

  .header_news{
    font-size: 18px;
    font-weight: bold;
  }

  .judul-berita{
    height: 80px;
    /* white-space: nowrap;  */
    /* width: 50px;  */
    overflow: hidden;
    text-overflow: ellipsis;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
  }
</style>
<div class="row">
  <?php foreach($news as $n){ ?>
    <div class="col-lg-6 col-md-12">
      <div class="card card-default">
        <div class="card-body">
          <div class="image">
            <img class="image-berita" src="<?=base_url('assets/img/login.jpg')?>" />
          </div>
          <div class="judul-berita">
            <hr>
            <span class="header_news"><?=$n['judul_ina']?></span>
          </div>
          <div class="footer-berita">
            <div class="row align-items-center justify-content-center">
              <div class="col-lg-12 col-md-12">
                <hr>
              </div>
              <div class="col-lg-9 col-md-9">
                
              </div>
              <div class="col-lg-3 col-md-3" style="text-align: right;">
                <button class="btn btn-selengkapnya-berita btn-sm">Selengkapnya <i class="fas fa-angle-double-right"></i></button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  <?php } ?>
</div>