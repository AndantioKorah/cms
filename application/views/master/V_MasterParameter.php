<div class="card card-default">
    <div class="card-header"  style="display: block;">
        <h3 class="card-title">MASTER PARAMETER</h3>
    </div>
    <div class="card-body" style="display: block;">
        <form id="form_tambah_master_parameter" enctype="multipart/form-data">
            <div class="row">
                <div class="col-lg-5 col-md-12">
                    <div class="form-group">
                        <label class="bmd-label-floating">Nama Parameter</label>
                        <input class="form-control" autocomplete="off" name="parameter_name" id="parameter_name" required/>
                    </div>
                </div>

                <div class="col-lg-5 col-md-12">
                    <div class="form-group">
                        <label class="bmd-label-floating">File</label>
                        <input type="file" class="form-control" autocomplete="off" name="parameter_file" id="parameter_file"/>
                    </div>
                </div>

                <div class="col-lg-10 col-md-12">
                    <div class="form-group">
                        <label class="bmd-label-floating">Value Parameter</label>
                        <input class="form-control" autocomplete="off" name="parameter_value" id="parameter_value" required/>
                    </div>
                </div>
                
                <div class="col-lg-10 col-md-12 text-left">
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
        <h3 class="card-title">LIST MASTER PARAMETER</h3>
    </div>
    <div class="card-body">
        <div id="list_master_parameter" class="row">
        </div>
    </div>
</div>
<div class="modal fade" id="modal_data_parameter" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content" id="modal_data_parameter_content"></div>
    </div>
</div>
<script>
    $(function(){
        $('#id_unitkerja').select2()
        loadMasterParameter()
    })

    function loadMasterParameter(){
        $('#list_master_parameter').html('')
        $('#list_master_parameter').append(divLoaderNavy)
        $('#list_master_parameter').load('<?=base_url("master/C_Master/loadMasterParameter")?>', function(){
            $('#loader').hide()
        })
    }

    $('#form_tambah_master_parameter').on('submit', function(e){
        // $('#btn_save').hide()
        // $('#btn_save_loading').show()
        e.preventDefault();
        $.ajax({
            url: '<?=base_url("master/C_Master/insertMasterParameter")?>',
            method: 'post',
            data:new FormData(this),  
                    contentType: false,  
                    cache: false,  
                    processData:false,
            success: function(res){
                let rs = JSON.parse(res)
                if(rs.code == 0){
                    successtoast('Data berhasil ditambahkan')
                    loadMasterParameter()
                    $('#parameter_name').val('')
                    $('#parameter_value').val('')
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