<style>
</style>
<main id="main">
  <section id="breadcrumbs" class="breadcrumbs">
    <div class="container">

      <div class="d-flex justify-content-between align-items-center">
        <h2>Agenda</h2>
        <ol>
          <li><a href="<?=base_url('')?>"><?=$this->lang->line('home')?></a></li>
          <li><a>Agenda</a></li>
        </ol>
      </div>
    </div>
  </section>

  <section id="agenda" class="blog">
    <div class="container">
      <?php 
        $data['total_page'] = $total_page_agenda;
        $data['active_page'] = 1;
        $data['page_content'] = 'agenda';
        $data['title'] = '';
        $this->load->view('webcp/news/V_NewsPaging', $data);
      ?>
      <div id="div_agenda_data" class="row">
        <?php
          $data['agenda'] = $agenda;
          $this->load->view('webcp/agenda/V_AgendaData', $data);
        ?>
      </div>
    </div>
  </section>

</main>

<script>
  function refreshAgendaData(ap){
    $('#div_agenda_data').html('')
    $('#div_agenda_data').append(divLoaderNavy)
    $('#div_agenda_data').load('<?=base_url('webcp/agenda/C_Agenda/getDataAgendaByPage')?>'+'/'+ap, function(){
      $('#loader').hide()
    })
  }
</script>