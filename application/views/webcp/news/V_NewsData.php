<?php if($news){ ?>
  <style>
    .header_news{
      font-size: 18px;
      font-weight: bold;
    }

    .judul-berita{
      height: 85px;
      overflow: hidden;
      text-overflow: ellipsis;
      display: -webkit-box;
      -webkit-line-clamp: 2;
      -webkit-box-orient: vertical;
    }

    .judul-berita:hover{
      color: var(--primary); 
      transition: .3s;
    }

    .news-data-body:hover{
      background-color: #f5f5f5;  
      border-radius: 3px;
      cursor: pointer;
      transition: .3s;
    }

    .isi-berita{
      height: 115px;
      overflow: hidden;
      text-overflow: ellipsis;
      display: -webkit-box;
      -webkit-line-clamp: 4;
      -webkit-box-orient: vertical;
      font-size: 14px;
      font-family: "Open Sans";
      text-align: justify;
    }
  </style>
  <div class="row">
    <?php foreach($news as $n){
      $gambar = json_decode($n['gambar']);  
      if($gambar){
        $gambar = $gambar[0];
      }
    ?>
      <div onclick="openDetailNews('<?=$n['id']?>')" class="col-lg-4 col-md-12 news-data mb-3">
        <div class="card card-default">
          <div class="card-body news-data-body">
            <span class="badge badge-berita mb-2" style="float: right;"><?=formatDateNamaBulanWT($n['tanggal_berita'])?></span>
            <span class="badge badge-berita mb-2" style="float: left;"><?=$n['nama']?></span>
            <div class="image">
              <img class="image-berita b-lazy" src=data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw== data-src="<?=$this->general_library->getBeritaImage($gambar)?>" alt="Lazy load images example 3 image 1" />
            </div>
            <div class="judul-berita">
              <hr>
              <span class="header_news" title="<?=$n['judul_ina']?>"><?=$n['judul_ina']?></span>
            </div>
            <div class="footer-berita">
              <div class="row align-items-center justify-content-center">
                <div class="col-lg-12 col-md-12 isi-berita mb-2">
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
    $(function(){
      <?php if($flag_refresh_paging == 1){ ?>
        refreshPaging()
      <?php } ?>
    })

    function openDetailNews(id){
      location.href= "<?=base_url('news/detail')?>"+'/'+id;
    }

    window.bLazy = new Blazy({
      container: '.container',
      success: function(element){
        console.log("Element loaded: ", element.nodeName);
      }
    });

    function refreshPaging(){
      $('.div_news_paging_top').html('')
      $('.div_news_paging_top').append(divLoaderNavy)
      $('.div_news_paging_top').load('<?=base_url('webcp/news/C_News/refreshPaging')?>'+'/'+'<?=$limit?>', function(){
        $('#loader').hide()
      })

      $('.div_news_paging_bottom').html('')
      $('.div_news_paging_bottom').append(divLoaderNavy)
      $('.div_news_paging_bottom').load('<?=base_url('webcp/news/C_News/refreshPaging')?>'+'/'+'<?=$limit?>', function(){
        $('#loader').hide()
      })
    } 
  </script>
<?php } else { ?>
  <div class="row">
    <div class="col-lg-12 col-md-12 text-center float-center">
      <h4>Tidak Ada Berita <i class="fa fa-exclamation"></i></h4>
    </div>
  </div>
<?php } ?>