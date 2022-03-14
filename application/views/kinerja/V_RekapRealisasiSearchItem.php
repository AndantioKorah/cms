<?php if($result){ ?>
    <div class="col-12">
        <table border=1 class="table table-hover" id="table_search_rekap_realisasi">
            <thead>
                <th class="text-center">No</th>
                <th class="text-center">NIP</th>
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
                    <td><?=$rs['nama_pegawai'];?></td>
                    <td class="text-center">
                        <div class="text-center" style="border: 2px solid #80808082; border-radius: 5px; width: 100%; height: 30px; padding-bottom: 27px;">
                            <div class="text-center" style="border-radius: 3px; background-color: <?=getProgressBarColor($progress)?>; overflow: show; white-space: nowrap; width: <?=$progress.'%'?>; height: 27px;">
                                <strong style="font-size: 18px; color: <?=$progress == 25 || $progress == 100 ? 'white' : 'black'?>;"><?=$progress.' %';?></strong>
                            </div>
                        </div>
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

