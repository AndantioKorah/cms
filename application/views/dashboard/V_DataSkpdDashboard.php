<?php if($data_skpd){ ?>
    <style>
        .big_span{
            font-size: 22px;
            font-weight: bold;
        }

        .smaller_span{
            font-size: 16px;
            font-weight: bold;
        }
    </style>
    <div>
        <div class="card card-default">
            <div class="card-header">
                <div class="d-none d-sm-none d-md-block d-lg-block d-xl-block">
                    <span class="big_span"><?=strtoupper($data_skpd['nm_unitkerja'])?></span><br>
                    <hr>
                    <table>
                        <tr>
                            <td class="smaller_span" style="width: 20%">Alamat</td>
                            <td class="smaller_span" style="width: 5%">:</td>
                            <td class="smaller_span" style="width: 75%"><?=$data_skpd['alamat_unitkerja']?></td>
                        </tr>
                        <tr>
                            <td class="smaller_span" style="width: 20%">No. Telp</td>
                            <td class="smaller_span" style="width: 5%">:</td>
                            <td class="smaller_span" style="width: 75%"><?=$data_skpd['notelp']?></td>
                        </tr>
                        <tr>
                            <td class="smaller_span" style="width: 20%">Email</td>
                            <td class="smaller_span" style="width: 5%">:</td>
                            <td class="smaller_span" style="width: 75%"><?=$data_skpd['emailskpd']?></td>
                        </tr>
                    </table>
                </div>
                <div class="d-block d-sm-block d-md-none d-lg-none d-xl-none">
                    <span class="big_span"><?=strtoupper($data_skpd['nm_unitkerja'])?></span>
                    <hr>
                    <table>
                        <tr>
                            <td style="font-size: 12px; width: 20%">Alamat</td>
                            <td style="font-size: 12px; width: 5%">:</td>
                            <td style="font-size: 12px; white-space: nowrap; font-weight: bold; width: 75%"><?=$data_skpd['alamat_unitkerja']?></td>
                        </tr>
                        <tr>
                            <td style="font-size: 12px; width: 20%">No. Telp</td>
                            <td style="font-size: 12px; width: 5%">:</td>
                            <td style="font-size: 12px; white-space: nowrap; font-weight: bold; width: 75%"><?=$data_skpd['notelp']?></td>
                        </tr>
                        <tr>
                            <td style="font-size: 12px; width: 20%">Email</td>
                            <td style="font-size: 12px; width: 5%">:</td>
                            <td style="font-size: 12px; white-space: nowrap; font-weight: bold; width: 75%"><?=$data_skpd['emailskpd']?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="card card-default p-3">
            <?php if($this->general_library->isKabid()){ ?>
                <div class="row">
                    <div class="col-lg-12">
                        <h6><strong><?=strtoupper($bidang['nama_bidang'])?></strong></h6>
                        <hr>
                    </div>
                </div>
            <?php } ?>
            <form id="form_data_dashboard">
                <div class="d-none d-sm-none d-md-block d-lg-block d-xl-block">
                    <div class="row">
                        <?php if($this->general_library->isKaban() || $this->general_library->isWalikota() || $this->general_library->isSetda() || $this->general_library->isProgrammer()){ ?>
                            <div class="col-4">
                                <label class="bmd-label-floating">Pilih Bidang/Bagian</label>
                                <select class="form-control select2-navy" style="width: 100%"
                                    id="bidang" data-dropdown-css-class="select2-navy" name="bidang">
                                    <option value="0">Semua</option>
                                    <?php if($list_bidang){ foreach($list_bidang as $l){ ?>
                                        <option value="<?=$l['id']?>"><?=$l['nama_bidang']?></option>
                                    <?php } } ?>
                                </select>
                            </div>
                        <?php } ?>
                        <div class="col-4">
                            <label class="bmd-label-floating">Pilih Sub Bidang/Sub Bagian/Seksi</label>
                            <select class="form-control select2-navy" style="width: 100%"
                                id="sub_bidang" data-dropdown-css-class="select2-navy" name="sub_bidang">
                                <!-- <option selected value="0">Semua</option> -->
                                <?php if($this->general_library->isKabid()){ foreach($list_sub_bidang as $sb){ ?>
                                    <option value="<?=$sb['id']?>"><?=$sb['nama_sub_bidang']?></option>
                                <?php } } ?>
                            </select>
                        </div>
                        <div class="col-2">
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
                        <div class="col-2">
                            <label class="bmd-label-floating">Pilih Tahun</label>
                            <input readonly autocomplete="off" class="form-control datepicker" id="tahun" name="tahun" value="<?=date('Y')?>" />
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-9"></div>
                        <div class="col-3 text-right">
                            <button type="submit" class="btn btn-navy btn-sm"><i class="fa fa-search"></i> Cari Data</button>
                        </div>
                    </div>
                </div>
                <div class="d-block d-sm-block d-md-none d-lg-none d-xl-none">
                    <div class="row">
                        <?php if($this->general_library->isKaban() || $this->general_library->isWalikota() || $this->general_library->isSetda() || $this->general_library->isProgrammer()){ ?>
                            <div class="col-lg-12">
                                <label class="bmd-label-floating">Pilih Bidang/Bagian</label>
                                <select class="form-control select2-navy" style="width: 100%"
                                    id="bidang" data-dropdown-css-class="select2-navy" name="bidang">
                                    <option value="0">Semua</option>
                                    <?php if($list_bidang){ foreach($list_bidang as $l){ ?>
                                        <option value="<?=$l['id']?>"><?=$l['nama_bidang']?></option>
                                    <?php } } ?>
                                </select>
                            </div>
                        <?php } ?>
                        <div class="col-lg-12">
                            <label class="bmd-label-floating">Pilih Sub Bidang/Sub Bagian/Seksi</label>
                            <select class="form-control select2-navy" style="width: 100%"
                                id="sub_bidang" data-dropdown-css-class="select2-navy" name="sub_bidang">
                                <!-- <option selected value="0">Semua</option> -->
                                <?php if($this->general_library->isKabid()){ foreach($list_sub_bidang as $sb){ ?>
                                    <option value="<?=$sb['id']?>"><?=$sb['nama_sub_bidang']?></option>
                                <?php } } ?>
                            </select>
                        </div>
                        <div class="col-lg-12">
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
                        <div class="col-lg-12">
                            <label class="bmd-label-floating">Pilih Tahun</label>
                            <input readonly autocomplete="off" class="form-control datepicker" id="tahun" name="tahun" value="<?=date('Y')?>" />
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-lg-12 text-right">
                            <button type="submit" class="btn btn-navy btn-block"><i class="fa fa-search"></i> Cari Data</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script>
        $(function(){
            $('#bulan').select2()
            $('#bidang').select2()
            $('#sub_bidang').select2()

            $('#tahun').datepicker({
                autoClose: true,
                format: 'yyyy',
            })
            
            $('#form_data_dashboard').submit()
        })

        $('#bidang').on('change', function(){
            $.ajax({
                url: '<?=base_url("dashboard/C_Dashboard/loadSubBidangByBidang")?>'+'/'+$(this).val(),
                method: 'post',
                data: $(this).serialize(),
                success: function(data){
                    let res = JSON.parse(data)
                    $('#sub_bidang').empty()
                    $('#sub_bidang').append('<option selected value="0">Semua</option>')
                    res.forEach(function(item) {
                        $('#sub_bidang').append('<option value="'+item.id+'">'+item.nama_sub_bidang+'</option>')
                    })
                    $('#form_data_dashboard').submit()
                }, error: function(e){
                    errortoast('Terjadi Kesalahan')
                }
            })
        })

        $('#sub_bidang').on('change', function(){
            $('#form_data_dashboard').submit()
        })

        $('#bulan').on('change', function(){
            $('#form_data_dashboard').submit()
        })    

        $('#tahun').on('change', function(){
            $('#form_data_dashboard').submit()
        })        

        $('#form_data_dashboard').on('submit', function(e){
            $('#data_dashboard').html('')
            $('#data_dashboard').append(divLoaderNavy)
            e.preventDefault()
            $.ajax({
                url: '<?=base_url("dashboard/C_Dashboard/searchDataDashboard")?>',
                method: 'post',
                data: $(this).serialize(),
                success: function(data){
                    $('#data_dashboard').html('')
                    $('#data_dashboard').append(data)
                }, error: function(e){
                    errortoast('Terjadi Kesalahan')
                }
            })
        })
    </script>
<?php } ?>