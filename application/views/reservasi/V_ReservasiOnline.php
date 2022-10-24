<style>
    #div_result{
        max-height: 60vh;
        overflow-y: auto;
    }
</style>
<div class="row">
    <div class="col-lg-12">
        <div class="card card-default p-3">
            <div class="row">
            <?php if($this->general_library->isPetugasYantek()){ ?>
                <div class="col-lg-12 text-left">
                    <button onclick="tambahReservasi()" type="button" class="btn btn-sm btn-navy"><i class="fa fa-plus"></i> Tambah Reservasi</button>
                </div>
            <?php } ?>
            <button onclick="testNotif()" type="button" class="btn btn-sm btn-navy"><i class="fa fa-send"></i> Tes Notif</button>

                <div class="col-lg-12 text-center">
                    <h5>LIST RESERVASI ONLINE</h5>
                    <hr>
                </div>
                <div class="col-lg-12">
                    <ul class="nav nav-tabs mb-3">
                        <li class="nav-item">
                            <a data-toggle="tab" class="nav-link active" href="#search_tab"><span class="text_tab">Cari Reservasi</span></a>
                        </li>
                        <?php if($this->general_library->isPetugasYantek()){ ?>
                            <li class="nav-item">
                                <a data-toggle="tab" onclick="searchReservasiByStatus('2')" class="nav-link" href="#result_tab"><span class="text_tab">Menunggu Registrasi</span></a>
                            </li>
                            <li class="nav-item">
                                <a data-toggle="tab" onclick="searchReservasiByStatus('3')" class="nav-link" href="#result_tab"><span class="text_tab">Menunggu Pembayaran</span></a>
                            </li>
                            <li class="nav-item">
                                <a data-toggle="tab" onclick="searchReservasiByStatus('13')" class="nav-link" href="#result_tab"><span class="text_tab">Menunggu Publikasi</span></a>
                            </li>
                            <li class="nav-item">
                                <a data-toggle="tab" onclick="searchReservasiByStatus('10')" class="nav-link" href="#result_tab"><span class="text_tab">Publikasi</span></a>
                            </li>
                        <?php } ?>
                        <?php if($this->general_library->isKepalaInstalasi()){ ?>
                            <li class="nav-item">
                                <a data-toggle="tab" onclick="searchReservasiByStatus('5')" class="nav-link" href="#result_tab"><span class="text_tab">Belum Verif</span></a>
                            </li>
                            <!-- <li class="nav-item">
                                <a data-toggle="tab" onclick="searchReservasiByStatus('5', '1')" class="nav-link" href="#result_tab"><span class="text_tab">Sudah Verif</span></a>
                            </li> -->
                        <?php } ?>
                        <?php if($this->general_library->isKoordinatorLab()){ ?>
                            <li class="nav-item">
                                <a data-toggle="tab" onclick="searchReservasiByStatus('8')" class="nav-link" href="#result_tab"><span class="text_tab">Belum Verif</span></a>
                            </li>
                            <!-- <li class="nav-item">
                                <a data-toggle="tab" onclick="searchReservasiByStatus('8', '1')" class="nav-link" href="#result_tab"><span class="text_tab">Sudah Verif</span></a>
                            </li> -->
                        <?php } ?>
                        <?php if($this->general_library->isKepalaBalai()){ ?>
                            <li class="nav-item">
                                <a data-toggle="tab" onclick="searchReservasiByStatus('9')" class="nav-link" href="#result_tab"><span class="text_tab">Belum Verif</span></a>
                            </li>
                            <!-- <li class="nav-item">
                                <a data-toggle="tab" onclick="searchReservasiByStatus('9', '1')" class="nav-link" href="#result_tab"><span class="text_tab">Sudah Verif</span></a>
                            </li> -->
                        <?php } ?>
                    </ul>
                    </ul>
                    <div class="tab-content">
                        <div id="search_tab" class="tab-pane active">
                            <div class="row">
                                <div class="col-lg-12">
                                    <form id="form_search_reservasi">
                                        <div class="row">
                                            <div class="col-lg-4 form-group">
                                                <label>Cari Berdasarkan:</label>
                                                <select class="form-control form-control-sm select2_this select2-navy" data-dropdown-css-class="select2-navy" name="filter" id="filter">
                                                    <option value="1" selected>Tanggal</option>
                                                    <option value="2">Nomor Tiket</option>
                                                </select>
                                            </div>

                                            <div class="col-lg-8 form-group div_form_group" id="div_tanggal">
                                                <label>Pilih Range Tanggal:</label>
                                                <input class="form-control form-control-sm" id="range_tanggal" readonly name="range_tanggal"/>
                                            </div>

                                            <div class="col-lg-8 form-group div_form_group" id="div_nomor_tiket" style="display: none;">
                                                <label>Nomor Tiket:</label>
                                                <input class="form-control form-control-sm" id="nomor_tiket" name="nomor_tiket"/>
                                            </div>

                                            <div class="col-lg-12 text-right">
                                                <button type="submit" class="btn btn-sm btn-navy"><i class="fa fa-search"></i> Cari</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>   
                                <div class="col-lg-12 mt-3" id="div_result">
                                </div>                             
                            </div>
                        </div> 
                        <div id="result_tab" class="tab-pane p-3">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12" id="div_reservasi_detail"></div>
    <div class="col-lg-12" id="div_tambah_reservasi"></div>
</div>
<script>
    $(function(){
        $("#range_tanggal").daterangepicker({
            showDropdowns: true
        });
    })

    function testNotif(){
        $.ajax({
            url: '<?=base_url('reservasi/C_Reservasi/tesNotif')?>',
            method: 'POST',
            data: $(this).serialize(),
            success: function(res){
                $('#div_result').html('')
                $('#div_result').append(res)
            }, error: function(e){
                errortoast(e)
            }
        })
    }

    function searchReservasiByStatus(status, flag_greater = 0){
        $('#div_tambah_reservasi').html('')
        $('#div_reservasi_detail').html('')
        $('#result_tab').html('')
        $('#result_tab').append(divLoaderNavy)
        $('#result_tab').load('<?=base_url('reservasi/C_Reservasi/searchReservasiByStatus/')?>'+status+'/'+flag_greater, function(){
            $('#loader').hide()
        })
    }

    $('#filter').on('change', function(){
        if($(this).val() == 1){
            $('.div_form_group').hide()
            $('#div_tanggal').show()
        } else if($(this).val() == 2){
            $('.div_form_group').hide()
            $('#div_nomor_tiket').show()
        }
    })

    $('#form_search_reservasi').on('submit', function(e){
        e.preventDefault()
        $.ajax({
            url: '<?=base_url('reservasi/C_Reservasi/searchReservasi')?>',
            method: 'POST',
            data: $(this).serialize(),
            success: function(res){
                $('#div_result').html('')
                $('#div_result').append(res)
            }, error: function(e){
                errortoast(e)
            }
        })
    })

    function openReceipt(id){
        $('#div_reservasi_detail').html('')
        $('#div_reservasi_detail').append(divLoaderNavy)
        $('#div_reservasi_detail').load('<?=base_url('reservasi/C_Reservasi/openDetailAdministrasiReservasi/')?>'+id, function(){
            $('#loader').hide()
        })
    }

    function tambahReservasi(){
        $('#result_tab').html('')
        $('#div_reservasi_detail').html('')
        $('#div_tambah_reservasi').html('')
        $('#div_tambah_reservasi').append(divLoaderNavy)
        $('#div_tambah_reservasi').load('<?=base_url('reservasi/C_Reservasi/openFormTambahReservasi/')?>', function(){
            $('#loader').hide()
        })
    }
</script>