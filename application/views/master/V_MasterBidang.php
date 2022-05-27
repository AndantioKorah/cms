<div class="card card-default">
    <div class="card-header"  style="display: block;">
        <h3 class="card-title">MASTER BIDANG/BAGIAN</h3>
    </div>
    <div class="card-body" style="display: block;">
        <form id="form_tambah_master_bidang">
            <div class="row">
                <div class="col-3">
                    <button id="btn_import" class="btn btn-sm btn-navy" href="#modal_import" data-toggle="modal" type="button">
                    <i class="fa fa-file-import"></i> IMPORT DATABASE</button>
                </div>
                <div class="col-9"></div>
                <div class="col-lg-4 col-md-12">
                    <?php if($this->general_library->getRole() == 'programmer'){ ?>
                    <div class="form-group">
                        <label class="bmd-label-floating">Pilih SKPD</label>
                        <select class="form-control select2-navy" style="width: 100%"
                        id="id_unitkerja" data-dropdown-css-class="select2-navy" name="id_unitkerja">
                            <?php if($list_unit_kerja){
                                foreach($list_unit_kerja as $ljp){
                                ?>
                                <option value="<?=$ljp['id_unitkerja']?>">
                                    <?=$ljp['nm_unitkerja']?>
                                </option>
                            <?php } } ?>
                        </select>
                    </div>
                    <?php } else { ?>
                        <div class="form-group">
                            <label class="bmd-label-floating">SKPD</label>
                            <select class="form-control select2-navy" style="width: 100%"
                            id="id_unitkerja" data-dropdown-css-class="select2-navy" name="id_unitkerja">
                                <?php if($unit_kerja){
                                    ?>
                                    <option value="<?=$unit_kerja['id_unitkerja']?>">
                                        <?=$unit_kerja['nm_unitkerja']?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                    <?php } ?>
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="form-group">
                        <label class="bmd-label-floating">Nama Bidang/Bagian</label>
                        <input class="form-control" autocomplete="off" name="nama_bidang" id="nama_bidang" required/>
                    </div>
                </div>
                
                <div class="col-lg-2 col-md-12 text-left">
                    <label class="bmd-label-floating" style="color: white;">..</label>
                    <button class="btn btn-block btn-navy" type="submit"><i class="fa fa-save"></i> SIMPAN</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="card card-default">
    <div class="card-header">
        <h3 class="card-title">LIST MASTER BIDANG/BAGIAN</h3>
    </div>
    <div class="card-body">
        <div id="list_master_bidang" class="row">
        </div>
    </div>
</div>

<div class="modal fade" id="modal_import" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content" id="modal_import_content"></div>
    </div>
</div>

<script>
    $(function(){
        $('#id_unitkerja').select2()
        loadMasterBidang()
    })

    function loadMasterBidang(){
        $('#list_master_bidang').html('')
        $('#list_master_bidang').append(divLoaderNavy)
        $('#list_master_bidang').load('<?=base_url("master/C_Master/loadMasterBidang")?>'+'/'+$('#id_unitkerja').val(), function(){
            $('#loader').hide()
        })
    }

    $('#id_unitkerja').on('change', function(){
        loadMasterBidang()
    })

    $('#btn_import').on('click', function(){
        $('#modal_import_content').html()
        $('#modal_import_content').append(divLoaderNavy)
        $('#modal_import_content').load('<?=base_url("master/C_Master/importBidangSubBidangByUnitKerja")?>'+'/'+$('#id_unitkerja').val(), function(){

        })
    })

    $('#form_tambah_master_bidang').on('submit', function(e){
        e.preventDefault();
        $.ajax({
            url: '<?=base_url("master/C_Master/createMasterBidang")?>',
            method: 'post',
            data: $(this).serialize(),
            success: function(){
                successtoast('Data berhasil ditambahkan')
                loadMasterBidang()
                $('#nama_bidang').val('')
            }, error: function(e){
                errortoast('Terjadi Kesalahan')
            }
        })
    })

</script>