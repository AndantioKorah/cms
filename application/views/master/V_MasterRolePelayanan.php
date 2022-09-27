<div class="card card-default">
    <div class="card-header"  style="display: block;">
        <h3 class="card-title">MASTER ROLE PELAYANAN</h3>
    </div>
    <div class="card-body" style="display: block;">
        <form id="form_tambah_role_pelayanan">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="form-group">
                        <label class="bmd-label-floating">Nama Role</label>
                        <input class="form-control" autocomplete="off" name="nama_role" id="nama_role" required/>
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
        <h3 class="card-title">LIST ROLE PELAYANAN</h3>
    </div>
    <div class="card-body">
        <div id="list_role_pelayanan" class="row">
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
        $('#list_role_pelayanan').html('')
        $('#list_role_pelayanan').append(divLoaderNavy)
        $('#list_role_pelayanan').load('<?=base_url("master/C_Master/loadMasterRolePelayanan")?>', function(){
            $('#loader').hide()
        })
    }

    $('#form_tambah_role_pelayanan').on('submit', function(e){
        $('#btn_save').hide()
        $('#btn_save_loading').show()
        e.preventDefault();
        $.ajax({
            url: '<?=base_url("master/C_Master/insertMasterRolePelayanan")?>',
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