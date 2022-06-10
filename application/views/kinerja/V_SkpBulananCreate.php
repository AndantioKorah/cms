<?php
    $data['pegawai'] = $pegawai; 
    $data['atasan_pegawai'] = $atasan_pegawai; 
?>
<div class="card card-default p-3">
    <center>
        <span style="font-weight: bold; font-size: 16px;">PENEATAPAN SASARAN KERJA BULANAN PEGAWAI</span><br>
        <span style="font-weight: bold; font-size: 16px;"><?=strtoupper($pegawai['nm_unitkerja'])?></span><br>
        <span style="font-weight: bold; font-size: 14px;">BULAN <?=strtoupper(getNamaBulan($periode['bulan']))?> TAHUN <?=$periode['tahun']?></span>
    </center>
    <div id="header_skp">
        <?php $data['width'] = '100'; $this->load->view('kinerja/V_HeaderSkpBulanan', $data); ?>
    </div>
    <div class="mt-4" id="konten_skp">
        <table border=1 style="width: 100%;">
            <tr>
                <td style="font-weight: bold; width: 5%" class="text-center" rowspan=2>No</td>
                <td style="font-weight: bold; width: 45%" class="text-center" rowspan=2>Uraian Tugas</td>
                <td style="font-weight: bold; width: 30%" class="text-center" rowspan=2>Sasaran Kerja</td>
                <td style="font-weight: bold; width: 15%" class="text-center" rowspan=1 colspan=2>Target</td>
            </tr>
            <tr>
                <td style="font-weight: bold; width: 5%" class="text-center" rowspan=1>Kuantitas</td>
                <td style="font-weight: bold; width: 5%" class="text-center" rowspan=1>Output</td>
            </tr>
            <?php $no=1; if($rencana_kinerja){ foreach($rencana_kinerja as $rk){ ?>
                <tr>
                    <td class="text-center"><?=$no++;?></td>
                    <td><?=$rk['tugas_jabatan']?></td>
                    <td></td>
                    <td class="text-center"><?=$rk['target_kuantitas']?></td>
                    <td class="text-center"><?=$rk['satuan']?></td>
                </tr>
            <?php } } ?>
            <tr>
            </tr>
        </table>
    </div>
    <div class="mt-4" id="footer_skp">
        <?php $data['width'] = '100'; $this->load->view('kinerja/V_FooterSkpBulanan', $data); ?>
    </div>
</div>