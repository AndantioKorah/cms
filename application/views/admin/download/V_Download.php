

<div class="card card-default">
<div class="card-header">
            <div class="row">
                <div class="col-12">
                    <h3 class="card-title">FORM INPUT</h3>
                </div>
            </div>
        </div>
        <div class="card-body">
    <form action="#" method="post" id="form_download" align="center" enctype="multipart/form-data">  
  <div class="form-group text-left">
  <label class="bmd-label-floating">Judul</label>
    <textarea class="form-control" name="download_judul" id="download_judul" rows="3" required></textarea>
  </div>
  <div class="form-group text-left">
  <label class="bmd-label-floating">Keterangan</label>
    <textarea class="form-control" name="download_keterangan" id="download_keterangan" rows="3" ></textarea>
  </div>
  <div class="form-group text-left">
  <label class="bmd-label-floating">Tanggal</label>
    <input class="form-control datetimepickerthis" name="download_tanggal" id="download_tanggal"  autocomplete="off" required/>
  </div>

  <div class="form-group text-left">
  <label class="bmd-label-floating">Kategori</label>
  <select class="form-control select2-navy" style="width: 100%"
                 id="download_jenis" data-dropdown-css-class="select2-navy" name="download_jenis" required>
                 <option value="" selected>- Pilih Jenis Download -</option>
                 <?php if($list_master_download){
                                foreach($list_master_download as $ljp){
                                ?>
                                <option value="<?=$ljp['id']?>">
                                    <?=$ljp['jenis_download']?>
                                </option>
                            <?php } } ?>
                 </select>
  </div>


  
  <div class="form-group text-left">
  <label class="bmd-label-floating">File </label> 
 <input type="file"class="form-control"  name="download_file" id="download_file"/>
        <br>
    <div id="uploadPreview1"></div>
  </div>

  <div class="col-lg-12 col-md-4 text-right mt-2">
        <button class="btn btn-block btn-navy" id="btn_upload"><i class="fa fa-save"></i> SIMPAN</button>
        </div>
</form>
<div class="card card-default" style="margin-top:20px;">
            <div class="card-header">
                        <div class="row">
                            <div class="col-12">
                                <h3 class="card-title">LIST DATA</h3>
                            </div>
                        </div>
                    <div class="card-body" id="list_download">
                    
                                
                    </div>                
                     </div>
                    </div>
    </div>
  </div>

<script>
        $(document).ready(function(){  
          loadListDownload()
 });  

 function loadListDownload(){
        $('#list_download').html('')
        $('#list_download').load('<?=base_url("admin/C_Admin/loadListDownload/")?>', function(){
            $('#loader').hide()
        })
    }


     $('#form_download').on('submit', function(e){  
        $('#btn_upload').prop('disabled', true);
          $('#btn_upload').html('SIMPAN.. <i class="fas fa-spinner fa-spin"></i>')
          e.preventDefault();  
          if($('#file_ppid').val() == '')  
          {  
               alert("Please Select the File");  
          }  
          else  
          {  
               $.ajax({  
                   url:"<?=base_url("admin/C_Admin/submitKontenDownload")?>",  
                    method:"POST",  
                    data:new FormData(this),  
                    contentType: false,  
                    cache: false,  
                    processData:false,  
                    success:function(res)  
                    {  
                       
                       var result = JSON.parse(res); 
                    
                       if(result.success == true){
                           successtoast(result.msg)
                           document.getElementById("form_download").reset();  
                           $('#btn_upload').prop('disabled', false);
                           $('#btn_upload').html('<i class="fa fa-save"></i>  SIMPAN')
                           loadListPpid()                          
                       } else {
                           errortoast(result.msg)
                           return false;
                       }
                    }  
               });  
          }  
     });

     $('.datepicker').datepicker({
        todayHighlight: true,
        todayBtn: "linked",
        keyboardNavigation:true,
        autoclose: true,
        format: 'yyyy-mm-dd',
    })


$('.datetimepickerthis').datetimepicker({
    format: 'yyyy-mm-dd hh:ii:ss',
    autoclose: true,
    todayHighlight: true,
    todayBtn: true
  })
</script>