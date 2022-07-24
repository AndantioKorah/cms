
<div class="card card-default">
<div class="card-header">
            <div class="row">
                <div class="col-12">
                    <h3 class="card-title">FORM INPUT GALERI</h3>
                </div>
            </div>
        </div>
        <div class="card-body">
     



        <form action="<?=base_url("admin/C_Admin/submitKontenGaleri")?>" method="post" id="" align="center" enctype="multipart/form-data">  
                <div class="row">
                    <div class="col-lg-12 col-md-3">
                        <div class="form-group">
                       
                    <div class="row" >
                    <div class="col-lg-12 col-md-3">
                        <div class="form-group text-left">
                            <label class="bmd-label-floating">Judul Gamber</label>
                            <textarea class="form-control" name="judul_gambar" id="judul_gambar" rows="3" required></textarea>
                            <!-- <input required class="form-control" autocomplete="off" name="berita_judul" id="berita_judul"/> -->
                        </div>
                    </div>
                 
                    <div class="col-lg-12 col-md-3">
                        <div class="form-group text-left">
                            <label class="bmd-label-floating">Gambar </label> 
                            <input type="file"     class="form-control"  name="gambar" id="gambar"/>
                            <br>
                         <div id="uploadPreview1"></div>
                        </div>
                    </div>

                  
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
                    <h3 class="card-title">LIST GALERI</h3>
                </div>
            </div>
        </div>
        <div class="card-body" id="list_galeri">
           
                    
                        </div>
                    </div>                
                </div>
            
        </div>
    </div>
    <!-- List Berita -->

    <script>  
    $(document).ready(function(){  
        loadListGaleri()
 });  

 function loadListGaleri(){
        $('#list_galeri').html('')
        // $('#list_berita').append(divLoaderNavy)
        $('#list_galeri').load('<?=base_url("admin/C_Admin/loadListGaleri/")?>', function(){
            $('#loader').hide()
        })
    }

    
    </script> 