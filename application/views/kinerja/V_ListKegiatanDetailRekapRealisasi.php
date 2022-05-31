<?php if($result){ ?>
    <hr>
    <div  class="col-12 table-responsive">
    <table border=1 class="table table-hover" id="table_list_kegiatan_detail_rekap">
        <thead>
            <th class="text-center">No</th>
            <th class="text-center">Tanggal Kegiatan</th>
            <th class="text-center">Kegiatan</th>
            <th class="text-center">Realisasi</th>
            <th class="text-center">Bukti Realisasi</th>
            <th class="text-center">Verifikasi</th>
        </thead>
        <tbody>
            <?php $no=1; foreach($result as $rs){
                $status_verif = '<span style="font-weight: bold; color: white; padding: 5px; background-color: grey;"><i class="fa fa-dot-circle"></i> Belum Verif</span>';
                if($rs['status_verif'] == 1){
                    $status_verif = '<span style="font-weight: bold; color: white; padding: 5px; background-color: green;"><i class="fa fa-check-circle"></i> Diterima</span>';
                } else if($rs['status_verif'] == 2){
                    $status_verif = '<span style="font-weight: bold; color: white; padding: 5px; background-color: red;"><i class="fa fa-times-circle"></i> Ditolak</span>';
                } else if($rs['status_verif'] == 3){
                    $status_verif = '<span style="font-weight: bold; color: black; padding: 5px; background-color: yellow;"><i class="fa fa-minus-circle"></i> Verifikasi Dibatalkan</span>';
                }
            ?>
                <tr>
                    <td class="text-center"><?=$no++;?></td>
                    <td class="text-center"><?=formatDateOnly($rs['tanggal_kegiatan']);?></td>
                    <td><?=$rs['deskripsi_kegiatan'];?></td>
                    <td class="text-center"><?=$rs['realisasi_target_kuantitas'].' '.$rs['satuan']?></td>
                    <td class="text-center">
                    <button class="btn btn-info btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                         <i class="fa fa-file"></i> Lihat File
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <?php 
                                $file = json_decode($rs['bukti_kegiatan']);
                                $no = 1;
                                foreach($file as $file_name)
                                    {
                                        if($file_name == null){
                                            echo "<a class='dropdown-item' >Tidak Ada File</a>";
                                        } else {
                                            echo "<a class='dropdown-item' href=".base_url('assets/bukti_kegiatan/'.$file_name.'')." target='_blank'>Dokumen ".$no."</a>";
                                        }
                                    $no++;
                                    } 
                                ?>
    
                            </div>
                    </td>
                    <td>
                        <?=$status_verif?><br>
                        <?php if($rs['status_verif'] != 0){ ?>
                            <?=$rs['keterangan_verif'] ? "<strong>(".$rs['keterangan_verif'].")</strong>" : '-'?><br>
                            oleh <strong><?=$rs['verifikator']?></strong><br>
                            pada <strong><?=formatDate($rs['tanggal_verif'])?></strong>
                        <?php } ?>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    </div>
    <script>
        $(function(){
            $('#table_list_kegiatan_detail_rekap').dataTable()
        })
    </script>
<?php } else { ?>
    <center><b>Belum Diverifikasi Pimpinan<b></center>
<?php } ?>