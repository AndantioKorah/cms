<?php if($result){
    $filename = 'Nominatif SKPD '.$result[0]['nm_unitkerja'].'.xls';
    header("Content-type: application/vnd-ms-excel");
    header("Content-Disposition: attachment; filename=$filename");    
?>
    
    <center>
        <h4><?=strtoupper($result[0]['nm_unitkerja'])?></h4>
    </center>
    <br>
    <table border=1>
        <thead>
            <th style="text-align: center;">No</th>
            <th style="text-align: center;">NIP</th>
            <th style="text-align: center;">Nama</th>
            <th style="text-align: center;">Pangkat/Golongan</th>
            <th style="text-align: center;">TMT Pangkat</th>
            <th style="text-align: center;">Jabatan</th>
            <th style="text-align: center;">Masa Kerja</th>
            <th style="text-align: center;">Gaji</th>
        </thead>
        <tbody>
            <?php $no=1; foreach($result as $rs){ ?>
                <tr>
                    <td style="text-align: center;"><?=$no++;?></td>
                    <td style="text-align: center;"><?=$rs['nipbaru']?></td>
                    <td><?=getNamaPegawaiFull($rs)?></td>
                    <td><?=$rs['nm_pangkat']?></td>
                    <td style="text-align: center;"><?=formatDateOnly($rs['tmtpangkat'])?></td>
                    <td><?=$rs['jabatan']?></td>
                    <td style="text-align: center;"><?=countDiffDateLengkap(date('Y-m-d H:i:s'), $rs['tmtcpns'], ['tahun', 'bulan'])?></td>
                    <td><?=$rs['nipbaru_ws'].'`'?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
<?php } ?>