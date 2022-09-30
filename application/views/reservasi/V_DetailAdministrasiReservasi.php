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
    </style>
    <div class="container" style="
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
          <ul class="nav nav-tabs mb-3">
            <?php if($this->general_library->isPetugasYantek()){ ?>
              <li class="nav-item">
                  <a data-toggle="tab" onclick="loadDetailLayanan()" class="nav-link active" href="#administrasi_tab"><span class="text_tab">Administrasi</span></a>
              </li>
            <?php } ?>
            <?php if($result['status'] == 2){ ?>
              <?php if($this->general_library->isPetugasYantek()){ ?>
              <li class="nav-item">
                  <a data-toggle="tab" class="nav-link" href="#tambah_layanan_tab"><span class="text_tab">Tambah Layanan</span></a>
              </li>
              <?php } ?>
            <?php } ?>
          </ul>
          <div class="tab-content">
            <div id="administrasi_tab" class="tab-pane active">
              <form id="form_administrasi">
                <div class="col-lg-12" id="div_detail_layanan">
                </div>
                <div class="col-lg-12" style="height: 5vh;">
                  <hr>
                  <div class="row">
                    <div class="col-lg-12 text-right float-right">
                      <button type="button" id="btn_loading" style="float: right; display: none;" class="btn btn-navy btn-sm"><i class="fa fa-spin fa-spinner"></i> Loading...</button>
                      <?php if($this->general_library->isPetugasYantek()){ ?>
                        <?php if($result['status'] == 2){ ?>
                          <button type="submit" id="btn_create_billing" style="float: right;" class="btn btn-navy btn-sm"><i class="fa fa-file-invoice"></i> Buat Billing</button>
                        <?php } ?>
                        <?php if($result['status'] == 3){ ?>
                          <button type="button" id="btn_delete_billing" style="float: left;" class="btn btn-danger btn-sm"><i class="fa fa-times"></i> Batalkan Billing</button>
                          <button type="button" id="btn_acc_payment" style="float: right;" class="btn btn-navy btn-sm"><i class="fa fa-check"></i> Pembayaran Diterima</button>
                        <?php } ?>
                      <?php } ?>
                    </div>
                  </div>
                </div>
              </form>
            </div>
            <div id="tambah_layanan_tab" class="tab-pane">
              <form id="form_add_jenis_pelayanan">
                <div class="row">
                  <div class="col-lg-12 mb-2">
                    <label class="">Jenis Layanan</label><br>
                    <select style="width: 100%;" required class="form-control form-control-sm select2_this select2-navy" data-dropdown-css-class="select2-navy" name="id_m_jenis_pelayanan" id="id_m_jenis_pelayanan">
                        <?php if($layanan){ foreach($layanan as $l){ ?>
                            <option value="<?=$l['id']?>"><?=$l['nama_jenis_pelayanan']?></option>
                        <?php } } ?>
                    </select>
                  </div>
                  <div class="col-lg-12" id="div_parameter">
                  </div>
                </div>
              </form>
            </div>
        </div>
      </div>
    </div>
    <script>
      $(function(){
        $('#id_m_jenis_pelayanan').select2()
        getParameterByJenisLayanan()
        loadDetailLayanan()
      })

      $('#btn_delete_billing').on('click', function(){
        if(confirm('Apakah Anda yakin akan membatalkan Billing?')){
          $('#btn_delete_billing').hide()
          $('#btn_loading').show()
          $.ajax({
            url: '<?=base_url('reservasi/C_Reservasi/deleteBilling/')?>'+'<?=$result['id']?>',
            method: 'POST',
            data: null,
            success: function(res){
              let rs = JSON.parse(res)
              if(rs.code == 0){
                $('.status_<?=$result['id']?>').html(rs.data.status)
                successtoast('Billing Berhasil Dihapus')
                openReceipt('<?=$result['id']?>')
              } else {
                errortoast(rs.message)
              }
            }, error: function(e){
              errortoast(e)
            }
          })
        }
      })

      function formatRupiahDetailAdmin(angka, prefix = "Rp ") {
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

      function loadDetailLayanan(){
        $('#div_detail_layanan').html('')
        $('#div_detail_layanan').append(divLoaderNavy)
        $('#div_detail_layanan').load('<?=base_url('reservasi/C_Reservasi/loadDetailLayanan/'.$result['id'])?>', function(){
          $('#loader').hide()
        })
      }

      $('#form_administrasi').on('submit', function(e){
        $('#btn_create_billing').hide()
        $('#btn_loading').show()
        e.preventDefault()
        $.ajax({
          url: '<?=base_url('reservasi/C_Reservasi/createBilling/')?>'+'<?=$result['id']?>',
          method: 'POST',
          data: $(this).serialize(),
          success: function(res){
            let rs = JSON.parse(res)
            if(rs.code == 0){
              $('.total_biaya_<?=$result['id']?>').html(rs.data.total_biaya)
              $('.status_<?=$result['id']?>').html(rs.data.status)
              $('.label_status').html(rs.data.status)
              successtoast('Billing Berhasil Dibuat')
              openReceipt('<?=$result['id']?>')
            } else {
              errortoast(rs.message)
            }
          }, error: function(e){
            errortoast(e)
          }
        })
      })

      function getParameterByJenisLayanan(){
        $('#div_parameter').html('')
        $('#div_parameter').append(divLoaderNavy)
        $('#div_parameter').load('<?=base_url('reservasi/C_Reservasi/getListParameterJenisPelayanan/')?>'+$('#id_m_jenis_pelayanan').val(), function(){
          $('#loader').hide()
        })
      }

      $('#id_m_jenis_pelayanan').on('change', function(){
        getParameterByJenisLayanan()
      })

      $('#form_add_jenis_pelayanan').on('submit', function(e){
        e.preventDefault()
        $('#btn_save').hide()
        $('#btn_loading').show()
        $.ajax({
          url: '<?=base_url('reservasi/C_Reservasi/addJenisPelayanan/')?>'+'<?=$result['id']?>',
          method: 'POST',
          data: $(this).serialize(),
          success: function(res){
            let rs = JSON.parse(res)
            if(rs.code == 0){
              successtoast('Jenis Pelayanan Berhasil Ditambahkan')
            } else {
              errortoast(rs.message)
            }
            $('#btn_save').show()
            $('#btn_loading').hide()
          }, error: function(e){
            $('#btn_save').show()
            $('#btn_loading').hide()
            errortoast(e)
          }
        })
      })
    </script>
  <?php } else { ?>
    <div class="col-lg-12 text-center">
      <h5>Data tidak ditemukan <i class="fa fa-exclamation"></i></h5>
    </div>
  <?php } ?>
</div>