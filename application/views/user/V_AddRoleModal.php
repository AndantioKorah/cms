<?php
    if($user){
?>
    <div class="row p-2">
        <div class="col-12">
            <h5><strong><?=$user['username'].' ('.$user['nama'].')'?></strong></h5>
        </div>
        <div class="col-12">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#role_tab" data-toggle="tab">Role</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" onclick="refreshBidang()" href="#bidang_tab" data-toggle="tab">Bidang</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#password_tab" data-toggle="tab">Password</a>
                </li>
            </ul>
        </div>
        <div class="col-12"><hr></div>
        <div class="tab-content col-12" id="myTabContent">
            <div class="tab-pane fade show active" id="role_tab">
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
                            <input style="display: none;" class="form-control form-control-sm" id="id_m_user" name="id_m_user" value="<?=$user['id_m_user']?>"/>
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
            <div class="tab-pane fade" id="bidang_tab">
                <div class="row">
                    <div class="col-12">
                        <form id="form_tambah_bidang">
                            <label>Pilih Bidang:</label>
                            <select style="width: 100%;" class="form-control form-control-sm select2_this select2-navy" data-dropdown-css-class="select2-navy" name="id_m_bidang" id="id_m_bidang">
                                <option value="0" disabled selected>Pilih Item</option>
                                <?php if($bidang){ foreach($bidang as $b){ ?>
                                    <option value="<?=$b['id']?>"><?=$b['nama_bidang']?></option>
                                <?php } } ?>
                            </select>
                            <input style="display: none;" class="form-control form-control-sm" id="id_m_user" name="id_m_user" value="<?=$user['id_m_user']?>"/>
                            <button class="btn btn-sm btn-navy float-right mt-3"><i class="fa fa-save"></i> Simpan</button>
                        </form>
                    </div>
                    <div class="col-12"><hr></div>
                    <div class="col-12">
                        <div id="div_bidang"></div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="password_tab">
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
                                    <input style="display: none;" class="form-control form-control-sm" id="id_m_user" name="id_m_user" value="<?=$user['id_m_user']?>"/>
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

    function refreshBidang(){
        $('#div_bidang').html('')
        $('#div_bidang').append(divLoaderNavy)
        $('#div_bidang').load('<?=base_url("user/C_User/refreshBidang")?>'+'/'+'<?=$user['id_m_user']?>', function(){

        })
    }

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

    $('#form_tambah_bidang').on('submit', function(e){
        e.preventDefault()
        $.ajax({
            url: '<?=base_url("user/C_User/tambahBidangUser")?>',
            method: 'post',
            data: $(this).serialize(),
            success: function(data){
                let rs = JSON.parse(data)
                successtoast('Berhasil menambahkan Bidang pada User')
                refreshBidang()
                $('#label_bidang_<?=$user['id_m_user']?>').html(rs.nama_bidang)
            }, error: function(e){
                errortoast('Terjadi Kesalahan')
            }
        })
    })
</script>