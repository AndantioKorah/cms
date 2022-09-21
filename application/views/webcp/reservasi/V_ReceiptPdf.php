<style> 
  .r_nama_pelayanan, .r_total_biaya{
    font-size: 15px;
    font-weight: bold;
    margin-top: 5px;
  }

  .r_parameter_pelayanan{
    font-size: 14px;
    font-weight: 500;
    color: #383737;
  }

  .r_total_seluruh_biaya{
    font-size: 17px;
    font-weight: bold;
    float: right;
  }

  .label_th{
    font-size: 14px;
    text-align: center;
  }

  .print-logo{
    max-height: 80px;
    float: left;
  }

  .logo-text-print-h5{
    font-size: 2vw;
    font-weight: bold;
  }

  .logo-text-print-h3{
    font-size: 2vw;
    font-weight: bold;
  }
</style>
<?php if($result){ ?>
  <div class="row">
    <div class="col-lg-12" style="padding-bottom: 10px; 10px;">
      <table>
        <tr>
          <td style="width: 10%;">
            <img class="print-logo" src="<?=base_url('assets/webcp/assets/img/logo-kemenkes-only.png')?>" alt="" class="img-fluid">
          </td>
          <td style="90%; text-align: left;">
            <span class="logo-text-print-h5">KEMENTRIAN KESEHATAN RI</span><br>
            <span class="logo-text-print-h5">Direktorat Jenderal Pencegahan dan Pengendalian Penyakit</span><br>
            <span class="logo-text-print-h3">Balai Teknik Kesehatan Lingkungan Dan Pengendalian Penyakit (BTKLPP) Kelas I Manado</span>
          </td>
        </tr>
      </table>
      <!-- <div class="row">
        <div class="col-lg-2">
          <img class="print-logo" src="<?=base_url('assets/webcp/assets/img/logo-kemenkes-only.png')?>" alt="" class="img-fluid">
        </div>
        <div class="col-lg-10">
          <span class="logo-text-print-h5">KEMENTRIAN KESEHATAN RI</span><br>
          <span class="logo-text-print-h5">Direktorat Jenderal Pencegahan dan Pengendalian Penyakit</span><br>
          <span class="logo-text-print-h3">Balai Teknik Kesehatan Lingkungan Dan Pengendalian Penyakit (BTKLPP) Kelas I Manado</span>
        </div>
      </div>   -->
    </div>
    <div class="col-lg-12"><hr></div>
    <div class="col-lg-12 text-center float-center" style="text-align: center; margin-top: 50px;">
      <span style="float: center; font-size: 20px; font-weight: bold;">NOTA RESERVASI ONLINE</span>
    </div>
    <div class="col-lg-6">
      <h6 style="font-family: Tahoma; float:left; font-size: 18px; font-weight: 500;">No. Tiket : <?=$nomor_tiket?><h6>
    </div>
    <div class="col-lg-6">
      <h6 style="font-family: Tahoma; float:right; font-size: 18px; font-weight: 500;" id="tanggal_tiket"><?=formatDateNamaBulanWT($tanggal_tiket)?><h6>
    </div>
    <div class="col-lg-12">
      <table style="width: 100%; border-collapse: collapse;" border=1>
        <thead>
          <th style="padding: 10px;" class="label_th">JENIS LAYANAN</th>
          <th style="padding: 10px;" class="label_th">TOTAL</th>
        </thead>
        <tbody>
          <?php $total = 0; $total_seluruh = 0; foreach($result as $r){ ?>
            <tr style="padding: 5px;">
              <td style="width: 65%; line-height: 14pt; padding: 10px;">
                <span class="r_nama_pelayanan"><?=$r['nama_jenis_pelayanan']?> 
                </span>
                <br>
                <span class="r_parameter_pelayanan">
                  <?php $i = 0; foreach($r['parameter'] as $p){
                    $comma = ', ';
                    if($i == count($r['parameter']) - 1){
                      $comma = '';
                    }
                    $total += $p['harga']; 
                  ?>
                    <?=$p['nama_parameter_jenis_pelayanan'].$comma;?>
                  <?php $i++; } ?>
                </span>
              </td>
              <td style="width: 35%; text-align: right; padding: 10px;" valign="top">
                <span class="r_total_biaya"><?=formatCurrencyWithoutRp($total)?></span>
              </td>
            </tr>
          <?php $total_seluruh += $total; $total = 0; } ?>
          <tr style="border-top: 1px solid black;">
            <td style="padding: 10px;">
              <span class="r_total_seluruh_biaya">TOTAL : </span>
            </td>
            <td style="float: right; border: 0px !important; padding: 10px;">
              <span class="r_total_seluruh_biaya"><?=formatCurrency($total_seluruh)?></span>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
  <script>
    $(function(){
      $('#tanggal_tiket').html('<?=$r['created_date']?>')
    })
  </script>
<?php } ?>