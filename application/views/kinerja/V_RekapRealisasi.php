<div class="card card-default">
    <div class="card-header">
        <h3 class="card-title">REKAPITULASI REALISASI KINERJA</h3>
    </div>
    <div class="card-body">
        <form id="form_search_rekap_realisasi">
            <div class="row">
                <div class="col-4">
                    <div class="form-group">
                        <label class="bmd-label-floating">Pilih Bulan</label>
                        <select class="form-control select2-navy" style="width: 100%"
                                id="bulan" data-dropdown-css-class="select2-navy" name="bulan">
                                <option <?=date('m') == '01' ? 'selected' : ''?> value="01">Januari</option>
                                <option <?=date('m') == '02' ? 'selected' : ''?> value="02">Feburari</option>
                                <option <?=date('m') == '03' ? 'selected' : ''?> value="03">Maret</option>
                                <option <?=date('m') == '04' ? 'selected' : ''?> value="04">April</option>
                                <option <?=date('m') == '05' ? 'selected' : ''?> value="05">Mei</option>
                                <option <?=date('m') == '06' ? 'selected' : ''?> value="06">Juni</option>
                                <option <?=date('m') == '07' ? 'selected' : ''?> value="07">Juli</option>
                                <option <?=date('m') == '08' ? 'selected' : ''?> value="08">Agustus</option>
                                <option <?=date('m') == '09' ? 'selected' : ''?> value="09">September</option>
                                <option <?=date('m') == '10' ? 'selected' : ''?> value="10">Oktober</option>
                                <option <?=date('m') == '11' ? 'selected' : ''?> value="11">November</option>
                                <option <?=date('m') == '12' ? 'selected' : ''?> value="12">Desember</option>
                            </select>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label class="bmd-label-floating">Pilih Tahun</label>
                        <input readonly autocomplete="off" class="form-control datepicker" id="tahun" name="tahun" value="<?=date('Y')?>" />
                    </div>
                </div>
                <div class="col-2">
                    <div class="form-group">
                        <br>
                        <button style="margin-top: 8px;" class="btn btn-block btn-navy"><i class="fa fa-search"></i> Cari</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="card card-default">
    <div class="card-header">
        <h3 class="card-title">LIST PEGAWAI</h3>
    </div>
    <div class="card-body">
        <div id="result_search_rekapitulasi" class="row">
        </div>
    </div>
</div>

<script>
    $(function(){
        $('#bulan').select2()

        $('#tahun').datepicker({
            autoClose: true,
            format: 'yyyy',
        })

        $('#form_search_rekap_realisasi').submit()
    })

    $('#bulan').on('change', function(){
        $('#form_search_rekap_realisasi').submit()    
    })

    $('#tahun').on('change', function(){
        $('#form_search_rekap_realisasi').submit()    
    })

    $('#form_search_rekap_realisasi').on('submit', function(e){
        e.preventDefault()
        $('#result_search_rekapitulasi').show()
        $('#result_search_rekapitulasi').html('')
        $('#result_search_rekapitulasi').append(divLoaderNavy)
        $.ajax({
            url: '<?=base_url("kinerja/C_VerifKinerja/searchRekapRealisasi")?>',
            method: 'post',
            data: $(this).serialize(),
            success: function(data){
                $('#result_search_rekapitulasi').html('')
                $('#result_search_rekapitulasi').append(data)
            }, error: function(e){
                errortoast('Terjadi Kesalahan')
            }
        })
    })

</script>