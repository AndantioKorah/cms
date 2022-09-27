<div class="modal-header">
    <h5><?=$jenis_pelayanan['nama_jenis_pelayanan']?></h5>
</div>
<div class="modal-body">
    <div class="row">
        <div class="col-12">
            <form id="form_tambah_parameter">
                <div class="row">
                    <div class="col-lg-6 col-md-12">
                        <div class="form-group">
                            <label class="bmd-label-floating">Role</label>
                            <select class="form-control form-control-sm select2_this select2-navy" data-dropdown-css-class="select2-navy" name="id_role" id="id_role">
                                <?php if($role){ foreach($role as $p){ ?>
                                    <option value="<?=$p['id']?>"><?=$p['nama']?></option>
                                <?php } } ?>
                            </select>
                        </div>
                    </div>
                
                    <div class="col-lg-6 col-md-12">
                        <div class="form-group">
                            <label class="bmd-label-floating">Nomor Urut</label>
                            <input autocomplete="off" class="form-control form-control-sm" name="no_urut" type="number" id="no_urut" value="1" />
                        </div>
                    </div>
                    
                    <div class="col-lg-12">
                        <button id="btn_submit" type="submit" class="btn btn-block btn-navy">Simpan <i class="fa fa-save"></i></button>
                        <button style="display: none;" id="btn_loading" disabled class="btn btn-block btn-navy">Menyimpan.... <i class="fa fa-spin fa-spinner"></i></button>
                    </div>
                </div>
            </form>
            <hr>
        </div>
        <div class="col-12" id="list_parameter"></div>
    </div>
</div>
<script>
    $(function(){
        loadListRole()
  
    })

    function loadListRole(){
        $('#list_parameter').html('')
        $('#list_parameter').append(divLoaderNavy)
        $('#list_parameter').load('<?=base_url('master/C_Master/getListRoleJenisPelayanan/')?>'+<?=$jenis_pelayanan['id']?>, function(){
            $('#loader').hide()
        })
    }

    $('#form_tambah_parameter').on('submit', function(e){
        e.preventDefault()
        $('#btn_submit').hide()
        $('#btn_loading').show()
        $.ajax({
            url: '<?=base_url("master/C_Master/addRoleJenisPelayanan/")?>'+'<?=$jenis_pelayanan['id']?>',
            method: 'post',
            data: $(this).serialize(),
            success: function(res){
                let rs = JSON.parse(res)
                if(rs.code == 0){
                    loadListRole()
                    successtoast('Role Berhasil Ditambahkan')
                } else {
                    errortoast(rs.message)
                }
                $('#btn_submit').show()
                $('#btn_loading').hide()
            }, error: function(e){
                $('#btn_submit').show()
                $('#btn_loading').hide()
                errortoast('Terjadi Kesalahan')
            }
        })
    })


</script>