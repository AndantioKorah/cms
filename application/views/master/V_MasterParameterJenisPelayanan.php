<div class="card card-default">
    <div class="card-header"  style="display: block;">
        <h3 class="card-title">MASTER PARAMETER JENIS PELAYANAN</h3>
    </div>
    <div class="card-body" style="display: block;">
        <form id="form_tambah_master_pelayanan">
            <div class="row">
                <div class="col-lg-3 col-md-12">
                    <div class="form-group">
                        <label class="bmd-label-floating">Parameter Jenis Pelayanan</label>
                        <input class="form-control" autocomplete="off" name="nama_parameter_jenis_pelayanan" id="nama_parameter_jenis_pelayanan" required/>
                    </div>
                </div>

                <div class="col-lg-3 col-md-12">
                    <div class="form-group">
                        <label class="bmd-label-floating">Satuan</label>
                        <input class="form-control" autocomplete="off" name="satuan" id="satuan"/>
                    </div>
                </div>

                <div class="col-lg-3 col-md-12">
                    <div class="form-group">
                        <label class="bmd-label-floating">Baku Mutu</label>
                        <input class="form-control" autocomplete="off" name="baku_mutu" id="baku_mutu"/>
                    </div>
                </div>

                <div class="col-lg-3 col-md-12">
                    <div class="form-group">
                        <label class="bmd-label-floating">Metode</label>
                        <input class="form-control" autocomplete="off" name="metode" id="metode"/>
                    </div>
                </div>

                <!-- <div class="col-lg-3 col-md-12">
                    <div class="form-group">
                        <label class="bmd-label-floating">Kategori Parameter</label>
                        <select class="form-control select2_this select2-navy" data-dropdown-css-class="select2-navy" name="id_m_kategori_parameter" id="id_m_kategori_parameter">
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
                        <select class="form-control select2_this select2-navy" data-dropdown-css-class="select2-navy" name="id_m_jenis_parameter" id="id_m_jenis_parameter">
                            <option value="" selected>Tidak ada</option>
                        </select>
                    </div>
                </div> -->
                
                <div class="col-lg-12 col-md-12 text-left">
                    <button id="btn_save" class="btn btn-block btn-navy" type="submit"><i class="fa fa-save"></i> SIMPAN</button>
                    <button style="display: none;" disabled id="btn_save_loading" class="btn btn-block btn-navy" type="submit"><i class="fa fa-spin fa-spinner"></i> Menyimpan...</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="card card-default">
    <div class="card-header">
        <h3 class="card-title">LIST PARAMETER MASTER PELAYANAN</h3>
    </div>
    <div class="card-body">
        <div id="list_master_pelayanan" class="row">
        </div>
    </div>
</div>

<script>
    $(function(){
        loadMasterParameterJenisPelayanan()
    })

    function loadMasterParameterJenisPelayanan(){
        $('#list_master_pelayanan').html('')
        $('#list_master_pelayanan').append(divLoaderNavy)
        $('#list_master_pelayanan').load('<?=base_url("master/C_Master/loadMasterParameterJenisPelayanan")?>', function(){
            $('#loader').hide()
        })
    }

    $('#form_tambah_master_pelayanan').on('submit', function(e){
        $('#btn_save').hide()
        $('#btn_save_loading').show()
        e.preventDefault();
        $.ajax({
            url: '<?=base_url("master/C_Master/insertMasterParameterJenisPelayanan")?>',
            method: 'post',
            data:$(this).serialize(),
            success: function(res){
                let rs = JSON.parse(res)
                if(rs.code == 0){
                    successtoast('Data berhasil ditambahkan')
                    loadMasterParameterJenisPelayanan()
                    $('#nama_parameter_jenis_pelayanan').val('')
                    $('#satuan').val('')
                    $('#baku_mutu').val('')
                    $('#metode').val('')
                    $('#btn_save').show()
                    $('#btn_save_loading').hide()
                } else {
                    errortoast(rs.message)
                    $('#btn_save').show()
                    $('#btn_save_loading').hide()
                }
            }, error: function(e){
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