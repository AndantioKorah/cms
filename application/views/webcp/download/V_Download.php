<style>
  #download{
    padding-bottom: 20px !important;
    padding-top: 20px !important;
  }
</style>
<main id="main">
  <section id="breadcrumbs" class="breadcrumbs">
    <div class="container">

      <div class="d-flex justify-content-between align-items-center">
        <h2>Download</h2>
        <ol>
          <li><a href="<?=base_url('')?>"><?=$this->lang->line('home')?></a></li>
          <li><a>Download</a></li>
        </ol>
      </div>
    </div>
  </section>

  <section id="download" class="features">
    <div class="container">
      <div class="row">
        <div class="col-lg-3">
          <ul class="nav nav-tabs flex-column">
            <?php $i = 0; foreach($jenis_download as $d){ ?>
              <li class="nav-item">
                <a onclick="loadDownloadData('<?=$d['id']?>')" class="nav-link <?=$i == 0 ? 'active show' : ''?>" data-bs-toggle="tab" href="#data"><?=$d['jenis_download']?></a>
              </li>
            <?php $i++; } ?>
          </ul>
        </div>
        <div class="col-lg-9 mt-4 mt-lg-0">
          <div class="tab-content">
            <div class="tab-pane active show" id="data">
              <div class="row" id="download_data">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>

<script>
  $(function(){
    loadDownloadData('<?=$jenis_download[0]['id']?>')
  })

  function loadDownloadData(id){
    $('#download_data').html('')
    $('#download_data').append(divLoaderNavy)
    $('#download_data').load('webcp/download/C_Download/loadDownloadData/'+id, function(){
      $('#loader').hide()
    })
  }
</script>