<?php if($data_dashboard){
    $total_target = $data_dashboard['total_target'];    
    $total_realisasi_target = $data_dashboard['total_realisasi_target'];    
    $progress_realisasi_target = 0;
    $progress_target = 0;
    if($total_target != 0){
        $progress_realisasi_target = ($total_realisasi_target/$total_target) * 100;
        $progress_target = ($total_target/$total_target) * 100;
    }
?>
    <style>
        .knob{
            font-size: 80px !important;
        }
    </style>
    <div class="d-none d-sm-none d-md-block d-lg-block d-xl-block">
        <div class="row">
            <div class="col-12">
                <table style="width: 100%;">
                    <tr>
                        <td rowspan=7 style="width: 40%;">
                            <div class="card card-default" style="height: 650px;">
                                <div class="card-header">
                                    <b>Total Target Rencana Kinerja</b><br>
                                    <div class="progress progress-sm" style="height: 1rem !important; border-radius: 10px;">
                                        <div class="progress-bar" role="progressbar" aria-valuenow="<?=$progress_target?>" aria-valuemin="0" aria-valuemax="<?=$progress_target?>" style="width: <?=$progress_target == 0 ? 0 : $progress_target?>%; background-color: <?=getProgressBarColor($progress_target)?>;">
                                        </div>
                                    </div>
                                    <small style="font-size: 15px;"><strong><?=$total_target?></strong></small><br>
                                    <b>Total Target Realisasi Kinerja</b><br>
                                    <div class="progress progress-sm" style="height: 1rem !important; border-radius: 10px;">
                                        <div class="progress-bar" role="progressbar" aria-valuenow="<?=$progress_realisasi_target?>" aria-valuemin="0" aria-valuemax="<?=$progress_realisasi_target?>" style="width: <?=$progress_realisasi_target == 0 ? 0 : $progress_realisasi_target?>%; background-color: <?=getProgressBarColor($progress_realisasi_target)?>;">
                                        </div>
                                    </div>
                                    <small style="font-size: 15px;"><strong><?=$total_realisasi_target?></strong></small>
                                </div>
                                <div class="card-body">
                                    <div class="col-12 text-center">
                                        <?php $color = getProgressBarColor(formatTwoMaxDecimal($data_dashboard['total_progress']), false); ?>
                                        <?php if($data_dashboard['total_progress'] > 100){
                                            $data_dashboard['total_progress'] = 100;
                                        } ?>
                                        <input data-readonly="true" disabled type="number" class="knob" 
                                        value="<?=formatTwoMaxDecimal($data_dashboard['total_progress'])?>"
                                        data-width="450" data-height="450" data-fgColor="<?=$color?>">
                                        <div class="knob-label"><strong>PRESENTASE CAPAIAN REALISASI TARGET</strong></div>
                                    </div>
                                    <br>
                                    <div class="col-12">
                                        
                                    </div>
                                    <div class="col-12">
                                        
                                    </div>
                                </div>
                            </div> 
                        </td>
                    </tr>
                    <tr>
                        <td style="padding-left: 30px;">
                            <div class="info-box">
                                <span class="info-box-icon bg-info"><i class="far fa-file"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">TOTAL RENCANA KINERJA</span>
                                    <span class="info-box-number"><?=count($data_dashboard['rencana_kinerja'])?></span>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <?php
                        $progress_realisasi = 0;
                        $progress_diterima = 0;
                        $progress_ditolak = 0;
                        $progress_batal = 0;
                        $progress_belum = 0;
                        if(floatval($data_dashboard['realisasi']) != 0){
                            $progress_realisasi = (count($data_dashboard['realisasi']) / count($data_dashboard['realisasi'])) * 100;
                            $progress_diterima = (($data_dashboard['verif_diterima']) / count($data_dashboard['realisasi'])) * 100;
                            $progress_ditolak = (($data_dashboard['verif_ditolak']) / count($data_dashboard['realisasi'])) * 100;
                            $progress_batal = (($data_dashboard['batal_verif']) / count($data_dashboard['realisasi'])) * 100;
                            $progress_belum = (($data_dashboard['belum_verif']) / count($data_dashboard['realisasi'])) * 100;
                        }
                    ?>
                    <tr>
                        <td style="padding-left: 30px;">
                            <div class="info-box">
                                <span class="info-box-icon bg-info"><i class="far fa-file-alt"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">TOTAL REALISASI KINERJA</span>
                                    <div class="progress progress-sm" style="height: 1rem !important; border-radius: 10px;">
                                        <div class="progress-bar" role="progressbar" aria-valuenow="<?=count($data_dashboard['realisasi'])?>" aria-valuemin="0" aria-valuemax="<?=$progress_realisasi?>" style="width: <?=$progress_realisasi == 0 ? '0' : '100' ?>%; background-color: <?=getProgressBarColor($progress_realisasi)?>;">
                                        </div>
                                    </div>
                                    <span class="info-box-number"><?=count($data_dashboard['realisasi'])?></span>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding-left: 30px;">
                            <div class="info-box">
                                <span class="info-box-icon bg-green"><i class="fa fa-check"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">KINERJA YANG SUDAH DIVERIFIKASI</span>
                                    <div class="progress progress-sm" style="height: 1rem !important; border-radius: 10px;">
                                        <div class="progress-bar" role="progressbar" aria-valuenow="<?=$data_dashboard['verif_diterima']?>" aria-valuemin="0" aria-valuemax="<?=count($data_dashboard['realisasi'])?>" style="width: <?=$progress_diterima.'%'?>; background-color: <?=getProgressBarColor($progress_diterima)?>;">
                                        </div>
                                    </div>
                                    <span class="info-box-number"><?=$data_dashboard['verif_diterima']?></span>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding-left: 30px;">
                            <div class="info-box">
                                <span class="info-box-icon bg-danger"><i class="fa fa-times"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">KINERJA YANG DITOLAK VERIFIKASI</span>
                                    <div class="progress progress-sm" style="height: 1rem !important; border-radius: 10px;">
                                        <div class="progress-bar" role="progressbar" aria-valuenow="<?=$data_dashboard['verif_ditolak']?>" aria-valuemin="0" aria-valuemax="<?=count($data_dashboard['realisasi'])?>" style="width: <?=$progress_ditolak.'%'?>; background-color: #dc3545;">
                                        </div>
                                    </div>
                                    <span class="info-box-number"><?=$data_dashboard['verif_ditolak']?></span>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding-left: 30px;">
                            <div class="info-box">
                                <span class="info-box-icon bg-warning"><i class="fa fa-minus"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">KINERJA YANG DIBATALKAN VERIFIKASI</span>
                                    <div class="progress progress-sm" style="height: 1rem !important; border-radius: 10px;">
                                        <div class="progress-bar" role="progressbar" aria-valuenow="<?=$data_dashboard['batal_verif']?>" aria-valuemin="0" aria-valuemax="<?=count($data_dashboard['realisasi'])?>" style="width: <?=$progress_batal.'%'?>; background-color: #ffc107;">
                                        </div>
                                    </div>
                                    <span class="info-box-number"><?=$data_dashboard['batal_verif']?></span>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding-left: 30px;">
                            <div class="info-box">
                                <span class="info-box-icon bg-dark"><i class="far fa-circle"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">KINERJA YANG BELUM DIVERIFIKASI</span>
                                    <div class="progress progress-sm" style="height: 1rem !important; border-radius: 10px;">
                                        <div class="progress-bar" role="progressbar" aria-valuenow="<?=$data_dashboard['belum_verif']?>" aria-valuemin="0" aria-valuemax="<?=count($data_dashboard['realisasi'])?>" style="width: <?=$progress_belum.'%'?>; background-color: #343a40;">
                                        </div>
                                    </div>
                                    <span class="info-box-number"><?=$data_dashboard['belum_verif']?></span>
                                </div>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div class="d-block d-sm-block d-md-none d-lg-none d-xl-none">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-default" style="height: 450px;">
                    <div class="card-header">
                        <b>Total Target Rencana Kinerja</b><br>
                        <div class="progress progress-sm" style="height: 1rem !important; border-radius: 10px;">
                            <div class="progress-bar" role="progressbar" aria-valuenow="<?=$progress_target?>" aria-valuemin="0" aria-valuemax="<?=$progress_target?>" style="width: <?=$progress_target == 0 ? 0 : $progress_target?>%; background-color: <?=getProgressBarColor($progress_target)?>;">
                            </div>
                        </div>
                        <small style="font-size: 15px;"><strong><?=$total_target?></strong></small><br>
                        <b>Total Target Realisasi Kinerja</b><br>
                        <div class="progress progress-sm" style="height: 1rem !important; border-radius: 10px;">
                            <div class="progress-bar" role="progressbar" aria-valuenow="<?=$progress_realisasi_target?>" aria-valuemin="0" aria-valuemax="<?=$progress_realisasi_target?>" style="width: <?=$progress_realisasi_target == 0 ? 0 : $progress_realisasi_target?>%; background-color: <?=getProgressBarColor($progress_realisasi_target)?>;">
                            </div>
                        </div>
                        <small style="font-size: 15px;"><strong><?=$total_realisasi_target?></strong></small>
                    </div>
                    <div class="card-body">
                        <div class="col-12 text-center">
                            <?php $color = getProgressBarColor(formatTwoMaxDecimal($data_dashboard['total_progress']), false); ?>
                            <input data-readonly="true" disabled type="number" class="knob" 
                            value="<?=formatTwoMaxDecimal($data_dashboard['total_progress'])?>"
                            data-width="250" data-height="250" data-fgColor="<?=$color?>">
                            <div class="knob-label"><strong style="font-size: 12px;">PRESENTASE CAPAIAN REALISASI TARGET</strong></div>
                        </div>
                        <br>
                        <div class="col-12">
                            
                        </div>
                        <div class="col-12">
                            
                        </div>
                    </div>
                </div> 
            </div>
            <div class="col-lg-12">
                <div class="info-box">
                    <span class="info-box-icon bg-info"><i class="far fa-file"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text" style="font-size: 12px; font-weight: bold;">TOTAL RENCANA KINERJA</span>
                        <span class="info-box-number"><?=count($data_dashboard['rencana_kinerja'])?></span>
                    </div>
                </div>
                <?php
                    $progress_realisasi = 0;
                    $progress_diterima = 0;
                    $progress_ditolak = 0;
                    $progress_batal = 0;
                    $progress_belum = 0;
                    if(floatval($data_dashboard['realisasi']) != 0){
                        $progress_realisasi = (count($data_dashboard['realisasi']) / count($data_dashboard['realisasi'])) * 100;
                        $progress_diterima = (($data_dashboard['verif_diterima']) / count($data_dashboard['realisasi'])) * 100;
                        $progress_ditolak = (($data_dashboard['verif_ditolak']) / count($data_dashboard['realisasi'])) * 100;
                        $progress_batal = (($data_dashboard['batal_verif']) / count($data_dashboard['realisasi'])) * 100;
                        $progress_belum = (($data_dashboard['belum_verif']) / count($data_dashboard['realisasi'])) * 100;
                    }
                ?>
                <div class="info-box">
                    <span class="info-box-icon bg-info"><i class="far fa-file-alt"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text" style="font-size: 12px; font-weight: bold;">TOTAL REALISASI KINERJA</span>
                        <div class="progress progress-sm" style="height: 1rem !important; border-radius: 10px;">
                            <div class="progress-bar" role="progressbar" aria-valuenow="<?=count($data_dashboard['realisasi'])?>" aria-valuemin="0" aria-valuemax="<?=$progress_realisasi?>" style="width: <?=$progress_realisasi == 0 ? '0' : '100' ?>%; background-color: <?=getProgressBarColor($progress_realisasi)?>;">
                            </div>
                        </div>
                        <span class="info-box-number"><?=count($data_dashboard['realisasi'])?></span>
                    </div>
                </div>
                <div class="info-box">
                    <span class="info-box-icon bg-green"><i class="fa fa-check"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text" style="font-size: 12px; font-weight: bold;">KINERJA YANG SUDAH DIVERIFIKASI</span>
                        <div class="progress progress-sm" style="height: 1rem !important; border-radius: 10px;">
                            <div class="progress-bar" role="progressbar" aria-valuenow="<?=$data_dashboard['verif_diterima']?>" aria-valuemin="0" aria-valuemax="<?=count($data_dashboard['realisasi'])?>" style="width: <?=$progress_diterima.'%'?>; background-color: <?=getProgressBarColor($progress_diterima)?>;">
                            </div>
                        </div>
                        <span class="info-box-number"><?=$data_dashboard['verif_diterima']?></span>
                    </div>
                </div>
                    <div class="info-box">
                        <span class="info-box-icon bg-danger"><i class="fa fa-times"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text" style="font-size: 12px; font-weight: bold;">KINERJA YANG DITOLAK VERIFIKASI</span>
                            <div class="progress progress-sm" style="height: 1rem !important; border-radius: 10px;">
                                <div class="progress-bar" role="progressbar" aria-valuenow="<?=$data_dashboard['verif_ditolak']?>" aria-valuemin="0" aria-valuemax="<?=count($data_dashboard['realisasi'])?>" style="width: <?=$progress_ditolak.'%'?>; background-color: #dc3545;">
                                </div>
                            </div>
                            <span class="info-box-number"><?=$data_dashboard['verif_ditolak']?></span>
                        </div>
                    </div>
                <div class="info-box">
                    <span class="info-box-icon bg-warning"><i class="fa fa-minus"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text" style="font-size: 12px; font-weight: bold;">KINERJA YANG DIBATALKAN VERIFIKASI</span>
                        <div class="progress progress-sm" style="height: 1rem !important; border-radius: 10px;">
                            <div class="progress-bar" role="progressbar" aria-valuenow="<?=$data_dashboard['batal_verif']?>" aria-valuemin="0" aria-valuemax="<?=count($data_dashboard['realisasi'])?>" style="width: <?=$progress_batal.'%'?>; background-color: #ffc107;">
                            </div>
                        </div>
                        <span class="info-box-number"><?=$data_dashboard['batal_verif']?></span>
                    </div>
                </div>
                <div class="info-box">
                    <span class="info-box-icon bg-dark"><i class="far fa-circle"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text" style="font-size: 12px; font-weight: bold;">KINERJA YANG BELUM DIVERIFIKASI</span>
                        <div class="progress progress-sm" style="height: 1rem !important; border-radius: 10px;">
                            <div class="progress-bar" role="progressbar" aria-valuenow="<?=$data_dashboard['belum_verif']?>" aria-valuemin="0" aria-valuemax="<?=count($data_dashboard['realisasi'])?>" style="width: <?=$progress_belum.'%'?>; background-color: #343a40;">
                            </div>
                        </div>
                        <span class="info-box-number"><?=$data_dashboard['belum_verif']?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(function(){
            $('#loader').hide()

            $('.knob').knob({
                /*change : function (value) {
                //console.log("change : " + value);
                },
                release : function (value) {
                console.log("release : " + value);
                },
                cancel : function () {
                console.log("cancel : " + this.value);
                },*/
                draw: function () {

                    // "tron" case
                    if (this.$.data('skin') == 'tron') {

                        var a   = this.angle(this.cv)  // Angle
                            ,
                            sa  = this.startAngle          // Previous start angle
                            ,
                            sat = this.startAngle         // Start angle
                            ,
                            ea                            // Previous end angle
                            ,
                            eat = sat + a                 // End angle
                            ,
                            r   = true

                        this.g.lineWidth = this.lineWidth

                        this.o.cursor
                        && (sat = eat - 0.3)
                        && (eat = eat + 0.3)

                        if (this.o.displayPrevious) {
                            ea = this.startAngle + this.angle(this.value)
                            this.o.cursor
                            && (sa = ea - 0.3)
                            && (ea = ea + 0.3)
                            this.g.beginPath()
                            this.g.strokeStyle = this.previousColor
                            this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sa, ea, false)
                            this.g.stroke()
                        }

                        this.g.beginPath()
                        this.g.strokeStyle = r ? this.o.fgColor : this.fgColor
                        this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sat, eat, false)
                        this.g.stroke()

                        this.g.lineWidth = 2
                        this.g.beginPath()
                        this.g.strokeStyle = this.o.fgColor
                        this.g.arc(this.xy, this.xy, this.radius - this.lineWidth + 1 + this.lineWidth * 2 / 3, 0, 2 * Math.PI, false)
                        this.g.stroke()

                        return false
                    }
                }
            })
        })
    </script>
<?php } ?>