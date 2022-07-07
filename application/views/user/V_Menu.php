<div class="card card-default">
    <div class="card-header"  style="display: block;">
        <h3 class="card-title">TAMBAH MENU</h3>
    </div>
    <div class="card-body" style="display: block;">
        <form id="form_tambah_menu">
            <div class="row">
                <div class="col-lg-2 col-md-2">
                    <div class="form-group">
                        <label class="bmd-label-floating">Nama Menu</label>
                        <input class="form-control form-control-sm" autocomplete="off" name="nama_menu" id="nama_menu"/>
                    </div>
                </div>
                <div class="col-lg-2 col-md-2">
                    <div class="form-group">
                        <label class="bmd-label-floating">URL</label>
                        <input class="form-control form-control-sm" autocomplete="off" name="url" id="url"/>
                    </div>
                </div>
                <div class="col-lg-1 col-md-1">
                    <div class="form-group">
                        <label class="bmd-label-floating">Icon</label>
                        <input class="form-control form-control-sm" autocomplete="off" name="icon" id="icon"/>
                    </div>
                </div>
                <div class="col-lg-2 col-md-2">
                    <div class="form-group">
                        <label class="bmd-label-floating">Keterangan</label>
                        <input class="form-control form-control-sm" autocomplete="off" name="keterangan" id="keterangan"/>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3">
                    <div class="form-group">
                        <label class="bmd-label-floating">Parent</label>
                        <select class="form-control form-control-sm select2_this select2-navy" data-dropdown-css-class="select2-navy" name="id_m_menu_parent" id="id_m_menu_parent">
                            <option value="0" selected>Tidak ada</option>
                            <?php if($list_menu){ foreach($list_menu as $l){ ?>
                                <option value="<?=$l['id']?>"><?=$l['nama_menu']. ' ('.$l['url'].')'?></option>
                            <?php } } ?>
                        </select>
                    </div>
                </div>
                <div class="col-lg-1 col-md-1">
                    <div class="form-group">
                        <label class="bmd-label-floating">Menu Admin?</label>
                        <select class="form-control form-control-sm select2_this select2-navy" data-dropdown-css-class="select2-navy" name="flag_menu_admin" id="flag_menu_admin">
                            <option value="1" selected>Ya</option>
                            <option value="0">Tidak</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-1 col-md-1" id="language_div" style="display: none;">
                    <div class="form-group">
                        <label class="bmd-label-floating">Language</label>
                        <input class="form-control form-control-sm" autocomplete="off" name="site_lang" id="site_lang"/>
                    </div>
                </div>
                <div class="col-10"></div>
                <div class="col-2 text-right mt-2">
                    <button class="btn btn-block btn-navy" type="submit"><i class="fa fa-save"></i> SIMPAN</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="card card-default">
    <div class="card-header">
        <h3 class="card-title">LIST MENU</h3>
    </div>
    <div class="card-body">
        <div id="list_menu" class="row table-responsive">
        </div>
    </div>
</div>

<script>
    $(function(){
        loadMenu()
    })

    $('#flag_menu_admin').on('change', function(){
        if($(this).val() == '0'){
            $('#language_div').show()
        } else {
            $('#language_div').hide()
        }
    })

    function loadMenu(){
        $('#list_menu').html('')
        $('#list_menu').append(divLoaderNavy)
        $('#list_menu').load('<?=base_url("user/C_User/loadMenu")?>', function(){
            $('#loader').hide()
        })
    }

    $('#form_tambah_menu').on('submit', function(e){
        e.preventDefault();
        $.ajax({
            url: '<?=base_url("user/C_User/createMenu")?>',
            method: 'post',
            data: $(this).serialize(),
            success: function(data){
                let rs = JSON.parse(data)
                if(rs.code == 0){
                    window.location=""
                    successtoast('Menu telah ditambahkan')
                    $('#nama_menu').val('')
                    $('#url').val('')
                    $('#keterangan').val('')
                    $('#icon').val('')
                } else {
                    errortoast(rs.message)
                }
            }, error: function(e){
                errortoast('Terjadi Kesalahan')
            }
        })
    })
</script>