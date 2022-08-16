<style>
</style>
<main id="main">
  <section id="breadcrumbs" class="breadcrumbs">
    <div class="container">

      <div class="d-flex justify-content-between align-items-center">
        <h2><?=$this->lang->line('ttg')?></h2>
        <ol>
          <li><a href="<?=base_url('')?>"><?=$this->lang->line('home')?></a></li>
          <li><a><?=$this->lang->line('ttg')?></a></li>
        </ol>
      </div>
    </div>
  </section>

  <section id="ttg" class="blog">
    <div class="container">
      <?php 
        $data['total_page'] = $total_page_ttg;
        $data['active_page'] = 1;
        $data['page_content'] = 'pojok-ttg';
        $data['title'] = '';
        $this->load->view('webcp/news/V_NewsPaging', $data);
      ?>
      <div id="div_ttg_data" class="row">
        <?php
          $data['ttg'] = $ttg;
          $this->load->view('webcp/ttg/V_TtgData', $data);
        ?>
      </div>
    </div>
  </section>

</main>

<script>
  function refreshTtgData(ap){
    $('#div_ttg_data').html('')
    $('#div_ttg_data').append(divLoaderNavy)
    $('#div_ttg_data').load('<?=base_url('webcp/ttg/C_Ttg/getDataTtgByPage')?>'+'/'+ap, function(){
      $('#loader').hide()
    })
  }
</script>