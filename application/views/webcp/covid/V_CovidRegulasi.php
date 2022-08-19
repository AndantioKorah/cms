<style>
  #covid{
    min-height: 50vh;
  }
</style>
<main id="main">
  <section id="breadcrumbs" class="breadcrumbs">
    <div class="container">

      <div class="d-flex justify-content-between align-items-center">
        <h2>Covid 19 - Regulasi</h2>
        <ol>
          <li><a href="<?=base_url('')?>"><?=$this->lang->line('home')?></a></li>
          <li><a><?=$this->lang->line('covid')?></a></li>
          <li><a>Regulasi</a></li>
        </ol>
      </div>
    </div>
  </section>

  <section id="covid" class="services">
    <div class="container">
      <?php 
        $data['total_page'] = $total_page;
        $data['active_page'] = 1;
        $data['page_content'] = 'covid-regulasi';
        $this->load->view('webcp/news/V_NewsPaging', $data);
      ?>
      <div id="div_regulasi_covid" class="row">
        
      </div>
    </div>
  </section>

</main>

<script>
  let page_content;

  $(function(){
    refreshRegulasiContent(1)
  })

  function refreshRegulasiContent(ap){
    $('#div_regulasi_covid').html('')
    $('#div_regulasi_covid').append(divLoaderNavy)
    $('#div_regulasi_covid').load('<?=base_url('webcp/covid/C_Covid/getDataCovidRegulasi')?>'+'/'+ap, function(){
      $('#loader').hide()
    })
  }
</script>