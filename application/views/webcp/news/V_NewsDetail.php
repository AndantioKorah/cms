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
        <h2><?=$this->lang->line('news')?></h2>
        <div class="bc-detail-news">
          <ol>
            <li><a href="<?=base_url('home')?>"><?=$this->lang->line('home')?></a></li>
            <li><a href="<?=base_url('news')?>"><?=$this->lang->line('news')?></a></li>
            <?php if($result){ ?>
              <li class="breadcrumb-judul"><a title="<?=$result['judul_ina']?>"><?=$result['judul_ina']?></a></li>
            <?php } ?>
          </ol>
        </div>
      </div>
    </div>
  </section>

  <section id="news" class="news">
    <div class="container">
      <div class="content">
          <?php if($result){ $rs = $result; ?>
            <div class="row">
              <div class="col-lg-8 col-md-12 main-news">
                <div class="info-berita mb-2">
                  <span class="badge-berita badge"><i class="fa fa-pen"></i> <?=($rs['nama'])?></span>
                  <span class="badge-berita badge"><i class="fa fa-calendar"></i> <?=formatDateNamaBulanWT($rs['tanggal_berita'])?></span>
                  <span class="badge-berita badge"><i class="fa fa-eye"></i> <?=formatCurrencyWithoutRp($rs['seen_count'])?> kali dilihat</span>
                </div>
                <div class="image">
                  <?php
                    $data['gambar'] = json_decode($rs['gambar'], true);
                    $data['page'] = 'news';
                    $this->load->view('webcp/partials/V_ImageVerticalSlider.php', $data);
                  ?>
                  <!-- <img class="image-berita-detail" src="<?=$this->general_library->getBeritaImage($rs['gambar'])?>" /> -->
                </div>
                <div class="judul-berita mt-3">
                  <span class="header_news" title="<?=$rs['judul_ina']?>"><?=$rs['judul_ina']?></span><br>
                  <table>
                      <tr>
                        <td style="vertical-align: top;"><span style="color: grey;" class="badge"><i class="fa fa-tags"></i></span></td>
                        <td>
                          <?php 
                            $tags = json_decode($rs['tag_berita'], true); 
                            if($tags){
                              $i = 1;
                              foreach($tags as $t){
                          ?>
                            <span style="color: grey;" class="badge"><?=$t?></span>
                          <?php $i++; } } ?>
                        </td>
                      </tr>
                  </table>
                  <hr>
                  <p><?=($rs['isi_berita'])?></p>
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
                    <?php if($other_news){ 
                      $data['news'] = $other_news;
                      $this->load->view('webcp/news/V_OtherNewsData', $data);
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
  $(function(){
    $('#berita_content').html($('#textarea_content').html())
  })
</script>