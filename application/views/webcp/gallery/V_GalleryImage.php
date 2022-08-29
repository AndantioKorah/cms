<style>
  #img_preview_modal{
    width: 100%;
    /* max-height: 600px; */
    height: 100%;
    border-radius: 10px;
    box-shadow: 7px 7px 8px -4px rgba(0,0,0,0.6);
    -webkit-box-shadow: 7px 7px 8px -4px rgba(0,0,0,0.6);
    -moz-box-shadow: 7px 7px 8px -4px rgba(0,0,0,0.6);
  }

  #img_name{
    font-size: 30px;
    color: white;
    font-weight: bold;
  }

  #gallery-image{
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
          <li><a>Gambar</a></li>
        </ol>
      </div>
    </div>
  </section>

  <section id="gallery-image" class="gallery-image">
    <div class="container">
      <?php 
        $data['total_page'] = $total_page_gambar;
        $data['active_page'] = 1;
        $data['page_content'] = 'gallery-image';
        $data['title'] = 'GAMBAR';
        $this->load->view('webcp/news/V_NewsPaging', $data);
      ?>
      <div id="div_gallery_image" class="row">
        <?php
          $data['gambar'] = $gambar;
          $this->load->view('webcp/gallery/V_GalleryImageData', $data);
        ?>
      </div>
    </div>
  </section>

</main>
<div class="modal fade" id="modal_image_preview" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div style="float: right; text-align: right; color: white; cursor: pointer;">
      <i class="fa fa-2x fa-times"></i>
    </div>
    <center>
      <img id="img_preview_modal" />
      <span id="img_name"></span>
    </center>
  </div>
</div>
<script>
  let page_content;

  function refreshImageGalleryContent(ap){
    $('#div_gallery_image').html('')
    $('#div_gallery_image').append(divLoaderNavy)
    $('#div_gallery_image').load('<?=base_url('webcp/gallery/C_Gallery/getGambarByPage')?>'+'/'+ap, function(){
      $('#loader').hide()
    })
  }
</script>