<?php if($this->general_library->getRole() == 'programmer') { ?>
    <div class="card card-default">
        <div class="card-header">
            <div class="row">
                <div class="col-6">
                    <h3 class="card-title">TAMBAH USER</h3>
                </div>
                <div class="col-6 text-right">
                    <button class="btn btn-sm btn-navy" onclick="loadDataPegawaiFromNewDb()" data-toggle="modal" data-target="#modal_import_pegawai">
                        <i class="fa fa-file-import"></i> Import Pegawai dari Database Baru
                    </button>
                    <button class="btn btn-sm btn-navy" data-toggle="modal" data-target="#modal_import_user"><i class="fa fa-file-import"></i> Import dari Data Pegawai</button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form id="form_tambah_user">
                <div class="row">
                    <div class="col-lg-3 col-md-3">
                        <div class="form-group">
                            <label class="bmd-label-floating">Nama</label>
                            <input required class="form-control" autocomplete="off" name="nama" id="nama"/>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-2">
                        <div class="form-group">
                            <label class="bmd-label-floating">Nomor HP</label>
                            <input required class="form-control" autocomplete="off" name="no_hp" id="no_hp"/>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3">
                        <div class="form-group">
                            <label class="bmd-label-floating">Username</label>
                            <input required class="form-control" autocomplete="off" name="username" id="username"/>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-2">
                        <div class="form-group">
                            <label class="bmd-label-floating">Password</label>
                            <input required class="form-control" autocomplete="off" type="password" name="password" id="password"/>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-2">
                        <div class="form-group">
                            <label class="bmd-label-floating">Konfirmasi Password</label>
                            <input required class="form-control" autocomplete="off" type="password" name="konfirmasi_password" id="konfirmasi_password"/>
                        </div>
                    </div>
                        <div class="col-lg-8 col-md-8"></div>
                    <div class="col-lg-4 col-md-4 text-right mt-2">
                        <button class="btn btn-sm btn-navy" type="submit"><i class="fa fa-save"></i> SIMPAN</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
<?php } ?>
<style>
     
</style>
<div class="card card-default">
    <div class="card-header">
        <?php if($this->general_library->getRole() == 'programmer') { ?>
            <h3 class="card-title mb-2"><strong>PILIH SKPD</strong></h3>
            <select class="form-control select2-navy" style="width: 100%;"
                id="select_search_skpd" data-dropdown-css-class="select2-navy" name="select_search_skpd">
                <?php if($list_skpd){
                    foreach($list_skpd as $ls){
                    ?>
                    <option value="<?=$ls['id_unitkerja']?>">
                        <?=$ls['nm_unitkerja']?>
                    </option>
                <?php } } ?>
            </select>
        <?php } else { ?>
            <h3 class="card-title mb-2"><strong>LIST PEGAWAI</strong></h3>
        <?php } ?>
    </div>
    <div class="card-body">
        <div id="list_users" class="row table-responsive">
        </div>
    </div>
</div>
<div class="modal fade" id="modal_import_user" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div id="modal-dialog" class="modal-dialog modal-xl">
		<div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Pilih User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                    <div class="col-12">
                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                            <a data-toggle="tab" class="nav-link active" href="#pegawai_tab"><span class="text_tab">Pegawai</span></a>
                            </li>
                            <li class="nav-item">
                                <a data-toggle="tab" onclick="searchBySkpd()" class="nav-link" href="#skpd_tab"><span class="text_tab">SKPD</span></a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div id="pegawai_tab" class="tab-pane active">
                                <form id="form_search_pegawai_new_user">
                                    <div class="row">
                                        <div class="col-9">
                                            <label>NIP / Nama Pegawai:</label>
                                            <input class="form-control" autocomplete="off" name="search_value" />
                                        </div>
                                        <div class="col-3 text-right">
                                            <label style="color: white;">ts</label>
                                            <button type="submit" class="btn btn-block btn-navy"><i class="fa fa-search"></i> Cari</button>
                                        </div>
                                        <div class="col-12 mt-3" id="result_search_pegawai" style="display: none;"></div>
                                    </div>
                                </form>
                            </div>
                            <div id="skpd_tab" class="tab-pane">
                                <label>Pilih SKPD</label>
                                <select class="form-control select2-navy" style="width: 100%"
                                id="id_skpd" data-dropdown-css-class="select2-navy" name="id_skpd">
                                    <?php if($list_skpd){
                                        foreach($list_skpd as $ls){
                                        ?>
                                        <option value="<?=$ls['id_unitkerja']?>">
                                            <?=$ls['nm_unitkerja']?>
                                        </option>
                                    <?php } } ?>
                                </select>
                                <div class="row">
                                    <div class="col-12">
                                        <h5>LIST PEGAWAI</h5>
                                        <hr>
                                    </div>
                                    <div class="col-12" id="div_create_list_pegawai" style="max-height: 600px; overflow: auto !important;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
		</div>
	</div>
