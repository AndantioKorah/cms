<div class="card card-default">
    <div class="card-header"  style="display: block;">
        <h3 class="card-title">MASTER PELANGGAN</h3>
    </div>
    <div class="card-body" style="display: block;">
        <form id="form_tambah_master_pelanggan">
            <div class="row">
                <div class="col-lg-4 col-md-12">
                    <div class="form-group">
                        <label class="bmd-label-floating">Nama</label>
                        <input class="form-control" autocomplete="off" name="nama" id="nama" required/>
                    </div>
                </div>

                <div class="col-lg-4 col-md-12">
                    <div class="form-group">
                        <label class="bmd-label-floating">Alamat</label>
                        <input class="form-control" autocomplete="off" name="alamat" id="alamat"/>
                    </div>
                </div>

                <div class="col-lg-4 col-md-12">
                    <div class="form-group">
                        <label class="bmd-label-floating">No HP</label>
                        <input class="form-control" autocomplete="off" name="no_hp" id="no_hp"/>
                    </div>
                </div>
                
                <div class="col-lg-12 col-md-12 text-left">
                    <label class="bmd-label-floating" style="color: white;">..</label>
                    <button id="btn_save" class="btn btn-block btn-navy" type="submit"><i class="fa fa-save"></i> SIMPAN</button>
                    <button style="display: none;" disabled id="btn_save_loading" class="btn btn-block btn-navy" type="submit"><i class="fa fa-spin fa-spinner"></i> Menyimpan...</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="card card-default">
    <div class="card-header">
        <h3 class="card-title">LIST MASTER PELANGGAN</h3>
    </div>
    <div class="card-body">
        <div id="list_master_pelanggan" class="row">
        </div>
    </div>
</div>
<div class="modal fade" id="modal_data_pelanggan" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content" id="modal_data_pelanggan_edit"></div>
    </div>
</div>
<script>
    $(function(){
        loadMasterPelanggan()
    })

    function loadMasterPelanggan(){
        $('#list_master_pelanggan').html('')
        $('#list_master_pelanggan').append(divLoaderNavy)
        $('#list_master_pelanggan').load('<?=base_url("master/C_Master/loadMasterPelanggan")?>', function(){
            $('#loader').hide()
        })
    }

    $('#form_tambah_master_pelanggan').on('submit', function(e){
        $('#btn_save').hide()
        $('#btn_save_loading').show()
        e.preventDefault();
        $.ajax({
            url: '<?=base_url("master/C_Master/insertMasterPelanggan")?>',
            method: 'post',
            data:$(this).serialize(),
            success: function(res){
                let rs = JSON.parse(res)
                if(rs.code == 0){
                    successtoast('Data berhasil ditambahkan')
                    loadMasterPelanggan()
                    $('#nama').val('')
                    $('#alamat').val('')
                    $('#no_hp').val('')
                    $('#btn_save').show()
                    $('#btn_save_loading').hide()
                } else {
                    errortoast(rs.message)
                    $('#btn_save').show()
                    $('#btn_save_loading').hide()
                }
            }, error: function(e){
                errortoast('Terjadi Kesalahan')
            }
        })
    })

</script>