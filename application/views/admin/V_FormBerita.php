<form method="post" id="form_berita" align="center" enctype="multipart/form-data">  
<div class="row">
                    <div class="col-lg-4 col-md-3">
                        <div class="form-group">
                            <label class="bmd-label-floating">Judul (Indonesia)</label>
                            <textarea class="form-control" name="berita_judul_ina" id="berita_judul_ina" rows="3"></textarea>
                            <!-- <input required class="form-control" autocomplete="off" name="berita_judul" id="berita_judul"/> -->
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-3">
                        <div class="form-group">
                            <label class="bmd-label-floating">Judul (English)</label>
                            <textarea class="form-control" name="berita_judul_eng" id="berita_judul_eng" rows="3"></textarea>
                            <!-- <input required class="form-control" autocomplete="off" name="" id=""/> -->
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-3">
                        <div class="form-group">
                            <label class="bmd-label-floating">Tanggal Berita</label>
                            <input  class="form-control datepicker"  name="" id=""/>
                        </div>
                    </div>
                  
                    <div class="col-lg-6 col-md-3">
                        <div class="form-group">
                            <label class="bmd-label-floating">Dokumen</label>
                            <input type="file"  class="form-control"  name="berita_dokumen" id="berita_dokumen"/>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-3">
                        <div class="form-group">
                            <label class="bmd-label-floating">Thumbnails</label>
                            <input type="file"  class="form-control" autocomplete="off" name="thumbnail_berita" id="thumbnail_berita"/>
                        </div>
                    </div>
                
                    
                  
                    <div class="col-lg-8 col-md-8"></div>
                    <div class="col-lg-4 col-md-4 text-right mt-2">
                    <input type="submit" name="upload" id="upload" value="Simpan" class="btn btn-info" />
                    </div>
                </div>
                <!-- <input type="submit" name="upload" id="upload" value="Upload" class="btn btn-info" />   -->
           </form>  
           
<script>  
    $(document).ready(function(){  
      $('#form_berita').on('submit', function(e){  
           e.preventDefault();  
           if($('#image_file').val() == '')  
           {  
                alert("Please Select the File");  
           }  
           else  
           {  
                $.ajax({  
                    url:"<?=base_url("admin/C_Admin/ajax_upload")?>",  
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
                            
                        } else {
                            errortoast(result.msg)
                            return false;
                        }
                     }  
                });  
           }  
      });  
 });  
 </script> 