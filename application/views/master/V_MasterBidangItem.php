<?php if($list_master_bidang){ ?>
    <div class="col-12">
        <table class="table table-hover table-striped" id="table_master_bidang">
            <thead>
                <th class="text-center">No</th>
                <th class="text-left">SKPD</th>
                <th class="text-left">Bidang/Bagian</th>
                <th class="text-center">Pilihan</th>
            </thead>
            <tbody>
                <?php $no=1; foreach($list_master_bidang as $lp){ ?>
                    <tr>
                        <td class="text-center"><?=$no++;?></td>
                        <td class="text-left"><?=$lp['nm_unitkerja']?></td>
                        <td class="text-left"><?=$lp['nama_bidang']?></td>
                        <td class="text-center">
                            <button onclick="deleteMasterBidang('<?=$lp['id']?>')" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Hapus</button>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <script>
        $(function(){
            $('#table_master_bidang').DataTable({
                responsive: false
            });
        })

        function deleteMasterBidang(id){
            if(confirm('Apakah Anda yakin ingin menghapus data?')){
                $.ajax({
                    url: '<?=base_url("master/C_Master/deleteMasterBidang/")?>'+id,
                    method: 'post',
                    data: null,
                    success: function(){
                        successtoast('Data sudah terhapus')
                        loadMasterBidang()
                    }, error: function(e){
                        errortoast('Terjadi Kesalahan')
                    }
                })
            }
        }
    </script>
<?php } else { ?>
    <div class="row">
        <div class="col-12">
            <h5 style="text-center">DATA TIDAK DITEMUKAN <i class="fa fa-exclamation"></i></h5>
        </div>
    </div>
<?php } ?>