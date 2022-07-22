<div class="modal-header">
    <h4>Edit Data Master Parameter</h4>
</div>
<div class="modal-body">
    <?php if($result){ ?>
        <form id="form_edit_master">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="form-group">
                        <label class="bmd-label-floating">Nama Parameter</label>
                        <input style="display: none;" class="form-control" autocomplete="off" name="id" id="id_param" value="<?=$result['id']?>" required/>
                        <input class="form-control" autocomplete="off" name="parameter_name" id="parameter_name" value="<?=$result['parameter_name']?>" required/>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12">
                    <div class="form-group">
                        <label class="bmd-label-floating">Value Parameter</label>
                        <input class="form-control" autocomplete="off" name="parameter_value" id="parameter_value" value="<?=$result['parameter_value']?>" required/>
                    </div>
                </div>
                
                <div class="col-lg-12 col-md-12 text-left">
                    <label class="bmd-label-floating" style="color: white;">..</label>
                    <button id="btn_edit" class="btn btn-block btn-navy" type="submit"><i class="fa fa-save"></i> SIMPAN</button>
                    <button disabled style="display: none;" id="btn_loading_edit" class="btn btn-block btn-navy" type="submit"><i class="fa fa-spin fa-spinner"></i> Loading...</button>
                </div>
            </div>
        </form>
        <script>
            $('#form_edit_master').submit(function(e){
                $('#btn_edit').hide()
                $('#btn_loading_edit').show()
                e.preventDefault();
                $.ajax({
                    url: '<?=base_url("master/C_Master/editMasterParameter")?>',
                    method: 'post',
                    data: $(this).serialize(),
                    success: function(res){
                        let rs = JSON.parse(res)
                        if(rs.code == 0){
                            successtoast('Data berhasil diupdate')
                            // $('#modal_data_parameter_content').modal('hide')
                            setTimeout(loadMasterParameter, 500);
                            $('#btn_edit').show()
                            $('#btn_loading_edit').hide()
                        } else {
                            errortoast(rs.message)
                            $('#btn_edit').show()
                            $('#btn_loading_edit').hide()
                        }
                    }, error: function(e){
                        errortoast('Terjadi Kesalahan')
                    }
                })
            })
        </script>
<?php } else { ?>
    <div class="col-12 text-center">
        <h5>Data Tidak Ditemukan <i class="fa fa-exclamation"></i></h5>
    </div>
<?php } ?>
</div>