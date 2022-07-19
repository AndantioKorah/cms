<?php if($result){ ?>
    <table class="table" id="table_master_parameter">
        <thead>
            <th class="text-center">No</th>
            <th class="text-left">Parameter Name</th>
            <th class="text-left">Parameter Value</th>
            <th class="text-center">Pilihan</th>
        </thead>
        <tbody>
            <?php $no = 1; foreach($result as $rs){ ?>
                <tr>
                    <td style="width: 5%" class="text-center"><?=$no++;?></td>
                    <td style="width: 20%" class="text-left"><?=$rs['parameter_name']?></td>
                    <td style="width: 55%" class="text-left"><?=$rs['parameter_value']?></td>
                    <td style="width: 20%" class="text-center">
                        <button data-toggle="modal" href="#modal_data_parameter" onclick="editParameter('<?=$rs['id']?>')" class="btn btn-sm btn-warning text-white"><i class="fa fa-edit"></i> Edit</button>
                        <button onclick="deleteParameter('<?=$rs['id']?>')" id="btn_delete_<?=$rs['id']?>" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Hapus</button>
                        <button disabled style="display: none;" id="btn_loading_<?=$rs['id']?>" class="btn btn-sm btn-danger"><i class="fa fa-spin fa-spinner"></i> Menghapus....</button>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    
    <script>
        $(function(){
            $('#table_master_parameter').dataTable()
        })

        function editParameter(id){
            $('#modal_data_parameter_content').html('')
            $('#modal_data_parameter_content').append(divLoaderNavy)
            $('#modal_data_parameter_content').load('<?=base_url('master/C_Master/loadDetailParameter')?>'+'/'+id, function(){
                $('#loader').hide()
            })
        }

        function deleteParameter(id){
            if(confirm('Apakah Anda yakin?')){
                $('#btn_loading_'+id).show()
                $('#btn_delete_'+id).hide()
                $.ajax({
                    url: '<?=base_url("master/C_Master/deleteMasterParameter")?>'+'/'+id,
                    method: 'post',
                    data: $(this).serialize(),
                    success: function(){
                        successtoast('Data berhasil dihapus')
                        loadMasterParameter()
                        $('#btn_loading_'+id).hide()
                        $('#btn_delete_'+id).show()
                    }, error: function(e){
                        $('#btn_loading_'+id).hide()
                        $('#btn_delete_'+id).show()
                        errortoast('Terjadi Kesalahan')
                    }
                })
            }
        }
    </script>
<?php } else { ?>
    <div class="col-12 text-center">
        <h5>Data Tidak Ditemukan <i class="fa fa-exclamation"></i></h5>
    </div>
<?php } ?>