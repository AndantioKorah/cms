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
          <ul class="nav nav-tabs mb-3">
            <?php if($this->general_library->isPetugasYantek()){ ?>
              <li class="nav-item">
                  <a data-toggle="tab" onclick="loadDetailLayanan()" class="nav-link active" href="#administrasi_tab"><span class="text_tab">Administrasi</span></a>
              </li>
            <?php if($result['status'] == 2){ ?>
              <?php if($this->general_library->isPetugasYantek()){ ?>
              <li class="nav-item">
                  <a data-toggle="tab" class="nav-link" href="#tambah_layanan_tab"><span class="text_tab">Tambah Layanan</span></a>
              </li>
              <?php } ?>
            <?php } } ?>
          </ul>
          <div class="tab-content">
            <div id="administrasi_tab" class="tab-pane active">
            
              <form id="form_administrasi">
              <?php if($result['id_m_pelanggan'] == null){ ?>
                <a href="<?=base_url('admin/master/pelanggan');?>">
            <button type="button" id="btn_create_billing" style="float: right;" class="btn btn-navy btn-sm"><i class="fa fa-user"></i> Tambah Data Pelanggan</button></a>
            <div class="row">
                            <div class="col-lg-4 form-group">
                                <label>Pilih Pelanggan</label>
                                <select onchange="getPelanggan()" class="form-control form-control-sm select2_this select2-navy" data-dropdown-css-class="select2-navy" name="pelanggan" id="pelanggan">
                                <option value=""></option>
                                <?php if($pelanggan){ foreach($pelanggan as $l){ ?>
                                   <option value="<?=$l['id']?>"><?=$l['nama']?></option>
                                <?php } } ?>
                                </select>
                            </div>
                        </div>
           
          <div class="col-lg-12" id="data_pelanggan" style="display:none; margin-bottom: 10px;">
            <table style="width: 100%;" >
            <tr>
              <td style="width: 10%;">
                <span class="label_title">Nama</span>  
              </td>
              <td style="width: 33%; text-align: left;"> : 
              <span class="value_title" id="pelanggan_nama"></span>
              </td>
           
            </tr>
            <tr>
              <td style="width: 10%;">
                <span class="label_title">Alamat</span> 
              </td>
              <td style="width: 33%; text-align: left;"> : 
              <span class="value_title" id="pelanggan_alamat"></span>
              </td>
             
            </tr>
            <tr>
              <td style="width: 10%;">
                <span class="label_title">No HP</span> 
              </td>
              <td style="width: 33%; text-align: left;"> : 
              <span class="value_title" id="pelanggan_no_hp"></span>
              </td>
              
            </tr>
          </table>
          </div>
            <?php } ?>
            <?php if($result['id_m_pelanggan']){ ?>
              <div class="col-lg-12" style=" margin-bottom: 10px;">
            <table style="width: 100%;" >
            <tr>
              <td style="width: 10%;">
                <span class="label_title">Nama</span>  
              </td>
              <td style="width: 33%; text-align: left;"> : <?= $result['nama']?> 
              <span class="value_title" id="pelanggan_nama"></span>
              </td>
           
            </tr>
            <tr>
              <td style="width: 10%;">
                <span class="label_title">Alamat</span> 
              </td>
              <td style="width: 33%; text-align: left;"> : <?= $result['alamat']?> 
              <span class="value_title" id="pelanggan_alamat"></span>
              </td>
             
            </tr>
            <tr>
              <td style="width: 10%;">
                <span class="label_title">No HP</span> 
              </td>
              <td style="width: 33%; text-align: left;"> : <?= $result['no_hp']?> 
              <span class="value_title" id="pelanggan_no_hp"></span>
              </td>
              
            </tr>
          </table>
          </div>
              <?php } ?>
                <div class="col-lg-12" id="div_detail_layanan">
                </div>
                <div class="col-lg-12" style="height: 5vh;">
                  <hr>
                  <div class="row">
                    <div class="col-lg-12 text-right float-right">
                      <button disabled type="button" id="btn_loading" style="float: right; display: none;" class="btn btn-navy btn-sm"><i class="fa fa-spin fa-spinner"></i> Loading...</button>
                      <?php if($this->general_library->isPetugasYantek()){ ?>
                        <?php if($result['status'] == 2){ ?>
                          <button type="submit" id="btn_create_billing" style="float: right;" class="btn btn-navy btn-sm"><i class="fa fa-file-invoice"></i> Buat Billing</button>
                        <?php } ?>
                        <?php if($result['status'] == 3){ ?>
                          <button type="button" id="btn_delete_billing" style="float: left;" class="btn btn-danger btn-sm"><i class="fa fa-times"></i> Batalkan Billing</button>
                          <button type="button" id="btn_acc_payment" style="float: right;" class="btn btn-navy btn-sm"><i class="fa fa-check"></i> Pembayaran Diterima </button>
                        <?php } ?>
                        <?php if($result['status'] == 5){ ?>
                          <div class="row">
                            <div class="col-lg-8">
                              <input class="form-control form-control-sm" id="keterangan_delete_payment" autocomplete="off" placeholder="Keterangan" />
                            </div>
                            <div class="col-lg-4">
                              <button type="button" id="btn_delete_payment" style="float: right;" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Hapus Pembayaran</button>
                            </div>
                          </div>
                        <?php } ?>
                        <?php if($result['status'] == 13){ ?>
                          <div class="row">
                            <div class="col-lg-12">
                              <button id="btn_publikasi" style="float: right; text-align: right;" class="btn btn-info btn-sm float-right" type="button"><i class="fa fa-rss"></i> Publish Hasil</button>
                            </div>
                          </div>
                        <?php } else if($result['status'] == 10){ ?>
                          <div class="row">
                            <div class="col-lg-12">
                              <button id="btn_delete_publikasi" style="float: right; text-align: right;" class="btn btn-danger btn-sm float-right" type="button"><i class="fa fa-trash"></i> Batal Publish Hasil</button>
                            </div>
                          </div>
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

      $('#btn_delete_publikasi').on('click', function(){
        if(confirm('Apakah Anda yakin akan Publish Hasil?')){
          $('#btn_delete_publikasi').hide()
          $('#btn_loading').show()
          $.ajax({
            url: '<?=base_url('reservasi/C_Reservasi/deletePublishHasil/')?>'+'<?=$result['id']?>',
            method: 'POST',
            data: null,
            success: function(res){
              let rs = JSON.parse(res)
              if(rs.code == 0){
                $('.status_<?=$result['id']?>').html(rs.data.status)
                $('.label_status').html(rs.data.status)
                successtoast('Berhasil Batal Publish')
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

      $('#btn_publikasi').on('click', function(){
        if(confirm('Apakah Anda yakin akan Publish Hasil?')){
          $('#btn_publikasi').hide()
          $('#btn_loading').show()
          $.ajax({
            url: '<?=base_url('reservasi/C_Reservasi/publishHasil/')?>'+'<?=$result['id']?>',
            method: 'POST',
            data: null,
            success: function(res){
              let rs = JSON.parse(res)
              if(rs.code == 0){
                $('.status_<?=$result['id']?>').html(rs.data.status)
                $('.label_status').html(rs.data.status)
                successtoast('Publish Berhasil')
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
                $('.label_status').html(rs.data.status)
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
         var pelanggan = $('#pelanggan').val()
        
        if(pelanggan == ""){
          errortoast(" Belum ada data pelanggan")
          return false
        }
        if(pelanggan == null){
          errortoast(" Belum ada data pelanggan")
          return false
        }

        $('#btn_create_billing').hide()
        $('#btn_loading').show()
       
        // return false
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

      $('#btn_acc_payment').on('click', function(){
        if(confirm('Apakah Anda yakin?')){
          $('#btn_acc_payment').hide()
          $('#btn_loading').show()
          $.ajax({
            url: '<?=base_url('reservasi/C_Reservasi/acceptPayment/')?>'+'<?=$result['id']?>',
            method: 'POST',
            data: null,
            success: function(res){
              let rs = JSON.parse(res)
              if(rs.code == 0){
                $('.status_<?=$result['id']?>').html(rs.data.status)
                $('.label_status').html(rs.data.status)
                successtoast('Pembayaran Diterima')
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

      $('#btn_delete_payment').on('click', function(){
        if(confirm('Apakah Anda yakin?')){
          $('#btn_delete_payment').hide()
          $('#btn_loading').show()
          $.ajax({
            url: '<?=base_url('reservasi/C_Reservasi/deletePayment/')?>'+'<?=$result['id']?>',
            method: 'POST',
            data: {
              keterangan: $('#keterangan_delete_payment').val()
            },
            success: function(res){
              let rs = JSON.parse(res)
              if(rs.code == 0){
                $('.status_<?=$result['id']?>').html(rs.data.status)
                $('.label_status').html(rs.data.status)
                successtoast('Berhasil menghapus pembayaran')
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

      function getPelanggan() {
      
        var id_m_pelanggan = $('#pelanggan').val(); 
        $.ajax({
        type : "POST",
        url: '<?=base_url('reservasi/C_Reservasi/getPelanggan')?>',
        dataType : "JSON",
        data : {id_m_pelanggan:id_m_pelanggan},
        success: function(data){
          if (data.length === 0) { 
              $("#data_pelanggan").hide('fast');
            } else {
              $('#data_pelanggan').show('fast')
              $('#pelanggan_nama').html(data[0].nama);
              $('#pelanggan_alamat').html(data[0].alamat);
              $('#pelanggan_no_hp').html(data[0].no_hp);
            }
         
            console.log(data)
           
           
         }
        });
      
        }
        
       
      
        


    </script>
  <?php } else { ?>
    <div class="col-lg-12 text-center">
      <h5>Data tidak ditemukan <i class="fa fa-exclamation"></i></h5>
    </div>
  <?php } ?>
</div>