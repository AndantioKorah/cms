<style>
  .card {
    flex-direction: row;
    align-items: center;
  }

  .card-title {
    font-weight: bold;
  }

  .card-img-top{
    width: 10% !important;
  }

  .card img {
    width: 10%;
    border-top-right-radius: 0;
    border-bottom-left-radius: calc(0.25rem - 1px);
  }

  @media only screen and (max-width: 768px) {
    a {
      display: none;
    }
    .card-body {
      padding: 0.5em 1.2em;
    }
    .card-body .card-text {
      margin: 0;
    }
    .card img {
      width: 30%;
    }
  }

  @media only screen and (max-width: 1200px) {
    .card img {
      width: 10%;
    }
  }

  .data-card:hover{
    cursor: pointer;
    background-color: #efefef;
    transition: .2s;
  }

  .data-announcement{
    font-size: 12px;
    font-family: "Open Sans";
  }

  .div-title{
    /* height: 28px;
    overflow: hidden;
    text-overflow: ellipsis;
    display: -webkit-box;
    -webkit-line-clamp: 1;
    -webkit-box-orient: vertical; */
  }

  .div-keterangan{
    /* height: 25px;
    overflow: hidden;
    text-overflow: ellipsis;
    display: -webkit-box;
    -webkit-line-clamp: 1;
    -webkit-box-orient: vertical; */
  }

  .card-title:hover{
    color: var(--primary);
    transition: .2s;
  }
</style>

<?php if($result){ foreach($result as $rs) {
  $file = explode(".", $rs['file']);
  $fa = 'fa fa-file';
  switch($file[count($file)-1]){
    case 'pdf' : $fa = 'fa fa-file-pdf'; break;
    case 'xls' : $fa = 'fa fa-file-excel'; break;
    case 'xlsx' : $fa = 'fa fa-file-excel'; break;
    case 'png' : $fa = 'fa fa-file-image'; break;
    case 'jpg' : $fa = 'fa fa-file-image'; break;
    case 'jpeg' : $fa = 'fa fa-file-image'; break;
  }
?>
  <div class="col-md-12 mt-3">
    <div class="card data-card">
      <div class="card-img-top">
        <center>
          <i class="<?=$fa?> fa-5x" style="color: var(--primary)"></i>
        </center>
      </div>
        <div class="card-body">
          <div class="div-title">
            <h4 class="card-title"><?=$rs['judul']?></h4>
          </div>
          <div class="div-keterangan">
            <p class="card-text">
              <?=$rs['judul']?>
            </p>
          </div>
          <div class="row d-flex align-content-center mt-2">
            <div class="col-lg-8 col-md-12">
              <span class="data-announcement"><i class="fa fa-pen"></i> <?=$rs['created_by']?></span> |
              <span class="data-announcement"><i class="fa fa-clock"></i> <?=formatDateNamaBulan($rs['tanggal'])?></span>
            </div>
            <div class="col-lg-4 col-md-12" style="text-align: right;">
              <a target="_blank" href="<?=base_url(URI_COVID.$rs['file'])?>" class="btn btn-sm btn-primary-color">Download <i class="fa fa-download"></i></a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php } } else { ?>
  <div class="col-lg-12 text-center">
    <h6>Data Tidak Ditemukan <i class="fa fa-exclamation"></i></h6>
  </div>
<?php } ?>