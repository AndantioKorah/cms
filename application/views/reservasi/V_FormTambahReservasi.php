
<div class="row">
    <div class="col-lg-12">
        <div class="card card-default">
            <div class="card-header">
                <h5>Tambah Resevasi</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                    <form id="form_tambah_reservasi">
                    <input style="display: none;" id="session_id" name="session_id" value="<?=generateRandomNumber(4).date('Ymdhis')?>" />
                    <div class="row">
                            <div class="col-lg-12 form-group">
                                <label>Pilih Pelanggan</label>
                                <select onchange="getPelanggan()" class="form-control form-control-sm select2_this select2-navy" data-dropdown-css-class="select2-navy" name="id_m_pelanggan" id="id_m_pelanggan">
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
                    <div class="col-lg-12 mt-3" id="list_reservasi_input"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(function(){
        $('#id_m_jenis_pelayanan').select2()
        getParameterByJenisLayanan()
        // loadDetailLayanan()
      })

      $('#id_m_jenis_pelayanan').on('change', function(){
        getParameterByJenisLayanan()
      })


      function getParameterByJenisLayanan(){
        $('#div_parameter').html('')
        $('#div_parameter').append(divLoaderNavy)
        $('#div_parameter').load('<?=base_url('reservasi/C_Reservasi/getListParameterJenisPelayanan/')?>'+$('#id_m_jenis_pelayanan').val(), function(){
          $('#loader').hide()
        })
      }


      function getPelanggan() {
      
      var id_m_pelanggan = $('#id_m_pelanggan').val(); 
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

<script>
   $('#form_tambah_reservasi').on('submit', function(e){
       var status = 3;
    var pelanggan = $('#id_m_pelanggan').val()
        
        if(pelanggan == ""){
          errortoast(" Belum ada data pelanggan")
          return false
        }
        if(pelanggan == null){
          errortoast(" Belum ada data pelanggan")
          return false
        }

    $('#btn_save').hide()
    $('#btn_loading').show()
    e.preventDefault()
    $.ajax({
      url: '<?=base_url("reservasi/C_Reservasi/formAddParameterLangsung")?>',
      method: 'post',
      data:$(this).serialize(),
      success: function(res){
          let rs = JSON.parse(res)
        
          if(rs.code == 0){
              successtoast('Data berhasil ditambahkan')
              openReceipt(rs.id)
            $('#div_tambah_reservasi').hide()
            
        
              $('#btn_save').show()
              $('#btn_loading').hide()
          } else {
              errortoast(rs.message)
              $('#btn_save').show()
              $('#btn_loading').hide()
          }
      }, error: function(e){
          $('#btn_save').show()
          $('#btn_loading').hide()
          errortoast('Terjadi Kesalahan')
      }
    })
    // $('#btn_save').show()
    // $('#btn_loading').hide()
  })



    function openReceipt(id){
        $('#div_reservasi_detail').html('')
        $('#div_reservasi_detail').append(divLoaderNavy)
        $('#div_reservasi_detail').load('<?=base_url('reservasi/C_Reservasi/openDetailAdministrasiReservasi/')?>'+id, function(){
            $('#loader').hide()
        })
    }

</script>