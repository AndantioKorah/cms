<!-- form input -->
<!-- <script src="//cdn.ckeditor.com/4.19.0/standard/ckeditor.js"></script> -->


<style>
        body{
	background: #fcfcfc;
}
h1{
	text-align: center;
	font-family: sans-serif;
	font-weight: 300;
	color: #fff;
}
 
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

/*
 * bootstrap-tagsinput v0.8.0
 * 
 */

.bootstrap-tagsinput {
  background-color: #fff;
  border: 1px solid #ccc;
  box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
  /* display: inline-block; */
  padding: 4px 6px;
  color: #555;
  vertical-align: middle;
  border-radius: 4px;
  max-width: 100%;
  line-height: 22px;
  
  cursor: text;
}
.bootstrap-tagsinput input {
  border: none;
  box-shadow: none;
  outline: none;
  background-color: transparent;
  padding: 0 6px;
  margin: 0;
  width: auto;
  max-width: inherit;
  height: 28px;
}
.bootstrap-tagsinput.form-control input::-moz-placeholder {
  color: #777;
  opacity: 1;
}
.bootstrap-tagsinput.form-control input:-ms-input-placeholder {
  color: #777;
}
.bootstrap-tagsinput.form-control input::-webkit-input-placeholder {
  color: #777;
}
.bootstrap-tagsinput input:focus {
  border: none;
  box-shadow: none;
}
.bootstrap-tagsinput .tag {
  margin-right: 2px;
  color: dark;
  background-color: aqua;
  border-radius: inherit
}
.bootstrap-tagsinput .tag [data-role="remove"] {
  margin-left: 8px;
  cursor: pointer;
}
.bootstrap-tagsinput .tag [data-role="remove"]:after {
  content: "x";
  padding: 0px 2px;
}
.bootstrap-tagsinput .tag [data-role="remove"]:hover {
  box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2), 0 1px 2px rgba(0, 0, 0, 0.05);
}
.bootstrap-tagsinput .tag [data-role="remove"]:hover:active {
  box-shadow: inset 0 3px 5px rgba(0, 0, 0, 0.125);
}

</style>
<div class="card card-default">
<div class="card-header">
            <div class="row">
                <div class="col-12">
                    <h3 class="card-title">FORM INPUT AGENDA</h3>
                </div>
            </div>
        </div>
        <div class="card-body">
     



        <form action="<?=base_url("admin/C_Admin/submitKontenAgenda")?>" method="post" id="form_agenda" align="center" enctype="multipart/form-data">  
                <div class="row">
                    <div class="col-lg-12 col-md-3">
                        <div class="form-group">
                       
                    <div class="row" >
                    <div class="col-lg-12 col-md-3">
                        <div class="form-group text-left">
                            <label class="bmd-label-floating">Judul </label>
                            <textarea class="form-control" name="agenda_judul" id="agenda_judul" rows="3" required></textarea>
                            <!-- <input required class="form-control" autocomplete="off" name="berita_judul" id="berita_judul"/> -->
                        </div>
                    </div>
                 

                    <div class="col-lg-12 col-md-3">
                        <div class="form-group text-left">
                            <label class="bmd-label-floating">Tanggal</label>
                            <input  class="form-control datetimepickerthis"  name="agenda_tanggal" id="agenda_tanggal" autocomplete="off" required/>
                        </div>
                    </div>

    
     
                     
                    <div class="col-lg-12 col-md-3">
                        <div class="form-group text-left">
                            <label class="bmd-label-floating">Gambar  <a onclick="resetUploadPreview()" href="#"><i class="fa fa-undo" aria-hidden="true"></i></a> </label> 
                            <input type="file"     class="form-control"  name="agenda_gambar[]" id="agenda_gambar" multiple="multiple"/>
                            <br>
                         <div id="uploadPreview1"></div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-3">
                        <div class="form-group">
                           
                            <br>
                         <div id="uploadPreview1"></div>
                        </div>
                    </div>
                   
        
                    <div class="col-lg-12 col-md-3">
                        <div class="form-group text-left">
                            <label class="bmd-label-floating">Isi</label>
                            <textarea  onkeyup="sendCode()" type="file" rows="10"  class="form-control "  autocomplete="off" name="isi_agenda" id="editor" ></textarea>
                        </div>
                    </div>
               
                  
                    <div class="col-lg-12 col-md-8"></div>
                    <div class="col-lg-12 col-md-4 text-right mt-2">
                    <button type="submit" class="btn btn-block btn-navy " id="btn_upload"><i class="fa fa-save"></i> SIMPAN</button>
                    </div>
                </div>
                <!-- <input type="submit" name="upload" id="upload" value="Upload" class="btn btn-info" />   -->
           </form>  
                    
                        </div>
                    </div>                
                </div>
            </form>
        </div>
    </div>
    <!-- form input -->


    <!-- List Berita -->
    <div class="card card-default">
