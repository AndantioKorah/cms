<?php if($list_rencana_kinerja){ ?>
    <div class="col-12 table-responsive">
        <table class="table table-hover table-striped" id="table_rencana_kinerja">
            <thead>
                <th class="text-center table-danger">No</th>
                <th class="text-left table-danger">Kegiatan Tugas Jabatan</th>
                <th class="text-left table-danger">Tahun</th>
                <th class="text-left table-danger">Bulan</th>
                <th class="text-left table-danger">Target Kuantitas</th>
                <th class="text-left table-danger">Satuan</th>
                <th class="text-left table-danger">Target Kualitas (%)</th>
                <th class="table-danger"></th>
            </thead>
            <tbody>
            <?php $no=1; foreach($list_rencana_kinerja as $lp){ ?>
                
                    <tr>
                        <td class="text-center"><?=$no++;?></td>
                        <td class="text-left"><?=$lp['tugas_jabatan']?></td>
                        <td class="text-left"><?=$lp['tahun']?></td>                       
                        <td class="text-left"><?= getNamaBulan($lp['bulan'])?></td>
                        <td class="text-left"><?=$lp['target_kuantitas']?></td>
                        <td class="text-left"><?=$lp['satuan']?></td>
                        <td class="text-left"><?=$lp['target_kualitas']?></td>                        
                        <td class="text-center">
                        <?php if($lp['count'] != 0 ){ ?>
                            <?php } else { ?>
                                <span href="#edit_rencana_kinerja" data-toggle="modal" >
                                <button href="#edit_rencana_kinerja" data-toggle="tooltip" class="btn btn-sm btn-navy"  data-placement="top" title="Edit" 
                                 onclick="openModalEditRencanaKinerja('<?=$lp['id']?>')"><i class="fa fa-edit"></i> </button>
                                 </span>
                                <button onclick="deleteRencanaKinerja('<?=$lp['id']?>')" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Hapus"><i class="fa fa-trash"></i> </button>
                            
                            <?php } ?>
                        </td>
                        
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <script>

        function deleteRencanaKinerja(id){
           
            if(confirm('Apakah Anda yakin ingin menghapus data?')){
                $.ajax({
                    url: '<?=base_url("kinerja/C_Kinerja/deleteRencanaKinerja/")?>'+id,
                    method: 'post',
                    data: null,
                    success: function(){
                        successtoast('Data sudah terhapus')
                        loadRencanaKinerja()
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



<script>

$('#table_rencana_kinerja').DataTable({
    "ordering": false
     } );
    

    $(function () {
  $('[data-toggle="tooltip"]').tooltip()
})



</script>