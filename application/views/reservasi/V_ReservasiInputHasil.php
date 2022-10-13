<div class="row">
    <div class="col-lg-12">
        <div class="card card-default">
            <div class="card-header">
                <h5>Input Hasil Pemeriksaan</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        <form id="form_search_parameter">
                            <label>Pilih Parameter</label>
                            <select class="form-control form-control-sm select2_this select2-navy" data-dropdown-css-class="select2-navy" name="parameter" id="parameter">
                                <option value="0" selected disabled>Pilih Parameter</option>
                                <?php if($list_parameter) { foreach($list_parameter as $l){ ?>
                                    <option value="<?=$l['id']?>"><?=$l['nama_parameter_jenis_pelayanan']?></option>
                                <?php } } ?>
                            </select>
                        </form>
                    </div>
                    <div class="col-lg-12 mt-3" id="list_reservasi_input"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(function(){
        $('#parameter').select2()
    })

    $('#parameter').on('change', function(){
        $('#list_reservasi_input').html('')
        $('#list_reservasi_input').append(divLoaderNavy)
        $('#list_reservasi_input').load('<?=base_url('reservasi/C_Reservasi/loadParameterForInputHasil/')?>'+$('#parameter').val(), function(){
            $('#loader').hide()
        })
    })
</script>