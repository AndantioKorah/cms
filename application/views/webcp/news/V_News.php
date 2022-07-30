<style>
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
          <li><a href="<?=base_url('')?>"><?=$this->lang->line('home')?></a></li>
          <li><a><?=$this->lang->line('news')?></a></li>
        </ol>
      </div>
    </div>
  </section>

  <section id="news" class="news">
    <div class="container">
      <div class="content">
        <div class="row mb-3">
          <div class="col-lg-3 col-md-3 mb-3">
            <div class="input-group input-group-sm div_data_per_page">
              <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-sm">Data per Halaman</span>
              </div>
              <select id="data_per_page" class="select2_this form-control">
                <option selected value="6">6</option>
                <option value="15">15</option>
                <option value="30">30</option>
              </select>
            </div>
          </div>
          <div class="col-lg-5 col-md-3">
          </div>
          <div style="float: right;" class="col-lg-4 col-md-6 div_search">
            <div class="input-group input-group-sm">
              <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-sm"><i class="fa fa-search"></i> Cari Berita</span>
              </div>
              <input id="input_search" name="input_search" type="text" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
            </div>
          </div>
        </div>
        <div class="div_news_paging_top">
          <?php 
            $data['total_page'] = $total_page;
            $data['active_page'] = $active_page;
            // $data['title'] = '';
            $data['page_content'] = 'news';
            $this->load->view('webcp/news/V_NewsPaging', $data);
          ?>
        </div>
        <div class="content-news">
          <?php
            $data['news'] = $news;
            $data['limit'] = 6;
            $data['flag_refresh_paging'] = 0;
            $data['total_data'] = count($news);
            $this->load->view('webcp/news/V_Newsdata', $data);
          ?>
        </div>
        <div class="content-news-search">
        </div>
      </div>
      <div class="div_news_paging_bottom">
        <?php
            $this->load->view('webcp/news/V_NewsPaging', $data);
        ?>
      </div>
    </div>
  </section>

</main>
<script>
  let active_page;
  let total_page;
  let visible_page;
  let minpage;
  let maxpage;
  let page_content;
  $('#input_search').on('input', function(){
    if($(this).val() == ''){
      $('.div_search').removeClass('mb-3')
      $('.d-paging').show()
      $('.content-news').show()
      $('.content-news-search').hide()
      $('.div_data_per_page').show()
    } else {
      $('.div_search').addClass('mb-3')
      $('.d-paging').hide()
      $('.content-news').hide()
      $('.content-news-search').show()
      $('.content-news-search').html('')
      $('.content-news-search').append(divLoaderNavy)
      $('.div_data_per_page').hide()
      $.ajax({
        url: '<?=base_url("webcp/news/C_News/searchNews")?>',
        method: 'post',
        data: $(this).serialize(),
        success: function(res){
          $('#loader').hide()
          $('.content-news-search').html(res)
        }, error: function(e){
          errortoast('Terjadi Kesalahan')
        }
      })
    }
  })

  function refreshNewsContent(ap){
    $('.content-news').html('')
    $('.content-news').append(divLoaderNavy)
    $('.content-news').load('<?=base_url('webcp/news/C_News/getNewsByPage')?>'+'/'+ap+'/'+$('#data_per_page').val(), function(){
      $('#loader').hide()
    })
  }

  $('#data_per_page').on('change', function(){
    $('.d-paging').show()
    $('.content-news-search').hide()
    $('.content-news').show()
    $('.content-news').html('')
    $('.content-news').append(divLoaderNavy)
    $.ajax({
      url: '<?=base_url("webcp/news/C_News/getNewsByPage")?>'+'/1/'+$(this).val()+'/1',
      method: 'post',
      data: null,
      success: function(res){
        $('#loader').hide()
        $('.content-news').html(res)
      }, error: function(e){
        errortoast('Terjadi Kesalahan')
      }
    })
  })
</script>