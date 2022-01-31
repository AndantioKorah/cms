<?php if($result){ ?>
    <table border=1 class="table table-hover table-striped">
        <thead>
            <th class="text-center">No</th>
            <th class="text-center">Tanggal Kegiatan</th>
            <th class="text-center">Nama Pegawai</th>
            <th class="text-center">Nama Kegiatan</th>
            <th class="text-center">Rencana Kegiatan</th>
            <th class="text-center">Realisasi</th>
            <th class="text-center">Detail</th>
            <th class="text-center">Verifikasi</th>
        </thead>
        <tbody>
            <?php $no = 1; foreach($result as $rs){ ?>
                <tr>
                    <td class="text-center"><?=$no++;?></td>
                    <td class="text-center"><?=formatDateOnly($rs['tanggal_kegiatan'])?></td>
                    <td><?=$rs['nama']?></td>
                    <td><?=$rs['deskripsi_kegiatan']?></td>
                    <td><?=$rs['tugas_jabatan']?></td>
                    <td class="text-center"><?=formatCurrencyWithoutRp($rs['realisasi_target_kuantitas']).' '.$rs['satuan']?></td>
                    <td class="text-center"><button title="Detail" class="btn btn-sm btn-navy"><i class="fa fa-edit"></i></button></td>
                    <td class="text-center">
                        <button onclick="checkVerif(1, '<?=$rs['id_t_kegiatan']?>')" title="Terima" class="btn btn_verif_<?=$rs['id_t_kegiatan']?> btn-sm btn-success"><i class="fa fa-check"></i></button>
                        <button onclick="checkVerif(2, '<?=$rs['id_t_kegiatan']?>')" title="Tolak" class="btn btn_verif_<?=$rs['id_t_kegiatan']?> btn-sm btn-danger"><i class="fa fa-times"></i></button>
                        <button style="display: none;" disabled class="btn btn_loading_<?=$rs['id_t_kegiatan']?> btn-sm btn-warning"><i class="fa fa-spin fa-spinner"></i> Loading...</button>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <script>
        function checkVerif(status, id){
            $('.btn_verif_'+id).hide()
            $('.btn_loading_'+id).show()
            $.ajax({
                url: '<?=base_url("kinerja/C_VerifKinerja/checkVerif")?>'+'/'+status+'/'+id,
                method: 'post',
                data: null,
                success: function(data){
                    let rs = JSON.parse(data)
                    
                }, error: function(e){
                    errortoast('Terjadi Kesalahan')
                }
            })
        }
    </script>
<?php } else { ?>
    <div class="col-12 text-center">
        <h6>Data Tidak Ditemukan <i class="fa fa-exclamation"></i></h6>
    </div>
<?php } ?>