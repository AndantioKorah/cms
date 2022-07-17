<?php if($this->general_library->getRole() == 'programmer') { ?>
    <div class="card card-default">
        <div class="card-header">
            <div class="row">
                <div class="col-12">
                    <h3 class="card-title">TAMBAH KONTEN</h3>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form id="form_tambah_user">
                <div class="row">
                    <div class="col-lg-12 col-md-3">
                        <div class="form-group">
                            <label class="bmd-label-floating">Jenis Konten</label>
                            <select onchange="getval(this)" required class="form-control form-control-sm select2_this select2-navy" data-dropdown-css-class="select2-navy" name="jenis_konten" id="jenis_konten">
                            <option value="">-</option>
                            <option value="1">Profil</option>
                            <option value="2">Berita</option>
                            <option value="3">Galeri</option>
                            <option value="4">PPID</option>
                            <option value="5">Pelayanan</option>
                            <option value="6">Pengumuman</option>
                            <option value="7">Kontak</option>
                            <option value="8">WBS</option>
                            <option value="9">Pojok TTG</option>
                            <option value="10">Covid-19</option>


                            </select>
                        </div>
                    </div>                
                </div>
            </form>
        </div>
        <!-- form  -->
        <div id="" class="card-body" >
        </div>

      
        <!-- form -->

    </div>

    <!-- form berita -->
    
    <div  id="form-container">
       
    </div>
     <!-- form berita -->
    
<?php } ?>

<script>
    function getval(sel){
    if(sel.value == 1){
        // $('#form-profil').show('fast');
        // $('#form-berita').hide('fast');
        $('#form-container').html('')
        $('#form-container').append(divLoaderNavy)
        $('#form-container').load('<?=base_url("admin/C_Admin/loadFormProfil")?>', function(){
            $('#loader').hide()
        })
    }else if(sel.value == 2){
        // $('#form-profil').hide('fast');
        // $('#form-berita').show('fast');
        $('#form-container').html('')
        $('#form-container').append(divLoaderNavy)
        $('#form-container').load('<?=base_url("admin/C_Admin/loadFormBerita")?>', function(){
            $('#loader').hide()
        })
    }
    }
</script>