<style>
  .right_side_div{
    background-color: white;
    border-radius: 5px;
    max-height: 50vh;
    width: 100%;
    padding-left: 10px !important;
    padding-right: 10px !important;
    box-shadow: 3px 3px 16px 0px rgba(0,0,0,0.56);
    -webkit-box-shadow: 3px 3px 16px 0px rgba(0,0,0,0.56);
    -moz-box-shadow: 3px 3px 16px 0px rgba(0,0,0,0.56);
    overflow-y: auto;
  }

  #reservasi{
    padding-top: 10px !important;
  }

  .title-layanan{
    font-size: 16px;
    font-weight: bold;
  }

  .form-check-choose{
    cursor: pointer;
  }

  .total_biaya_temp{
    font-size: 20px;
    font-weight: bold;
  }
</style>
<main id="main">
  <section id="breadcrumbs" class="breadcrumbs">
    <div class="container-fluid">

      <div class="d-flex justify-content-between align-items-center">
        <h2>Reservasi</h2>
        <ol>
          <li><a href="<?=base_url('')?>"><?=$this->lang->line('home')?></a></li>
          <li><a>Reservasi</a></li>
        </ol>
      </div>
    </div>
  </section>

  <section id="reservasi" class="reservasi">
    <div class="container-fluid">
      <div class="row mb-3" style="min-height: 54vh;">
        <div class="col-lg-8 col-md-12 mb-3" style="
        background-color: white;
        border-radius: 5px;
        padding: 10px;
        ">
          <form id="form_reservasi">
            <div class="row">
              <div class="col-lg-12">
                <div class="form-group">
                  <input style="display: none;" id="session_id" name="session_id" value="<?=generateRandomNumber(4).date('Ymdhis')?>" />
                  <label class="title-layanan">Pilih Jenis Layanan</label>
                    <select required class="form-control select2_this select2-navy" data-dropdown-css-class="select2-navy" name="id_m_jenis_pelayanan" id="id_m_jenis_pelayanan">
                        <?php if($layanan){ foreach($layanan as $l){ ?>
                            <option value="<?=$l['id']?>"><?=$l['nama_jenis_pelayanan']?></option>
                        <?php } } ?>
                    </select>
                </div>
                <div class="col-lg-12 mt-3 div_parameter">
                </div>
              </div>
            </div>
          </form>
        </div>
        <div class="col-lg-4 col-md-12" id="div_receipt" style="display: none;">
          <div class="row right_side_div">
              <div class="col-lg-12 text-center p-3">
                <span style="font-size: 15px; font-weight: bold;">BIAYA LAYANAN RESERVASI</span>
              </div>
              <div class="col-lg-12 p-3" id="receipt">
              </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12">
          <hr>
        </div>
        <div class="col-lg-12">
          <div class="row">
            <form id="form_search_nomor_tiket">
              <div class="col-lg-12">
                <div class="row">
                  <div class="col-lg-4"></div>
                  <div class="col-lg-4 form-group text-center">
                      <label class="title-layanan">Masukkan No. Tiket Anda :</label>
                      <input autocomplete="off" class="form-control" type="text" name="search_nomor_tiket" />
                  </div>
                  <div class="col-lg-4 form-group">
                    <button id="btn_search_no_tiket" type="submit" style="margin-top: 24px;" class="btn btn-primary-color"><i class="fa fa-search"></i> Cari</button>
                    <button id="btn_loading_no_tiket" disabled style="margin-top: 24px; display: none;" class="btn btn-primary-color"><i class="fa fa-spin fa-spinner"></i> Loading...</button>
                  </div>
                </div>
              </div>
              <div class="col-lg-12 mt-3" id="nomor_tiket_search_result">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>

</main>

<div class="modal fade" id="modal_final_receipt" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div id="modal-dialog" class="modal-dialog modal-xl">
		<div class="modal-content" id="content_modal_final_receipt">
		</div>
	</div>
</div>

<script>
  let total_biaya = 0
  $(function(){
      // $('#id_m_jenis_pelayanan').select2()
      searchParameter()
      // refreshReceipt()
  })

  $('#id_m_jenis_pelayanan').on('change', function(){
    searchParameter()
  })

  $('#form_search_nomor_tiket').on('submit', function(e){
    e.preventDefault()
    $('#btn_search_no_tiket').hide()
    $('#btn_loading_no_tiket').show()
    $.ajax({
      url: '<?=base_url("webcp/reservasi/C_Reservasi/searchNomorTiket")?>',
      method: 'post',
      data: $(this).serialize(),
      success: function(res){
        $('#btn_search_no_tiket').show()
        $('#btn_loading_no_tiket').hide()
        $('#nomor_tiket_search_result').html('')
        $('#nomor_tiket_search_result').append(res)
      }, error: function(e){
          $('#btn_search_no_tiket').show()
          $('#btn_loading_no_tiket').hide()
          errortoast('Terjadi Kesalahan')
      }
    })
  })

  function refreshReceipt(){
    // $('#receipt').html('')
    // $('#receipt').append(divLoaderNavy)
    $('#receipt').load('<?=base_url('webcp/reservasi/C_Reservasi/refreshReceipt/')?>'+$('#session_id').val(), function(){
      $('#loader').hide()
    })
    $('#div_receipt').show()
  }

  function searchParameter(){
    $('.div_parameter').html('')
    $('.div_parameter').append(divLoaderNavy)
    $('.div_parameter').load('<?=base_url('webcp/reservasi/C_Reservasi/getParameterByJenisLayanan/')?>'+$('#id_m_jenis_pelayanan').val(), function(){
      $('#loader').hide()
    })
  }

  $('#form_reservasi').on('submit', function(e){
    $('#btn_save').hide()
    $('#btn_loading').show()
    e.preventDefault()
    $.ajax({
      url: '<?=base_url("webcp/reservasi/C_Reservasi/formAddParameter")?>',
      method: 'post',
      data:$(this).serialize(),
      success: function(res){
          let rs = JSON.parse(res)
          if(rs.code == 0){
              successtoast('Data berhasil ditambahkan')
              refreshReceipt()
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
</script>