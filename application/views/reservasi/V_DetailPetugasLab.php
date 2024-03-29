<div class="card card-default p-3">
  <?php if($result){ ?>
    <style>
      .value_title{
        font-size: 12pt;
        font-weight: bold;
      }

      .label_title{
        font-size: 10pt;
      }

      .search_jenis_layanan{
        font-size: 12pt;
        font-weight: bold;
      }

      .search_parameter_jenis_layanan{
        font-size: 10pt;
        font-weight: 400;
      }

      .total_biaya_title{
        font-size: 14pt;
        font-weight: bold;
      }

      .form-check-label{
        font-size: 10pt;
      }

      .form-check-choose:hover{
        cursor: pointer;
      }

      #div_detail_layanan{
        max-height: 60vh;
        overflow-y: auto;
        padding-bottom: 10px;
      }

      #div_detail_layanan_verif_ki{
        max-height: 60vh;
        overflow-y: auto;
        padding-bottom: 10px;
      }
    </style>
    <div class="" style="
        font-family: 'Tahoma';
      ">
      <div class="row">
        <div class="col-lg-12">
          <table style="width: 100%;">
            <tr>
              <td style="width: 34%;">
                <span class="label_title">Nomor Tiket</span> : <br><span class="value_title" id="nomor_tiket_search"><?=$result['nomor_tiket']?></span>
              </td>
              <td style="width: 33%; text-align: center;">
                <span class="label_title">Tanggal</span> : <br><span class="value_title" id="tanggal_tiket_search"><?=formatDateNamaBulanWT($result['tanggal_reservasi'])?></span>
              </td>
              <td style="width: 33%; text-align: right;">
                <span class="label_title">Status</span> : <br><span class="value_title label_status" id="status_search"><?=$result['nama_status']?></span>
              </td>
            </tr>
          </table>
          <hr>
        </div>

        <div class="col-lg-12">
          <form id="form_input_data">
            <div class="row">
              <div class="col-lg-12" id="div_detail_layanan">
              </div>
              <div class="col-lg-12">
                <hr>
                <button id="btn_loading" style="float: right; text-align: right; display: none;" disabled class="btn btn-navy btn-sm"><i class="fa fa-spin fa-spinner"></i> Loading...</button>
                <?php if($result['status'] == 6){ ?>
                  <button id="btn_submit" style="float: right; text-align: right;" class="btn btn-navy btn-sm" type="submit"><i class="fa fa-save"></i> Simpan Data</button>
                  <button id="btn_lock" style="float: right; text-align: right;" class="btn btn-info btn-sm float-left" type="button"><i class="fa fa-lock"></i> Kunci Input Hasil</button>
                <?php } else if($result['status'] == 8){ ?>
                  <button id="btn_open_lock" style="float: right; text-align: right;" class="btn btn-info btn-sm" type="button"><i class="fa fa-lock-open"></i> Buka Kunci Input</button>
                <?php } ?>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    <script>
      $(function(){
        loadDetailLayanan()
      })

      $('#btn_open_lock').on('click', function(){
        $('#btn_open_lock').hide()
        $('#btn_loading').show()
        $.ajax({
          url: '<?=base_url('reservasi/C_Reservasi/openLockResult/')?>'+'<?=$result['id']?>',
          method: 'POST',
          data: null,
          success: function(res){
            $('#btn_open_lock').show()
            $('#btn_loading').hide()
            let rs = JSON.parse(res)
            if(rs.code == 0){
              $('.status_<?=$result['id']?>').html(rs.data.status)
              $('.label_status').html(rs.data.status)
              successtoast('Berhasil')
              openReceipt('<?=$result['id']?>')
            } else {
              errortoast(rs.message)
            }
          }, error: function(e){
            $('#btn_open_lock').show()
            $('#btn_loading').hide()
            errortoast(e)
          }
        })
      })

      $('#btn_lock').on('click', function(){
        $('#btn_submit').hide()
        $('#btn_lock').hide()
        $('#btn_loading').show()
        $.ajax({
          url: '<?=base_url('reservasi/C_Reservasi/lockResult/')?>'+'<?=$result['id']?>',
          method: 'POST',
          data: null,
          success: function(res){
            $('#btn_submit').show()
            $('#btn_lock').show()
            $('#btn_loading').hide()
            let rs = JSON.parse(res)
            if(rs.code == 0){
              $('.status_<?=$result['id']?>').html(rs.data.status)
              $('.label_status').html(rs.data.status)
              successtoast('Kunci Input Hasil Berhasil')
              openReceipt('<?=$result['id']?>')
            } else {
              errortoast(rs.message)
            }
          }, error: function(e){
            $('#btn_submit').show()
            $('#btn_lock').show()
            $('#btn_loading').hide()
            errortoast(e)
          }
        })
      })

      $('#form_input_data').on('submit', function(e){
        e.preventDefault()
        $('#btn_submit').hide()
        $('#btn_loading').show()
        $.ajax({
          url: '<?=base_url('reservasi/C_Reservasi/simpanHasilInputData/')?>'+'<?=$result['id']?>',
          method: 'POST',
          data: $(this).serialize(),
          success: function(res){
            $('#btn_submit').show()
            $('#btn_loading').hide()
            let rs = JSON.parse(res)
            if(rs.code == 0){
              // $('.status_<?=$result['id']?>').html(rs.data.status)
              // $('.label_status').html(rs.data.status)
              successtoast('Data Berhasil Disimpan')
              // openReceipt('<?=$result['id']?>')
            } else {
              errortoast(rs.message)
            }
          }, error: function(e){
            $('#btn_submit').show()
            $('#btn_loading').hide()
            errortoast(e)
          }
        })
      })

      function loadDetailLayanan(){
        $('#div_detail_layanan').html('')
        $('#div_detail_layanan').append(divLoaderNavy)
        $('#div_detail_layanan').load('<?=base_url('reservasi/C_Reservasi/loadDetailLayananPetugasLab/'.$result['id'])?>', function(){
          $('#loader').hide()
        })
      }
     
    </script>
  <?php } else { ?>
    <div class="col-lg-12 text-center">
      <h5>Data tidak ditemukan <i class="fa fa-exclamation"></i></h5>
    </div>
  <?php } ?>
</div>