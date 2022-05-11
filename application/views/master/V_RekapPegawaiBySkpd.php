<div class="row">
    <form method="post" action="<?=base_url('master/C_Master/rekapPegawaiSubmit')?>" target="_blank">
        <div class="col-8">
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
        </div>
        <div class="col-4">
            <button type="submit" class="btn btn-navy btn-block">Submit</button>
        </div>
    </form>
</div>
<script>
    $(function(){
        $('#id_unitkerja').select2()
    })
</script>