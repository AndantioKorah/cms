<div class="card card-default">
    <div class="card-header"  style="display: block;">
        <h3 class="card-title">Rencana Kinerja Pegawai</h3>
    </div>
    <div class="card-body" style="display: block;">
    
    <form method="post" id="form_tambah_rencana_kinerja">
    
  <div class="form-group" >
    <label for="exampleFormControlInput1">Kegiatan Tugas Jabatan</label>
    <input  class="form-control " id="tugas_jabatan" name="tugas_jabatan" autocomplete="off">
  </div>

    <div class="form-group" >
    <label for="exampleFormControlInput1">Tahun</label>
    <input  class="form-control datepicker" id="tahun" name="tahun" value="<?= date('Y');?>">
  </div>

    <div class="form-group" >
    <label for="exampleFormControlInput1">Bulan</label>
    <select class="form-control select2-navy" style="width: 100%"
                 id="bulan" data-dropdown-css-class="select2-navy" name="bulan">
                 <option selected>- Pilih Bulan -</option>
                 <option value="1">Januari</option>
                 <option value="2">Feburari</option>
                 <option value="3">Maret</option>
                 <option value="4">April</option>
                 <option value="5">Mei</option>
                 <option value="6">Juni</option>
                 <option value="7">Juli</option>
                 <option value="8">Agustus</option>
                 <option value="9">September</option>
                 <option value="10">Oktober</option>
                 <option value="11">November</option>
                 <option value="12">Desember</option>
                 </select>
  </div>

      
 <div class="form-group" >
    <div class="row">
    <div class="col">
    <label >Target Kuantitas</label>
      <input type="text" class="form-control" name="target_kuantitas" id="target_kuantitas">
    </div>
    <div class="col">
    <label >Satuan</label>
      <input type="text" class="form-control" name="satuan" id="satuan" >
    </div>
  </div>
  </div>

  <div class="form-group">
    <label>Target Kualitas (%)</label>
    <input  class="form-control" type="text" id="target_kualitas" name="target_kualitas" value="100" readonly/>
  </div>
  <div class="form-group">
     <button class="btn btn-block btn-navy" id="btn_upload"><i class="fa fa-save"></i> SIMPAN</button>
 </div>
</form> 

    </div>
</div>

<div class="card card-default">
    <div class="card-header">
        <h3 class="card-title">List Rencana Kinerja</h3>
    </div>
    <div class="card-body">
        <div id="list_rencana_kinerja" class="row">
        </div>
    </div>
</div>





<script>

    $(function(){
        loadRencanaKinerja()
    })

    function loadRencanaKinerja(){
        $('#list_rencana_kinerja').html('')
        $('#list_rencana_kinerja').append(divLoaderNavy)
        $('#list_rencana_kinerja').load('<?=base_url("kinerja/C_kinerja/loadRencanaKinerja")?>', function(){
            $('#loader').hide()
        })
    }

    $('#form_tambah_rencana_kinerja').on('submit', function(e){
        e.preventDefault();
        $.ajax({
            url: '<?=base_url("kinerja/C_Kinerja/createRencanaKinerja")?>',
            method: 'post',
            data: $(this).serialize(),
            success: function(){
                successtoast('Data berhasil ditambahkan')
                loadRencanaKinerja()
                document.getElementById("form_tambah_rencana_kinerja").reset();
            }, error: function(e){
                errortoast('Terjadi Kesalahan')
            }
        })
    })


</script>

