<?php if($result){ ?>
    <div class="col-lg-12 table-responsive">
        <table class="table table-hover data_table table-striped">
            <thead>
                <th class="text-center">No</th>
                <th class="">Nama</th>
                <th class="">Alamat</th>
                <th class="">No HP</th>
                <th class="text-center">Pilihan</th>
            </thead>
            <tbody>
                <?php $no=1; foreach($result as $rs){ ?>
                    <tr>
                        <td class="text-center"><?=$no++;?></td>
                        <td class=""><?=$rs['nama'];?></td>
                        <td class=""><?=$rs['alamat'];?></td>
                        <td class=""><?=$rs['no_hp'];?></td>
                        <td class="text-center">
                        <button data-toggle="modal" href="#modal_data_pelanggan" onclick="editPelanggan('<?=$rs['id']?>')" class="btn btn-sm btn-warning text-white"><i class="fa fa-edit"></i> Edit</button>
                                    <button id="btn_delete_<?=$rs['id']?>" onclick="deleteData('<?=$rs['id']?>')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Hapus</button>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <div class="modal fade" id="modal_set_pelanggan" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content" id="modal_set_parameter_content"></div>
        </div>
    </div>
   
    <script>
        $(function(){
            $('.data_table').dataTable()
        })

        function deleteData(id){
            if(confirm('Apakah Anda yakin ingin menghapus data?')){
                $('#btn_delete_'+id).hide()
                $('#btn_loading_delete_'+id).show()
                $.ajax({
                    url: '<?=base_url("master/C_Master/deleteMasterPelanggan")?>'+'/'+id,
                    method: 'post',
                    data: null,
                    success: function(res){
                        let rs = JSON.parse(res)
                        if(rs.code == 0){
                            successtoast('Data berhasil dihapus')
                            loadMasterPelanggan()
                            $('#btn_delete_'+id).hide()
                            $('#btn_loading_delete_'+id).show()
                        } else {
                            errortoast(rs.message)
                            $('#btn_delete_'+id).hide()
                            $('#btn_loading_delete_'+id).show()
                        }
                    }, error: function(e){
                        errortoast('Terjadi Kesalahan')
                    }
                })
            }
        }

        function editPelanggan(id){
            $('#modal_data_pelanggan_edit').html('')
            $('#modal_data_pelanggan_edit').append(divLoaderNavy)
            $('#modal_data_pelanggan_edit').load('<?=base_url('master/C_Master/loadDetailPelanggan')?>'+'/'+id, function(){
                $('#loader').hide()
            })
        }

    </script>
<?php } else { ?>
    <div class="col-12 text-center">
        <h5>Data Tidak Ditemukan <i class="fa fa-exclamation"></i></h5>
    </div>
<?php } ?>