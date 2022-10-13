<div class="card card-default">
    <div class="card-header"  style="display: block;">
        <h3 class="card-title">MASTER LABORATORIUM</h3>
    </div>
    <div class="card-body" style="display: block;">
        <form id="form_tambah_master_laboratorium">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="form-group">
                        <label class="bmd-label-floating">Nama Laboratorium</label>
                        <input class="form-control" autocomplete="off" name="nama_lab" id="nama_lab" required/>
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
        <h3 class="card-title">LIST MASTER LABORATORIUM</h3>
    </div>
    <div class="card-body">
        <div id="list_master_laboratorium" class="row">
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
        loadMasterLaboratorium()
    })

    function loadMasterLaboratorium(){
        $('#list_master_laboratorium').html('')
        $('#list_master_laboratorium').append(divLoaderNavy)
        $('#list_master_laboratorium').load('<?=base_url("master/C_Master/loadMasterLaboratorium")?>', function(){
            $('#loader').hide()
        })
    }

    $('#form_tambah_master_laboratorium').on('submit', function(e){
        $('#btn_save').hide()
        $('#btn_save_loading').show()
        e.preventDefault();
        $.ajax({
            url: '<?=base_url("master/C_Master/insertMasterLaboratorium")?>',
            method: 'post',
            data:$(this).serialize(),
            success: function(res){
                let rs = JSON.parse(res)
                if(rs.code == 0){
                    successtoast('Data berhasil ditambahkan')
                    loadMasterLaboratorium()
                    $('#nama_lab').val('')
                   
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