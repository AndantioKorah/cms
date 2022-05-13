<?php
    if($user){
?>
    <div class="row p-2">
        <div class="col-12">
            <h5><strong><?=$user['username'].' ('.getNamaPegawaiFull($user).')'?></strong></h5>
        </div>
        <div class="col-12">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#role_tab" data-toggle="tab">Role</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" onclick="refreshSubBidang()" href="#bidang_tab" data-toggle="tab">Sub Bidang</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#password_tab" data-toggle="tab">Password</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" onclick="refreshListVerifBidang()" href="#verif_tab" data-toggle="tab">Verifikasi</a>
                </li>
            </ul>
        </div>
        <div class="tab-content col-12" id="myTabContent">
            <div class="tab-pane show active" id="role_tab">
                <div class="row">
                    <div class="col-12">
                        <form id="form_tambah_role">
                            <label>Pilih Role:</label>
                            <select class="form-control form-control-sm select2_this select2-navy" data-dropdown-css-class="select2-navy" name="id_m_role" id="id_m_role">
                                <option value="0" disabled selected>Pilih Item</option>
                                <?php if($roles){ foreach($roles as $r){ ?>
                                    <option value="<?=$r['id']?>"><?=$r['nama'].' ('.$r['role_name'].')'?></option>
                                <?php } } ?>
                            </select>
                            <input style="display: none;" class="form-control form-control-sm" name="id_m_user" value="<?=$user['id_m_user']?>"/>
                            <button class="btn btn-sm btn-navy float-right mt-3"><i class="fa fa-save"></i> Simpan</button>
                        </form>
                    </div>
                    <div class="col-12"><hr></div>
                    <div class="col-12">
                        <label>Role:</label>
                        <div id="list_role"></div>
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="bidang_tab">
                <div class="row">
                    <div class="col-12">
                        <form id="form_tambah_sub_bidang">
                            <label>Pilih Sub Bidang:</label>
                            <select style="width: 100%;" class="form-control form-control-sm select2_this select2-navy" data-dropdown-css-class="select2-navy" name="id_m_sub_bidang">
                                <option value="0" disabled selected>Pilih Item</option>
                                <?php if($sub_bidang){ foreach($sub_bidang as $b){ ?>
                                    <option value="<?=$b['id']?>"><?=$b['nama_sub_bidang']?></option>
                                <?php } } ?>
                            </select>
                            <input style="display: none;" class="form-control form-control-sm" name="id_m_user" value="<?=$user['id_m_user']?>"/>
                            <button class="btn btn-sm btn-navy float-right mt-3"><i class="fa fa-save"></i> Simpan</button>
                        </form>
                    </div>
                    <div class="col-12"><hr></div>
                    <div class="col-12">
                        <div id="div_bidang"></div>
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="password_tab">
                <div class="row">
                    <div class="col-12">
                        <form id="form_ganti_password">
                            <div class="row">
                                <div class="col-6">
                                    <label>Password Baru:</label>
                                    <input class="form-control password_input" name="new_password" type="password" />
                                </div>
                                <div class="col-6">
                                    <label>Konfirmasi Password Baru:</label>
                                    <input class="form-control password_input" name="confirm_new_password" type="password" />
                                </div>
                                <div class="col-9"></div>
                                <div class="col-3 text-right">
                                    <input style="display: none;" class="form-control form-control-sm" name="id_m_user" value="<?=$user['id_m_user']?>"/>
                                    <button class="btn btn-sm btn-navy float-right mt-3"><i class="fa fa-save"></i> Simpan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-12">
                        <hr>
                    </div>
                    <div class="col-12">
                        <div class="row">
                            <div class="col-3"></div>
                            <div class="col-6">
                                <button onclick="resetPassword()" class="btn btn-block btn-navy"><i class="fa fa-key"></i> Reset Default Password</button>
                            </div>
                            <div class="col-3"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="verif_tab">
                <div class="row">
                    <div class="col-12">
                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <a class="nav-link active" onclick="refreshListVerifBidang()" aria-current="page" href="#verif_bidang_tab" data-toggle="tab">Per Sub Bidang</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" onclick="refreshListVerifPegawai()" href="#verif_pegawai_tab" data-toggle="tab">Per Pegawai</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-12">
                        <div class="tab-content col-12" id="myTabContent">
                            <div class="tab-pane show active" id="verif_bidang_tab">
                                <div class="row">
                                    <div class="col-12">
                                        <form id="form_tambah_verif_bidang">
                                            <label>Pilih Bidang:</label>
                                            <select style="width: 100%;" class="form-control form-control-sm select2_this select2-navy" data-dropdown-css-class="select2-navy" name="id_m_sub_bidang" id="id_m_sub_bidang">
                                                <option value="0" disabled selected>Pilih Sub Bidang</option>
                                                <?php if($sub_bidang){ foreach($sub_bidang as $sb){ ?>
                                                    <option value="<?=$sb['id']?>"><?=$sb['nama_sub_bidang']?></option>
                                                <?php } } ?>
                                            </select>
                                            <input style="display: none;" class="form-control form-control-sm" name="id_m_user" value="<?=$user['id_m_user']?>"/>
                                            <button class="btn btn-sm btn-navy float-right mt-3"><i class="fa fa-save"></i> Simpan</button>
                                        </form>
                                    </div>
                                    <div class="col-12" id="list_verif_bidang"></div>
                                </div>
                            </div>
                            <div class="tab-pane" id="verif_pegawai_tab">
                                <div class="row">
                                    <div class="col-12">
                                        <form id="form_tambah_verif_pegawai">
                                            <label>Pilih Pegawai:</label>
                                            <select style="width: 100%;" class="form-control form-control-sm select2_this select2-navy" data-dropdown-css-class="select2-navy" name="id_m_user_verif" id="id_m_user_verif">
                                                <option value="0" disabled selected>Pilih Pegawai</option>
                                                <?php if($pegawai){ foreach($pegawai as $p){ ?>
                                                    <option value="<?=$p['id_m_user']?>"><?='('.formatNip($p['username']).') <strong>'.getNamaPegawaiFull($p).'</strong>'?></option>
                                                <?php } } ?>
                                            </select>
                                            <input style="display: none;" class="form-control form-control-sm" name="id_m_user" value="<?=$user['id_m_user']?>"/>
                                            <button class="btn btn-sm btn-navy float-right mt-3"><i class="fa fa-save"></i> Simpan</button>
                                        </form>
                                    </div>
                                    <div class="col-12" id="list_verif_pegawai"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
<script>
    $(function(){
        $('.select2_this').select2()
        loadListRole('<?=$user['id_m_user']?>')
    })

    function loadListRole(id){
        $('#list_role').html('')
        $('#list_role').append(divLoaderNavy)
        $('#list_role').load('<?=base_url("user/C_User/loadRoleForUser")?>'+'/'+id, function(){

        })
    }

    function refreshSubBidang(){
        $('#div_bidang').html('')
        $('#div_bidang').append(divLoaderNavy)
        $('#div_bidang').load('<?=base_url("user/C_User/refreshSubBidang")?>'+'/'+'<?=$user['id_m_user']?>', function(){

        })
    }

    function refreshListVerifBidang(){
        $('#list_verif_bidang').html('')
        $('#list_verif_bidang').append(divLoaderNavy)
        $('#list_verif_bidang').load('<?=base_url("user/C_User/getVerifBidang")?>'+'/'+'<?=$user['id_m_user']?>', function(){

        })
    }

    function refreshListVerifPegawai(){
        $('#list_verif_pegawai').html('')
        $('#list_verif_pegawai').append(divLoaderNavy)
        $('#list_verif_pegawai').load('<?=base_url("user/C_User/getVerifPegawai")?>'+'/'+'<?=$user['id_m_user']?>', function(){

        })
    }
    
    $('#form_tambah_verif_pegawai').on('submit', function(e){
        e.preventDefault()
        $.ajax({
            url: '<?=base_url("user/C_User/tambahVerifPegawai")?>',
            method: 'post',
            data: $(this).serialize(),
            success: function(data){
                let rs = JSON.parse(data)
                if(rs.code == 0){
                    successtoast('Berhasil menambah Verifikasi Pegawai')
                    refreshListVerifPegawai()
                } else {
                    errortoast(rs.message)
                }
            }, error: function(e){
                errortoast('Terjadi Kesalahan')
            }
        })
    })

    $('#form_tambah_verif_bidang').on('submit', function(e){
        e.preventDefault()
        $.ajax({
            url: '<?=base_url("user/C_User/tambahVerifBidang")?>',
            method: 'post',
            data: $(this).serialize(),
            success: function(data){
                let rs = JSON.parse(data)
                if(rs.code == 0){
                    successtoast('Berhasil menambah Verifikasi Bidang')
                    refreshListVerifBidang()
                } else {
                    errortoast(rs.message)
                }
            }, error: function(e){
                errortoast('Terjadi Kesalahan')
            }
        })
    })

    function resetPassword(){
        if(confirm('Apakah Anda yakin ingin me-reset Password?')){
            $.ajax({
                url: '<?=base_url("user/C_User/resetPassword")?>'+'/'+'<?=$user['id_m_user']?>',
                method: 'post',
                data: $(this).serialize(),
                success: function(data){
                    // let rs = JSON.parse(data)
                    $('.password_input').val('')
                    successtoast('Berhasil me-reset Password menjadi Tanggal Lahir dengan format "hhbbtttt" ')
                }, error: function(e){
                    errortoast('Terjadi Kesalahan')
                }
            })
        }
    }

    $('#form_ganti_password').on('submit', function(e){
        e.preventDefault()
        $.ajax({
            url: '<?=base_url("user/C_User/userChangePassword")?>',
            method: 'post',
            data: $(this).serialize(),
            success: function(data){
                let rs = JSON.parse(data)
                $('.password_input').val('')
                if(rs.code == 0){
                    successtoast('Berhasil mengganti Password')
                } else {
                    errortoast(rs.message)
                }
            }, error: function(e){
                errortoast('Terjadi Kesalahan')
            }
        })
    })

    $('#form_tambah_role').on('submit', function(e){
        e.preventDefault()
        $.ajax({
            url: '<?=base_url("user/C_User/addRoleForUser")?>',
            method: 'post',
            data: $(this).serialize(),
            success: function(data){
                let rs = JSON.parse(data)
                if(rs.code == 0){
                    successtoast('Berhasil menambahkan role')
                } else {
                    errortoast(rs.message)
                }
                loadListRole('<?=$user['id_m_user']?>')
            }, error: function(e){
                errortoast('Terjadi Kesalahan')
            }
        })
    })

    $('#form_tambah_sub_bidang').on('submit', function(e){
        e.preventDefault()
        $.ajax({
            url: '<?=base_url("user/C_User/tambahSubBidangUser")?>',
            method: 'post',
            data: $(this).serialize(),
            success: function(data){
                let rs = JSON.parse(data)
                successtoast('Berhasil menambahkan Sub Bidang pada User')
                refreshSubBidang()
                $('#label_bidang_<?=$user['id_m_user']?>').html(rs.nama_bidang)
            }, error: function(e){
                errortoast('Terjadi Kesalahan')
            }
        })
    })
</script>