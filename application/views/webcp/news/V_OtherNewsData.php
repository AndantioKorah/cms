<style>
  .image-berita-other{
    width: 100%;
    position: relative;
  }

  .header_news_other{
    font-size: 14px;
    font-weight: bold;
  }

  .judul-berita-other{
    height: 80px;
    overflow: hidden;
    text-overflow: ellipsis;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
  }

  .judul-berita-other:hover{
    color: var(--primary); 
    transition: .3s;
  }

  .news-data-body:hover{
    background-color: #f5f5f5;  
    border-radius: 3px;
    cursor: pointer;
    transition: .3s;
  }

  .isi-berita-other{
    height: 70px;
    overflow: hidden;
    text-overflow: ellipsis;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    font-size: 12px;
    font-family: "Open Sans";
    text-align: justify;
  }
</style>
<div class="row">
  <?php foreach($news as $n){ ?>
    <div onclick="openDetailNews('<?=$n['id']?>')" class="col-lg-12 col-md-12 news-data mb-3">
      <div class="card card-default">
        <div class="card-body news-data-body">
          <span class="badge badge-berita mb-2" style="float: right;"><?=formatDateNamaBulanWT($n['tanggal_berita'])?></span>
          <span class="badge badge-berita mb-2" style="float: left;"><?=$n['nama']?></span>
          <div class="image">
            <img class="image-berita-other" src="<?=base_url('assets/img/login.jpg')?>" />
          </div>
          <div class="judul-berita-other">
            <hr>
            <span class="header_news_other" title="<?=$n['judul_ina']?>"><?=$n['judul_ina']?></span>
          </div>
          <div class="footer-berita">
            <div class="row align-items-center justify-content-center">
              <div class="col-lg-12 col-md-12 isi-berita-other mb-2">
                <hr>
                <?=$n['isi_berita']?>
              </div>
              <div class="col-lg-12 col-md-12" style="text-align: right;">
                <button onclick="openDetailNews('<?=$n['id']?>')" class="btn btn-selengkapnya-berita btn-sm">Selengkapnya <i class="fas fa-angle-double-right"></i></button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  <?php } ?>
</div>
<script>
    function openDetailNews(id){
      location.href= "<?=base_url('news/detail')?>"+'/'+id;
    }
</script>