<div class="card card-default">
    <div class="card-header"  style="display: block;">
        <h3 class="card-title">MASTER JENIS PELAYANAN</h3>
    </div>
    <div class="card-body" style="display: block;">
        <form id="form_tambah_master_pelayanan">
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <div class="form-group">
                        <label class="bmd-label-floating">Nama Jenis Pelayanan</label>
                        <input class="form-control" autocomplete="off" name="nama_jenis_pelayanan" id="nama_jenis_pelayanan" required/>
                    </div>
                </div>

                <div class="col-lg-6 col-md-12">
                    <div class="form-group">
                        <label class="bmd-label-floating">Keterangan</label>
                        <input class="form-control" autocomplete="off" name="keterangan" id="keterangan"/>
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
        <h3 class="card-title">LIST MASTER PELAYANAN</h3>
    </div>
    <div class="card-body">
        <div id="list_master_pelayanan" class="row">
        </div>
    </div>
</div>
<div class="modal fade" id="modal_data_pelayanan" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content" id="modal_data_pelayanan_content"></div>
    </div>
</div>
<script>
    $(function(){
        loadMasterJenisPelayanan()
    })

    function loadMasterJenisPelayanan(){
        $('#list_master_pelayanan').html('')
        $('#list_master_pelayanan').append(divLoaderNavy)
        $('#list_master_pelayanan').load('<?=base_url("master/C_Master/loadMasterJenisPelayanan")?>', function(){
            $('#loader').hide()
        })
    }

    $('#form_tambah_master_pelayanan').on('submit', function(e){
        $('#btn_save').hide()
        $('#btn_save_loading').show()
        e.preventDefault();
        $.ajax({
            url: '<?=base_url("master/C_Master/insertMasterJenisPelayanan")?>',
            method: 'post',
            data:$(this).serialize(),
            success: function(res){
                let rs = JSON.parse(res)
                if(rs.code == 0){
                    successtoast('Data berhasil ditambahkan')
                    loadMasterJenisPelayanan()
                    $('#nama_jenis_pelayanan').val('')
                    $('#keterangan').val('')
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