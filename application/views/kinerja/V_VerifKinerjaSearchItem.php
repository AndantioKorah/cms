<?php if($result){ ?>
    <div class="col-12">
        <table border=1 style="width: 100%;" id="table_verif_kinerja" class="table table-hover">
            <thead>
                <th class="text-center">No</th>
                <th class="text-center">Tanggal Kegiatan</th>
                <th class="text-center">Nama Pegawai</th>
                <th class="text-center">Nama Kegiatan</th>
                <th class="text-center">Rencana Kegiatan</th>
                <th class="text-center">Realisasi</th>
                <th class="text-center">Detail</th>
                <th class="text-center">Keterangan</th>
                <th class="text-center">Verifikasi</th>
            </thead>
            <tbody>
                <?php $no = 1; foreach($result as $rs){
                    // dv-> display_verified, dnv-> display_not_verified
                    $ket_verif = $rs['keterangan_verif'];
                    $dv = 'show';
                    $dnv = 'none';
                    if($rs['status_verif'] == 0 || $rs['status_verif'] == 3){
                        $dv = 'none';
                        $dnv = 'show';
                        $ket_verif = '';
                    }
                ?>
                    <tr>
                        <td class="text-center"><?=$no++;?></td>
                        <td class="text-center"><?=formatDateNamaBulan($rs['tanggal_kegiatan'])?></td>
                        <td><?=$rs['nama']?></td>
                        <td><?=$rs['deskripsi_kegiatan']?></td>
                        <td><?=$rs['tugas_jabatan']?></td>
                        <td class="text-center"><?=formatCurrencyWithoutRp($rs['realisasi_target_kuantitas']).' '.$rs['satuan']?></td>
                        <td class="text-center">
                            <button onclick="loadDetailKegiatan('<?=$rs['id_t_kegiatan']?>')" data-target="#modal_detail_kegiatan" data-toggle="modal" title="Detail" class="btn btn-sm btn-navy"><i class="fa fa-edit"></i></button>
                        </td>
                        <td>
                            <textarea style="display: <?=$dnv?>;" class="form-control" rows=5 id="keterangan_verif_<?=$rs['id_t_kegiatan']?>"></textarea>
                            <h6 style="display: <?=$dv?>;" id="text_keterangan_verif_<?=$rs['id_t_kegiatan']?>">
                                <?=$ket_verif?>
                            </h6>
                        </td>
                        <td class="text-center">
                            <button style="display: <?=$dnv?>;" onclick="checkVerif(1, '<?=$rs['id_t_kegiatan']?>')" title="Terima" class="btn btn_verif_<?=$rs['id_t_kegiatan']?> btn-sm btn-success"><i class="fa fa-check"></i></button>
                            <button style="display: <?=$dnv?>;" onclick="checkVerif(2, '<?=$rs['id_t_kegiatan']?>')" title="Tolak" class="btn btn_verif_<?=$rs['id_t_kegiatan']?> btn-sm btn-danger"><i class="fa fa-times"></i></button>
                            <button style="display: none;" disabled class="btn btn_loading_<?=$rs['id_t_kegiatan']?> btn-sm btn-warning"><i class="fa fa-spin fa-spinner"></i> Loading...</button>
                            <button style="display: <?=$dv?>;" onclick="checkVerif(3, '<?=$rs['id_t_kegiatan']?>')" title="Batal Verif" class="btn btn_batal_verif_<?=$rs['id_t_kegiatan']?> btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

<div class="modal fade" id="modal_detail_kegiatan" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div id="modal-dialog" class="modal-dialog modal-xl">
		<div class="modal-content" id="modal_detail_kegiatan_content">
		</div>
	</div>
</div>

    <script>
        $('#table_verif_kinerja').dataTable()

        function loadDetailKegiatan(id){
            $('#modal_detail_kegiatan_content').html('')
            $('#modal_detail_kegiatan_content').append(divLoaderNavy)
            $('#modal_detail_kegiatan_content').load('<?=base_url("kinerja/C_VerifKinerja/loadDetailKegiatan")?>'+'/'+id, function(){
                $('#loader').hide()
            })
        }

        function checkVerif(status, id){
            $('.btn_verif_'+id).hide()
            $('.btn_loading_'+id).show()
            $('.btn_batal_verif_'+id).hide()
            $.ajax({
                url: '<?=base_url("kinerja/C_VerifKinerja/checkVerif")?>'+'/'+status+'/'+id,
                method: 'post',
                data: {
                    'keterangan_verif' : $('#keterangan_verif_'+id).val()
                },
                success: function(data){
                    let rs = JSON.parse(data)
                    if(rs.code == 0){
                        if(rs.status == 1 || rs.status == 2){
                            $('.btn_verif_'+id).hide()
                            $('.btn_loading_'+id).hide()
                            $('.btn_batal_verif_'+id).show()
                            $('#text_keterangan_verif_'+id).html($('#keterangan_verif_'+id).val())
                            
                            $('#text_keterangan_verif_'+id).show()
                            $('#keterangan_verif_'+id).hide()
                            $('#keterangan_verif_'+id).val('')
                        } else if(rs.status == 3){
                            $('.btn_verif_'+id).show()
                            $('.btn_loading_'+id).hide()
                            $('.btn_batal_verif_'+id).hide()

                            $('#text_keterangan_verif_'+id).html()
                            $('#text_keterangan_verif_'+id).hide()
                            $('#keterangan_verif_'+id).val('')
                            $('#keterangan_verif_'+id).show()
                        }
                    } else {
                        errortoast(rs.message)
                    }
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