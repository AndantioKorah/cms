<?php if($result){ ?>
    <div class="col-12">
        <h6>LIST BIDANG VERIFIKASI:</h6>
        <table class="table table-hover table-striped" style="width:100%;" id="data_table_verif_bidang">
            <thead>
                <th class="text-center">No</th>
                <th>Nama Bidang</th>
                <th>Pilihan</th>
            </thead>
            <tbody>
                <?php $no = 1; foreach($result as $rs){ ?>
                    <tr>
                        <td align="center"><?=$no++;?></td>
                        <td><?=$rs['nama_bidang'];?></td>
                        <td>
                            <button type="button" onclick="hapus('<?=$rs['id_t_verif_tambahan']?>')" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Hapus</button>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <script>
        $(function(){
            let table = $('#data_table_verif_bidang').DataTable({
                responsive: false
            });
            $('[data-tooltip="tooltip"]').tooltip();
        })


        function hapus(id){
            if(confirm('Apakah Anda yakin ingin menghapus data ini ?')){
                $.ajax({
                    url: '<?=base_url("user/C_User/deleteVerifBidang/")?>'+id,
                    method: 'post',
                    data: null,
                    success: function(){
                        refreshListVerifBidang()
                    }, error: function(e){
                        alert('Terjadi Kesalahan')
                    }
                })   
            }
        }
    </script>
<?php } ?>