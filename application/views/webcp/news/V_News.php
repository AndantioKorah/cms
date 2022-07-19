<style>
    .d-paging{
      text-align: right;
    }

    .active{
      background-color: var(--primary) !important;
      cursor: pointer;
      color: white !important;
    }

    .disabled {
      display: none;
    }

    .d-paging span{
      padding: 10px;
      border-radius: 3px;
      border: 1px var(--primary) solid;
      color: #556270;
      margin: 0;
    }


    .d-paging span:hover{
      background-color: var(--primary);
      color: white;
      transition: .4s;
      cursor: pointer;
    }

    .content{
      min-height: 300px;
    }
</style>
<main id="main">
  <section id="breadcrumbs" class="breadcrumbs">
    <div class="container">

      <div class="d-flex justify-content-between align-items-center">
        <h2><?=$this->lang->line('news')?></h2>
        <ol>
          <li><a href="<?=base_url('home')?>"><?=$this->lang->line('home')?></a></li>
          <li><a><?=$this->lang->line('news')?></a></li>
        </ol>
      </div>
    </div>
  </section>

  <section id="news" class="news">
    <div class="container">
      <div class="content">
        <?php 
          $data['news'] = $news;
          $this->load->view('webcp/news/V_Newsdata', $data)
        ?>
      </div>
      <div class="d-paging" class="col-lg-12 col-md-12">
        <hr>
        <span id="prev_page" onclick="pagingClick('back')" class="<?=$active_page == 1 ? 'disabled' : '' ?>"><i class="fa fa-angle-left"></i></span>
        <?php for($i = 1; $i <= $total_page ; $i++){ ?>
          <span id="page_<?=$i?>" onclick="pagingClick('<?=$i?>')" class="<?=$active_page == $i ? 'active' : ''?> span_page"><?=$i?></span>
        <?php } ?>
        <span id="next_page" onclick="pagingClick('next')" class="<?=$active_page == $total_page ? 'disabled' : '' ?>"><i class="fa fa-angle-right"></i></span>
      </div>
    </div>
  </section>

</main>

<script>
  let active_page;
  let total_page;
  $(function(){
    active_page = '<?=$active_page?>'
    total_page = '<?=$total_page?>'
  })

  function pagingClick(e){
    $('.span_page').removeClass('active')
    if(e == 'next'){
      active_page = parseInt(active_page) + 1;
      $('#page_'+active_page).addClass("active")
    } else if(e == 'back'){
      active_page = parseInt(active_page) - 1;
      $('#page_'+active_page).addClass("active")
    } else {
      active_page = e;
      $('#page_'+active_page).addClass("active")
    }

    if(active_page == 1){
      $('#next_page').show()
      $('#prev_page').hide()
    } else if(active_page == total_page){
      $('#next_page').hide()
      $('#prev_page').show()
    } else {
      $('#prev_page').show()
      $('#next_page').show()
    }
    refreshNewsContent(active_page);
  }

  function refreshNewsContent(ap){
    $('.content').html('')
    $('.content').append(divLoaderNavy)
    $('.content').load('<?=base_url('webcp/news/C_News/getNewsByPage')?>'+'/'+ap, function(){
      $('#loader').hide()
    })
  }
</script>