

<div class="card card-default">
<div class="card-header">
            <div class="row">
                <div class="col-12">
                    <h3 class="card-title">FORM INPUT GALERI</h3>
                </div>
            </div>
        </div>
        <div class="card-body">

<ul class="nav nav-tabs ">
  <li class="nav-item">
    <a data-toggle="tab" class="nav-link active" href="#home">Gambar</a>
  </li>
  <li class="nav-item">
    <a data-toggle="tab" class="nav-link" href="#menu1">Video</a>
  </li>


</ul>

  <div class="tab-content">
    <div id="home" class="tab-pane active">
    <form action="#" method="post" id="form_galeri" align="center" enctype="multipart/form-data">  
  <div class="form-group text-left">
  <label class="bmd-label-floating">Judul Gambar</label>
    <textarea class="form-control" name="judul_gambar" id="judul_gambar" rows="3" required></textarea>
  </div>
  <div class="form-group text-left">
  <label class="bmd-label-floating">Gambar </label> 
 <input type="file"class="form-control"  name="gambar" id="gambar"/>
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
                                <h3 class="card-title">LIST GAMBAR</h3>
                            </div>
                        </div>
                    <div class="card-body" id="list_galeri">
                    
                                
                    </div>                
                     </div>
                    </div>
    </div>
    <div id="menu1" class="tab-pane fade">
    <form action="#" method="post" id="form_galeri_video" align="center" enctype="multipart/form-data">  
  <div class="form-group text-left">
  <label class="bmd-label-floating">Judul Video</label>
    <textarea class="form-control" name="judul_video" id="judul_video" rows="3" required></textarea>
  </div>
  <div class="form-group text-left">
  <label class="bmd-label-floating">Link Video </label> 
    <input class="form-control"  name="link_video" id="link_video" autocomplete="off"/> 
  </div>

  <div class="col-lg-12 col-md-4 text-right mt-2">
    <button class="btn btn-block btn-navy" id="btn_upload"><i class="fa fa-save"></i> SIMPAN</button>
    </div>
</form>
<div class="card card-default" style="margin-top:20px;">
            <div class="card-header">
                        <div class="row">
                            <div class="col-12">
                                <h3 class="card-title">LIST VIDEO</h3>
                            </div>
                        </div>
                    <div class="card-body" id="list_galeri_video">
                    
                                
                    </div>                
                     </div>
                    </div>
    </div>
  </div>




    <script>  
    $(document).ready(function(){  
        loadListGaleri()
        loadListGaleriVideo()
 });  


 $('#form_galeri').on('submit', function(e){  
        $('#btn_upload').prop('disabled', true);
          $('#btn_upload').html('SIMPAN.. <i class="fas fa-spinner fa-spin"></i>')
          e.preventDefault();  
          if($('#gambar').val() == '')  
          {  
               alert("Please Select the File");  
          }  
          else  
          {  
               $.ajax({  
                   url:"<?=base_url("admin/C_Admin/submitKontenGaleri")?>",  
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
                           document.getElementById("form_galeri").reset();  
                           $('#btn_upload').html('<i class="fa fa-save"></i>  SIMPAN')
                           loadListGaleri()                          
                       } else {
                           errortoast(result.msg)
                           return false;
                       }
                    }  
               });  
          }  
     });

     $('#form_galeri_video').on('submit', function(e){  
          $('input[type="submit"]').attr('disabled','disabled');
          $('#btn_upload').html('SIMPAN.. <i class="fas fa-spinner fa-spin"></i>')
          e.preventDefault();    
               $.ajax({  
                   url:"<?=base_url("admin/C_Admin/submitKontenGaleriVideo")?>",  
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
                           document.getElementById("form_galeri").reset();  
                           $('#btn_upload').html('<i class="fa fa-save"></i>  SIMPAN')
                           loadListGaleriVideo()                          
                       } else {
                           errortoast(result.msg)
                           return false;
                       }
                    }  
               });  
            
     });

 function loadListGaleri(){
        $('#list_galeri').html('')
        // $('#list_berita').append(divLoaderNavy)
        $('#list_galeri').load('<?=base_url("admin/C_Admin/loadListGaleri/")?>', function(){
            $('#loader').hide()
        })
    }

    function loadListGaleriVideo(){
        $('#list_galeri_video').html('')
        // $('#list_berita').append(divLoaderNavy)
        $('#list_galeri_video').load('<?=base_url("admin/C_Admin/loadListGaleriVideo/")?>', function(){
            $('#loader').hide()
        })
    }

    
    </script> 