</div>
<div class="modal fade" id="modal_import_pegawai" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div id="modal-dialog" class="modal-dialog modal-xl">
		<div class="modal-content" id="content_modal_import_pegawai">
		</div>
	</div>
</div>
<div class="modal fade" id="modal_auth" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div id="modal-dialog" class="modal-dialog modal-sm">
		<div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Need Password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="need_password_form">
                    <div class="row">
                        <div class="col-12">
                            <label>Password:</label>
                            <input class="form-control form-control-sm" autocomplete="off" name="password" type="password" />
                        </div>
                        <div class="col-12 text-right mt-3">
                            <button type="submit" class="btn btn-sm btn-navy">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
		</div>
	</div>
</div>
<script>
    $(function(){
        $('#id_skpd').select2()
        $('#select_search_skpd').select2()
        // searchBySkpd()
        loadUsers()
    })

    function loadUsers(){
        let parameter = '<?=$pegawai['skpd']?>'
        <?php if($this->general_library->getRole() == 'programmer') { ?>
            parameter = $('#select_search_skpd').val()
        <?php } ?>
        $('#list_users').html('')
        $('#list_users').append(divLoaderNavy)
        $('#list_users').load('<?=base_url("user/C_User/loadUsers")?>'+'/'+parameter, function(){
            $('#loader').hide()
        })
    }

    function loadDataPegawaiFromNewDb(){
        $('#content_modal_import_pegawai').html('')
        $('#content_modal_import_pegawai').append(divLoaderNavy)
        $('#content_modal_import_pegawai').load('<?=base_url("user/C_User/loadDataPegawaiFromNewDb")?>', function(){
            $('#loader').hide()
        })
    }

    function searchBySkpd(){
        $('#div_create_list_pegawai').html('')
        $('#div_create_list_pegawai').append(divLoaderNavy)
        $('#div_create_list_pegawai').load('<?=base_url("user/C_User/loadPegawaiBySkpd")?>'+'/'+$('#id_skpd').val(), function(){
            $('#loader').hide()
        })
    }

    $('#select_search_skpd').on('change', function(){
        loadUsers()
    })

    $('#id_skpd').on('change', function(){
        searchBySkpd()
    })

    $('#need_password_form').on('submit', function(e){
        e.preventDefault()
        $.ajax({
            url: '<?=base_url("user/C_User/needPassword")?>',
            method: 'post',
            data: $(this).serialize(),
            success: function(data){
                let resp = JSON.parse(data)
                if(resp['message'] == 'true'){
                    createUser()
                } else {
                    errortoast('Mo ba apa so?')
                }
            }, error: function(e){
                errortoast('Terjadi Kesalahan')
            }
        })
    })

    $('#form_search_pegawai_new_user').on('submit', function(e){
        e.preventDefault()
        $('#result_search_pegawai').show()
        $('#result_search_pegawai').html('')
        $('#result_search_pegawai').append(divLoaderNavy)
        $.ajax({
            url: '<?=base_url("user/C_User/importPegawaiNewUser")?>',
            method: 'post',
            data: $(this).serialize(),
            success: function(data){
                $('#result_search_pegawai').html('')
                $('#result_search_pegawai').append(data)
            }, error: function(e){
                errortoast('Terjadi Kesalahan')
            }
        })
    })

    // $('#form_tambah_user').on('submit', function(e){
    //     e.preventDefault();
    //     let role = $('#id_m_role').val().split(';')
    //     if(role[1] == 'programmer'){
    //         $('#modal_auth').modal()
    //     } else {
    //         createUser()
    //     }
    // })

    $('#form_tambah_user').on('submit', function(e){
        e.preventDefault();
        $.ajax({
            url: '<?=base_url("user/C_User/createUser")?>',
            method: 'post',
            data: $('#form_tambah_user').serialize(),
            success: function(data){
                let resp = JSON.parse(data)
                if(resp['message'] == '0'){
                    loadUsers()
                    $('#nama').val('')
                    $('#username').val('')
                    $('#password').val('')
                    $('#no_hp').val('')
                    $('#konfirmasi_password').val('')
                } else {
                    errortoast(resp['message'])
                }
            }, error: function(e){
                errortoast('Terjadi Kesalahan')
            }
        })
    })
</script>