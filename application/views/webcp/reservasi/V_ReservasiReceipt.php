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
<?php if($result){ ?>
  <table style="width: 100%;" border="1">
    <thead>
      <th class="label_th">JENIS LAYANAN</th>
      <th class="label_th">TOTAL</th>
    </thead>
    <tbody>
      <?php $total = 0; $total_seluruh = 0; foreach($result as $r){ ?>
        <tr style="padding: 5px;">
          <td style="width: 65%; line-height: 1; padding-bottom: 10px; padding-top: 10px;">
            <span class="r_nama_pelayanan"><?=$r['nama_jenis_pelayanan']?> 
              <i title="Hapus" id="i_delete_<?=$r['id_t_reservasi_online_detail']?>" onclick="deleteParameter('<?=$r['id_t_reservasi_online_detail']?>')"
              style="color: red; font-size: 12px; cursor: pointer;" class="fa fa-trash"></i>
              <i id="i_loading_delete_<?=$r['id_t_reservasi_online_detail']?>"
              style="color: red; font-size: 12px; display: none;" disabled class="fa fa-spin fa-spinner"></i>
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
        <tr>
          <td>Provinsi : <?=$r['nama_provinsi']?> , Kabupaten/Kota  <?=$r['nama_kabupaten_kota']?>, Kecamatan : <?=$r['nama_kecamatan']?>, kelurahan : <?=$r['nama_kelurahan']?> 
                <br>
              Waktu Pengambilan Sampel : <?=$r['waktu_pengambilan_sampel']?> 
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
      <tr>
        <td></td>
        <td style="float: right;">
          <button id="btn_checkout" onclick="checkout()" class="btn btn-primary-color btn-sm"><i class="fa fa-check-circle"></i> Checkout</button>
          <button id="btn_loading_checkout" style="display: none;" class="btn btn-primary-color btn-sm"><i class="fa fa-spin fa-spinner"></i> Loading...</button>
        </td>
      </tr>
    </tbody>
  </table>

  <script>
    function deleteParameter(id){
      if(confirm('Apakah Anda yakin ingin menghapus?')){
        $('#i_delete_'+id).hide()
        $('#i_loading_delete_'+id).show()
        $.ajax({
          url: '<?=base_url("webcp/reservasi/C_Reservasi/deleteJenisLayananReceipt/")?>'+id,
          method: 'post',
          data:$(this).serialize(),
          success: function(res){
              let rs = JSON.parse(res)
              if(rs.code == 0){
                  successtoast('Data berhasil dihapus')
                  refreshReceipt()
                  $('#i_delete_'+id).hide()
                  $('#i_loading_delete_'+id).show()
              } else {
                  errortoast(rs.message)
                  $('#i_delete_'+id).hide()
                  $('#i_loading_delete_'+id).show()
              }
          }, error: function(e){
              $('#i_delete_'+id).hide()
              $('#i_loading_delete_'+id).show()
              errortoast('Terjadi Kesalahan')
          }
        })
      }
    }

    function checkout(){
      if(confirm('Apakah Anda yakin untuk Checkout?')){
        $('#btn_checkout').hide()
        $('#btn_loading_checkout').show()
        $.ajax({
          url: '<?=base_url("webcp/reservasi/C_Reservasi/checkoutReservasi/")?>'+$('#session_id').val(),
          method: 'post',
          data:$(this).serialize(),
          success: function(res){
              let rs = JSON.parse(res)
              if(rs.code == 0){
                  // successtoast('Data berhasil dihapus')
                  // refreshReceipt()
                  openModalFinalReceipt(rs.nomor_tiket, '<?=$r['id_t_reservasi_online']?>')
                  <?php
                    $this->session->set_userdata('final_receipt_'.$r['id_t_reservasi_online'], $result);
                  ?>
                  $('#btn_checkout').show()
                  $('#btn_loading_checkout').hide()
                  $('#div_receipt').hide();
                  $('#receipt').html('');
                  $('#session_id').val('<?=generateRandomNumber(4).date('Ymdhis')?>')
              } else {
                  errortoast(rs.message)
                  $('#btn_checkout').show()
                  $('#btn_loading_checkout').hide()
              }
          }, error: function(e){
              $('#btn_checkout').show()
              $('#btn_loading_checkout').hide()
              errortoast('Terjadi Kesalahan')
          }
        })
      }
    }

    function openModalFinalReceipt(nomor_tiket, id_t_reservasi_online){
      $('#modal_final_receipt').modal({backdrop: 'static', keyboard: false})
      $('#modal_final_receipt').modal('show')
      $('#content_modal_final_receipt').html('')
      $('#content_modal_final_receipt').append(divLoaderNavy)
      $('#content_modal_final_receipt').load('<?=base_url('webcp/reservasi/C_Reservasi/finalReceiptModal/')?>'+id_t_reservasi_online+'/'+nomor_tiket, function(){
        $('#loader').hide()
      })
    }
  </script>
<?php } ?>