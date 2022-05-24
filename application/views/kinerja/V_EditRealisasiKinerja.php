<?php if($realisasi){ ?>
    <form id="form_edit_realisasi_kinerja">
        <input style="display: none;" id="id_kegiatan" name="id_kegiatan" value="<?=$realisasi['id']?>" />
        <div class="row p-3">
            <div class="col-md-12">
             
            </div>
            <div class="col-md-9"></div>
            <div class="col-md-4">
                <label>Rencana Kegiatan</label>
                <input required autocomplete="off" id="edit_tugas_jabatan"  class="form-control form-control-sm" name="edit_tugas_jabatan" value="<?=$realisasi['tugas_jabatan']?>" readonly/>
            </div>

            <div class="col-md-4">
                <label>Tanggal Kegiatan</label>
                <input autocomplete="off"  id="edit_tanggal_kegiatan"  class="form-control form-control-sm" name="edit_tanggal_kegiatan" value="<?= formatDateNamaBulanWT($realisasi['tanggal_kegiatan'])?>" readonly/>
            </div>

            <div class="col-md-4">
                <label>Detail Kegiatan</label>
                <input autocomplete="off" id="edit_deskripsi_kegiatan"  class="form-control form-control-sm" name="edit_deskripsi_kegiatan" value="<?=$realisasi['deskripsi_kegiatan']?>" />
            </div>

            <div class="col-md-4">
                <label>Realisasi Target (Kuantitas)</label>
                <input required autocomplete="off" id="edit_realisasi_target_kuantitas"  class="form-control form-control-sm" name="edit_realisasi_target_kuantitas" value="<?=$realisasi['realisasi_target_kuantitas']?>" />
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
                url: '<?=base_url("kinerja/C_Kinerja/editRealisasiKinerja")?>',
                method: 'post',
                data: $(this).serialize(),
                success: function(datares){
                   let res = JSON.parse(datares)
                   if(res.code == 0){
                        successtoast('Data Berhasil Disimpan')
            
                            $('#edit_realisasi_kinerja').modal('hide')
                            loadListKegiatan()
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