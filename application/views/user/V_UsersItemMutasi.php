<?php if($result){ ?>
    <div class="col-12">
        <table class="table table-hover table-striped" style="width:100%;" id="data_table">
            <thead>
                <th class="text-center">No</th>
                <th>Nama</th>
                <th>Unit Kerja</th>   
                <th>Pilihan</th>
            </thead>
            <tbody>
                <?php $no = 1; foreach($result as $rs){ ?>
                    <tr>
                        <td align="center"><?=$no++;?></td>
                        <td><?=$rs['nama_user'];?></td>
                        <td><?=$rs['nm_unitkerja'];?></td>
                       
                        <td>
                            <button type="button" data-toggle="modal" href="#mutasi_pegawai_modal" onclick="openMutasiPegawaiModal('<?=$rs['id_peg']?>')" class="btn btn-sm btn-info"
                           ><i class="fa fa-arrow-circle-right"></i> Mutasi Pegawai</button>
                            <button type="button" data-toggle="modal" href="#riwayat_mutasi_modal" onclick="openRiwayatMutasiModal('<?=$rs['id_peg']?>')" class="btn btn-sm btn-warning"
                            ><i class="fa fa-history"></i> Riwayat Mutasi</button>
              
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <div class="modal fade" id="mutasi_pegawai_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div id="modal-dialog" class="modal-dialog modal-xl">
      <div class="modal-content">
          <div class="modal-header">
              <h6 class="modal-title">MUTASI PEGAWAI</h6>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div id="mutasi_pegawai_modal_content">
          </div>
      </div>
  </div>
</div>


<div class="modal fade" id="riwayat_mutasi_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div id="modal-dialog" class="modal-dialog modal-xl">
      <div class="modal-content">
          <div class="modal-header">
              <h6 class="modal-title">RIWAYAT MUTASI</h6>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div id="riwayat_mutasi_modal_content">
          </div>
      </div>
  </div>
</div>


    <script>
        $(function(){
            let table = $('#data_table').DataTable({
                responsive: false
            });
            $('[data-tooltip="tooltip"]').tooltip();
        })

        function openMutasiPegawaiModal(id){
            $('#mutasi_pegawai_modal_content').html('')
            $('#mutasi_pegawai_modal_content').append(divLoaderNavy)
            $('#mutasi_pegawai_modal_content').load('<?=base_url("user/C_User/openMutasiPegawaiModal")?>'+'/'+id, function(){

            })
        }

        function openRiwayatMutasiModal(id){
            $('#riwayat_mutasi_modal_content').html('')
            $('#riwayat_mutasi_modal_content').append(divLoaderNavy)
            $('#riwayat_mutasi_modal_content').load('<?=base_url("user/C_User/openRiwayatMutasiModal")?>'+'/'+id, function(){

            })
        }


        function hapus(id){
            if(confirm('Apakah Anda yakin ingin menghapus data ini ?')){
                $.ajax({
                    url: '<?=base_url("user/C_User/deleteUser/")?>'+id,
                    method: 'post',
                    data: null,
                    success: function(){
                        loadUsers()
                    }, error: function(e){
                        alert('Terjadi Kesalahan')
                    }
                })   
            }
        }
    </script>
<?php } else { ?>
    <div class="col-12 text-center">
        <h5>DATA TIDAK DITEMUKAN !</h5>
    </div>
<?php } ?>