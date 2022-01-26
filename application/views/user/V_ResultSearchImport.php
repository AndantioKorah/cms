<?php
    if($result){
?>
    <table class="table table-hover table-striped table-sm data_table_result_search_import">
        <thead>
            <th class="text-center">No</th>
            <th>NIP</th>
            <th>Nama Pegawai</th>
            <th>SKPD</th>
            <th class="text-center">Pilihan</th>
        </thead>
        <?php $no = 1; foreach($result as $lr){ ?>
            <tr>
                <td class="text-center"><?=$no?></td>
                <td><?=formatnip($lr['nipbaru_ws'])?></td>
                <td><?=$lr['gelar1'].''.$lr['nama'].$lr['gelar2']?></td>
                <td><?=$lr['nm_unitkerja']?></td>
                <td class="text-center">
                    <?php
                        if($lr['flag_user_created'] == 1){
                            echo "<label style='color: red;'>User sudah dibuat</label>";
                        } else {
                            ?>
                            <button id="btn_create_<?=$lr['nipbaru_ws']?>" class="btn btn-sm btn-navy" onclick="createUserImport('<?=$lr['nipbaru_ws']?>')"><i class="fa fa-plus"></i> Buat User</button>
                            <button style="display: none;" id="btn_loading_<?=$lr['nipbaru_ws']?>" disabled class="btn btn-sm btn-navy"><i class="fa fa-spin fa-spinner"></i> Loading...</button>
                            <?php
                        }
                    ?>
                </td>
            </tr>
        <?php $no++; } ?>
    </table>
<?php } else { ?>
    <center><label><i class="fa fa-exclamation"></i> Data Tidak Ditemukan</label></center>
<?php } ?>
<script>
    $(function(){
        let table = $('.data_table_result_search_import').DataTable({
            responsive: false
        });
        $('[data-tooltip-role="tooltip"]').tooltip();
    })

    function createUserImport(nip){
        $('#btn_create_'+nip).hide()
        $('#btn_loading_'+nip).show()
        $.ajax({
            url: '<?=base_url("user/C_User/createUserImport")?>'+'/'+nip,
            method: 'post',
            data: null,
            success: function(rs){
                let resp = JSON.parse(rs)
                if(resp.code == 0){
                    successtoast(resp.message)
                    loadUsers()
                    $('#form_search_pegawai_new_user').submit()
                } else {
                    errortoast(resp.message)
                }
            }, error: function(e){
                errortoast('Terjadi Kesalahan')
            }
        })
    }
</script>