<div class="d-paging" class="col-lg-12 col-md-12">
  <hr>
  <span onclick="pagingClick('back')" class="<?=$active_page == 1 ? 'disabled' : '' ?>; prev_page"><i class="fa fa-angle-left"></i></span>
  <?php for($i = 1; $i <= $total_page ; $i++){
    $display = '';
    if($total_page > 10){
      if($i == $total_page && $total_page > 10){
      } else {
        $display = 'none';
      }
    }
  ?>
    <?php if($total_page > 12 && $i == 2){ ?>
      <span style="display: none;" id="span_choose_page_left" class="span_choose_page">...</span>
    <?php } ?>
    <?php if($total_page > 11 && $i == $total_page){ ?>
      <span id="span_choose_page_right" class="span_choose_page">...</span>
    <?php } ?>
    <span style="display: <?=$i > 10 ? $display : '' ?>" onclick="pagingClick('<?=$i?>')" class="<?=$active_page == $i ? 'active' : ''?> span_page page_<?=$i?>"><?=$i?></span>
  <?php } ?>
  <span onclick="pagingClick('next')" class="<?=$active_page == $total_page ? 'disabled' : '' ?>; next_page"><i class="fa fa-angle-right"></i></span>
  <hr>
</div>

<script>
  $(function(){
    active_page = '<?=$active_page?>'
    total_page = '<?=$total_page?>'
    visible_page = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10]
    $('.prev_page').hide();
  })

  function pagingClick(e){
    if(e != active_page){
      $('.span_page').removeClass('active')
      if(e == 'next'){
        active_page = parseInt(active_page) + 1;
      } else if(e == 'back'){
        active_page = parseInt(active_page) - 1;
      } else{
        active_page = e;
      }

      $('.page_'+active_page).addClass("active")

      if(active_page == 1){
        console.log('active_page == 1')
        $('.next_page').show()
        $('.prev_page').hide()
      } else if((active_page == total_page) && total_page > 1){
        console.log('(active_page == total_page) && total_page > 1')
        $('.next_page').hide()
        $('.prev_page').show()
      } else {
        console.log('else')
        $('.prev_page').show()
        $('.next_page').show()
      }

      // if(active_page == 1 && total_page == 1){
      //   console.log('123')
      //   $('.next_page').hide()
      //   $('.prev_page').hide()
      // }

      setVisiblePage(active_page)
      refreshNewsContent(active_page)
    }
  }

  function setVisiblePage(ap){
    total_page = parseInt(total_page)
    active_page = parseInt(active_page)
    if(total_page > 10){
      if((((active_page + 5) > visible_page[9]) || ((active_page - 4) < visible_page[0])) && 
      (visible_page[9] != total_page || visible_page[0] != 1)){
        visible_page = []
        minpage = active_page - 4;
        maxpage = active_page + 5;
        if(maxpage > total_page){
          minpage = minpage - (maxpage - total_page);
          maxpage = total_page;
        } else if(minpage < 1){
          minpage = 1;
          maxpage = 10;
        }

        $('.span_page').hide()

        for(let i = minpage; i <= maxpage; i++){
          $('#page_'+i).show()
          visible_page.push(i)
        }

        $('#page_1').show()
        $('#page_'+total_page).show()
        $('#page_'+active_page).addClass("active")
      }
    }

    if(visible_page[0] > 2){
      $('#span_choose_page_left').show()
    } else {
      $('#span_choose_page_left').hide()
    }

    if((visible_page[9] == total_page) || (visible_page[9] == (total_page - 1))){
      $('#span_choose_page_right').hide()
    } else if(total_page > 11){
      $('#span_choose_page_right').show()
    }

    console.log(visible_page)
  }

  function refreshNewsContent(ap){
    $('.content-news').html('')
    $('.content-news').append(divLoaderNavy)
    $('.content-news').load('<?=base_url('webcp/news/C_News/getNewsByPage')?>'+'/'+ap+'/'+$('#data_per_page').val(), function(){
      $('#loader').hide()
    })
  }
</script>