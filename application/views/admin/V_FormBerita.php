<!-- form input -->
<script src="//cdn.ckeditor.com/4.19.0/standard/ckeditor.js"></script>
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
    </style>
<div class="card card-default">
<div class="card-header">
            <div class="row">
                <div class="col-12">
                    <h3 class="card-title">FORM INPUT BERITA</h3>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form id="form_berita">
                <div class="row">
                    <div class="col-lg-12 col-md-3">
                        <div class="form-group">
                        <form method="post" id="form_berita" align="center" enctype="multipart/form-data">  
                    <div class="row" >
                    <div class="col-lg-6 col-md-3">
                        <div class="form-group">
                            <label class="bmd-label-floating">Judul (Indonesia)</label>
                            <textarea class="form-control" name="berita_judul_ina" id="berita_judul_ina" rows="3"></textarea>
                            <!-- <input required class="form-control" autocomplete="off" name="berita_judul" id="berita_judul"/> -->
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-3">
                        <div class="form-group">
                            <label class="bmd-label-floating">Judul (English)</label>
                            <textarea class="form-control" name="berita_judul_eng" id="berita_judul_eng" rows="3"></textarea>
                            <!-- <input required class="form-control" autocomplete="off" name="" id=""/> -->
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-3">
                        <div class="form-group">
                            <label class="bmd-label-floating">Tanggal Berita</label>
                            <input  class="form-control datetimepickerthis"  name="tanggal_berita" id="tanggal_berita" autocomplete="off"/>
                        </div>
                    </div>
                  
                    <div class="col-lg-6 col-md-3">
                        <div class="form-group">
                            <label class="bmd-label-floating">Gambar</label>
                            <input type="file"  class="form-control"  name="berita_gambar" id="berita_gambar"/>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-3">
                        <div class="form-group text-left">
                            <label class="bmd-label-floating">Isi Berita</label>
                            <textarea type="file" rows="10"  class="form-control ckeditor"  autocomplete="off" name="isi_berita" id="isi_berita"></textarea>
                        </div>
                    </div>
                    <style>
                        
                        /* body{
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
} */
                    </style>
                  
                  
                    <div class="col-lg-12 col-md-8"></div>
                    <div class="col-lg-12 col-md-4 text-right mt-2">
                    <input type="submit" name="upload" id="upload" value="Simpan" class="btn btn-block btn-info" />
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
                    <h3 class="card-title">LIST BERITA</h3>
                </div>
            </div>
        </div>
        <div class="card-body" id="list_berita">
           
                    
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
        $('#list_berita').html('')
        // $('#list_berita').append(divLoaderNavy)
        $('#list_berita').load('<?=base_url("admin/C_Admin/loadListBerita/")?>', function(){
            $('#loader').hide()
        })
    }

 $('#form_berita').on('submit', function(e){  
           e.preventDefault();  
           if($('#berita_gambar').val() == '')  
           {  
                alert("Please Select the File");  
           }  
           else  
           {  
                $.ajax({  
                    url:"<?=base_url("admin/C_Admin/submitKontenBerita")?>",  
                     //base_url() = http://localhost/tutorial/codeigniter  
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
                            document.getElementById("form_berita").reset();  
                            loadListBerita()                          
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
        autoclose: true
    })

    
  $('.datetimepickerthis').datetimepicker({
    format: 'yyyy-mm-dd hh:ii:ss',
    autoclose: true,
    todayHighlight: true,
    todayBtn: true
  })


 </script> 