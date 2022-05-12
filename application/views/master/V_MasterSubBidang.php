<div class="card card-default">
    <div class="card-header"  style="display: block;">
        <h3 class="card-title">MASTER SUB BIDANG/BAGIAN</h3>
    </div>
    <div class="card-body" style="display: block;">
        <form id="form_tambah_master_sub_bidang">
            <div class="row">
                <?php if($this->general_library->getRole() != 'programmer'){ ?>
                    <div class="col-lg-12 col-md-12">
                        <h5><strong><?=strtoupper($unit_kerja['nm_unitkerja'])?></strong><h5>
                        <hr>
                    </div>
                    <div class="col-lg-4 col-md-12">
                        <div class="form-group">
                            <label class="bmd-label-floating">Pilih Bidang</label>
                            <select class="form-control select2-navy" style="width: 100%"
                            id="id_m_bidang" data-dropdown-css-class="select2-navy" name="id_m_bidang">
                                <?php if($list_master_bidang){
                                    foreach($list_master_bidang as $ljp){
                                    ?>
                                    <option value="<?=$ljp['id']?>">
                                        <?=$ljp['nama_bidang']?>
                                    </option>
                                <?php } } ?>
                            </select>
                        </div>
                    </div>
                <?php } else { ?>
                    <div class="col-lg-3 col-md-12">
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
                    <div class="col-lg-3 col-md-12">
                        <div class="form-group">
                            <label class="bmd-label-floating">Pilih Bidang</label>
                            <select class="form-control select2-navy" style="width: 100%"
                                id="id_m_bidang" data-dropdown-css-class="select2-navy" name="id_m_bidang">
                            </select>
                        </div>
                    </div>
                <?php } ?>
                <div class="col-lg-4 col-md-12">
                    <div class="form-group">
                        <label class="bmd-label-floating">Nama Sub Bidang/Bagian</label>
                        <input class="form-control" autocomplete="off" name="nama_sub_bidang" id="nama_sub_bidang" required/>
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
        <h3 class="card-title">LIST MASTER SUB BIDANG/BAGIAN</h3>
    </div>
    <div class="card-body">
        <div id="list_master_sub_bidang" class="row">
        </div>
    </div>
</div>


<script>
    $(function(){
        $('#id_m_bidang').select2()
        $('#id_unitkerja').select2()
        loadMasterSubBidang()
    })

    $('#id_unitkerja').on('change', function(){
        $.ajax({
            url: '<?=base_url("master/C_Master/loadBidangByUnitKerja")?>'+'/'+$(this).val(),
            method: 'post',
            data: $(this).serialize(),
            success: function(data){
                let res = JSON.parse(data)
                $('#id_m_bidang').empty()
                res.forEach(function(item) {
                    $('#id_m_bidang').append('<option value="'+item.id+'">'+item.nama_bidang+'</option>')
                })
                // successtoast('Data berhasil ditambahkan')
                loadMasterSubBidang()
                // $('#nama_sub_bidang').val('')
            }, error: function(e){
                errortoast('Terjadi Kesalahan')
            }
        })
    })

    function loadMasterSubBidang(){
        let unit_kerja = '<?=$unit_kerja['id_unitkerja']?>';
        <?php if($this->general_library->getRole() == 'programmer'){ ?>
                unit_kerja = $('#id_unitkerja').val()
        <?php } ?>
        $('#list_master_sub_bidang').html('')
        $('#list_master_sub_bidang').append(divLoaderNavy)
        $('#list_master_sub_bidang').load('<?=base_url("master/C_Master/loadMasterSubBidangByUnitKerja")?>'+'/'+unit_kerja, function(){
            $('#loader').hide()
        })
    }

    $('#form_tambah_master_sub_bidang').on('submit', function(e){
        e.preventDefault();
        $.ajax({
            url: '<?=base_url("master/C_Master/createMasterSubBidang")?>',
            method: 'post',
            data: $(this).serialize(),
            success: function(){
                successtoast('Data berhasil ditambahkan')
                loadMasterSubBidang()
                $('#nama_sub_bidang').val('')
            }, error: function(e){
                errortoast('Terjadi Kesalahan')
            }
        })
    })

</script>