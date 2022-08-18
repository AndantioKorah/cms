<style>
  #covid{
    min-height: 50vh;
  }
</style>
<main id="main">
  <section id="breadcrumbs" class="breadcrumbs">
    <div class="container">

      <div class="d-flex justify-content-between align-items-center">
        <h2>Covid 19 - Infografis</h2>
        <ol>
          <li><a href="<?=base_url('')?>"><?=$this->lang->line('home')?></a></li>
          <li><a><?=$this->lang->line('covid')?></a></li>
          <li><a>Infografis</a></li>
        </ol>
      </div>
    </div>
  </section>

  <section id="covid" class="covid">
    <div class="container">
      <?php 
        $data['total_page'] = $total_page;
        $data['active_page'] = 1;
        $data['page_content'] = 'covid-infografis';
        $data['title'] = '';
        $this->load->view('webcp/news/V_NewsPaging', $data);
      ?>
      <div id="div_covid_infografis" class="row">
        <?php
          $data['gambar'] = $gambar;
          $this->load->view('webcp/covid/V_CovidInfografisData', $data);
        ?>
      </div>
    </div>
  </section>

</main>

<script>
  let page_content;

  function refreshInfografisContent(ap){
    $('#div_covid_infografis').html('')
    $('#div_covid_infografis').append(divLoaderNavy)
    $('#div_covid_infografis').load('<?=base_url('webcp/covid/C_Covid/getDataCovidInfografis')?>'+'/'+ap, function(){
      $('#loader').hide()
    })
  }
</script>