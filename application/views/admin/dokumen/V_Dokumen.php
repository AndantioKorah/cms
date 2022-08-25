

<div class="card card-default">
<div class="card-header">
            <div class="row">
                <div class="col-12">
                    <h3 class="card-title">UPLOAD DOKUMEN</h3>
                </div>
            </div>
        </div>
<?php if(!$this->general_library->isExternal()){ ?>
        <div class="card-body">
    <form action="#" method="post" id="form_dokumen" align="center" enctype="multipart/form-data">  
  <div class="form-group text-left">
  <label class="bmd-label-floating">Judul</label>
    <textarea class="form-control" name="judul_dokumen" id="judul_dokumen" rows="3" required></textarea>
  </div>
  <div class="form-group text-left">
  <label class="bmd-label-floating">Keterangan</label>
    <textarea class="form-control" name="keterangan_dokumen" id="keterangan_dokumen" rows="3" ></textarea>
  </div>
  <div class="form-group text-left">
  <label class="bmd-label-floating">Tanggal</label>
    <input class="form-control datetimepickerthis" name="tanggal_dokumen" id="tanggal_dokumen"  autocomplete="off" required/>
  </div>




  <div class="form-group text-left">
  <label class="bmd-label-floating">File </label> 
 <input type="file"class="form-control"  name="dokumen_file" id="dokumen_file"/>
        <br>
    <div id="uploadPreview1"></div>
  </div>

  <div class="col-lg-12 col-md-4 text-right mt-2">
        <button class="btn btn-block btn-navy" id="btn_upload"><i class="fa fa-save"></i> SIMPAN</button>
        </div>
</form>
<?php } ?>
<div class="card card-default" style="margin-top:20px;">
            <div class="card-header">
                        <div class="row">
                            <div class="col-12">
                                <h3 class="card-title">LIST DOKUMEN</h3>
                            </div>
                        </div>
                    <div class="card-body" id="list_dokumen">
                    
                                
                    </div>                
                     </div>
                    </div>
    </div>
  </div>

<script>
        $(document).ready(function(){  
            loadListDokumen()
 });  

 function loadListDokumen(){
        $('#list_dokumen').html('')
        $('#list_dokumen').load('<?=base_url("admin/C_Admin/loadListDokumen/")?>', function(){
            $('#loader').hide()
        })
    }


     $('#form_dokumen').on('submit', function(e){  
        $('#btn_upload').prop('disabled', true);
          $('#btn_upload').html('SIMPAN.. <i class="fas fa-spinner fa-spin"></i>')
          e.preventDefault();  
          if($('#dokumen_file').val() == '')  
          {  
               alert("Please Select the File");  
          }  
          else  
          {  
               $.ajax({  
                   url:"<?=base_url("admin/C_Admin/submitDokumen")?>",  
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
                           document.getElementById("form_dokumen").reset();  
                           $('#btn_upload').prop('disabled', false);
                           $('#btn_upload').html('<i class="fa fa-save"></i>  SIMPAN')
                           loadListDokumen()                          
                       } else {
                           errortoast(result.msg)
                           $('#btn_upload').prop('disabled', false);
                           $('#btn_upload').html('<i class="fa fa-save"></i>  SIMPAN')
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