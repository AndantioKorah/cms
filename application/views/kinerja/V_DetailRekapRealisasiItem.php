<?php if($result){ ?>
    <style>
        .tr_rekap_realisasi:hover{
            cursor: pointer;
        }

        .tr_rekap_active{
            background-color: #dbd7d7;
        }
    </style>
    <div class="modal-header">
        <h5>Detail Rekap Realisasi Kinerja</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="row">
            <div class="col-12 text-center">
                <strong><h5 style="font-size: 25px;"><?=$result[0]['nama']?></h5></strong>
                <h5>NIP. <?=formatnip($result[0]['username'])?></h5>
                <span style="font-size: 17px; font-weight: bold;">Periode: <?=getNamaBulan($periode['bulan']).' '.$periode['tahun']?></span>
            </div>
            <div class="col-12 table-responsive">
                <table border=1 class="table table-hover" id="table_detail_rekap">
                    <thead>
                        <th class="text-center">No</th>
                        <th class="text-center">Rencana Kegiatan</th>
                        <th class="text-center">Target</th>
                        <th class="text-center">Satuan</th>
                        <th class="text-center">Realisasi</th>
                        <th class="text-center">Nilai Capaian</th>
                    </thead>
                    <tbody>
                        <?php $no=1; foreach($result as $rs){
                            $progress = (floatval($rs['total_realisasi'])/floatval($rs['target_kuantitas'])) * 100;
                            $progress = formatTwoMaxDecimal($progress);
                        ?>
                            <tr id="tr_rekap_<?=$rs['id_t_rencana_kinerja']?>" class="tr_rekap_realisasi" onclick="openListKegiatan('<?=$rs['id_t_rencana_kinerja']?>')">
                                <td class="text-center"><?=$no++;?></td>
                                <td><?=$rs['tugas_jabatan'];?></td>
                                <td class="text-center"><?=$rs['target_kuantitas'];?></td>
                                <td class="text-center"><?=$rs['satuan'];?></td>
                                <td class="text-center"><?=$rs['total_realisasi'] > 0 ? $rs['total_realisasi'] : '0'?></td>
                                <!-- <td class="text-center">
                                    <div class="text-center" style="border: 2px solid #80808082; border-radius: 5px; width: 100%; height: 30px; padding-bottom: 27px;">
                                        <div class="text-center" style="border-radius: 3px; background-color: <?=getProgressBarColor($progress)?>; overflow: show; white-space: nowrap; width: <?=$progress.'%'?>; height: 27px;">
                                            <strong style="font-size: 18px; color: <?=$progress == 25 || $progress == 100 ? 'white' : 'black'?>;"><?=$progress.' %';?></td></strong>
                                        </div>
                                    </div>
                                </td> -->
                                <td class="project_progress">
                                    <div class="progress progress-sm">
                                        <div class="progress-bar" role="progressbar" aria-valuenow="<?=$progress?>" aria-valuemin="0" aria-valuemax="100" style="width: <?=$progress.'%'?>; background-color: <?=getProgressBarColor($progress)?>;">
                                        </div>
                                    </div>
                                    <small style="font-size: 90% !important; font-weight: bold !important;">
                                        <?=$progress.' % selesai'?>
                                    </small>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <div class="col-12" id="list_kegiatan" style="display: none;">
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
    </div>

    <script>
        $(function(){
            // $('#table_detail_rekap').dataTable()
        })

        function openListKegiatan(id){
            $('.tr_rekap_realisasi').removeClass('tr_rekap_active')
            $('#tr_rekap_'+id).addClass('tr_rekap_active')

            $('#list_kegiatan').show()
            $('#list_kegiatan').html('')
            $('#list_kegiatan').append(divLoaderNavy)
            $('#list_kegiatan').load('<?=base_url("kinerja/C_VerifKinerja/loadListKegiatanRencanaKinerja")?>'+'/'+id, function(){
                $('#loader').hide()
            })
        }        
    </script>
<?php } else { ?>
<?php } ?>