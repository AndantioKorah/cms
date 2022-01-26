<?php if($list_kegiatan){ ?>
    <div class="col-12">
        <table class="table table-hover table-striped" id="table_master_bidang">
            <thead>
                <th class="text-center">No</th>
                <th class="text-left">Tanggal Kegiatan</th>
                <th class="text-left">Deskripsi Kegiatan</th>
                <th class="text-center">Dokumen Bukti Kegiatan</th>
                <th></th>
            </thead>
            <tbody>
            <?php $no=1; foreach($list_kegiatan as $lp){ ?>
                    <tr>
                        <td class="text-center"><?=$no++;?></td>
                        <td class="text-left"><?=$lp['tanggal_kegiatan']?></td>
                        <td class="text-left"><?=$lp['deskripsi_kegiatan']?></td>
                        <td class="text-center">  
                        <a class="btn btn-sm btn-success" href="<?= base_url('assets/bukti_kegiatan/'.$lp['bukti_kegiatan'].'');?>" target="_blank"><i class="fa fa-file"> Lihat</i></a>

                        </td>
                        
                        <td class="text-center">
                            <button onclick="deleteKegiatan('<?=$lp['id']?>')" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Hapus</button>
                        </td>
                        
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <script>

        function deleteKegiatan(id){
           
            if(confirm('Apakah Anda yakin ingin menghapus data?')){
                $.ajax({
                    url: '<?=base_url("kinerja/C_Kinerja/deleteKegiatan/")?>'+id,
                    method: 'post',
                    data: null,
                    success: function(){
                        successtoast('Data sudah terhapus')
                        loadListKegiatan()
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