<?php if($result){ ?>
    <div class="col-lg-12 table-responsive">
        <table class="table table-hover data_table table-striped">
            <thead>
                <th class="text-center">No</th>
                <th style="width:30%;"  class="">Jenis Pelayanan</th>
                <th style="width:30%;" class="">Keterangan</th>
                <th  class="">Jenis Laboratorium</th>
                <th class="text-center">Pilihan</th>
            </thead>
            <tbody>
                <?php $no=1; foreach($result as $rs){ ?>
                    <tr>
                        <td class="text-center"><?=$no++;?></td>
                        <td class=""><?=$rs['nama_jenis_pelayanan'];?></td>
                        <td class=""><?=$rs['keterangan'];?></td>
                        <td class="">
                      
                        <div class="form-group">
                            
                        <select onchange="updateLab(<?=$rs['id']?>)" style="width:170px;" class="form-control form-control-sm" id="jenisLab_<?=$rs['id']?>">
                        <option ></option>
                        <?php  foreach($lab as $l){ ?>
                                <option <?= $rs['id_m_lab'] == $l['id'] ? 'selected' : '' ?> value="<?=$l['id']?>"><?=$l['nama_lab']?></option>
                            <?php }  ?>
                        </select>
                    </div>
                        </td>
                        <td class="text-center">
                            <button data-toggle="modal" href="#modal_set_role" onclick="setRole('<?=$rs['id']?>')" class="btn btn-info btn-sm"><i class="fa fa-user"></i> 
                        Role</button>

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
    <div class="modal fade" id="modal_set_role" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content" id="modal_set_role_content"></div>
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
        function setRole(id){
            $('#modal_set_role_content').html('')
            $('#modal_set_role_content').append(divLoaderNavy)
            $('#modal_set_role_content').load('<?=base_url('master/C_Master/loadRoleJenisPelayanan/')?>'+id, function(){
                $('#loader').hide()
            })
        }
    </script>
<?php } else { ?>
    <div class="col-12 text-center">
        <h5>Data Tidak Ditemukan <i class="fa fa-exclamation"></i></h5>
    </div>
<?php } ?>

    <script type="text/javascript">
function updateLab(id){
  
    var jenis_lab =  $('#jenisLab_'+id).val();
  $.ajax({
                    url: '<?=base_url("master/C_Master/updateJenisLab")?>',
                    method: 'post',
                    data: {
                        'jenis_lab' : jenis_lab,
                        'id' : id
                    },
                    success: function(res){
                        let rs = JSON.parse(res)
                        if(rs.code == 0){
                            successtoast('Berhasil ')
                            $('#jenisLab_'+id).val(jenis_lab)
                            // setTimeout(loadListParameter, 200);  
                        } else {
                            errortoast(rs.message)
                        }
                    }, error: function(e){
                        errortoast('Terjadi Kesalahan')
                    }
                })
}
</script>