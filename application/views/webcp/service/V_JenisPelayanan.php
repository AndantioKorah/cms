<style>
  #service{
    min-height: 50vh;
  }
</style>
<main id="main">
  <section id="breadcrumbs" class="breadcrumbs">
    <div class="container">

      <div class="d-flex justify-content-between align-items-center">
        <h2>Jenis Pelayanan</h2>
        <ol>
          <li><a href="<?=base_url('')?>"><?=$this->lang->line('home')?></a></li>
          <li><a><?=$this->lang->line('service')?></a></li>
          <li><a>Jenis Pelayanan</a></li>
        </ol>
      </div>
    </div>
  </section>

  <section id="service" class="jenis-pelayanan">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 col-md-12">
          <iframe style="border-radius: 5px;" src="<?=base_url(URI_PELAYANAN.'04_ll_cop_agenda_1_latsar_-_rencana_aksi_kbnv2.pdf')?>" width="100%" height="800px">
          </iframe>
        </div>
      </div>
    </div>
  </section>

</main>

<script>
</script>