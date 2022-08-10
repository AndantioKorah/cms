<style>
  #ppid-berkala{
    min-height: 50vh;
  }
</style>
<main id="main">
  <section id="breadcrumbs" class="breadcrumbs">
    <div class="container">

      <div class="d-flex justify-content-between align-items-center">
        <h2><?=$this->lang->line('ppid')?> - Serta Merta</h2>
        <ol>
          <li><a href="<?=base_url('')?>"><?=$this->lang->line('home')?></a></li>
          <li><a><?=$this->lang->line('ppid')?></a></li>
          <li><a>Serta Merta</a></li>
        </ol>
      </div>
    </div>
  </section>

  <section id="ppid-berkala" class="ppid">
    <div class="container">
      <div class="row content">
        <div class="col-lg-12 col-md-12">
          <div class="section-title">
            <p>PPID (Serta Merta)</p>
          </div>
        </div>
        <div class="col-lg-12 col-md-12">
          <select id="select_jenis" style="width: 100%;" data-dropdown-css-class="select2-primary-color" class="form-select select2-primary-color select2_this">
            <?php if($result){ foreach($result as $rs){ ?>
              <option value="<?=$rs['id']?>"><?=$rs['nama_jenis']?></option>
            <?php } }?>
          </select>
        </div>
        <div class="col-lg-12 col-md-12 mt-5">
          <div class="row" id="result_data"></div>
        </div>
      </div>
    </div>
  </section>

</main>

<script>
  $(function(){
    getDataBerkalaByJenis()
  })

  function getDataBerkalaByJenis(){
    $('#result_data').html('')
    $('#result_data').append(divLoaderNavy)
    $('#result_data').load('<?=base_url("webcp/ppid/C_Ppid/getDataPpid/3/")?>'+$('#select_jenis').val(), function(){
      $('#loader').hide()
    })
  }

  $('#select_jenis').on('change', function(){
    getDataBerkalaByJenis()
  })
</script>