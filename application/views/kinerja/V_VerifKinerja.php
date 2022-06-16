<div class="card card-default">
    <div class="card-header">
        <h3 class="card-title">VERIFIKASI KINERJA</h3>
    </div>
    <div class="card-body">
        <form id="form_search_verif_kinerja">
            <div class="row">
                <?php if($this->general_library->isKaban()){ ?>
                    <div class="col">
                        <label class="bmd-label-floating">Filter</label>
                        <select class="form-control select2-navy" style="width: 100%"
                            id="filter" data-dropdown-css-class="select2-navy" name="filter">
                            <option value="0" selected>Semua Bidang/Bagian</option>
                            <option value="eselon_tiga">Eselon III</option>
                            <option value="eselon_empat">Eselon IV</option>
                            <?php if($list_bidang){ foreach($list_bidang as $lb){ ?>
                                <option value="<?=$lb['id']?>"><?=$lb['nama_bidang']?></option>
                            <?php } } ?>
                        </select>
                    </div>
                <?php } else if($this->general_library->isWalikota() || $this->general_library->isSetda()) { ?>
                    <div class="col">
                        <label class="bmd-label-floating">Filter Berdasarkan</label>
                        <select class="form-control select2-navy" style="width: 100%"
                            id="filter_walikota" data-dropdown-css-class="select2-navy" name="filter_walikota">
                            <option value="skpd" selected>SKPD</option>
                            <option value="eselon_dua">Eselon II dan Camat</option>
                            <!-- <option value="eselon_tiga">Eselon III</option> -->
                            <!-- <option value="eselon_empat">Eselon IV</option> -->
                            <option value="pegawai">Pegawai</option>
                        </select>
                    </div>
                    <div id="div_skpd" class="col">
                        <label class="bmd-label-floating">Pilih SKPD</label>
                        <select class="form-control select2-navy" style="width: 100%"
                            id="filter_skpd" data-dropdown-css-class="select2-navy" name="filter_skpd">
                            <?php foreach($list_skpd as $skpd){ ?>
                                <option value="<?=$skpd['id_unitkerja']?>"><?=$skpd['nm_unitkerja']?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div id="div_pegawai" class="col" style="display: none;">
                        <label class="bmd-label-floating">NIP / Nama Pegawai</label>
                        <input class="form-control" name="nama_pegawai" />
                    </div>
                <?php } ?>
                <div class="col d-none d-sm-none d-md-block d-lg-block d-xl-block"></div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="form-group">
                        <label class="bmd-label-floating">Pilih Periode</label>
                        <input class="form-control form-control-sm" id="range_periode" readonly name="range_periode"/>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3">
                    <div class="form-group">
                        <br>
                        <div class="d-none d-sm-none d-md-block d-lg-block d-xl-block">
                            <button type="submit" style="margin-top: 8px;" class="btn btn-sm btn-navy"><i class="fa fa-search"></i> Cari</button>
                        </div>
                        <div class="d-block d-sm-block d-md-none d-lg-none d-xl-none">
                            <button type="submit" style="margin-top: 8px;" class="btn btn-block btn-navy"><i class="fa fa-search"></i> Cari</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="card card-default">
    <div class="card-header">
        <h3 class="card-title">LIST VERIFIKASI</h3>
    </div>
    <div class="card-body">
        <div id="result_search_verif" class="row">
        </div>
    </div>
</div>

<script>
    $(function(){
        $('#filter').select2()
        $('#filter_walikota').select2()
        $('#filter_skpd').select2()

        $("#range_periode").daterangepicker({
            showDropdowns: true
        });

        $('#form_search_verif_kinerja').submit()
    })

    $('#filter_walikota').on('change', function(){
        if($('#filter_walikota').val() == 'skpd'){
            $('#div_skpd').show()
        } else {
            $('#div_skpd').hide()
        }

        if($('#filter_walikota').val() == 'pegawai'){
            $('#div_pegawai').show()
        } else {
            $('#div_pegawai').hide()
        }
    })

    $('#range_periode').on('change', function(){
        $('#form_search_verif_kinerja').submit()    
    })

    $('#form_search_verif_kinerja').on('submit', function(e){
        e.preventDefault()
        $('#result_search_verif').show()
        $('#result_search_verif').html('')
        $('#result_search_verif').append(divLoaderNavy)
        $.ajax({
            url: '<?=base_url("kinerja/C_VerifKinerja/searchVerifKinerja")?>',
            method: 'post',
            data: $(this).serialize(),
            success: function(data){
                $('#result_search_verif').html('')
                $('#result_search_verif').append(data)
            }, error: function(e){
                errortoast('Terjadi Kesalahan')
            }
        })
    })

</script>