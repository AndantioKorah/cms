<?php if($news){ ?>
  <style>
    .header_news{
      font-size: 18px;
      font-weight: bold;
    }

    .judul-berita{
      height: 70px;
      overflow: hidden;
      text-overflow: ellipsis;
      display: -webkit-box;
      -webkit-line-clamp: 2;
      -webkit-box-orient: vertical;
      /* text-align: justify; */
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

    .image-berita-new{
      width: 100%;
      position: absolute;
      /* height: calc(100vw); */
    }

    .image-wrapper{
      position: relative;
      padding-bottom: 56.2%;
    }
  </style>
  <div class="row">
    <?php foreach($news as $n){
      $gambar = json_decode($n['gambar']);  
      if($gambar){
        $gambar = $gambar[0];
      }
    ?>
      <div onclick="openDetailNews('<?=$n['id']?>')" class="col-lg-4 col-md-12 news-data">
        <article class="entry news-data-body">
          <div class="entry-img">
            <div class="image-wrapper">
              <img class="image-berita-new img-fluid b-lazy" src=data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw== data-src="<?=$this->general_library->getBeritaImage($gambar)?>" alt="Lazy load images example 3 image 1" />
            </div>
          </div>

          <h2 class="entry-title judul-berita">
            <a href="<?=base_url('news/detail/'.$n['id'])?>" title="<?=$n['judul_ina']?>" class="header_news"><?=$n['judul_ina']?></a>
          </h2>

          <div class="entry-meta">
            <ul>
              <li class="d-flex align-items-center"><i class="fa fa-user"></i> <a><?=$n['nama']?></a></li>
              <li class="d-flex align-items-center"><i class="fa fa-clock"></i> <a><time datetime="<?=$n['tanggal_berita']?>"><?=formatDateOnly($n['tanggal_berita'])?></time></a></li>
              <li class="d-flex align-items-center"><i class="fa fa-eye"></i> <a><?=$n['seen_count']?></a></li>
            </ul>
          </div>

          <div class="entry-content">
            <div class="isi-berita">
              <p>
                <?=$n['isi_berita']?>
              </p>
            </div>
            <div class="read-more mt-2">
              <a href="<?=base_url('news/detail/'.$n['id'])?>">Selengkapnya</a>
            </div>
          </div>

        </article>      
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