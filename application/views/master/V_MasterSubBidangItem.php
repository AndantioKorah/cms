<?php if($list_master_sub_bidang){ ?>
    <div class="col-12">
        <table class="table table-hover table-striped" id="table_master_sub_bidang">
            <thead>
                <th class="text-center">No</th>
                <th class="text-left">Bidang</th>
                <th class="text-left">Sub Bidang</th>
                <th class="text-center">Pilihan</th>
            </thead>
            <tbody>
                <?php $no=1; foreach($list_master_sub_bidang as $lp){ ?>
                    <tr>
                        <td class="text-center"><?=$no++;?></td>
                        <td class="text-left"><?=$lp['nama_bidang']?></td>
                        <td class="text-left"><?=$lp['nama_sub_bidang']?></td>
                        <td class="text-center">
                            <button onclick="deleteMasterSubBidang('<?=$lp['id_m_sub_bidang']?>')" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Hapus</button>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <script>
        $(function(){
            $('#table_master_sub_bidang').DataTable({
                responsive: false
            });
        })

        function deleteMasterSubBidang(id){
            if(confirm('Apakah Anda yakin ingin menghapus data?')){
                $.ajax({
                    url: '<?=base_url("master/C_Master/deleteMasterSubBidang/")?>'+id,
                    method: 'post',
                    data: null,
                    success: function(){
                        successtoast('Data sudah terhapus')
                        loadMasterSubBidang()
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
