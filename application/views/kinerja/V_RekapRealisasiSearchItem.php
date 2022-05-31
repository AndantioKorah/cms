<?php if($result){ ?>
    <div class="col-12">
        <table border=1 class="table table-hover" id="table_search_rekap_realisasi">
            <thead>
                <th class="text-center">No</th>
                <th class="text-center">NIP</th>
                <?php if($this->general_library->isKaban()){ ?>
                    <th>Bidang/Bagian</th>
                <?php } else if ($this->general_library->isWalikota() || $this->general_library->isSetda()){ ?>
                    <th>SKPD</th>
                <?php } ?>
                <th>Nama Pegawai</th>
                <th class="text-center">Nilai Capaian</th>
                <th class="text-center">Pilihan</th>
            </thead>
            <tbody>
            <?php $no = 1; foreach($result as $rs){ if(isset($rs['id_m_user'])) {
                $progress = formatTwoMaxDecimal($rs['total_progress']);
            ?>
                <tr>
                    <td class="text-center"><?=$no++;?></td>
                    <td class="text-center"><?=formatnip($rs['nip_pegawai']);?></td>
                    <?php if($this->general_library->isKaban()){ ?>
                        <td><?=$rs['nama_sub_bidang']?></td>
                    <?php } else if ($this->general_library->isWalikota() || $this->general_library->isSetda()){ ?>
                        <td><?=$rs['nm_unitkerja']?></td>
                    <?php } ?>
                    <td><?=getNamaPegawaiFull($rs)?></td>
                    <!-- <td class="text-center">
                        <div class="text-center" style="border: 2px solid #80808082; border-radius: 5px; width: 100%; height: 30px; padding-bottom: 27px;">
                            <div class="text-center" style="border-radius: 3px; background-color: <?=getProgressBarColor($progress)?>; overflow: show; white-space: nowrap; width: <?=$progress.'%'?>; height: 27px;">
                                <strong style="font-size: 18px; color: <?=$progress == 25 || $progress == 100 ? 'white' : 'black'?>;"><?=$progress.' %';?></strong>
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
                    <td class="text-center">
                        <button onclick="openDetailModal('<?=$rs['id_m_user']?>')" data-target="#modal_detail_rekap" data-toggle="modal" class="btn btn-navy btn-sm"><i class="fa fa-edit"></i> Detail</button>
                    </td>
                </tr>
            <?php } } ?>
            </tbody>
        </table>
    </div>
    <div class="modal fade" id="modal_detail_rekap" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div id="modal-dialog" class="modal-dialog modal-xl">
            <div class="modal-content" id="modal_detail_rekap_content">
            </div>
        </div>
    </div>
    <script>
        $(function(){
            $('#table_search_rekap_realisasi').dataTable()
        })

        function openDetailModal(id){
            $('#modal_detail_rekap_content').html('')
            $('#modal_detail_rekap_content').append(divLoaderNavy)
            $('#modal_detail_rekap_content').load('<?=base_url("kinerja/C_VerifKinerja/loadDetailRekap")?>'+'/'+id, function(){
                $('#loader').hide()
            })
        }
    </script>
<?php } ?>

