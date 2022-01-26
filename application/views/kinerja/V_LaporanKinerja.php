<div class="card card-default">
    <div class="card-header"  style="display: block;">
        <h3 class="card-title">Laporan Kinerja Pegawai</h3>
    </div>
    <div class="card-body" style="display: block;">
    <form id="form_tambah_kegiatan">
  <div class="form-group" method="post" enctype="multipart/form-data">
    <label for="exampleFormControlInput1">Tanggal Kegiatan</label>
    <input  class="form-control datetimepickerthis" id="tanggal_kegiatan" name="tanggal_kegiatan" readonly value="<?= date('Y-m-d H:i:s') ;?>">
  </div>


  <div class="form-group">
    <label for="exampleFormControlTextarea1">Deskripsi Kegiatan</label>
    <textarea class="form-control" id="deskripsi_kegiatan" name="deskripsi_kegiatan" rows="3"></textarea>
  </div>
  <div class="form-group">
    <label for="exampleFormControlFile1">Dokumen Bukti Kegiatan</label>
    <input type="file" class="form-control-file"  id="butki_kegiatan" name="butki_kegiatan">
  </div>
  <div class="col-lg-2 col-md-12 text-left">
                    <label class="bmd-label-floating" style="color: white;">..</label>
                    <button class="btn btn-block btn-navy" type="submit"><i class="fa fa-save"></i> SIMPAN</button>
                </div>
</form>
    </div>
</div>


<script>

    $('#form_tambah_kegiatan').on('submit', function(e){
        e.preventDefault();
        $.ajax({
            url: '<?=base_url("kinerja/C_Kinerja/createLaporanKegiatan")?>',
            method: 'post',
            data: $(this).serialize(),
            success: function(){
                successtoast('Data berhasil ditambahkan')
                
            }, error: function(e){
                errortoast('Terjadi Kesalahan')
            }
        })
    })

</script>


