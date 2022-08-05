<style>
</style>
<main id="main">
  <section id="breadcrumbs" class="breadcrumbs">
    <div class="container">

      <div class="d-flex justify-content-between align-items-center">
        <h2><?=$this->lang->line('announcement')?></h2>
        <ol>
          <li><a href="<?=base_url('')?>"><?=$this->lang->line('home')?></a></li>
          <li><a><?=$this->lang->line('announcement')?></a></li>
        </ol>
      </div>
    </div>
  </section>

  <section id="announcement" class="services">
    <div class="container">
    <?php 
        $data['total_page'] = $total_page;
        $data['active_page'] = 1;
        $data['page_content'] = 'announcement';
        $data['title'] = $this->lang->line('announcement');
        $this->load->view('webcp/news/V_NewsPaging', $data);
      ?>
      <div id="div_announcement" class="row">
        
      </div>
    </div>
  </section>

</main>

<script>
  let page_content;

  $(function(){
    refreshAnnouncementContent(1)
  })

  function refreshAnnouncementContent(ap){
    $('#div_announcement').html('')
    $('#div_announcement').append(divLoaderNavy)
    $('#div_announcement').load('<?=base_url('webcp/announcement/C_Announcement/getAnnouncementByPage')?>'+'/'+ap, function(){
      $('#loader').hide()
    })
  }
</script>