<?php if($result){ ?>
               
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
            <div class="row">
              <div class="col-lg-12">
                <span class="search_jenis_layanan"><?=$rs['nama_jenis_pelayanan']?></span>
                <input value="<?=$rs['id_t_reservasi_online_detail']?>" name="detail[]" style="display: none;" />
                <?php if($result['status'] == 2){ ?>
                  <i id="btn_delete_<?=$rs['id_t_reservasi_online_detail']?>" onclick="deleteJenisLayanan('<?=$rs['id_t_reservasi_online_detail']?>')" style="color: red; cursor: pointer;" class="fa fa-trash"></i>
                  <i id="btn_loading_<?=$rs['id_t_reservasi_online_detail']?>" disabled style="display: none; color: red; cursor: pointer;" class="fa fa-spin fa-spinner"></i>
                <?php } ?>
              </div>
              <div class="col-lg-12">
                <?php if($result['status'] == 2){ ?>
                  <div class="row">
                    <?php foreach($rs['parameter'] as $p){ 
                      if($p['checked'] == 1){
                        $total += $p['harga'];
                      }
                      ?>
                      <div class="col-lg-4">
                        <div class="form-check">
                          <input onclick="checkboxClick('<?=$p['id_t_parameter_jenis_pelayanan'].$rs['id_t_reservasi_online_detail']?>', '<?=$p['harga']?>', '<?=$rs['id_t_reservasi_online_detail']?>')" 
                          type="checkbox" class="form-check-choose all_option_checkbox option_checkbox_<?=$rs['id_t_reservasi_online_detail']?> form-check-input" 
                          id="check_<?=$p['id_t_parameter_jenis_pelayanan'].$rs['id_t_reservasi_online_detail']?>" name="parameter_<?=$rs['id_t_reservasi_online_detail']?>[]" 
                          value="<?=$p['id_t_parameter_jenis_pelayanan'].';'.$p['harga']?>" <?=$p['checked'] == 1 ? 'checked' : ''?>>

                          <label onclick="checkboxClick('<?=$p['id_t_parameter_jenis_pelayanan'].$rs['id_t_reservasi_online_detail']?>', '<?=$p['harga']?>')" class="form-check-choose form-check-label" 
                          for="check_<?=$p['id_t_parameter_jenis_pelayanan']?>"><?=$p['nama_parameter_jenis_pelayanan'].' ('.formatCurrencyWithoutRp($p['harga']).')'?></label>
                        </div>
                      </div>
                    <?php } ?>
                  </div>
                  <?php } else { ?>
                    <?php $comma = ', '; $i = 0; foreach($rs['parameter'] as $p){ if($p['checked'] == 1){
                      if($i == count($rs['parameter']) - 1){
                        $comma = '';
                      }

                      if($p['checked'] == 1){
                        $total += $p['harga'];
                      }
                    ?>
                      <span style="font-size: 10pt; color: grey;"><?=$p['nama_parameter_jenis_pelayanan'].$comma;?></span>
                    <?php $i++; } } ?>
                  <?php } ?>
              </div>
            </div>
          </td>
          <td style="width: 30%; border: 1px solid black;" class="text-center">
            <span class="search_jenis_layanan text_sub_total" id="text_total_<?=$rs['id_t_reservasi_online_detail']?>"><?=formatCurrencyWithoutRp($total)?></span>
          </td>
        </tr>
      <?php } ?>
      <tr style="border: 1px solid black;">
        <td style="padding: 10px; text-align: right;">
          <span class="total_biaya_title">TOTAL : </span>
        </td>
        <td class="text-right" style="padding: 10px; text-align: center;">
          <span class="total_biaya_title" id="total_biaya_value"><?=formatCurrency($result['total_biaya'])?></span>
        </td>
      </tr>
    </tbody>
  </table>
  <script>
    $(function(){
      <?php if($result['status'] == 2){ ?>
        countTotalBiaya()
      <?php } ?>
    })

    function deleteJenisLayanan(id){
      if(confirm('Apakah Anda yakin ingin menghapus Jenis Pelayanan?')){
        $('#btn_delete_'+id).hide()
        $('#btn_loading_'+id).show()
        $.ajax({
          url: '<?=base_url('reservasi/C_Reservasi/deleteJenisLayanan/')?>'+id,
          method: 'POST',
          data: null,
          success: function(res){
            let rs = JSON.parse(res)
            if(rs.code == 0){
              successtoast('Jenis Pelayanan Berhasil Dihapus')
              loadDetailLayanan()
            } else {
              errortoast(rs.message)
            }
            $('#btn_save').show()
            $('#btn_loading').hide()
          }, error: function(e){
            $('#btn_save').show()
            $('#btn_loading').hide()
            errortoast(e)
          }
        })
      }
    }

    function formatRupiah(angka, prefix = "Rp ") {
      var number_string = angka.replace(/[^,\d]/g, "").toString(),
          split = number_string.split(","),
          sisa = split[0].length % 3,
          rupiah = split[0].substr(0, sisa),
          ribuan = split[0].substr(sisa).match(/\d{3}/gi);

      // tambahkan titik jika yang di input sudah menjadi angka ribuan
      if (ribuan) {
          separator = sisa ? "." : "";
          rupiah += separator + ribuan.join(".");
      }

      rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
      return prefix == undefined ? rupiah : rupiah ? rupiah : "";
    }
    
    function countTotalBiaya(id){
      sub_total = 0;
      $('.option_checkbox_'+id+':checked').each(function(){
        var temp = $(this).val().split(";")
        sub_total = parseInt(sub_total) + parseInt(temp[1]);
      });
      $('#text_total_'+id).html('Rp '+formatRupiah(String(sub_total)))

      total_biaya = 0;
      $('.all_option_checkbox:checked').each(function(){
        var temp_total = $(this).val().split(";")
        total_biaya = parseInt(total_biaya) + parseInt(temp_total[1]);
      });
      $('#total_biaya_value').html('Rp '+formatRupiah(String(total_biaya)))
    }

    function checkboxClick(id, harga, id_t_reservasi_online_detail){
      console.log(id)
      console.log(id_t_reservasi_online_detail)
      if(id == 'all'){
        if($('#check_all').is(':checked')){
          $('.option_checkbox_'+id).prop('checked', true)
        } else {
          $('.option_checkbox_'+id).prop('checked', false)
        }
      } else {
        if($('#check_'+id).is(':checked')){
          if($('.option_checkbox_'+id+':checked').length == $('.option_checkbox_'+id).length){
            // $('#check_all').prop('checked', true)
          }
        } else {
          // $('#check_all').prop('checked', false)
        }
      }
      countTotalBiaya(id_t_reservasi_online_detail)
    }
  </script>
<?php } else { ?>
  <div class="text-center">
    <h6>Belum Ada Layanan yang Dipilih <i class="fa fa-exclamation"></i></h6>
  </div>
<?php } ?>
<script>
          $(function(){
        $('.select2_this').select2()
        startTime()
        console.log($('.div-navbar-logo').height())
        console.log($('.div-navbar-logo').width())
      })
</script>