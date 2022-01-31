<?php if($list_kegiatan){ ?>
   
    <div class="col-12">
        <table class="table table-hover table-striped" id="table_realisasi_kinerja" width="100%">
            <thead>
                <th class="text-center">No</th>
                <th class="text-left">Kegiatan Tugas Jabatan</th>
                <th class="text-left">Tanggal Kegiatan</th>
                <th class="text-left">Detail Kegiatan</th>
                <th class="text-left">Realisasi Target (Kuantitas)</th>
                <th class="text-left">Satuan</th>
                <th class="text-center">Dokumen Bukti Kegiatan</th>
                <th></th>
            </thead>
            <tbody>
            <?php $no=1; foreach($list_kegiatan as $lp){ ?>
                    <tr>
                        <td class="text-center"><?=$no++;?></td>
                        <td class="text-left"><?=$lp['tugas_jabatan']?></td>
                        <td class="text-left"><?=$lp['tanggal_kegiatan']?></td>                       
                        <td class="text-left"><?=$lp['deskripsi_kegiatan']?></td>
                        <td class="text-left"><?=$lp['realisasi_target_kuantitas']?></td>
                        <td class="text-left"><?=$lp['satuan']?></td>
                        <td class="text-center">  
                        <button class="btn btn-info btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                         <i class="fa fa-file"></i> Lihat File
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <?php 
                            
                            $file = json_decode($lp['bukti_kegiatan']);
                            foreach($file as $file_name)
                                {
                                    if($file_name == null){
                                        echo "<a class='dropdown-item' >Tidak Ada File</a>";
                                    } else {
                                        echo "<a class='dropdown-item' href=".base_url('assets/bukti_kegiatan/'.$file_name.'')." target='_blank'>".$file_name."</a>";
                                    }
                                   
                                } 
                            ?>
   
                        </div>
                           
                        </td>
                        
                        <td class="text-center">
                            <button onclick="deleteKegiatan('<?=$lp['id']?>')" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i>  Hapus</button>
                        </td>
                        
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <script>
        $(document).ready(function () {
        $('#table_realisasi_kinerja').DataTable({
        "scrollX": true
        });
        $('.dataTables_length').addClass('bs-select');
        });

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