<div class="card-header">
            <div class="row">
                <div class="col-12">
                    <h3 class="card-title">LIST AGENDA</h3>
                </div>
            </div>
        </div>
        <div class="card-body" id="list_pojokttg">
           
                    
                        </div>
                    </div>                
                </div>
            
        </div>
    </div>
    <!-- List Berita -->



<script src="<?=base_url('assets/js/bootstrap-datetimepicker.js')?>"></script>
<script src="<?=base_url('assets/js/bootstrap-datepicker.js')?>"></script>
<script>  
    $(document).ready(function(){  
        loadListBerita()
 });  

 function loadListBerita(){
        $('#list_pojokttg').html('')
        // $('#list_berita').append(divLoaderNavy)
        $('#list_pojokttg').load('<?=base_url("admin/C_Admin/loadListAgenda/")?>', function(){
            $('#loader').hide()
        })
    }

    function resetUploadPreview(){
        $('#uploadPreview1').html('');
         $('#agenda_gambar').val('');
    }

  
        $( "#btn_upload" ).click(function() {

           if($('#agenda_judul').val() == '')  
           {  
            errortoast(" Judul masih kosong"); 
                return false;
           }
    
           if($('#agenda_tanggal').val() == '')  
           {  
                errortoast("Tanggal berita masih kosong");  
                return false;
           }
           if($('#agenda_gambar').val() == '')  
           {  
                errortoast("Please Select the File"); 
                return false;
           } 

           
            $('#btn_upload').prop('disabled', true);
            $('#btn_upload').html('SIMPAN.. <i class="fas fa-spinner fa-spin"></i>')
            document.getElementById("form_agenda").submit();
        });


 

 $('.datepicker').datepicker({
        todayHighlight: true,
        todayBtn: "linked",
        keyboardNavigation:true,
        autoclose: true
    })

    
  $('.datetimepickerthis').datetimepicker({
    format: 'yyyy-mm-dd hh:ii:ss',
    autoclose: true,
    todayHighlight: true,
    todayBtn: true
  })

  function readImage2(file) {
        // $('#uploadPreview1').html('');
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
        $('#uploadPreview1').append('<img src="' + this.src + '" class="thumb">');
        };
        // image.onerror= function() {
        // alert('Invalid file type: '+ file.type);
        // };      
        };
        }
        $("#agenda_gambar").change(function (e) {
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


        ClassicEditor
		.create( document.querySelector( '#editor' ), {
			// toolbar: [ 'heading', '|','bold', 'italic', '|', 'undo', 'redo', '-', 'numberedList', 'bulletedList' ]
		} )
		.then( editor => {
			window.editor = editor;
		} )
		.catch( err => {
			console.error( err.stack );
		} );

    
       
 </script> 
 <!-- toolbar: {
    items: [
        'heading', '|',
        'fontfamily', 'fontsize', '|',
        'alignment', '|',
        'fontColor', 'fontBackgroundColor', '|',
        'bold', 'italic', 'strikethrough', 'underline', 'subscript', 'superscript', '|',
        'link', '|',
        'outdent', 'indent', '|',
        'bulletedList', 'numberedList', 'todoList', '|',
        'code', 'codeBlock', '|',
        'insertTable', '|',
        'uploadImage', 'blockQuote', '|',
        'undo', 'redo'
    ],
    shouldNotGroupWhenFull: true
} -->