<?php if($list_kegiatan){ ?>
   
    <div class="col-12 table-responsive">
        <table class="table table-hover table-striped" id="table_realisasi_kinerja" width="100%">
            <thead>
                <th class="text-center table-danger">No</th>
                <th class="text-left table-danger">Kegiatan Tugas Jabatan</th>
                <th class="text-left table-danger">Tanggal Kegiatan</th>
                <th class="text-left table-danger">Detail Kegiatan</th>
                <th class="text-left table-danger">Realisasi Target (Kuantitas)</th>
                <th class="text-left table-danger">Satuan</th>
                <th class="text-center table-danger">Status</th>
                <th class="text-center table-danger">Dokumen Bukti Kegiatan</th>
               
                <th class="table-danger"></th>
            </thead>
            <tbody>
            <?php $no=1; foreach($list_kegiatan as $lp){ ?>
                    <tr>
                        <td class="text-center"><?=$no++;?></td>
                        <td class="text-left"><?=$lp['tugas_jabatan']?></td>
                        <td class="text-left"><?= formatDateNamaBulanWT($lp['tanggal_kegiatan'])?></td>                       
                        <td class="text-left"><?=$lp['deskripsi_kegiatan']?></td>
                        <td class="text-left" style="width:10%;"><?=$lp['realisasi_target_kuantitas']?></td>
                        <td class="text-left"><?=$lp['satuan']?></td>
                        <td class="text-left">
                        <button class="btn btn-<?php if($lp['id_status_verif'] == 0) echo  "warning";
                                                    else if($lp['id_status_verif'] == 1) echo "success";
                                                    else if($lp['id_status_verif'] == 2) echo "danger";
                                                    else if($lp['id_status_verif'] == 3) echo "warning";   ?> btn-sm" type="button" >
                        <?= $lp['status_verif'];?>
                            </button></td>
                        <td class="text-center">  
                        <button class="btn btn-info btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                         <i class="fa fa-file"></i> Lihat File
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <?php 
                            
                            $file = json_decode($lp['bukti_kegiatan']);
                            $nodok = 1;
                            foreach($file as $file_name)
                                {
                                    if($file_name == null){
                                        echo "<a class='dropdown-item' >Tidak Ada File</a>";
                                    } else {
                                        echo "<a class='dropdown-item' href=".base_url('assets/bukti_kegiatan/'.$file_name.'')." target='_blank'>Dokumen ".$nodok."</a>";
                                    }
                                   $nodok++;
                                } 
                            ?>
   
                        </div>
                           
                        </td>
                        
                        <td class="text-center">
                       
                        <?php if($lp['id_status_verif'] != 1){ ?>
                            <span href="#edit_realisasi_kinerja" data-toggle="modal" >
                            <button href="#edit_realisasi_kinerja" data-toggle="tooltip" class="btn btn-sm btn-navy" data-placement="top" title="Edit" 
                             onclick="openModalEditRealisasiKinerja('<?=$lp['id']?>')"><i class="fa fa-edit"></i> </button>
                                 </span>  
                            <button onclick="deleteKegiatan('<?=$lp['id']?>')" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Hapus"><i class="fa fa-trash" ></i></button>
                            <?php } ?>
                        </td>
                        
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <script>
        // $(document).ready(function () {
        // $('#table_realisasi_kinerja').DataTable({
        // "scrollX": true
        // });
        // $('.dataTables_length').addClass('bs-select');
        // });

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

<script>
    $('#table_realisasi_kinerja').DataTable({
    "ordering": false
     } );
    
    $(function () {
    $('[data-toggle="tooltip"]').tooltip()
    })
</script>