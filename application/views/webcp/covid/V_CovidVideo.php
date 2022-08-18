<style>
  #covid{
    min-height: 50vh;
  }
</style>
<main id="main">
  <section id="breadcrumbs" class="breadcrumbs">
    <div class="container">

      <div class="d-flex justify-content-between align-items-center">
        <h2>Covid 19 - Video</h2>
        <ol>
          <li><a href="<?=base_url('')?>"><?=$this->lang->line('home')?></a></li>
          <li><a><?=$this->lang->line('covid')?></a></li>
          <li><a>Video</a></li>
        </ol>
      </div>
    </div>
  </section>

  <section id="covid" class="covid">
    <div class="container">
      <?php 
        $data['total_page'] = $total_page;
        $data['active_page'] = 1;
        $data['page_content'] = 'covid-video';
        $data['title'] = '';
        $this->load->view('webcp/news/V_NewsPaging', $data);
      ?>
      <div id="div_covid_video" class="row">
        <?php
          $data['video'] = $video;
          $this->load->view('webcp/covid/V_CovidVideoData', $data);
        ?>
      </div>
    </div>
  </section>

</main>

<script>
  let page_content;

  function refreshVideoCovidContent(ap){
    $('#div_covid_video').html('')
    $('#div_covid_video').append(divLoaderNavy)
    $('#div_covid_video').load('<?=base_url('webcp/covid/C_Covid/getDataCovidVideo')?>'+'/'+ap, function(){
      $('#loader').hide()
    })
  }
</script>