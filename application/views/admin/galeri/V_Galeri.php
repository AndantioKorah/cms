
<style>

 
.tombol{
	padding: 8px 15px;
	border-radius: 3px;
	background: #ECF0F1;
	border: none;
	color: #232323;
	font-size: 12pt;
}
 
.kotak{
	margin: 20px auto;
	background: #1ABC9C;
	width: 900px;	
	padding: 20px 50px 50px 50px;
	border-radius: 3px;
}

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


  #img_preview_modal{
    width: 100%;
    max-height: 600px;
  }

  #img_name{
    font-size: 30px;
    color: white;
  }
</style>
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
    <a id="video" data-toggle="tab" class="nav-link" href="#menu1">Video</a>
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
  <label class="bmd-label-floating">Tanggal</label>
    <input class="form-control datetimepickerthis" name="tanggal_gambar" id="tanggal_gambar"  autocomplete="off" required/>
  </div>
  
  <div class="form-group text-left">
  <label class="bmd-label-floating">Gambar </label> 
 <input type="file"class="form-control"  name="gambar" id="gambar"/>
        <br>
    <div id="uploadPreview2"></div>
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
  <label class="bmd-label-floating">Tanggal</label>
    <input class="form-control datetimepickerthis" name="tanggal_video" id="tanggal_video" autocomplete="off" required/>
  </div>
  

  <div class="form-group text-left">
  <label class="bmd-label-floating">Link Video </label> 
    <input class="form-control"  name="link_video" id="link_video" autocomplete="off" required/> 
  </div>

  <div class="col-lg-12 col-md-4 text-right mt-2">
    <button class="btn btn-block btn-navy" id="btn_upload_video"><i class="fa fa-save"></i> SIMPAN</button>
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


  <div class="modal fade" id="modal_image_preview" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div style="float: right; text-align: right; color: white; cursor: pointer;">
      <i class="fa fa-2x fa-times"></i>
    </div>
    <center>
     
      <img id="img_preview_modal"/>
      <span id="img_name"></span>
    </center>
  </div>
</div>


    <script>  
    $(document).ready(function(){  
        loadListGaleri()
       
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
                           $('#uploadPreview2').html('');
                           $('#btn_upload').prop('disabled', false);
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
      $('#btn_upload_video').prop('disabled', true);
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
                           document.getElementById("form_galeri_video").reset();  
                           $('#btn_upload_video').prop('disabled', false);
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
        $('#list_berita').append(divLoaderNavy)
        $('#list_galeri').load('<?=base_url("admin/C_Admin/loadListGaleri/")?>', function(){
            $('#loader').hide()
        })
    }

    function loadListGaleriVideo(){
        $('#list_galeri_video').html('')
        $('#list_berita').append(divLoaderNavy)
        $('#list_galeri_video').load('<?=base_url("admin/C_Admin/loadListGaleriVideo/")?>', function(){
            $('#loader').hide()
        })
    }


    function readImage2(file) {
        $('#uploadPreview2').html('');
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
        $('#uploadPreview2').append('<img src="' + this.src + '" class="thumb">');
        };
        // image.onerror= function() {
        // alert('Invalid file type: '+ file.type);
        // };      
        };
        }
        $("#gambar").change(function (e) {
        if(this.disabled) {
        return alert('File upload not supported!');
        }
        var F = this.files;
        if (F && F[0]) {
        for (var i = 0; i < F.length; i++) {
        readImage2(F[i]);
        }
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


  $('#video').click(function(e) {  
    loadListGaleriVideo()
});


    </script> 