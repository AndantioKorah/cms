<div class="card card-default">
    <div class="card-header"  style="display: block;">
        <h3 class="card-title">Realisasi Kinerja Pegawai</h3>
    </div>
    <div class="card-body" style="display: block;">
    <form method="post" id="submit">
    <div class="form-group">
         <label class="bmd-label-floating">Kegiatan Tugas Jabatan </label>
             <select class="form-control select2-navy" style="width: 100%" onchange="getSatuan()"
                 id="tugas_jabatan" data-dropdown-css-class="select2-navy" name="tugas_jabatan" required>
                 <option value="" selected>- Pilih Tugas Jabatan -</option>
                 <?php if($list_rencana_kinerja){
                                foreach($list_rencana_kinerja as $ljp){
                                ?>
                                <option value="<?=$ljp['id']?>">
                                    <?=$ljp['tugas_jabatan']?>
                                </option>
                            <?php } } ?>
                 </select>
        </div>
  <div class="form-group" >
    <label for="exampleFormControlInput1">Tanggal Kegiatan</label>
    <input  class="form-control datepicker" id="tanggal_kegiatan" name="tanggal_kegiatan" readonly value="<?= date('Y-m-d') ;?>">
  </div>

  <div class="form-group">
    <label for="exampleFormControlTextarea1">Deskripsi Kegiatan</label>
    <textarea class="form-control" id="deskripsi_kegiatan" name="deskripsi_kegiatan" rows="3" required></textarea>
  </div>

   <div class="form-group">
    <label>Realisasi Target (Kuantitas)</label>
    <input  class="form-control" type="text" id="target_kuantitas" name="target_kuantitas" required/>
  </div>
  
  <div class="form-group">
    <label>Satuan</label>
    <input class="form-control" type="text" id="satuan" name="satuan"  readonly/>
  </div>



  <div class="form-group">
    <label>Dokumen Bukti Kegiatan</label>
    <!-- <input class="form-control" type="file" id="image_file" multiple="multiple" /> -->
    <input  class="form-control" type="file" name="file" multiple="multiple" />
  </div>
  <div class="form-group">
     <button class="btn btn-block btn-navy" id="btn_upload"><i class="fa fa-save"></i> SIMPAN</button>
 </div>
</form> 

    </div>
</div>

<div class="card card-default">
    <div class="card-header">
        <h3 class="card-title">LIST KEGIATAN</h3>
    </div>
    <div class="card-body">
        <div id="list_kegiatan" class="row">
        </div>
    </div>
</div>

<script type="text/javascript">


    $(function(){
        
        loadListKegiatan()
    })

     function loadListKegiatan(){
        $('#list_kegiatan').html('')
        $('#list_kegiatan').append(divLoaderNavy)
        $('#list_kegiatan').load('<?=base_url("kinerja/C_Kinerja/loadKegiatan")?>', function(){
            $('#loader').hide()
           
        })
    }


    $("#submit").submit(function(e){

    e.preventDefault();
    // if($('#tugas_jabatan').val() == '')  
    // {  
    // alert("Please Select the File");  
    // } 


    $.ajax({
    url:"<?=base_url("kinerja/C_Kinerja/createLaporanKegiatan")?>",
    type:'POST',
    data:new FormData(this),
    processData:false,
    contentType:false,
    cache:false,
    async:false,
    success:function(data){
        successtoast("Data berhasil disimpan")
        loadListKegiatan()
        document.getElementById("submit").reset();
    } , error: function(e){
                errortoast('Terjadi Kesalahan')
    }
})
})



 function getSatuan() {
        var id_t_rencana_kinerja = $('#tugas_jabatan').val(); 
        var base_url = "<?=base_url()?>";
     
        $.ajax({
        type : "POST",
        url  : base_url + '/kinerja/C_Kinerja/getSatuan',
        dataType : "JSON",
        data : {id_t_rencana_kinerja:id_t_rencana_kinerja},
        success: function(data){
            var satuan = data[0].satuan;
            console.log(satuan)
            $('[name="satuan"]').val(satuan);
         }
        });
        return false;
        
       
      
        }


</script>
