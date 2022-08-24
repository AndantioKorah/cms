<style>
  #service{
    min-height: 50vh;
  }
</style>
<main id="main">
  <section id="breadcrumbs" class="breadcrumbs">
    <div class="container">

      <div class="d-flex justify-content-between align-items-center">
        <h2>Jam Pelayanan</h2>
        <ol>
          <li><a href="<?=base_url('')?>"><?=$this->lang->line('home')?></a></li>
          <li><a><?=$this->lang->line('service')?></a></li>
          <li><a>Jam Pelayanan</a></li>
        </ol>
      </div>
    </div>
  </section>

  <section id="service" class="jam-pelayanan">
    <div class="container">
      <div class="col-lg-12 col-md-12">
        <?php 
          $file = $this->general_library->getPelayananFile('tarif');
        ?>
        <a target="_blank" class="btn btn-primary-color btn-sm mb-3" style="text-align: right; float: right;" href="<?=base_url($file)?>">Download <i class="fa fa-download"></i></a>
        <?php
        if($file){
        ?>
          <iframe style="border-radius: 5px;" src="<?=base_url($file)?>" width="100%" height="800px">
          </iframe>
        <?php } ?>
      </div>
    </div>
  </section>

</main>

<script>
</script>