<html>
    <head>
        <style>
            body{
                font-family: Tahoma;
            }
            
            .normal{
                color: black;
                text-align: center;
            }

            .lvl_1{
                background-color: #ffff00;
                text-align: center;
                color: black;        
            }

            .lvl_2{
                background-color: #ff9900;
                text-align: center;
                color: black;
            }

            .lvl_3{
                background-color: #ff0000;
                text-align: center;
                color: white;
            }

            .alpa{
                background-color: #33ccff;
                text-align: center;
                color: black;
            }

            .tidak_absen{
                background-color: #ccccb3;
                text-align: center;
                color: black;
            }

            .tr_odd{
                /* background-color: #dfdfdf; */
                background-color: #e8e9eb;
            }
        </style>
    <head>
    <?php 
        $filename = $nama_file;
        header("Content-type: application/vnd-ms-excel");
        header("Content-Disposition: attachment; filename=$filename"); 
    ?>
    <body>
        <div style="width: 100%;">
            <center>
            <h5 style="font-size: 20px;">
                REKAP ABSENSI <?=strtoupper($skpd)?><br>
                <?=strtoupper($periode)?>
            </h5>
            </center>
            <table border=1 style="width: 100%;">
                <thead>
                    <?php $i=0; foreach($header[0] as $h){
                        $val = $h;
                        $rowspan = 1;
                        if($i !=0 || $i != 1){
                            $val = $val.'<br>'.$header[1][$i];
                        }
                    ?>
                        <th style="text-align: center; font-size: 13px;"><?=$val?></th>
                    <?php $i++; } ?>
                </thead>
                <tbody>
                    <?php $no = 1; foreach($result as $rs){
                    $bgtr = fmod($no, 2) == 0 ? "tr_even" : "tr_odd";
                    ?>
                        <tr class="<?=$bgtr?>">
                            <td style="text-align: center; font-size: 12px;"><?=$no++;?></td>
                            <td style="width: 300px; font-size: 12px;"><?=$rs['nama_pegawai']?></td>
                            <?php $ctr = 0; foreach($rs['absen']['jam'] as $ab){
                                $bgcolor = 'normal';
                                if(($rs['absen']['hari'][$ctr] != 'Sb') && ($rs['absen']['hari'][$ctr] != 'Mg')){
                                    $ev = explode('-', $ab);
                                    if(isset($ev[0])){
                                        if($ab == "A" || $ab == "I" || $ab == "S"){
                                            $bgcolor = 'alpa';
                                        } else if(strtotime($ev[0]) > strtotime("09:01")){
                                            $bgcolor = 'lvl_3';
                                        } else if(strtotime($ev[0]) > strtotime("08:31")){
                                            $bgcolor = 'lvl_2';
                                        } else if(strtotime($ev[0]) > strtotime("08:01")){
                                            $bgcolor = 'lvl_1';
                                        } else if($ab == "-"){
                                            $bgcolor = 'tidak_absen';
                                        }
                                    }
                                } else {
                                    $bgcolor = 'libur';
                                }
                            ?>
                                <td class="<?=$bgcolor?>" style="width: <?=$bgcolor == 'libur' ? '25; text-align: center;' : '100px';?>; font-size: 12px;"><?=$ab?></td>
                            <?php $ctr++; } ?>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <br>
            <span style="font-size: 12px;">printed by: </span><span style="font-size: 12px; font-weight: bold;"><?=$this->general_library->getNamaUser()?></span>
            <br>
            <span style="font-size: 12px;">date: </span><span style="font-size: 12px; font-weight: bold;"><?=date('d/m/Y H:i:s')?></span>
        </div>
    </body>
</html>