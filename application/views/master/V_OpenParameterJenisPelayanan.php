<div class="modal-header">
    <h5><?=$jenis_pelayanan['nama_jenis_pelayanan']?></h5>
</div>
<div class="modal-body">
    <div class="row">
        <div class="col-12">
            <form id="form_tambah_parameter">
                <div class="row">
                    <div class="col-lg-3 col-md-12">
                        <div class="form-group">
                            <label class="bmd-label-floating">Parameter</label>
                            <select class="form-control form-control-sm select2_this select2-navy" data-dropdown-css-class="select2-navy" name="id_m_parameter_jenis_pelayanan" id="id_m_parameter_jenis_pelayanan">
                                <?php if($parameter_jenis_pelayanan){ foreach($parameter_jenis_pelayanan as $p){ ?>
                                    <option value="<?=$p['id']?>"><?=$p['nama_parameter_jenis_pelayanan']?></option>
                                <?php } } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-12">
                        <div class="form-group">
                            <label class="bmd-label-floating">Kategori Parameter</label>
                            <select class="form-control form-control-sm select2_this select2-navy" data-dropdown-css-class="select2-navy" name="id_m_kategori_parameter" id="id_m_kategori_parameter">
                                <option value="" selected>Tidak ada</option>
                                <?php if($kategori_parameter){ foreach($kategori_parameter as $k){ ?>
                                    <option value="<?=$k['id']?>"><?=$k['nama_kategori_parameter']?></option>
                                <?php } } ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-12">
                        <div class="form-group">
                            <label class="bmd-label-floating">Jenis Parameter</label>
                            <select class="form-control form-control-sm select2_this select2-navy" data-dropdown-css-class="select2-navy" name="id_m_jenis_parameter" id="id_m_jenis_parameter">
                                <option value="" selected>Tidak ada</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-2 col-md-12">
                        <div class="form-group">
                            <label class="bmd-label-floating">Harga</label>
                            <input autocomplete="off" class="form-control form-control-sm" name="harga" id="harga" />
                        </div>
                    </div>

                    <div class="col-lg-1 col-md-12">
                        <div class="form-group">
                            <label class="bmd-label-floating">Urutan</label>
                            <input autocomplete="off" class="form-control form-control-sm" name="urutan" type="number" id="urutan" value="1" />
                        </div>
                    </div>
                    
                    <div class="col-lg-12">
                        <button id="btn_submit" type="submit" class="btn btn-block btn-navy">Simpan <i class="fa fa-save"></i></button>
                        <button style="display: none;" id="btn_loading" disabled class="btn btn-block btn-navy">Menyimpan.... <i class="fa fa-spin fa-spinner"></i></button>
                    </div>
                </div>
            </form>
            <hr>
        </div>
        <div class="col-12" id="list_parameter"></div>
    </div>
</div>
<script>
    $(function(){
        loadListParameter()
        $('#id_m_parameter_jenis_pelayanan').select2()
        $('#id_m_kategori_parameter').select2()
        $('#id_m_jenis_parameter').select2()
        function formatRupiah(angka, prefix = "Rp ") {
            var number_string = angka.replace(/[^,\d]/g, "").toString(),
                split = number_string.split(","),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            // tambahkan titik jika yang di input sudah menjadi angka ribuan
            if (ribuan) {
                separator = sisa ? "." : "";
                rupiah += separator + ribuan.join(".");
            }

            rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
            return prefix == undefined ? rupiah : rupiah ? rupiah : "";
        }

        $('#harga').on('keyup', function(){
            $(this).val(formatRupiah($(this).val()))
        })
    })

    function loadListParameter(){
        $('#list_parameter').html('')
        $('#list_parameter').append(divLoaderNavy)
        $('#list_parameter').load('<?=base_url('master/C_Master/getListParameterJenisPelayanan/')?>'+<?=$jenis_pelayanan['id']?>, function(){
            $('#loader').hide()
        })
    }

    $('#form_tambah_parameter').on('submit', function(e){
        e.preventDefault()
        $('#btn_submit').hide()
        $('#btn_loading').show()
        $.ajax({
            url: '<?=base_url("master/C_Master/addParameterJenisPelayanan/")?>'+'<?=$jenis_pelayanan['id']?>',
            method: 'post',
            data: $(this).serialize(),
            success: function(res){
                let rs = JSON.parse(res)
                if(rs.code == 0){
                    loadListParameter()
                    successtoast('Parameter Berhasil Ditambahkan')
                } else {
                    errortoast(rs.message)
                }
                $('#btn_submit').show()
                $('#btn_loading').hide()
            }, error: function(e){
                $('#btn_submit').show()
                $('#btn_loading').hide()
                errortoast('Terjadi Kesalahan')
            }
        })
    })

    $('#id_m_kategori_parameter').on('change', function(){
        $('#id_m_jenis_parameter')
            .find('option')
            .remove()
            .end();

        $('#id_m_jenis_parameter').append('<option selected value="">Tidak Ada</option>')

        $.ajax({
            url: '<?=base_url("master/C_Master/getJenisParameterByKategori/")?>'+$(this).val(),
            method: 'post',
            data: null,
            success: function(res){
                let rs = JSON.parse(res)
                if(rs.length >= 1){
                    for (let i = 0; i < rs.length; ++i) {
                        $('#id_m_jenis_parameter').append('<option value="'+rs[i].id+'">'+rs[i].nama_jenis_parameter+'</option>')
                    }
                }
            }, error: function(e){
                errortoast('Terjadi Kesalahan')
            }
        })
    })
</script>