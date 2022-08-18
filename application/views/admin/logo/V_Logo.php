

<div class="card card-default">
<div class="card-header">
            <div class="row">
                <div class="col-12">
                    <h3 class="card-title">FORM INPUT LOGO</h3>
                </div>
            </div>
        </div>
        <div class="card-body">
    <form action="#" method="post" id="form_logo" align="center" enctype="multipart/form-data">  
  <div class="form-group text-left">
  <label class="bmd-label-floating">Nama Aplikasi</label>
    <input class="form-control" name="nama_aplikasi" id="nama_aplikasi"  required></input>
  </div>


  <div class="form-group text-left">
  <label class="bmd-label-floating">File </label> 
 <input type="file"class="form-control"  name="logo_file" id="logo_file" required/>
        <br>
    <div id="uploadPreview1"></div>
  </div>

  <div class="form-group text-left">
  <label class="bmd-label-floating">URL </label> 
 <input type="text "class="form-control"  name="url_aplikasi" id="url_aplikasi" required/>
    
  </div>




  <div class="col-lg-12 col-md-4 text-right mt-2">
        <button class="btn btn-block btn-navy" id="btn_upload"><i class="fa fa-save"></i> SIMPAN</button>
        </div>
</form>
<div class="card card-default" style="margin-top:20px;">
            <div class="card-header">
                        <div class="row">
                            <div class="col-12">
                                <h3 class="card-title">LIST lOGO</h3>
                            </div>
                        </div>
                    <div class="card-body" id="list_logo">
                    
                                
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
        $('#list_logo').html('')
        $('#list_logo').load('<?=base_url("admin/C_Admin/loadListLogo/")?>', function(){
            $('#loader').hide()
        })
    }


     $('#form_logo').on('submit', function(e){  
       
        $('#btn_upload').prop('disabled', true);
          $('#btn_upload').html('SIMPAN.. <i class="fas fa-spinner fa-spin"></i>')
          e.preventDefault();  
          if($('#logo_file').val() == '')  
          {  
               alert("Please Select the File");  
          }  
          else  
          {  
               $.ajax({  
                   url:"<?=base_url("admin/C_Admin/submitLogo")?>",  
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
                           document.getElementById("form_logo").reset();  
                           $('#btn_upload').prop('disabled', false);
                           $('#btn_upload').html('<i class="fa fa-save"></i>  SIMPAN')
                           loadListCovid19()                          
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