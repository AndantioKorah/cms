<div class="card card-default">
    <div class="card-header">
        <h3 class="card-title">VERIFIKASI KINERJA</h3>
    </div>
    <div class="card-body">
        <form id="form_search_verif_kinerja">
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label class="bmd-label-floating">Pilih Periode</label>
                        <input class="form-control form-control-sm" id="range_periode" readonly name="range_periode"/>
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group">
                        <br>
                        <button style="margin-top: 8px;" class="btn btn-sm btn-navy"><i class="fa fa-search"></i> Cari</button>
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
        $("#range_periode").daterangepicker({
            showDropdowns: true
        });

        $('#form_search_verif_kinerja').submit()
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