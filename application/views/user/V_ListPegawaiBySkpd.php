<?php if($list_pegawai){ ?>
    <div class="row">
        <div class="col-12">
            <table class="table table-hover table-striped" id="dt_table_list_pegawai">
                <thead>
                    <th class="text-center">No</th>
                    <th class="text-center">NIP</th>
                    <th>Nama Pegawai</th>
                    <th>Keterangan</th>
                </thead>
                <tbody>
                    <?php $no = 1; foreach($list_pegawai as $lp){ ?>
                        <tr>
                            <td class="text-center"><?=$no++;?></td>
                            <td class="text-center"><?=$lp['nipbaru_ws']?></td>
                            <td><?=getNamaPegawaiFull($lp)?></td>
                            <td class="text-center">
                                <?php if($lp['flag_user_created'] == 0) { ?>
                                    <h6 style="padding: 5px; border-radius: 2px; background-color: red; color: white;"><i class="fa fa-times"></i> User Belum Terdaftar</h6>
                                <?php } else { ?>
                                    <h6 style="padding: 5px; border-radius: 2px; background-color: green; color: white;"><i class="fa fa-check"></i> User Sudah Ada</h6>
                                <?php } ?>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <div class="col-8">
        </div>
        <div class="col-4 text-right">
            <button disabled style="display: none;" id="btn_loading_create_user" class="btn btn-navy btn-block"><i class="fa fa-spin fa-spinner"></i> Loading</button>
            <button id="btn_create_user" class="btn btn-navy btn-block"><i class="fa fa-up-from-line"></i> Buat User</button>
        </div>
    </div>
    <script>
        $(function(){
            $('#dt_table_list_pegawai').dataTable()
        })

        $('#btn_create_user').on('click', function(){
            $('#btn_loading_create_user').show()
            $('#btn_create_user').hide()
            $.ajax({
            url: '<?=base_url("user/C_User/importPegawaiByUnitKerja")?>'+'/'+'<?=$list_pegawai[0]['skpd']?>',
            method: 'post',
            data: null,
            success: function(data){
                let resp = JSON.parse(data)
                if(resp['code'] != 1){
                    successtoast(resp['message'])
                    searchBySkpd()
                } else {
                    errortoast(resp['message'])
                }
            }, error: function(e){
                errortoast('Terjadi Kesalahan')
            }
        })
        })
    </script>
<?php } else { ?>
    <h5 class="text-center">DATA TIDAK DITEMUKAN <i class="fa fa-exclamation"></i></h5>
<?php } ?>
