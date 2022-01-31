<style type="text/css">
.thumb{
  margin: 24px 5px 20px 0;
  width: 150px;
  float: left;
}
#blah {
  border: 2px solid;
  display: block;
  background-color: white;
  border-radius: 5px;
}
</style>
<div class="card card-default">
    <div class="card-header"  style="display: block;">
        <h3 class="card-title">Realisasi Kinerja Pegawai</h3>
    </div>
    <div class="card-body" style="display: block;">
    <form method="post" id="upload_form" enctype="multipart/form-data">
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
    <input  class="form-control datepickerthis" id="tanggal_kegiatan" name="tanggal_kegiatan" readonly value="<?= date('Y-m-d') ;?>">
  </div>

  <div class="form-group">
    <label for="exampleFormControlTextarea1">Detail Kegiatan</label>
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
    <input class="form-control" type="file" id="image_file" name="files[]" multiple="multiple" />
    <br>
      <div id="uploadPreview"></div>
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
    <div class="col-12">
    <form class="form-inline" method="post">
  <div class="form-group">
    <label for="email" class="mr-2">Tahun </label>
    <input  class="form-control datepicker" id="tahun" name="tahun" value="<?=date('Y');?>">
  </div>
  <div class="form-group">
    <label for="pwd" class="mr-2 ml-3"> Bulan</label>
    <select class="form-control select2-navy" 
                 id="bulan" data-dropdown-css-class="select2-navy" name="bulan" required>
                 <option value="" selected>- Pilih Bulan -</option>
                 <option value="1">Januari</option>
                 <option value="2">Feburari</option>
                 <option value="3">Maret</option>
                 <option value="4">April</option>
                 <option value="5">Mei</option>
                 <option value="6">Juni</option>
                 <option value="7">Juli</option>
                 <option value="8">Agustus</option>
                 <option value="9">September</option>
                 <option value="10">Oktober</option>
                 <option value="10">November</option>
                 <option value="10">Desember</option>
                 </select>
         </div>
        <button type="button" onclick="searchListKegiatan()" class="btn btn-primary ml-3">Cari</button>
        </form>
     <br>
    </div>
        <div id="list_kegiatan" class="row">
        </div>
    </div>
</div>



<script type="text/javascript">


    $(function(){
        
        loadListKegiatan()
    })

     function loadListKegiatan(){
         var tahun = new Date().getFullYear()
         var bulan = new Date().getMonth()+1;
 
        $('#list_kegiatan').html('')
        $('#list_kegiatan').append(divLoaderNavy)
        $('#list_kegiatan').load('<?=base_url("kinerja/C_Kinerja/loadKegiatan/")?>'+tahun+'/'+bulan+'', function(){
            $('#loader').hide()
           
        })
    }

    
        $('#upload_form').on('submit', function(e){  
        e.preventDefault();  
        if($('#image_file').val() == '')  
        {  
        alert("Please Select the File");  
        }  
        else 
        {  

        var formvalue = $('#upload_form');
        var form_data = new FormData(formvalue[0]);
       
        $.ajax({  
        url:"<?=base_url("kinerja/C_Kinerja/multipleImageStore")?>",
        method:"POST",  
        data:form_data,  
        contentType: false,  
        cache: false,  
        processData:false,  
        // dataType: "json",
        success:function(data){  
           
                successtoast("Data berhasil disimpan")
                loadListKegiatan()
                document.getElementById("upload_form").reset();
                $('#uploadPreview').html('');
        }  
        });  
        }  
        }); 


    $("#submit").submit(function(e){
    e.preventDefault();
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

        function readImage(file) {
        var reader = new FileReader();
        var image  = new Image();
        reader.readAsDataURL(file);  
        reader.onload = function(_file) {
        image.src = _file.target.result; // url.createObjectURL(file);
        image.onload = function() {
        var w = this.width,
        h = this.height,
        t = file.type, // ext only: // file.type.split('/')[1],
        n = file.name,
        s = ~~(file.size/1024) +'KB';
        $('#uploadPreview').append('<img src="' + this.src + '" class="thumb">');
        };
        image.onerror= function() {
        alert('Invalid file type: '+ file.type);
        };      
        };
        }
        $("#image_file").change(function (e) {
        if(this.disabled) {
        return alert('File upload not supported!');
        }
        var F = this.files;
        if (F && F[0]) {
        for (var i = 0; i < F.length; i++) {
        readImage(F[i]);
        }
        }
        });

      

    function searchListKegiatan(){
        if($('#bulan').val() == '')  
        {  
        alert("Pilih Bulan terlebih dahulu");  
        return false
        } 
        var tahun = $('#tahun').val(); 
        var bulan = $('#bulan').val();
        $('#list_kegiatan').html(' ')
        $('#list_kegiatan').append(divLoaderNavy)
        $('#list_kegiatan').load('<?=base_url('kinerja/C_Kinerja/loadKegiatan/')?>'+tahun+'/'+bulan+'', function(){
            $('#loader').hide()
           
        })
    }

</script>
