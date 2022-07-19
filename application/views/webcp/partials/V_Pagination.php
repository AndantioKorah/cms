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
</style>

<div class="content_pagination">
  
</div>

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
      $('#page_'+active_page).addClass('active')
    } else if(e == 'back'){
      active_page = parseInt(active_page) - 1;
      $('#page_'+active_page).addClass('active')
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
  }
</script>