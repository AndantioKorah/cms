<?php if($list_rencana_kinerja){ ?>
    <div class="col-12">
        <table class="table table-hover table-striped" id="table_master_bidang">
            <thead>
                <th class="text-center">No</th>
                <th class="text-left">Kegiatan Tugas Jabatan</th>
                <th class="text-left">Tahun</th>
                <th class="text-left">Bulan</th>
                <th class="text-left">Target Kuantitas</th>
                <th class="text-left">Satuan</th>
                <th class="text-left">Target Kualitas (%)</th>
                <th></th>
            </thead>
            <tbody>
            <?php $no=1; foreach($list_rencana_kinerja as $lp){ ?>
                    <tr>
                        <td class="text-center"><?=$no++;?></td>
                        <td class="text-left"><?=$lp['tugas_jabatan']?></td>
                        <td class="text-left"><?=$lp['tahun']?></td>                       
                        <td class="text-left"><?=$lp['bulan']?></td>
                        <td class="text-left"><?=$lp['target_kuantitas']?></td>
                        <td class="text-left"><?=$lp['satuan']?></td>
                        <td class="text-left"><?=$lp['target_kualitas']?></td>
                        <td class="text-center">  

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