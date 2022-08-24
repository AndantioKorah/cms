<?php if($agenda){ ?>
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
  </style>
  <div class="row">
    <?php foreach($agenda as $n){
      $gambar = json_decode($n['gambar']);  
      if($gambar){
        $gambar = $gambar[0];
      }
    ?>
      <div onclick="openDetailNews('<?=$n['id']?>')" class="col-lg-4 col-md-12 news-data">
        <article class="entry news-data-body">
          <div class="entry-img">
            <img class="image-berita img-fluid b-lazy" src=data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw== data-src="<?=$this->general_library->getAgendaImage($gambar)?>" alt="Lazy load images example 3 image 1" />
          </div>

          <h2 class="entry-title judul-berita">
            <a href="<?=base_url('agenda/detail/'.$n['id'])?>" title="<?=$n['judul']?>" class="header_news"><?=$n['judul']?></a>
          </h2>

          <div class="entry-meta">
            <ul>
              <li class="d-flex align-items-center"><i class="fa fa-user"></i> <a><?=$n['nama']?></a></li>
              <li class="d-flex align-items-center"><i class="fa fa-clock"></i> <a><time datetime="<?=$n['tanggal']?>"><?=formatDateOnly($n['tanggal'])?></time></a></li>
              <li class="d-flex align-items-center"><i class="fa fa-eye"></i> <a><?=$n['seen_count']?></a></li>
            </ul>
          </div>

          <div class="entry-content">
            <div class="isi-berita">
              <p>
                <?=$n['isi_agenda']?>
              </p>
            </div>
            <div class="read-more mt-2">
              <a href="<?=base_url('agenda/detail/'.$n['id'])?>">Selengkapnya</a>
            </div>
          </div>

        </article>      
      </div>
    <?php } ?>
  </div>
  <script>
    $(function(){
      
    })

    function openDetailNews(id){
      location.href= "<?=base_url('agenda/detail')?>"+'/'+id;
    }

    window.bLazy = new Blazy({
      container: '.container',
      success: function(element){
        console.log("Element loaded: ", element.nodeName);
      }
    });

  </script>
<?php } else { ?>
  <div class="row">
    <div class="col-lg-12 col-md-12 text-center float-center">
      <h4>Tidak Ada Agenda <i class="fa fa-exclamation"></i></h4>
    </div>
  </div>
<?php } ?>