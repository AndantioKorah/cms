<style>
  .d-paging{
    display: inline;
  }

  .paging_number{
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
    padding: 8px;
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
</style>

<div class="d-paging align-items-center" class="col-lg-12 col-md-12">
  <div class="row">
    <hr>
      <div class="paging_title col-4">
        <?= isset($title)? '<h4>'.$title.'</h4>' : '<h4 style="color: white;">.</h4>'?>
      </div>
      <div class="paging_number col-8">
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
        <?php if($total_page > 1){ ?>
          <span onclick="pagingClick('next')" class="<?=$active_page == $total_page ? 'disabled' : '' ?>; next_page"><i class="fa fa-angle-right"></i></span>
        <?php } ?>
      </div>
    <hr>
  </div>
  
</div>

<script>
  $(function(){
    active_page = '<?=$active_page?>'
    total_page = '<?=$total_page?>'
    visible_page = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10]
    page_content = '<?=$page_content?>'
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

      setVisiblePage(active_page)
      console.log(page_content)
      if(page_content == 'news'){
        refreshNewsContent(active_page)
      } else if(page_content == 'gallery-image'){
        refreshImageGalleryContent(active_page)
      } else if(page_content == 'gallery-video'){
        refreshVideoGalleryContent(active_page)
      }
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

    console.log(total_page)
    if(total_page == 1){
      $('.next_page').hide()
      $('.prev_page').hide()
    }
  }
</script>