<style>
</style>
<main id="main">
  <section id="breadcrumbs" class="breadcrumbs">
    <div class="container">

      <div class="d-flex justify-content-between align-items-center">
        <h2><?=$this->lang->line('gallery')?></h2>
        <ol>
          <li><a href="<?=base_url('')?>"><?=$this->lang->line('home')?></a></li>
          <li><a><?=$this->lang->line('gallery')?></a></li>
        </ol>
      </div>
    </div>
  </section>

  <section id="gallery-image" class="gallery-image">
    <div class="container">
      <?php 
        $data['total_page'] = countTotalPage(count($gambar), 6);
        $data['active_page'] = 1;
        $data['page_content'] = 'gallery-image';
        $data['title'] = 'GAMBAR';
        $this->load->view('webcp/news/V_NewsPaging', $data);
      ?>
      <div id="div_gallery_image" class="row">
        <?php
          $data['image'] = $gambar;
          $this->load->view('webcp/gallery/V_GalleryImage', $data);
        ?>
      </div>
    </div>
  </section>

  <section id="gallery-video" class="gallery-video section-bg">
    <div class="container">
      <h4>Video</h4>
    </div>
  </section>

</main>

<script>
</script>