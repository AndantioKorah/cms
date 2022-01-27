<div class="card card-default">
    <div class="card-header"  style="display: block;">
        <h3 class="card-title">Laporan Kinerja Pegawai</h3>
    </div>
    <div class="card-body" style="display: block;">
    <form method="post" id="submit">
    <div class="form-group">
         <label class="bmd-label-floating">Rencana Kerja</label>
             <select class="form-control select2-navy" style="width: 100%"
                 id="rencana_kerja" data-dropdown-css-class="select2-navy" name="rencana_kerja">
                 <option selected>-</option>
                 <option value="1">One</option>
                 <option value="2">Two</option>
                 <option value="3">Three</option>
                 </select>
        </div>
  <div class="form-group" >
    <label for="exampleFormControlInput1">Tanggal Kegiatan</label>
    <input  class="form-control datetimepickerthis" id="tanggal_kegiatan" name="tanggal_kegiatan" readonly value="<?= date('Y-m-d H:i:s') ;?>">
  </div>

  <div class="form-group">
    <label for="exampleFormControlTextarea1">Deskripsi Kegiatan</label>
    <textarea class="form-control" id="deskripsi_kegiatan" name="deskripsi_kegiatan" rows="3"></textarea>
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

$("#datepicker").datepicker( {
    format: "mm-yyyy",
    startView: "months", 
    minViewMode: "months"
});


</script>



 <script type="text/javascript">
// $(document).ready(function(){  
// $('#upload_form').on('submit', function(e){  
// e.preventDefault();  
// if($('#image_file').val() == '')  
// {  
// alert("Please Select the File");  
// }  
// else 
// {  
// var form_data = new FormData();
// var ins = document.getElementById('image_file').files.length;
// for (var x = 0; x < ins; x++) {
// form_data.append("files[]", document.getElementById('image_file').files[x]);
// }
// $.ajax({  
// url:"<?=base_url("kinerja/C_Kinerja/createLaporanKegiatan")?>",    
// method:"POST",  
// data:form_data,  
// contentType: false,  
// cache: false,  
// processData:false,  
// dataType: "json",
// success:function(res)  
// {  
// console.log(res.success);
// if(res.success == true){
// $('#image_file').val('');
// // $('#uploadPreview').html('');   
// // $('#msg').html(res.msg);   
// // $('#divMsg').show();   
// }
// else if(res.success == false){
// $('#msg').html(res.msg); 
// $('#divMsg').show(); 
// }
// setTimeout(function(){
// $('#msg').html('');
// $('#divMsg').hide(); 
// }, 3000);
// }  
// });  
// }  
// });  
// }); 
// // var url = window.URL || window.webkitURL; // alternate use
// function readImage(file) {
// var reader = new FileReader();
// var image  = new Image();
// reader.readAsDataURL(file);  
// reader.onload = function(_file) {
// image.src = _file.target.result; // url.createObjectURL(file);
// image.onload = function() {
// var w = this.width,
// h = this.height,
// t = file.type, // ext only: // file.type.split('/')[1],
// n = file.name,
// s = ~~(file.size/1024) +'KB';
// $('#uploadPreview').append('<img src="' + this.src + '" class="thumb">');
// };
// image.onerror= function() {
// alert('Invalid file type: '+ file.type);
// };      
// };
// }
// $("#image_file").change(function (e) {
// if(this.disabled) {
// return alert('File upload not supported!');
// }
// var F = this.files;
// if (F && F[0]) {
// for (var i = 0; i < F.length; i++) {
// // readImage(F[i]);
// }
// }
// });
</script>

<script>

    // $('#form_tambah_kegiatan').on('submit', function(e){
    //     e.preventDefault();
    //     $.ajax({
    //         url: '<?=base_url("kinerja/C_Kinerja/createLaporanKegiatan")?>',
    //         method: 'post',
    //         data: $(this).serialize(),
    //         success: function(){
    //             successtoast('Data berhasil ditambahkan')
                
    //         }, error: function(e){
    //             errortoast('Terjadi Kesalahan')
    //         }
    //     })
    // })

</script>


