

<div class="card card-default">
<div class="card-header">
            <div class="row">
                <div class="col-12">
                    <h3 class="card-title">FORM INPUT MASTER DOWNLOAD</h3>
                </div>
            </div>
        </div>
        <div class="card-body">
    <form action="#" method="post" id="form_master_downlaod" align="center" enctype="multipart/form-data">  

  <div class="form-group text-left">
  <label class="bmd-label-floating">Jenis Download</label>
    <input class="form-control " name="jenis_download" id="jenis_download"  autocomplete="off" required/>
  </div>



  <div class="col-lg-12 col-md-4 text-right mt-2">
        <button class="btn btn-block btn-navy" id="btn_upload"><i class="fa fa-save"></i> SIMPAN</button>
        </div>
</form>
<div class="card card-default" style="margin-top:20px;">
            <div class="card-header">
                        <div class="row">
                            <div class="col-12">
                                <h3 class="card-title">LIST DOWNLOAD</h3>
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
        loadListMasterDownload()
 });  

 function loadListMasterDownload(){
        $('#list_download').html('')
        $('#list_download').load('<?=base_url("master/C_Master/loadListMasterDownload/")?>', function(){
            $('#loader').hide()
        })
    }


     $('#form_master_downlaod').on('submit', function(e){  
        $('#btn_upload').prop('disabled', true);
          $('#btn_upload').html('SIMPAN.. <i class="fas fa-spinner fa-spin"></i>')
          e.preventDefault();  
          if($('#jenis_downlaod').val() == '')  
          {  
               alert("Silahkan Isi Jenis Download");  
          }  
          else  
          {  
               $.ajax({  
                   url:"<?=base_url("master/C_Master/submitMasterDownload")?>",  
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
                           document.getElementById("form_master_downlaod").reset();  
                           $('#btn_upload').prop('disabled', false);
                           $('#btn_upload').html('<i class="fa fa-save"></i>  SIMPAN')
                           loadListMasterDownload()                          
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