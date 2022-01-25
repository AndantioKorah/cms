<div class="card card-default">
    <div class="card-header"  style="display: block;">
        <h3 class="card-title">MASTER BIDANG/BAGIAN</h3>
    </div>
    <div class="card-body" style="display: block;">
        <form id="form_tambah_master_bidang">
            <div class="row">
                <div class="col-lg-4 col-md-12">
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


<script>
    $(function(){
        $('#id_unitkerja').select2()
        loadMasterBidang()
    })

    function loadMasterBidang(){
        $('#list_master_bidang').html('')
        $('#list_master_bidang').append(divLoaderNavy)
        $('#list_master_bidang').load('<?=base_url("master/C_Master/loadMasterBidang")?>', function(){
            $('#loader').hide()
        })
    }

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