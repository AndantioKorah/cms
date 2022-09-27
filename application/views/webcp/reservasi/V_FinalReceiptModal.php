<style> 
  .r_nama_pelayanan, .r_total_biaya{
    font-size: 15px;
    font-weight: bold;
    margin-top: 5px;
  }

  .r_parameter_pelayanan{
    font-size: 13px;
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
</style>
<div class="modal-content">
  <div class="modal-header">
    <h5 class="modal-title">Nota Reservasi Online</h5>
    <button id="close_button_modal" type="button" class="close btn btn-sm btn-danger" data-dismiss="modal" aria-label="Close">
      <i class="fa fa-times-circle"></i>
      <!-- <span aria-hidden="true">&times;</span> -->
    </button>
  </div>
  <div class="modal-body">
    <div class="row">
      <div class="col-lg-12 mb-3">
        <h6 style="font-family: Tahoma; float:right; font-size: 20px; font-weight: bold;">No. Ticket : <?=$nomor_tiket?><h6>
      </div>
    </div>
    <?php if($result){ ?>
      <table style="width: 100%;">
        <thead>
          <th class="label_th">JENIS LAYANAN</th>
          <th class="label_th">TOTAL</th>
        </thead>
        <tbody>
          <?php $total = 0; $total_seluruh = 0; foreach($result as $r){ ?>
            <tr style="padding: 5px;">
              <td style="width: 65%; line-height: 1; padding-bottom: 10px; padding-top: 10px;">
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
              <td style="width: 35%; text-align: right;" valign="top">
                <span class="r_total_biaya"><?=formatCurrencyWithoutRp($total)?></span>
              </td>
            </tr>
          <?php $total_seluruh += $total; $total = 0; } ?>
          <tr style="border-top: 1px solid black;">
            <td>
              <span class="r_total_seluruh_biaya">TOTAL : </span>
            </td>
            <td style="float: right;">
              <span class="r_total_seluruh_biaya"><?=formatCurrency($total_seluruh)?></span>
            </td>
          </tr>
        </tbody>
      </table>
    <?php } ?><br>
    <div class="row">
      <div class="col-lg-12">
        <span style="font-size: 12px; color: red; font-weight: bold;">*Harap agar Nomor Tiket dicatat atau cetak Nota Reservasi berikut untuk ditunjukkan pada saat Registrasi</span>
      </div>
    </div>
  </div>
  <div class="modal-footer">
    <!-- <form action="<?=base_url('webcp/reservasi/C_Reservasi/saveReceipt/'.$r['id_t_reservasi_online'].'/'.$nomor_tiket)?>" target="_blank"> -->
      <button onclick="cetakReceipt()" class="btn btn-sm btn-primary-color"><i class="fa fa-print"></i> Cetak Nota Reservasi</button>
    <!-- </form> -->
  </div>
</div>
<div id="print_div" style="display:none;"></div>
<iframe id="printing-frame" name="print_frame" src="about:blank" style="display:none;"></iframe>
<script>
  function cetakReceipt() {
    $("#print_div").load('<?= base_url('webcp/reservasi/C_Reservasi/saveReceipt/'.$r['id_t_reservasi_online'].'/'.$nomor_tiket)?>',
      function () {
        $('img').on('load', function(){
          printSpace('print_div');
        })
      });
  }

  $('#close_button_modal').on('click', function(){
    $('#modal_final_receipt').modal('hide')
  })

  function printSpace(elementId) {
    var isi = document.getElementById(elementId).innerHTML;
    window.frames["print_frame"].document.title = document.title;
    window.frames["print_frame"].document.body.innerHTML = isi;
    window.frames["print_frame"].window.focus();
    window.frames["print_frame"].window.print();
  }
</script>