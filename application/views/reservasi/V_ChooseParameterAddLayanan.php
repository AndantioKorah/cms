<?php if($parameter){ ?>
  <div class="row">
    <div class="col-lg-12">
      <label class="title-layanan">Pilih Parameter</label>
      <div class="form-check">
        <input onclick="checkboxClickChooseParameter('all')" type="checkbox" class="form-check-choose form-check-input" id="check_all" name="check_all" value="all" checked>
        <label onclick="checkboxClickChooseParameter('all')" class="form-check-choose form-check-label" for="check_all">Pilih Semua</label>
      </div>
    </div>
    <?php $total_biaya = 0; foreach($parameter as $p){
      $total_biaya += $p['harga'];
    ?>
      <div class="col-lg-4">
        <div class="form-check">
          <input onclick="checkboxClickChooseParameter('<?=$p['id']?>', '<?=$p['harga']?>')" type="checkbox" class="form-check-choose option_checkbox form-check-input" 
          id="check_<?=$p['id']?>" name="parameter[]" value="<?=$p['id'].';'.$p['harga']?>" <?= $p['flag_available'] == 0 ? 'disabled' : '' ?> <?= $p['flag_available'] == 1 ? 'checked' : '' ?>>

          <label onclick="checkboxClickChooseParameter('<?=$p['id']?>', '<?=$p['harga']?>')" class="form-check-choose form-check-label" 
          for="check_<?=$p['id']?>"><?=$p['nama_parameter_jenis_pelayanan'].' ('.formatCurrencyWithoutRp($p['harga']).')'?></label>
        </div>
      </div>
    <?php } ?>
    <div class="col-lg-12">
        <!-- pilih tempat -->
        <div class="col-lg-12">
              <!-- Provinsi -->
  <div class="form-group" style="margin-bottom:10px;">
  <label class="bmd-label-floating"><b>Provinsi</b></label>
  <select required class="form-control select2_this select2-navy" data-dropdown-css-class="select2-navy" name="id_m_provinsi" id="id_m_provinsi">
                 <option value="" selected>- Pilih Provinsi -</option>
                 <?php  foreach($list_provinsi as $ljp){?>
                                <option <?=$ljp['id'] == 71 ? 'selected' : '';?>     value="<?=$ljp['id']?>"><?=$ljp['nama_provinsi']?></option>
                            <?php } ?>
  </select>
  </div>
  <!-- Kabupaten Kota -->
  <div class="form-group" style="margin-bottom:10px;">
  <label class="bmd-label-floating"><b>Kabupaten/Kota</b></label>
  <select required class="form-control select2_this select2-navy kabupaten_kota" data-dropdown-css-class="select2-navy" name="id_m_kabupaten_kota" id="id_m_kabupaten_kota">
                 <option value="" selected>- Pilih Kabupaten Kota -</option>
                 <?php  foreach($list_kab_kota as $lkab){?>
                                <option <?=$lkab['id'] == 7171 ? 'selected' : '';?>     value="<?=$lkab['id']?>"><?=$lkab['nama_kabupaten_kota']?></option>
                            <?php } ?>

  </select>
  </div>
  <!-- Kecamatan -->
  <div class="form-group" style="margin-bottom:10px;">
  <label class="bmd-label-floating"><b>Kecamatan</b></label>
  <select required class="form-control select2_this select2-navy kecamatan" data-dropdown-css-class="select2-navy" name="id_m_kecamatan" id="id_m_kecamatan">
                 <option value="" selected>- Pilih Kecamatan -</option>
                 <?php  foreach($list_kecamatan as $lkec){?>
                                <option value="<?=$lkec['id']?>"><?=$lkec['nama_kecamatan']?></option>
                            <?php } ?>

  </select>
  </div>
  <!-- Kelurahan -->
  <div class="form-group" style="margin-bottom:10px;">
  <label class="bmd-label-floating"><b>Kelurahan</b></label>
  <select required class="form-control select2_this select2-navy kelurahan" data-dropdown-css-class="select2-navy" name="id_m_kelurahan" id="id_m_kelurahan">
                 <option value="" selected>- Pilih Kelurahan -</option>

  </select>
  </div>
  <div class="form-group">
  <label class="bmd-label-floating"><b>Waktu Pengambilan Sampel</b></label>
  <input required autocomplete="off" class="form-control datetimepickerthis" type="text" id="waktu_pengambilan_sampel" name="waktu_pengambilan_sampel" value="<?= date('Y-m-d H:i:s');?>"/>
  </div>

  <div class="form-group">
  <label class="bmd-label-floating"><b>Nama Pengambilan Sampel</b></label>
  <input required autocomplete="off" class="form-control " type="text" id="nama_pengambil_sampel" name="nama_pengambil_sampel" />
  </div>
              </div>
              <!-- tutup pilih tempat -->

      <hr>
    </div>
    <div class="col-lg-6">
      <span class="title-layanan">Total Biaya</span><br>
      <span class="total_biaya_temp"></span>
      <input type="hidden" id="total_biaya" name="total_biaya" >
    </div>
    <div class="col-lg-6">
      <button id="btn_save" type="submit" style="float: right;" class="btn_delete_parameter btn btn-sm btn-navy"><i class="fa fa-plus"></i> Tambah</button>
      <button id="btn_loading" disabled style="display: none; float: right;" class="btn btn-sm btn-navy"><i class="fa fa-spin fa-spinner"></i> Loading...</button>
    </div>
  </div>
  <script>
    $(function(){
      countTotalBiayaChooseParameter()
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
    
    function countTotalBiayaChooseParameter(){
      total_biaya = 0;
      $('.option_checkbox:checked').each(function(){
        var temp = $(this).val().split(";")
        total_biaya = parseInt(total_biaya) + parseInt(temp[1]);
      });
      $('.total_biaya_temp').html('Rp '+formatRupiah(String(total_biaya)))
      $('#total_biaya').val(total_biaya)
    }

    function checkboxClickChooseParameter(id, harga){
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
      countTotalBiayaChooseParameter()
    }

    $('#id_m_provinsi').change(function(){     
                 var id=$(this).val();
                 $.ajax({
                     url : "<?php echo base_url();?>reservasi/C_Reservasi/getListKabupatenKota",
                     method : "POST",
                     data : {id: id},
                     async : false,
                     dataType : 'json',
                     success: function(data){
                         var html = '';
                         var i;
                         for(i=0; i<data.length; i++){
                             html += '<option value='+data[i].id+'>'+data[i].nama_kabupaten_kota+'</option>';
                         }
                         $('.kabupaten_kota').html(html);
                          
                     }
                 });
             });


      $('#id_m_kabupaten_kota').change(function(){     
                 var id=$(this).val();
                 $.ajax({
                     url : "<?php echo base_url();?>reservasi/C_Reservasi/getListKecamatan",
                     method : "POST",
                     data : {id: id},
                     async : false,
                     dataType : 'json',
                     success: function(data){
                         var html = '';
                         var i;
                         for(i=0; i<data.length; i++){
                             html += '<option value='+data[i].id+'>'+data[i].nama_kecamatan+'</option>';
                         }
                         $('.kecamatan').html(html);
                          
                     }
                 });
             });

    

      $('#id_m_kecamatan').change(function(){     
                 var id=$(this).val();
                 $.ajax({
                     url : "<?php echo base_url();?>reservasi/C_Reservasi/getListKelurahan",
                     method : "POST",
                     data : {id: id},
                     async : false,
                     dataType : 'json',
                     success: function(data){
                         var html = '';
                         var i;
                         for(i=0; i<data.length; i++){
                             html += '<option value='+data[i].id+'>'+data[i].nama_kelurahan+'</option>';
                         }
                         $('.kelurahan').html(html);
                          
                     }
                 });
             });

     $('.datetimepickerthis').datetimepicker({
    format: 'yyyy-mm-dd hh:ii:ss',
    autoclose: true,
    todayHighlight: true,
    todayBtn: true
    })
  </script>
<?php } else { ?>
  <div class="text-center">
    <h6>Parameter tidak ditemukan <i class="fa fa-exclamation"></i></h6>
  </div>
<?php } ?>