<style>
  .content{
    min-height: 300px;
  }

  .main-news{
    border-right: 1px var(--primary) solid;
  }

  .image-berita-detail{
    width: 100%;
    position: relative;
  }

  .header_news{
    font-size: 25px;
    font-weight: bold;
  }

  .berita-lainnya {
    color: #444;
    font-size: 20px;
  }

  .berita-lainnya:hover {
    color: var(--primary);
    cursor: pointer;
    transition: .2s;
  }

  .info-berita span{
    margin-right: 5px;
  }
</style>
<main id="main">
  <section id="breadcrumbs" class="breadcrumbs">
    <div class="container">

      <div class="d-flex justify-content-between align-items-center mt-2">
        <h2><?=$this->lang->line('announcement')?></h2>
        <div class="bc-detail-news">
          <ol>
            <li><a href="<?=base_url('home')?>"><?=$this->lang->line('home')?></a></li>
            <li><a href="<?=base_url('announcement')?>"><?=$this->lang->line('announcement')?></a></li>
            <?php if($result){ ?>
              <li class="breadcrumb-judul"><a title="<?=$result['judul']?>"><?=$result['judul']?></a></li>
            <?php } ?>
          </ol>
        </div>
      </div>
    </div>
  </section>

  <section id="news" class="news">
    <div class="container">
      <div class="content">
          <?php if($result){ $rs = $result;
            $file = explode(".", $rs['file']);
            $fa = 'fa fa-file';
            $file_type = $file[count($file)-1];
          ?>
            <div class="row">
              <div class="col-lg-8 col-md-12 main-news">
                <div class="info-berita mb-2">
                  <span class="badge-berita badge"><i class="fa fa-pen"></i> <?=($rs['nama'])?></span>
                  <span class="badge-berita badge"><i class="fa fa-calendar"></i> <?=formatDateNamaBulanWT($rs['tanggal'])?></span>
                  <!-- <span class="badge-berita badge"><i class="fa fa-eye"></i> <?=formatCurrencyWithoutRp($rs['seen_count'])?> kali dilihat</span> -->
                </div>
                <div class="file-wrapper" style="width: 100%;">
                  <?php if(in_array($file_type, ['png', 'jpg', 'jpeg'])){ ?>
                    <img class="image-berita-new img-fluid b-lazy" src=data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw== 
                    data-src="<?=$this->general_library->getPengumumanImage($rs['file'])?>" alt="Lazy load images example 3 image 1" />
                  <?php } else { ?>
                    <iframe width="100%" height="400px" class="b-lazy" style="border-radius: 5px;" data-src="<?=base_url(URI_PENGUMUMAN.$rs['file'])?>">
                    </iframe>
                  <?php } ?>
                </div>
                <div class="judul-berita mt-3">
                  <span class="header_news" title="<?=$rs['judul']?>"><?=$rs['judul']?></span><br>
                  <hr>
                  <p><?=($rs['keterangan'])?></p>
                </div>
              </div>
              <div class="col-lg-4 col-md-12">
                <div class="row">
                  <div class="col-lg-12 col-md-12">
                    <div class="d-sm-block d-lg-none d-md-none">
                      <hr>
                    </div>
                    <!-- <a href="<?=base_url('news')?>" class="berita-lainnya">Berita Terbaru Lainnya</a>
                    <hr> -->
                    <?php if($others){ 
                      $data['result'] = $others;
                      $this->load->view('webcp/announcement/V_OtherAnnouncementData', $data);
                    } else { ?>
                      <h6>Tidak ada berita</h6>
                    <?php } ?>
                  </div>
                </div>
              </div>
            </div>
          <?php } else { ?>
            <a>Data Tidak Ditemukan <i class="fa fa-exclamation"></i></a>
          <?php } ?>
      </div>
    </div>
  </section>

</main>
<script>  
  window.bLazy = new Blazy({
    container: '.container',
    success: function(element){
      console.log("Element loaded: ", element.nodeName);
    }
  }); 
</script>