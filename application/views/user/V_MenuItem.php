<?php if($result){ ?>
    <div class="col-12">
        <table class="table table-hover table-striped" style="width:100%;" id="data_table">
            <thead>
                <th class="text-center">No</th>
                <th>Nama Menu</th>
                <th>URL</th>
                <th>Parent</th>
                <th>Icon</th>
                <th>Menu Admin</th>
                <th>Keterangan</th>
                <?php if($this->general_library->isProgrammer()) { ?>
                    <th>Pilihan</th>
                <?php } ?>
            </thead>
            <tbody>
                <?php $no = 1; foreach($result as $rs){ ?>
                    <tr>
                        <td align="center"><?=$no++;?></td>
                        <td><?=$rs['nama_menu'];?></td>
                        <td><?=$rs['url'];?></td>
                        <td><?=$rs['nama_menu_parent'];?></td>
                        <td><i class="<?=$rs['icon'] ? $rs['icon'] : 'far fa-circle'?>"></i> <?=$rs['icon'] ? $rs['icon'] : 'default-icon';?></td>
                        <td><?=$rs['flag_menu_admin'] == 1 ? 'Ya' : 'Tidak';?></td>
                        <td><?=$rs['keterangan'];?></td>
                        <?php if($this->general_library->isProgrammer()) { ?>
                            <td>
                                <div class="btn-group">
                                    <button style="display: <?=$rs['flag_general_menu'] == 0 ?  'block' : 'none'?>;" id="btn_general_menu_<?=$rs['id']?>" type="button" onclick="setGeneralMenu('<?=$rs['id']?>')" class="btn btn-sm btn-info"
                                    data-tooltip="tooltip" title="Atur Sebagai Menu General"><i class="fa fa-check"></i></button>

                                    <button disabled style="display: none;" id="btn_loading_general_menu_<?=$rs['id']?>" type="button" class="btn btn-sm btn-info"
                                    data-tooltip="tooltip" title="Loading..."><i class="fa fa-spin fa-spinner"></i> Loading...</button>

                                    <button style="display: <?=$rs['flag_general_menu'] == 1 ?  'block' : 'none'?>;;" id="btn_cancel_general_menu_<?=$rs['id']?>" type="button" onclick="cancelGeneralMenu('<?=$rs['id']?>')" class="btn btn-sm btn-danger"
                                    data-tooltip="tooltip" title="Hapus dari General Menu"><i class="fa fa-times"></i></button>

                                    <button type="button" data-toggle="modal" href="#add_role_modal" onclick="openAddRoleModal('<?=$rs['id']?>')" class="btn btn-sm btn-warning"
                                    data-tooltip="tooltip" title="Tambah Role"><i class="fa fa-user"></i></button>
                                    
                                    <button type="button" onclick="hapus('<?=$rs['id']?>')" class="btn btn-sm btn-danger"
                                    data-tooltip="tooltip" title="Hapus menu"><i class="fa fa-trash"></i></button>
                                </div>
                            </td>
                        <?php } ?>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <div class="modal fade" id="add_role_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div id="modal-dialog" class="modal-dialog modal-xl">
            <div class="modal-content">
                <div id="add_role_modal_content">
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

        function openAddRoleModal(id){
            $('#add_role_modal_content').html('')
            $('#add_role_modal_content').append(divLoaderNavy)
            $('#add_role_modal_content').load('<?=base_url("user/C_User/addRoleForMenu")?>'+'/'+id, function(){

            })
        }

        function setGeneralMenu(id){
                $('#btn_loading_general_menu_'+id).show()
                $('#btn_general_menu_'+id).hide()
                $.ajax({
                    url: '<?=base_url("user/C_User/setGeneralMenu/")?>'+id,
                    method: 'post',
                    data: null,
                    success: function(){
                        successtoast('Update Berhasil')
                        $('#btn_loading_general_menu_'+id).hide()
                        $('#btn_cancel_general_menu_'+id).show()
                    }, error: function(e){
                        errortoast('Terjadi Kesalahan')
                    }
                })
        }

        function cancelGeneralMenu(id){
                $('#btn_loading_general_menu_'+id).show()
                $('#btn_cancel_general_menu_'+id).hide()
                $.ajax({
                    url: '<?=base_url("user/C_User/setGeneralMenu/")?>'+id,
                    method: 'post',
                    data: null,
                    success: function(){
                        successtoast('Update Berhasil')
                        $('#btn_loading_general_menu_'+id).hide()
                        $('#btn_general_menu_'+id).show()
                    }, error: function(e){
                        errortoast('Terjadi Kesalahan')
                    }
                })
        }

        function hapus(id){
            if(confirm('Apakah Anda yakin ingin menghapus data ini ?')){
                $.ajax({
                    url: '<?=base_url("user/C_User/deleteMenu/")?>'+id,
                    method: 'post',
                    data: null,
                    success: function(){
                        window.location=""
                        // loadMenu()
                    }, error: function(e){
                        alert('Terjadi Kesalahan')
                    }
                })   
            }
        }
    </script>
<?php } else { ?>
    <div class="col-12 text-center"><h6>Belum ada Data Menu</h6></div>
<?php } ?>