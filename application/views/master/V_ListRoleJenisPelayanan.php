<?php if($result){ ?>
    <table class="table table-striped table-hover data_table">
        <thead>
            <th class="text-center">No</th>
            <th class="text-center">Role</th>
            <th class="text-center">Nomor Urut</th>
            <th class="text-center">Pilihan</th>
        </thead>
        <tbody>
            <?php $no=1; foreach($result as $rs){ ?>
                <tr>
                    <td class="text-center"><?=$no++;?></td>
                    <td class="text-center"><?=$rs['nama']?></td>
                    <td class="text-center"><?=$rs['no_urut']?></td>
                    <td class="text-center">
                        <button onclick="deleteRole('<?=$rs['id']?>')" id="btn_save_<?=$rs['id']?>" class="btn btn-sm btn-danger" ><i class="fa fa-save"></i> Hapus</button>
                        <button style="display: none;" disabled id="btn_save_loading_<?=$rs['id']?>" class="btn btn-sm btn-danger" type="submit"><i class="fa fa-spin fa-spinner"></i> Menghapus...</button>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <script>
        $(function(){
            $('.data_table').dataTable()
        })

        function deleteRole(id){
            $('#btn_save_'+id).hide()
            $('#btn_save_loading_'+id).show()
            if(confirm('Apakah Anda yakin ingin menghapus Role?')){
                $.ajax({
                    url: '<?=base_url("master/C_Master/deleteRoleJenisPelayanan/")?>'+id,
                    method: 'post',
                    data:$(this).serialize(),
                    success: function(res){
                        let rs = JSON.parse(res)
                        if(rs.code == 0){
                            successtoast('Data berhasil dihapus')
                            loadListRole()
                            $('#btn_save_'+id).show()
                            $('#btn_save_loading_'+id).hide()
                        } else {
                            errortoast(rs.message)
                            $('#btn_save_'+id).show()
                            $('#btn_save_loading_'+id).hide()
                        }
                    }, error: function(e){
                        errortoast('Terjadi Kesalahan')
                    }
                })
            }
        }
    </script>
<?php } else { ?>
    <div class="text-center">
        <h5>Role Belum Ada <i class="fa fa-exclamation"></i></h5>
    </div>
<?php } ?>