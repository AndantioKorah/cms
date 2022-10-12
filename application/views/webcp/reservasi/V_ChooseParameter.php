<?php if($parameter){ ?>
  <div class="row">
    <div class="col-lg-12">
      <span class="title-layanan">Pilih Parameter</span>
      <div class="form-check">
        <input onclick="checkboxClick('all')" type="checkbox" class="form-check-choose form-check-input" id="check_all" name="check_all" value="all" checked>
        <label onclick="checkboxClick('all')" class="form-check-label" for="check_all">Pilih Semua</label>
      </div>
    </div>
    <?php $total_biaya = 0; foreach($parameter as $p){
      $total_biaya += $p['harga'];
    ?>
      <div class="col-lg-4">
        <div class="form-check">
          
          <input onclick="checkboxClick('<?=$p['id']?>', '<?=$p['harga']?>')" type="checkbox" <?= $p['flag_available'] == 0 ? 'disabled' : '' ?> class="form-check-choose option_checkbox form-check-input" 
          id="check_<?=$p['id']?>" name="parameter[]" value="<?=$p['id'].';'.$p['harga']?>" <?= $p['flag_available'] == 1 ? 'checked' : '' ?>  >

          <label onclick="checkboxClick('<?=$p['id']?>', '<?=$p['harga']?>')" class="form-check-choose form-check-label" 
          for="check_<?=$p['id']?>"><?=$p['nama_parameter_jenis_pelayanan'].' ('.formatCurrencyWithoutRp($p['harga']).')'?></label>
        </div>
      </div>
    <?php } ?>
    <div class="col-lg-12">
      <hr>
    </div>
    <div class="col-lg-6">
      <span class="title-layanan">Total Biaya</span><br>
      <span class="total_biaya_temp"></span>
    </div>
    <div class="col-lg-6">
      <button id="btn_save" type="submit" style="float: right;" class="btn btn-sm btn-primary-color"><i class="fa fa-plus"></i> Tambah</button>
      <button id="btn_loading" disabled style="display: none; float: right;" class="btn btn-sm btn-primary-color"><i class="fa fa-spin fa-spinner"></i> Loading...</button>
    </div>
  </div>
  <script>
    $(function(){
      countTotalBiaya()
    })

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
    
    function countTotalBiaya(){
      total_biaya = 0;
      $('.option_checkbox:checked').each(function(){
        var temp = $(this).val().split(";")
        total_biaya = parseInt(total_biaya) + parseInt(temp[1]);
      });
      $('.total_biaya_temp').html('Rp '+formatRupiah(String(total_biaya)))
    }

    function checkboxClick(id, harga){
      if(id == 'all'){
        if($('#check_all').is(':checked')){
            $('input[type=checkbox]').not(":disabled").prop('checked', true)         
        } else {
          $('.option_checkbox').prop('checked', false)
        }
      } else {
        if($('#check_'+id).is(':checked')){
          if($('.option_checkbox:checked').length == $('.option_checkbox').length){
            $('#check_all').prop('checked', true)
          }
        } else {
          $('#check_all').prop('checked', false)
        }
      }
      countTotalBiaya()
    }
  </script>
<?php } else { ?>
  <div class="text-center">
    <h6>Parameter tidak ditemukan <i class="fa fa-exclamation"></i></h6>
  </div>
<?php } ?>