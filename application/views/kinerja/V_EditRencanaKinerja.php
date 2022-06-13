<?php if($rencana){ ?>
    <form id="form_edit_realisasi_kinerja">
        <input style="display: none;" id="id_kegiatan" name="id_rencana_kinerja" value="<?=$rencana['id']?>" />
        <div class="row p-3">
            <div class="col-md-12">
             
            </div>
            <div class="col-md-9"></div>
            <div class="col-md-6">
                <label>Kegiatan Tugas Jabatan</label>
                <input required autocomplete="off" id="edit_tugas_jabatan"  class="form-control form-control-sm" name="edit_tugas_jabatan" value="<?=$rencana['tugas_jabatan']?>" readonly/>
            </div>

            <div class="col-md-6">
                <label>Sasaran Kerja</label>
                <input required autocomplete="off" id="edit_sasaran_kerja"  class="form-control form-control-sm" name="edit_sasaran_kerja" value="<?=$rencana['sasaran_kerja']?>" readonly/>
            </div>

            <div class="col-md-4">
                <label>Tahun</label>
                <input autocomplete="off"  id="edit_tahun"  class="form-control form-control-sm" name="edit_tahun" value="<?= $rencana['tahun']?>" readonly/>
            </div>

            <div class="col-md-4">
                <label>Bulan</label>
                <input autocomplete="off" id="edit_bulan"  class="form-control form-control-sm" name="edit_bulan" value="<?= getNamaBulan($rencana['bulan'])?>" Readonly/>
            </div>

            <div class="col-md-4">
                <label>Target (Kuantitas)</label>
                <input required autocomplete="off" id="edit_target_kuantitas"  class="form-control form-control-sm" name="edit_target_kuantitas" value="<?=$rencana['target_kuantitas']?>" />
            </div>

            <div class="col-md-6">
                <label>Satuan</label>
                <input required autocomplete="off" id="edit_satuan"  class="form-control form-control-sm" name="edit_satuan" value="<?=$rencana['satuan']?>" />
            </div>


            <div class="col-md-6">
                <label>Target (Kualitas)</label>
                <input required autocomplete="off" id="edit_realisasi_target_kuantitas"  class="form-control form-control-sm" name="edit_realisasi_target_kuantitas" value="100%" Readonly/>
            </div>

            <div class="col-md-12"><hr></div>
            <div class="col-md-12 text-right">
                <button type="submit" id="btn_simpan_edit" accesskey="s" class="btn btn-block btn-navy"><i class="fa fa-save"></i> <u>S</u>IMPAN</button>
            </div>
        </div>
    </form>
    <script>
        $(function(){
            $('.select2_this').select2()

            $("#tanggal_lahir").inputmask("99-99-9999", {
                placeholder: "hh-bb-tttt"
            });
        })

        $('#form_edit_realisasi_kinerja').on('submit', function(e){
            e.preventDefault()
            $.ajax({
                url: '<?=base_url("kinerja/C_Kinerja/editRencanaKinerja")?>',
                method: 'post',
                data: $(this).serialize(),
                success: function(datares){
                   let res = JSON.parse(datares)
                   if(res.code == 0){
                        successtoast('Data Berhasil Disimpan')
            
                            $('#edit_rencana_kinerja').modal('hide')
                            loadRencanaKinerja()
                   } else {
                       errortoast(res.message)
                   }
                }, error: function(e){
                    errortoast('Terjadi Kesalahan')
                }
            })
        })
    </script>
<?php } else { ?>
    <div class="col-12 text-center">
        <h6><i class="fa fa-exclamation"></i> Data tidak ditemukan</h6>
    </div>
<?php } ?>    