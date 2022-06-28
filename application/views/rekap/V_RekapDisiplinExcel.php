<html>
    <?php
        $skpd = explode(";",$parameter['skpd']);
        $filename = 'Rekap Absensi BIDIK '.$skpd[1].' Bulan '.getNamaBulan($parameter['bulan']).' Tahun '.$parameter['tahun'].'.xls';
        header("Content-type: application/vnd-ms-excel");
        header("Content-Disposition: attachment; filename=$filename");
    ?>
    <head>
        <style>
        </style>
    </head>
    <body>
        <div style="width: 100%;">
            <center>
            <h5 style="font-size: 20px;">
                <?= 'Rekap Absensi BIDIK '.$skpd[1].' Bulan '.getNamaBulan($parameter['bulan']).' Tahun '.$parameter['tahun'] ?>
            </h5>
            </center>
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
                </thead>
                <tbody>
                <?php $no=1; foreach($result as $rs){ ?>
                    <tr>
                        <td style="text-align: center;"><?=$no++;?></td> 
                        <td><?=$rs['nama_pegawai']?></td>
                        <td style="text-align: center;">`<?=$rs['nip']?></td>
                        <th style="text-align: center;">TMK 1</th>
                        <th style="text-align: center;">TMK 2</th>
                        <th style="text-align: center;">TMK 3</th>
                        <th style="text-align: center;">PKSW 1</th>
                        <th style="text-align: center;">PKSW 2</th>
                        <th style="text-align: center;">PKSW 3</th>
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
            <!-- <br>
            <span style="font-size: 12px;">printed by: </span><span style="font-size: 12px; font-weight: bold;"><?=$this->general_library->getNamaUser()?></span>
            <br>
            <span style="font-size: 12px;">date: </span><span style="font-size: 12px; font-weight: bold;"><?=date('d/m/Y H:i:s')?></span> -->
        </div>
    </body>
</html>