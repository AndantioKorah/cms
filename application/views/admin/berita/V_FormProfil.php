<!-- form input -->
<div class="card card-default">
<div class="card-header">
            <div class="row">
                <div class="col-12">
                    <h3 class="card-title">FORM PROFIL</h3>
                </div>
            </div>
        </div>
        <div class="card-body">
       
            <form id="form_profil">
                <div class="row">
                    <div class="col-lg-12 col-md-3">
                        <div class="form-group">
                        <form method="post" id="form_berita" align="center" enctype="multipart/form-data">  
                    <div class="row" >
                    <div class="col-lg-12 col-md-3">
                        <div class="form-group">
                            <label class="bmd-label-floating">Visi</label>
                            <textarea class="form-control" name="profil_visi" id="profil_visi" rows="3"><?php if($profil) echo $profil[0]['visi'];  ?></textarea>
                            <!-- <input required class="form-control" autocomplete="off" name="berita_judul" id="berita_judul"/> -->
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-3">
                        <div class="form-group">
                            <label class="bmd-label-floating">Misi</label>
                            <textarea class="form-control" name="profil_misi" id="profil_misi" rows="8"><?php if($profil) echo $profil[0]['misi']; ?></textarea>
                            <!-- <input required class="form-control" autocomplete="off" name="" id=""/> -->
                        </div>
                    </div>

                    <div class="col-lg-12 col-md-3">
                        <div class="form-group">
                            <label class="bmd-label-floating">Motto</label>
                            <textarea class="form-control" name="profil_motto" id="profil_motto" rows="3"><?php if($profil) echo $profil[0]['motto']; ?></textarea>
                            <!-- <input required class="form-control" autocomplete="off" name="" id=""/> -->
                        </div>
                    </div>

                    <div class="col-lg-12 col-md-3">
                        <div class="form-group">
                            <label class="bmd-label-floating">Tugas dan Pokok dan Fungsi</label>
                            <textarea class="form-control" name="profil_tupoksi" id="profil_tupoksi" rows="10"><?php if($profil) echo $profil[0]['tupoksi']; ?></textarea>
                            <!-- <input required class="form-control" autocomplete="off" name="" id=""/> -->
                        </div>
                    </div>

                 
                  
                    <div class="col-lg-12 col-md-3">
                        <div class="form-group">
                            <label class="bmd-label-floating">Struktur Organisasi <?php echo base_url('/assets/profil/');?><?php if($profil) echo $profil[0]['struktur_organisasi']; ?></label>
                            <input type="file"  class="form-control"  name="profil_struktur_organisasi" id="profil_struktur_organisasi"/>
                            <div id="uploadPreview"></div>
                            <div id="gambar_lama">
                         <img src="<?php echo base_url();?>/assets/profil/<?php if($profil) echo $profil[0]['struktur_organisasi']; ?>?t=<?=time();?>" class="img-fluid" alt="Responsive image">
                        </div>
                        </div>
                    </div>
                 
                  
                    <div class="col-lg-12 col-md-8"></div>
                    <div class="col-lg-12 col-md-4 text-right mt-2">
                    <input type="submit" name="upload" id="upload" value="Simpan" class="btn btn-block btn-info" />
                    </div>
                </div>
                <!-- <input type="submit" name="upload" id="upload" value="Upload" class="btn btn-info" />   -->
             
          
                        </div>
                    </div>                
                </div>
            </form>
        </div>
    </div>
    <!-- form input -->



<script>
    $('#form_profil').on('submit', function(e){  
           e.preventDefault();  
                $.ajax({  
                    url:"<?=base_url("admin/C_Admin/submitKontenProfil")?>",  
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
                            // document.getElementById("form_berita").reset();  
                            // loadListBerita()                          
                        } else {
                            errortoast(result.msg)
                            return false;
                        }
                     }  
                });  
            
      });


      function readImage(file) {
        $('#uploadPreview').html('');
        $('#gambar_lama').html('');
        var reader = new FileReader();
        var image  = new Image();
        reader.readAsDataURL(file);  
        reader.onload = function(_file) {
        image.src = _file.target.result; // url.createObjectURL(file);
        image.onload = function() {
            console.log('ukuran');
            console.log(this.width + 'x' + this.height);
        var w = this.width,
        h = this.width,
        t = file.type, // ext only: // file.type.split('/')[1],
        n = file.name,
        s = ~~(file.size/1024) +'KB';
        // $('#uploadPreview').append('<img class="img-fluid" alt="Responsive image" style="width:1100px;height:500px;" src="' + this.src + '" class="thumb">');
        $('#uploadPreview').append('<img class="img-fluid" alt="Responsive image" src="' + this.src + '" class="thumb">');
        };
        // image.onerror= function() {
        // alert('Invalid file type: '+ file.type);
        // };      
        };
        }
        $("#profil_struktur_organisasi").change(function (e) {
        if(this.disabled) {
        return alert('File upload not supported!');
        }
        var F = this.files;
        if (F && F[0]) {
        for (var i = 0; i < F.length; i++) {
        readImage(F[i]);
        }
        }
        });
</script>