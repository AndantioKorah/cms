<?php if($result){ ?>
    <div class="col-lg-12 table-responsive">
        <table class="table table-hover data_table table-striped">
            <thead>
                <th class="text-center">No</th>
                <th class="">Jenis Pelayanan</th>
                <th class="">Keterangan</th>
                <th class="text-center">Pilihan</th>
            </thead>
            <tbody>
                <?php $no=1; foreach($result as $rs){ ?>
                    <tr>
                        <td class="text-center"><?=$no++;?></td>
                        <td class=""><?=$rs['nama_jenis_pelayanan'];?></td>
                        <td class=""><?=$rs['keterangan'];?></td>
                        <td class="text-center">
                            <button data-toggle="modal" href="#modal_set_parameter" onclick="setParameter('<?=$rs['id']?>')" class="btn btn-navy btn-sm"><i class="fa fa-edit"></i> Parameter</button>
                            <button id="btn_delete_<?=$rs['id']?>" onclick="deleteData('<?=$rs['id']?>')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Hapus</button>
                            <button style="display: none;" disabled id="btn_loading_delete_<?=$rs['id']?>" class="btn btn-danger btn-sm"><i class="fa fa-spin fa-spinner"></i> Menghapus....</button>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <div class="modal fade" id="modal_set_parameter" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
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
                    url: '<?=base_url("master/C_Master/deleteMasterJenisPelayanan")?>'+'/'+id,
                    method: 'post',
                    data: null,
                    success: function(res){
                        let rs = JSON.parse(res)
                        if(rs.code == 0){
                            successtoast('Data berhasil dihapus')
                            loadMasterJenisPelayanan()
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

        function setParameter(id){
            $('#modal_set_parameter_content').html('')
            $('#modal_set_parameter_content').append(divLoaderNavy)
            $('#modal_set_parameter_content').load('<?=base_url('master/C_Master/loadParameterJenisPelayanan/')?>'+id, function(){
                $('#loader').hide()
            })
        }
    </script>
<?php } else { ?>
    <div class="col-12 text-center">
        <h5>Data Tidak Ditemukan <i class="fa fa-exclamation"></i></h5>
    </div>
<?php } ?>