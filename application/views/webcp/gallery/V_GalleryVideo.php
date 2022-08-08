<style>
  #img_preview_modal{
    width: 100%;
    max-height: 600px;
  }

  #img_name{
    font-size: 30px;
    color: white;
  }

  #gallery-video{
    min-height: 50vh;
  }
</style>
<main id="main">
  <section id="breadcrumbs" class="breadcrumbs">
    <div class="container">

      <div class="d-flex justify-content-between align-items-center">
        <h2><?=$this->lang->line('gallery')?></h2>
        <ol>
          <li><a href="<?=base_url('')?>"><?=$this->lang->line('home')?></a></li>
          <li><a><?=$this->lang->line('gallery')?></a></li>
          <li><a>Video</a></li>
        </ol>
      </div>
    </div>
  </section>

  <section id="gallery-video" class="gallery-video">
    <div class="container">
      <?php 
        $data['total_page'] = $total_page_video;
        $data['active_page'] = 1;
        $data['page_content'] = 'gallery-video';
        $data['title'] = 'VIDEO';
        $this->load->view('webcp/news/V_NewsPaging', $data);
      ?>
      <div id="div_gallery_video" class="row">
        <?php
          $data['video'] = $video;
          $this->load->view('webcp/gallery/V_GalleryVideoData', $data);
        ?>
      </div>
    </div>
  </section>

  
</main>
<!-- <div class="modal fade" id="modal_image_preview" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div style="float: right; text-align: right; color: white; cursor: pointer;">
      <i class="fa fa-2x fa-times"></i>
    </div>
    <center>
      <img id="img_preview_modal" />
      <span id="img_name"></span>
    </center>
  </div>
</div> -->
<script>
  let page_content;

  function refreshVideoGalleryContent(ap){
    $('#div_gallery_video').html('')
    $('#div_gallery_video').append(divLoaderNavy)
    $('#div_gallery_video').load('<?=base_url('webcp/gallery/C_Gallery/getVideoByPage')?>'+'/'+ap, function(){
      $('#loader').hide()
    })
  }
</script>