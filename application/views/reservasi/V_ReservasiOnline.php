<style>
    #div_result{
        max-height: 60vh;
        overflow-y: auto;
    }
</style>
<div class="row">
    <div class="col-lg-6">
        <div class="card card-default p-3">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h5>LIST RESERVASI ONLINE</h5>
                    <hr>
                </div>
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
    </div>
    <div class="col-lg-6" id="div_reservasi_detail"></div>
</div>
<script>
    $(function(){
        $("#range_tanggal").daterangepicker({
            showDropdowns: true
        });
    })

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
            $('#loader').hide(0)
        })
    }
</script>