

<div class="card card-default">
<div class="card-header">
            <div class="row">
                <div class="col-12">
                    <h3 class="card-title">FORM INPUT PENGUMUMAN</h3>
                </div>
            </div>
        </div>
        <div class="card-body">
    <form action="#" method="post" id="form_pengumuman" align="center" enctype="multipart/form-data">  
  <div class="form-group text-left">
  <label class="bmd-label-floating">Judul</label>
    <textarea class="form-control" name="judul_pengumuman" id="judul_pengumuman" rows="3" required></textarea>
  </div>
  <div class="form-group text-left">
  <label class="bmd-label-floating">Keterangan</label>
    <textarea class="form-control" name="ketarangan_pengumuman" id="ketarangan_pengumuman" rows="3" required></textarea>
  </div>
  <div class="form-group text-left">
  <label class="bmd-label-floating">Tanggal</label>
    <input class="form-control datepicker" name="tanggal_pengumuman" id="tanggal_pengumuman"  autocomplete="off" required/>
  </div>
  <div class="form-group text-left">
  <label class="bmd-label-floating">File </label> 
 <input type="file"class="form-control"  name="pengumuman_file" id="pengumuman_file"/>
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
                                <h3 class="card-title">LIST PENGUMUMAN</h3>
                            </div>
                        </div>
                    <div class="card-body" id="list_pengumuman">
                    
                                
                    </div>                
                     </div>
                    </div>
    </div>
  </div>

<script>
        $(document).ready(function(){  
        loadListPengumuman()
 });  

 function loadListPengumuman(){
        $('#list_pengumuman').html('')
        $('#list_pengumuman').load('<?=base_url("admin/C_Admin/loadListPengumuman/")?>', function(){
            $('#loader').hide()
        })
    }


     $('#form_pengumuman').on('submit', function(e){  
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
                   url:"<?=base_url("admin/C_Admin/submitKontenPengumuman")?>",  
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
                           document.getElementById("form_pengumuman").reset(); 
                           $('#btn_upload').prop('disabled', false); 
                           $('#btn_upload').html('<i class="fa fa-save"></i>  SIMPAN')
                           loadListPengumuman()                          
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
</script>