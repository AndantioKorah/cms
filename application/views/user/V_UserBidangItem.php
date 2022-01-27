<div class="row p-3">
    <?php if($rs['id_m_sub_bidang'] != 0){ ?>
        <table class="table table-hover table-striped">
            <thead>
                <th>Bidang</th>
                <th>Sub Bidang</th>
                <th>Pilihan</th>
            </thead>
            <tbody>
                <tr>
                    <td><?=strtoupper($rs['nama_bidang'])?></td>
                    <td><?=strtoupper($rs['nama_sub_bidang'])?></td>
                    <td>
                        <button onclick="deleteUserBidang('<?=$rs['id_m_user']?>')" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Hapus</button>
                    </td>
                </tr>
            </tbody>
        </table>
    <?php } else { ?>
        <div class="col-12 text-center">
            <h5><i class="fa fa-exclamation"></i> User ini belum ditentukan Bidang</h5>
        </div>
    <?php } ?>
</div>

<script>
    function deleteUserBidang(id){
        if(confirm('Apakah Anda yakin ingin menghapus Bidang?')){
            $.ajax({
                url: '<?=base_url("user/C_User/deleteUserBidang")?>'+'/'+id,
                method: 'post',
                data: $(this).serialize(),
                success: function(data){
                    successtoast('Berhasil menghapus Sub Bidang pada User')
                    $('#label_bidang_<?=$rs['id_m_user']?>').html('')
                    refreshSubBidang()
                }, error: function(e){
                    errortoast('Terjadi Kesalahan')
                }
            })
        }
    }
</script>