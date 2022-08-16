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

<div class="blog" style="padding: 0px !important;">
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

    <!-- <a href="<?=base_url('news')?>"><h3 class="sidebar-title">Berita Terbaru Lainnya</h3></a> -->
    <div class="sidebar-item recent-posts">
      <?php if($news){ foreach($news as $n){
        $gambar = json_decode($n['gambar']);  
        if($gambar){
          $gambar = $gambar[0];
        }
      ?>
        <div class="post-item clearfix">
          <img class="image-berita-other b-lazy" src=data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw== 
          data-src="<?=$this->general_library->getBeritaImage($gambar)?>" alt="" />
          <h4 class="judul-berita-other" alt="<?=$n['judul_ina']?>"><a title="<?=$n['judul_ina']?>" href="<?=base_url('news/detail/'.$n['id'])?>"><?=$n['judul_ina']?></a></h4>
          <time><?=formatDateOnly($n['tanggal_berita'])?></time>
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