<style>
  .card {
    flex-direction: row;
    align-items: center;
  }

  .card-title {
    font-weight: bold;
  }

  .card-img-top{
    width: 10vw !important;
  }

  .card img {
    width: 10vw;
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
      width: 15vw;
    }
  }

  @media only screen and (max-width: 1200px) {
    .card img {
      width: 10vw;
    }
  }

  .data-card:hover{
    cursor: pointer;
    background-color: #efefef;
    transition: .2s;
  }

  .data-announcement{
    font-size: 12px;
    font-family: "Tahoma";
  }

  .div-title{
    height: 30px;
    overflow: hidden;
    text-overflow: ellipsis;
    display: -webkit-box;
    -webkit-line-clamp: 1;
    -webkit-box-orient: vertical;
    text-align: justify;
  }

  .div-keterangan{
    height: 75px;
    overflow: hidden;
    text-overflow: ellipsis;
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    text-align: justify;
    padding-bottom: 5px;
  }

  .card-title:hover{
    color: var(--primary);
    transition: .2s;
  }

  .announce_tags{
    position: relative;
    /* bottom: 21px; */
    /* width: 63.8vw; */
  }

  .image-announcement-wrapper img{
    width: 100%;
    height: 300px;
    border-radius: 8px;
    padding-top: 5px;
    padding-bottom: 5px;
    /* height: calc(591.44 / 1127.34 * 100%); */
    object-fit: cover;
    object-position: center;
  }

  .image-announcement-wrapper img:hover{
    opacity: .5;
    transition: .2s;
  }

  .file-wrapper{
    width: 100%;
    border-radius: 5px;
    height: calc(591.44 / 1127.34 * 100%);
  }

  /* .file-wrapper:hover{
    opacity: .5;
    transition: .2s;
  } */
</style>

<?php if($result){ $i = 0; foreach($result as $rs) {
  $file = explode(".", $rs['file']);
  $fa = 'fa fa-file';
  $file_type = $file[count($file)-1];
  switch($file_type){
    case 'pdf' : $fa = 'fa fa-file-pdf'; break;
    case 'xls' : $fa = 'fa fa-file-excel'; break;
    case 'xlsx' : $fa = 'fa fa-file-excel'; break;
    case 'png' : $fa = 'fa fa-file-image'; break;
    case 'jpg' : $fa = 'fa fa-file-image'; break;
    case 'jpeg' : $fa = 'fa fa-file-image'; break;
  }
?>
<div class="col-lg-6">
  <div class="card p-3 <?=$i != 0 ? '' : ''?>">
    <div class="col-lg-12">
      <div class="row">
        <div class="col-lg-12">
          <div class="div-title">
            <h4 class="card-title"><?=$rs['judul']?></h4>
          </div>
          <?php if(in_array($file_type, ['png', 'jpg', 'jpeg'])){ ?>
            <div class="image-announcement-wrapper">
              <center>
                <a target="_blank" href="<?=base_url(URI_PENGUMUMAN.$rs['file'])?>"><img class="image-berita-new img-fluid b-lazy" src=data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw== 
                data-src="<?=$this->general_library->getPengumumanImage($rs['file'])?>" alt="Lazy load images example 3 image 1" /></a>
              </center>
            </div>
          <?php } else { ?>
            <div class="file-wrapper">
              <center>
                <iframe class="b-lazy" style="border-radius: 5px;" data-src="<?=base_url(URI_PENGUMUMAN.$rs['file'])?>">
                </iframe>
              </center>
              <!-- <a target="_blank" href="<?=base_url(URI_PENGUMUMAN.$rs['file'])?>"><i class="<?=$fa?> fa-5x" style="color: var(--primary)"></i></a> -->
            </div>
          <?php } ?>
          <div class="div-keterangan">
            <p class="card-text">
              <?=$rs['keterangan']?>
            </p>
          </div>
          <div class="row d-flex align-content-center mt-2 announce_tags">
            <div class="col-lg-8 col-md-12">
              <span class="data-announcement"><i class="fa fa-pen"></i> <?=$rs['created_by']?></span> |
              <span class="data-announcement"><i class="fa fa-clock"></i> <?=formatDateNamaBulanWT($rs['tanggal'])?></span>
            </div>
            <div class="col-lg-4 col-md-12" style="text-align: right;">
              <!-- <a target="_blank" href="<?=base_url(URI_PENGUMUMAN.$rs['file'])?>" class="btn btn-sm btn-primary-color">Download <i class="fa fa-download"></i></a> -->
              <a href="<?=base_url('announcement/detail/'.$rs['id'])?>" class="btn btn-sm btn-primary-color">Selengkapnya <i class="fa fa-double-arrow-right"></i></a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
  window.bLazy = new Blazy({
    container: '.container',
    success: function(element){
      console.log("Element loaded: ", element.nodeName);
    }
  }); 
  </script>
<?php $i++; } } else { ?>
  <div class="col-lg-12 text-center">
    <h6>Data Tidak Ditemukan <i class="fa fa-exclamation"></i></h6>
  </div>
<?php } ?>