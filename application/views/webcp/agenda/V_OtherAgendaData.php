  <style>
    .image-berita-other{
      width: 100%;
      position: relative;
    }

    .sidebar-title:hover{
      color: var(--primary) !important;
      transition: .3s;
    }

    .judul-berita-other{
      height: 35px;
      overflow: hidden;
      text-overflow: ellipsis;
      display: -webkit-box;
      -webkit-line-clamp: 2;
      -webkit-box-orient: vertical;
    }
  </style>

  <div class="blog">
    <div class="sidebar">
      <!-- <h3 class="sidebar-title">Search</h3>
      <div class="sidebar-item search-form">
        <form action="">
          <input type="text">
          <button type="submit"><i class="bi bi-search"></i></button>
        </form>
      </div>

      <h3 class="sidebar-title">Categories</h3>
      <div class="sidebar-item categories">
        <ul>
          <li><a href="#">General <span>(25)</span></a></li>
          <li><a href="#">Lifestyle <span>(12)</span></a></li>
          <li><a href="#">Travel <span>(5)</span></a></li>
          <li><a href="#">Design <span>(22)</span></a></li>
          <li><a href="#">Creative <span>(8)</span></a></li>
          <li><a href="#">Educaion <span>(14)</span></a></li>
        </ul>
      </div>End sidebar categories -->

      <a href="<?=base_url('news')?>"><h3 class="sidebar-title">Agenda Lainnya</h3></a>
      <div class="sidebar-item recent-posts">
        <?php if($agenda){ foreach($agenda as $n){
          $gambar = json_decode($n['gambar']);  
          if($gambar){
            $gambar = $gambar[0];
          }
        ?>
          <div class="post-item clearfix">
            <img class="image-berita-other b-lazy" src=data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw== 
            data-src="<?=$this->general_library->getAgendaImage($gambar)?>" alt="Lazy load images example 3 image 1" />
            <h4 class="judul-berita-other"><a href="<?=base_url('agenda/detail/'.$n['id'])?>"><?=$n['judul']?></a></h4>
            <time><?=formatDateOnly($n['tanggal'])?></time>
          </div>
        <?php } } ?>
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
  </script>