<?php if($result){
    $skpd = explode(";",$parameter['skpd']);
    // if($flag_print == 1){
    //     $filename = 'REKAPITULASI PENILAIAN PRODUKTIVITAS KERJA '.$skpd[1].' Periode '.getNamaBulan($parameter['bulan']).' '.$parameter['tahun'].'.xls';
    //     header("Content-type: application/vnd-ms-excel");
    //     header("Content-Disposition: attachment; filename=$filename");
    // }
?>
    <style>
        .table-header{
            /* position: fixed;
            top: 0px; display:none; */
        }
    </style>
    <div class="col-lg-12 table-responsive" style="width: 100%;">
        <form action="<?=base_url('rekap/C_Rekap/saveExcelDisiplin')?>" method="post" target="_blank">
            <center><h5><strong>REKAPITULASI PENILAIAN DISIPLIN KERJA</strong></h5></center>
            <br>
            <?php if($flag_print == 0){ ?>
                <button style="display: block;" type="submit" class="text-right float-right btn btn-navy btn-sm"><i class="fa fa-download"></i> Simpan sebagai Excel</button>
            <?php } ?>
            <table style="width: 100%;">
                <tr>
                    <td>SKPD</td>
                    <td>:</td>
                    <td><?=$skpd[1]?></td>
                </tr>
                <tr>
                    <td>Periode</td>
                    <td>:</td>
                    <td><?=getNamaBulan($parameter['bulan']).' '.$parameter['tahun']?></td>
                </tr>
            </table>
            <?php $jumlah_hari = getJumlahHariDalamBulan($parameter['bulan'], $parameter['tahun']); ?>
            <table class="table-hover" border=1 id="table_data_disiplin" style="width: 100%;">
                <thead class="table-header">
                    <th style="text-align: center;">No</th>
                    <th style="text-align: center;">Nama Pegawai</th>
                    <th style="text-align: center;">NIP</th>
                    <?php for($i = 1; $i <= $jumlah_hari; $i++) {
                        $date = date('d-m-Y', strtotime($i.'-'.$parameter['bulan'].'-'.$parameter['tahun']));
                        $hari = getNamaHari($date);
                    ?>
                        <th style="text-align: center;">
                            <span><?=$hari?></span><br>
                            <span><?=$i?></span>
                        </th>
                    <?php } ?>
                    <th style="text-align: center;">TMK 1</th>
                    <th style="text-align: center;">TMK 2</th>
                    <th style="text-align: center;">TMK 3</th>
                    <th style="text-align: center;">PKSW 1</th>
                    <th style="text-align: center;">PKSW 2</th>
                    <th style="text-align: center;">PKSW 3</th>
                </thead>
                <tbody>
                <?php $no=1; foreach($result as $rs){ ?>
                    <tr>
                        <td style="text-align: center;"><?=$no++;?></td> 
                        <td><?=$rs['nama_pegawai']?></td>
                        <td><?=$rs['nip']?></td>
                        <?php
                            for($i = 1; $i <= $jumlah_hari; $i++){
                                if($i < 10){
                                    $i = '0'.$i;
                                }
                        ?>
                            <td style="text-align: center; width: 5% !important; vertical-align: middle;">
                                <?php 
                                    $tanggal = $i.'-'.$parameter['bulan'].'-'.$parameter['tahun'];
                                    if(isset($rs['absensi'][$tanggal])){ 
                                        $a = $rs['absensi'][$tanggal];
                                        $fcmasuk = '#000000';
                                        if($a['masuk']['keterangan'] == 'tmk1'){
                                            $fcmasuk = '#d3b700';
                                        } else if($a['masuk']['keterangan'] == 'tmk2'){
                                            $fcmasuk = '#d37c00';
                                        } else if($a['masuk']['keterangan'] == 'tmk3'){
                                            $fcmasuk = '#ff0000';
                                        }

                                        $fcpulang = '#000000';
                                        if($a['pulang']['keterangan'] == 'pksw1'){
                                            $fcpulang = '#d3b700';
                                        } else if($a['pulang']['keterangan'] == 'pksw2'){
                                            $fcpulang = '#d37c00';
                                        } else if($a['pulang']['keterangan'] == 'pksw3'){
                                            $fcpulang = '#ff0000';
                                        }
                                    ?>
                                        <span style="color: <?=$fcmasuk?>;font-size: 14px;"><?=$a['masuk']['data']?></span> - 
                                        <span style="color: <?=$fcpulang?>;font-size: 14px;"><?=$a['pulang']['data']?></span>
                                        <!-- <span style="font-size: 12px; color: red;"><?= $a['masuk']['keterangan'] ? json_encode($a['masuk']['keterangan']) : ''?></span><br>
                                        <span style="font-size: 12px; color: blue;"><?= $a['pulang']['keterangan'] ? json_encode($a['pulang']['keterangan']) : ''?></span> -->
                                <?php } else { ?>
                                    <span style="font-size: 14px;">-</span>
                                <?php } ?>
                            </td>
                        <?php } ?>
                        <td style="text-align: center;">
                            <?php if(isset($rs['rekap_absensi'])){ ?>
                                <?=$rs['rekap_absensi']['tmk1']?>
                            <?php } ?>
                        </td>
                        <td style="text-align: center;">
                            <?php if(isset($rs['rekap_absensi'])){ ?>
                                <?=$rs['rekap_absensi']['tmk2']?>
                            <?php } ?>
                        </td>
                        <td style="text-align: center;">
                            <?php if(isset($rs['rekap_absensi'])){ ?>
                                <?=$rs['rekap_absensi']['tmk3']?>
                            <?php } ?>
                        </td>
                        <td style="text-align: center;">
                            <?php if(isset($rs['rekap_absensi'])){ ?>
                                <?=$rs['rekap_absensi']['pksw1']?>
                            <?php } ?>
                        </td>
                        <td style="text-align: center;">
                            <?php if(isset($rs['rekap_absensi'])){ ?>
                                <?=$rs['rekap_absensi']['pksw2']?>
                            <?php } ?>
                        </td>
                        <td style="text-align: center;">
                            <?php if(isset($rs['rekap_absensi'])){ ?>
                                <?=$rs['rekap_absensi']['pksw3']?>
                            <?php } ?>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </form>
    </div>
    <script>
        $(function(){
            // var tableOffset = $("#table_data_disiplin").offset().top;
            // var $header = $("#table_data_disiplin > thead").clone();
            // var $fixedHeader = $(".table-header").append($header);

            // $(window).bind("scroll", function() {
            //     var offset = $(this).scrollTop();

            //     if (offset >= tableOffset && $fixedHeader.is(":hidden")) {
            //         $fixedHeader.show();
            //     }
            //     else if (offset < tableOffset) {
            //         $fixedHeader.hide();
            //     }
            // });
        })
    </script>
<?php } else { ?>
    <h5>Data Tidak Ditemukan <i class="fa fa-exclamation"></i></h5>
<?php } ?>