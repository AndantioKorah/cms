<div class="row">
    <?php if($rs['id_m_bidang'] != 0){ ?>
        <div class="col-12">
            Bidang:
        </div>
        <div class="col-10 text-center">
            <h5><?=strtoupper($rs['nama_bidang'])?></h5>
        </div>
        <div class="col-2">
            <button onclick="deleteUserBidang('<?=$rs['id_m_user']?>')" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Hapus</button>
        </div>
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
                    successtoast('Berhasil menghapus Bidang pada User')
                    $('#label_bidang_<?=$rs['id_m_user']?>').html('')
                    refreshBidang()
                }, error: function(e){
                    errortoast('Terjadi Kesalahan')
                }
            })
        }
    }
</script>