

<div class="card card-default">
<div class="card-header">
            <div class="row">
                <div class="col-12">
                    <h3 class="card-title">FORM INPUT</h3>
                </div>
            </div>
        </div>
        <div class="card-body">
    <form action="#" method="post" id="form_infografis" align="center" enctype="multipart/form-data">  
  <div class="form-group text-left">
  <label class="bmd-label-floating">Judul</label>
    <textarea class="form-control" name="judul_infografis" id="judul_infografis" rows="3" required></textarea>
  </div>

  <div class="form-group text-left">
  <label class="bmd-label-floating">Tanggal</label>
    <input class="form-control datepicker" name="tanggal_infografis" id="tanggal_infografis"  autocomplete="off" required/>
  </div>



  <div class="form-group text-left">
  <label class="bmd-label-floating">File </label> 
 <input type="file"class="form-control"  name="infografis_file" id="infografis_file"/>
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
                                <h3 class="card-title">LIST COVID-19</h3>
                            </div>
                        </div>
                    <div class="card-body" id="list_infografis">
                    
                                
                    </div>                
                     </div>
                    </div>
    </div>
  </div>

<script>
        $(document).ready(function(){  
            loadListCovid19()
 });  

 function loadListCovid19(){
        $('#list_infografis').html('')
        $('#list_infografis').load('<?=base_url("admin/C_Admin/loadListCovid19Infografis/")?>', function(){
            $('#loader').hide()
        })
    }


     $('#form_infografis').on('submit', function(e){  
        $('#btn_upload').prop('disabled', true);
          $('#btn_upload').html('SIMPAN.. <i class="fas fa-spinner fa-spin"></i>')
          e.preventDefault();  
          if($('#infografis_file').val() == '')  
          {  
               alert("Please Select the File");  
          }  
          else  
          {  
               $.ajax({  
                   url:"<?=base_url("admin/C_Admin/submitKontenCovid19Infografis")?>",  
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
                           document.getElementById("form_infografis").reset();  
                           $('#btn_upload').prop('disabled', false);
                           $('#btn_upload').html('<i class="fa fa-save"></i>  SIMPAN')
                           loadListCovid19()                          
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



</script>