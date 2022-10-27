 
  <!-- pilih tempat -->
  <form id="form_edit_lokasi">
  <div class="col-lg-12">
<input type="hidden" value="<?=$lokasi['id'];?>" name="id_t_reservasi_online_detail" id="id_t_reservasi_online_detail">
              <!-- Provinsi -->
  <div class="form-group" style="margin-bottom:10px;">
  <label class="bmd-label-floating"><b>Provinsi</b></label>
  <select required class="form-control select2_this" data-dropdown-css-class="select2-navy" name="id_m_provinsi" id="id_m_provinsi_edit">
                 <option value="" selected>- Pilih Provinsi -</option>
                 <?php  foreach($list_provinsi as $ljp){?>
                                <option <?=$ljp['id'] == $lokasi['id_m_provinsi'] ? 'selected' : '';?>     value="<?=$ljp['id']?>"><?=$ljp['nama_provinsi']?></option>
                            <?php } ?>
  </select>
  </div>
  <!-- Kabupaten Kota -->
  <div class="form-group" style="margin-bottom:10px;">
  <label class="bmd-label-floating"><b>Kabupaten/Kota</b></label>
  <select required class="form-control select2_this  kabupaten_kota" data-dropdown-css-class="select2-navy" name="id_m_kabupaten_kota" id="id_m_kabupaten_kota_edit">
                 <option value="" selected>- Pilih Kabupaten Kota -</option>
                 <?php  foreach($list_kab_kota as $lkab){?>
                                <option <?=$lkab['id'] == $lokasi['id_m_kabupaten_kota'] ? 'selected' : '';?>     value="<?=$lkab['id']?>"><?=$lkab['nama_kabupaten_kota']?></option>
                            <?php } ?>

  </select>
  </div>
  <!-- Kecamatan -->
  <div class="form-group" style="margin-bottom:10px;">
  <label class="bmd-label-floating"><b>Kecamatan</b></label>
  <select required class="form-control select2_this  kecamatan" data-dropdown-css-class="select2-navy" name="id_m_kecamatan" id="id_m_kecamatan_edit">
                 <option value="" selected>- Pilih Kecamatan -</option>
                 <?php  foreach($list_kecamatan as $lkec){?>
                                <option <?=$lkec['id'] == $lokasi['id_m_kecamatan'] ? 'selected' : '';?> value="<?=$lkec['id']?>"><?=$lkec['nama_kecamatan']?></option>
                            <?php } ?>

  </select>
  </div>
  <!-- Kelurahan -->
  <div class="form-group" style="margin-bottom:10px;">
  <label class="bmd-label-floating"><b>Kelurahan</b></label>
  <select required class="form-control select2_this  kelurahan" data-dropdown-css-class="select2-navy" name="id_m_kelurahan" id="id_m_kelurahan_edit">
                 <option value="" selected>- Pilih Kelurahan -</option>
                 <?php  foreach($list_kelurahan as $lkel){?>
                                <option <?=$lkel['id'] == $lokasi['id_m_kelurahan'] ? 'selected' : '';?> value="<?=$lkel['id']?>"><?=$lkel['nama_kelurahan']?></option>
                            <?php } ?>

  </select>
  </div>
  <div class="form-group">
  <label class="bmd-label-floating"><b>Waktu Pengambilan Sampel</b></label>
  <input required autocomplete="off" class="form-control datetimepickerthis" type="text" id="waktu_pengambilan_sampel" name="waktu_pengambilan_sampel" value="<?=$lokasi['waktu_pengambilan_sampel'];?>" />
  </div>
</div>

<div class="col-lg-12">
      <button id="" type="submit" style="float: right;" class=" btn btn-sm btn-navy">Simpan</button>
    </div>

</form>
              <!-- tutup pilih tempat -->


<script>



     $(function(){
       
      $('.select2_this').select2()
    })

    $('#form_edit_lokasi').on('submit', function(e){
    e.preventDefault()
    $.ajax({
      url: '<?=base_url("reservasi/C_Reservasi/submitEditLokasiPengambilan")?>',
      method: 'post',
      data:$(this).serialize(),
      success: function(res){
          let rs = JSON.parse(res)
        
          if(rs.code == 0){
              successtoast('Data berhasil diubah')
              $('#edit-lokasi').modal('hide');
              const myTimeout = setTimeout(loadDetailLayanan, 500);

    
          } else {
              errortoast(rs.message)
          }
      }, error: function(e){
          errortoast('Terjadi Kesalahan')
      }
    })
 
  })


    $('#id_m_provinsi_edit').change(function(){     
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
                         $('.kecamatan').html('<option value="" selected>- Pilih Kecamatan -</option>');
                         $('.kelurahan').html('<option value="" selected>- Pilih Kelurahan -</option>');
                          
                     }
                 });
             });


      $('#id_m_kabupaten_kota_edit').change(function(){     
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
                         $('.kelurahan').html('<option value="" selected>- Pilih Kelurahan -</option>');

                          
                     }
                 });
             });

    

      $('#id_m_kecamatan_edit').change(function(){     
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