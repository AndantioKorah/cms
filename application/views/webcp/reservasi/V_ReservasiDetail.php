<?php if($result){ ?>
  <style>
    .value_title{
      font-size: 12pt;
      font-weight: bold;
    }

    .label_title{
      font-size: 10pt;
    }

    .search_jenis_layanan{
      font-size: 12pt;
      font-weight: bold;
    }

    .search_parameter_jenis_layanan{
      font-size: 10pt;
      font-weight: 400;
    }

    .total_biaya_title{
      font-size: 14pt;
      font-weight: bold;
    }
  </style>
  <div class="container" style="
      background-color: white;
      border-radius: 5px;
      padding: 20px;
      font-family: 'Poppins', 'sans-serif';
      box-shadow: 3px 3px 16px 0px rgba(0,0,0,0.2);
      -webkit-box-shadow: 3px 3px 16px 0px rgba(0,0,0,0.2);
      -moz-box-shadow: 3px 3px 16px 0px rgba(0,0,0,0.2);
    ">
    <div class="row">
      <div class="col-lg-12 mb-3">
        <button onclick="cetakReceipt()" type="button" class="btn btn-sm btn-primary-color mb-2" style="float: right;"><i class="fa fa-print"></i> Cetak Nota Reservasi</button>
        <?php if($result['status'] == 10){ ?>
          <button onclick="cetakReceipt()" type="button" class="btn btn-sm btn-success mb-2" style="float: left; margin-right: 10px;"><i class="fa fa-print"></i> Cetak Hasil Pemeriksaan</button>
        <?php } ?>
        <table style="width: 100%;">
          <tr>
            <td style="width: 34%;">
              <span class="label_title">Nomor Tiket</span> : <br><span class="value_title" id="nomor_tiket_search"><?=$result['nomor_tiket']?></span>
            </td>
            <td style="width: 33%; text-align: center;">
              <span class="label_title">Tanggal</span> : <br><span class="value_title" id="tanggal_tiket_search"><?=formatDateNamaBulanWT($result['created_date'])?></span>
            </td>
            <td style="width: 33%; text-align: right;">
              <span class="label_title">Status</span> : <br><span class="value_title" id="status_search"><?=$result['nama_status']?></span>
            </td>
          </tr>
        </table>
        <hr>
      </div>
      <div class="col-lg-12">
        <table style="width: 100%; padding: 10px;">
          <thead style="border: 1px solid black;">
            <th style="padding: 10px; border: 1px solid black;">JENIS LAYANAN</th>
            <th class="text-center">BIAYA</th>
          </thead>
          <tbody>
            <?php foreach($result['pelayanan'] as $rs){
              $total = 0;
            ?>
              <tr style="border: 1px solid black;">
                <td style="padding: 10px; width: 70%; border: 1px solid black;">
                  <span class="search_jenis_layanan"><?=$rs['nama_jenis_pelayanan']?></span>
                  <br>
                  <?php $i = 0; $comma = ', '; foreach($rs['parameter'] as $p){
                    $total += $p['harga'];
                    if($i == count($rs['parameter'])-1){
                      $comma = '';
                    }
                  ?>
                    <span class="search_parameter_jenis_layanan"><?=$p['nama_parameter_jenis_pelayanan'].$comma?></span>
                  <?php $i++; } ?>
                </td>
                <td style="width: 30%; border: 1px solid black;" class="text-center">
                  <span class="search_jenis_layanan"><?=formatCurrencyWithoutRp($total)?></span>
                </td>
              </tr>
            <?php } ?>
            <tr style="border: 1px solid black;">
              <td style="padding: 10px; text-align: right;">
                <span class="total_biaya_title">TOTAL : </span>
              </td>
              <td class="text-right" style="padding: 10px; text-align: center;">
                <span class="total_biaya_title"><?=formatCurrency($result['total_biaya'])?></span>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div id="print_div" style="display:none;"></div>
  <iframe id="printing-frame" name="print_frame" src="about:blank" style="display:none;"></iframe>
  <script>
    $(function(){
      // $('#nomor_tiket_search').html('<?=$rs['nomor_tiket']?>')
      // $('#tanggal_tiket_search').html('<?=formatDateNamaBulanWT($rs['created_date'])?>')
      // $('#status_search').html('<?=($rs['nama_status'])?>')
    })

    function cetakReceipt() {
      <?php
        $this->session->set_userdata('final_receipt_search_'.$rs['id_t_reservasi_online'], $result);  
      ?>
      $("#print_div").load('<?= base_url('webcp/reservasi/C_Reservasi/saveReceipt/'.$rs['id_t_reservasi_online'].'/'.$rs['nomor_tiket'].'/1')?>',
        function () {
          $('img').on('load', function(){
            printSpace('print_div');
          })
        });
    }

    function printSpace(elementId) {
      var isi = document.getElementById(elementId).innerHTML;
      window.frames["print_frame"].document.title = document.title;
      window.frames["print_frame"].document.body.innerHTML = isi;
      window.frames["print_frame"].window.focus();
      window.frames["print_frame"].window.print();
    }
  </script>
<?php } else { ?>
  <div class="col-lg-12 text-center">
    <h5>Nomor Tiket tidak ditemukan <i class="fa fa-exclamation"></i></h5>
  </div>
<?php } ?>