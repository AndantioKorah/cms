<style>
    .big_span{
        font-size: 22px;
        font-weight: bold;
    }

    .smaller_span{
        font-size: 16px;
        font-weight: bold;
    }
</style>
<?php if($data_skpd){ ?>
    <div class="card card-default">
        <div class="card-header">
            <span class="big_span"><?=strtoupper($data_skpd[0]['nm_unitkerja'])?></span><br>
            <table>
                <tr>
                    <td class="smaller_span" style="width: 20%">Alamat</td>
                    <td class="smaller_span" style="width: 5%">:</td>
                    <td class="smaller_span" style="width: 75%"><?=$data_skpd[0]['alamat_unitkerja']?></td>
                </tr>
                <tr>
                    <td class="smaller_span" style="width: 20%">No. Telp</td>
                    <td class="smaller_span" style="width: 5%">:</td>
                    <td class="smaller_span" style="width: 75%"><?=$data_skpd[0]['notelp']?></td>
                </tr>
                <tr>
                    <td class="smaller_span" style="width: 20%">Email</td>
                    <td class="smaller_span" style="width: 5%">:</td>
                    <td class="smaller_span" style="width: 75%"><?=$data_skpd[0]['emailskpd']?></td>
                </tr>
            </table>
        </div>
    </div>
    <div class="row">
        <!-- <div class="col-12">
            <div class="row">
                <div class="col-3">
                    <div class="small-box bg-info">
                    <div class="inner">
                        <h3><?=count($data_skpd)?></h3>

                        <p>Jumlah Pegawai</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-3x fa-user"></i>
                    </div>
                    <a href="#" class="small-box-footer">
                        More info <i class="fas fa-arrow-circle-right"></i>
                    </a>
                    </div>
                </div>

                <div class="col-3">
                    <div class="small-box bg-info">
                    <div class="inner">
                        <h3><?=count($data_skpd)?></h3>

                        <p>Pegawai yang sudah input Rencana Kegiatan</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-3x fa-file"></i>
                    </div>
                    <a href="#" class="small-box-footer">
                        More info <i class="fas fa-arrow-circle-right"></i>
                    </a>
                    </div>
                </div>

                <div class="col-3">
                    <div class="small-box bg-info">
                    <div class="inner">
                        <h3><?=count($data_skpd)?></h3>

                        <p>Pegawai yang sudah input Realisasi Kegiatan</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-file-alt"></i>
                    </div>
                    <a href="#" class="small-box-footer">
                        More info <i class="fas fa-arrow-circle-right"></i>
                    </a>
                    </div>
                </div>

                <div class="col-3">
                    <div class="small-box bg-info">
                    <div class="inner">
                        <h3><?=count($data_skpd)?></h3>

                        <p>Presentase yang sudah input Realisasi Kegiatan</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-file-alt"></i>
                    </div>
                    <a href="#" class="small-box-footer">
                        More info <i class="fas fa-arrow-circle-right"></i>
                    </a>
                    </div>
                </div>
            </div>
        </div> -->
        <!-- <div class="col-12">
            <div class="row">
                <div class="col-6">
                    <div class="card card-default" style="height: 600px;">
                        <div class="card-header">
                            <h6>CAPAIAN REALISASI KEGIATAN</h6>
                        </div>
                        <div class="card-body">
                            <div class="col-12 text-center">
                                <input data-readonly="true" type="text" class="knob" value="90" data-width="450" data-height="450" data-fgColor="#932ab6">
                                <div class="knob-label">Bandwidth</div>
                            </div>
                        </div>
                    </div> 
                </div>
                <div class="col-6">
                    <div class="card card-default" style="height: 600px;">
                        <div class="row">
                            <div class="col-12">
                                <div class="info-box">
                                    <span class="info-box-icon bg-info"><i class="far fa-envelope"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">TOTAL RENCANA KEGIATAN</span>
                                        <span class="info-box-number">1,410</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="info-box">
                                    <span class="info-box-icon bg-info"><i class="far fa-envelope"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">TOTAL REALISASI KEGIATAN</span>
                                        <span class="info-box-number">1,410</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="info-box">
                                    <span class="info-box-icon bg-info"><i class="far fa-envelope"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">VERIFIKASI REALISASI DITERIMA</span>
                                        <span class="info-box-number">1,410</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="info-box">
                                    <span class="info-box-icon bg-info"><i class="far fa-envelope"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">VERIFIKASI REALISASI DITOLAK</span>
                                        <span class="info-box-number">1,410</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="info-box">
                                    <span class="info-box-icon bg-info"><i class="far fa-envelope"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">VERIFIKASI REALISASI DIBATALKAN</span>
                                        <span class="info-box-number">1,410</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="info-box">
                                    <span class="info-box-icon bg-info"><i class="far fa-envelope"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">BELUM VERIFIKASI REALISASI</span>
                                        <span class="info-box-number">1,410</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
        <div class="col-12">
            <table style="width: 100%;">
                <tr>
                    <td rowspan=7 style="width: 40%;">
                        <div class="card card-default" style="height: 600px;">
                            <div class="card-header">
                                <h6>CAPAIAN REALISASI KEGIATAN</h6>
                            </div>
                            <div class="card-body">
                                <div class="col-12 text-center">
                                    <input data-readonly="true" type="text" class="knob" value="90" data-width="450" data-height="450" data-fgColor="#932ab6">
                                    <div class="knob-label">CAPAIAN REALISASI TARGET</div>
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
                <tr>
                    <td style="padding-left: 30px;">
                        <div class="info-box">
                            <span class="info-box-icon bg-info"><i class="far fa-file-alt"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">TOTAL REALISASI KINERJA</span>
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
                                <span class="info-box-number">1,410</span>
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
                                <span class="info-box-number">1,410</span>
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
                                <span class="info-box-number">1,410</span>
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
                                <span class="info-box-number">1,410</span>
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <script>
        $(function(){
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