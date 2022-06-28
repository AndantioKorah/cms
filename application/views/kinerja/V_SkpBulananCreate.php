<?php
    $data['pegawai'] = $pegawai; 
    $data['atasan_pegawai'] = $atasan_pegawai; 
    $data['flag_komponen_kinerja'] = false;
    $data['kepala_pd'] = $kepala_pd;
?>

<!-- VIEW PENETAPAN SASARAN KERJA -->
<div class="card card-default p-3">
    <center>
        <span style="font-weight: bold; font-size: 16px;">PENETAPAN SASARAN KERJA BULANAN PEGAWAI</span><br>
        <span style="font-weight: bold; font-size: 16px;"><?=strtoupper($pegawai['nm_unitkerja'])?></span><br>
        <span style="font-weight: bold; font-size: 14px;">BULAN <?=strtoupper(getNamaBulan($periode['bulan']))?> TAHUN <?=$periode['tahun']?></span>
    </center>
    <div id="header_skp">
        <?php $data['width'] = '100'; $this->load->view('kinerja/V_HeaderSkpBulanan', $data); ?>
    </div>
    <div class="mt-4" id="konten_skp">
        <table border=1 style="width: 100%;">
            <tr>
                <td style="padding: 5px; font-weight: bold; width: 5%" class="text-center" rowspan=2>No</td>
                <td style="padding: 5px; font-weight: bold; width: 45%" class="text-center" rowspan=2>Uraian Tugas</td>
                <td style="padding: 5px; font-weight: bold; width: 30%" class="text-center" rowspan=2>Sasaran Kerja</td>
                <td style="padding: 5px; font-weight: bold; width: 15%" class="text-center" rowspan=1 colspan=2>Target</td>
            </tr>
            <tr>
                <td style="padding: 5px; font-weight: bold; width: 5%" class="text-center" rowspan=1>Kuantitas</td>
                <td style="padding: 5px; font-weight: bold; width: 5%" class="text-center" rowspan=1>Output</td>
            </tr>
            <?php $no=1; if($rencana_kinerja){ foreach($rencana_kinerja as $rk){ ?>
                <tr>
                    <td style="padding: 5px;" class="text-center"><?=$no++;?></td>
                    <td style="padding: 5px;"><?=$rk['tugas_jabatan']?></td>
                    <td style="padding: 5px;"><?=$rk['sasaran_kerja']?></td>
                    <td style="padding: 5px;" class="text-center"><?=$rk['target_kuantitas']?></td>
                    <td style="padding: 5px;" class="text-center"><?=$rk['satuan']?></td>
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
<!-- VIEW PENGUKURAN SASARAN KERJA -->
<div class="card card-default p-3 mt-3">
    <center>
        <span style="font-weight: bold; font-size: 16px;">PENGUKURAN SASARAN KERJA BULANAN PEGAWAI</span><br>
        <span style="font-weight: bold; font-size: 16px;"><?=strtoupper($pegawai['nm_unitkerja'])?></span><br>
        <span style="font-weight: bold; font-size: 14px;">BULAN <?=strtoupper(getNamaBulan($periode['bulan']))?> TAHUN <?=$periode['tahun']?></span>
    </center>
    <div id="header_skp">
        <?php $data['width'] = '100'; $this->load->view('kinerja/V_HeaderSkpBulanan', $data); ?>
    </div>
    <div class="mt-4" id="konten_skp">
        <table border=1 style="width: 100%;">
            <tr>
                <td style="padding: 5px; font-weight: bold; width: 5%" class="text-center" rowspan=2>No</td>
                <td style="padding: 5px; font-weight: bold; width: 30%" class="text-center" rowspan=2>Uraian Tugas</td>
                <td style="padding: 5px; font-weight: bold; width: 35%" class="text-center" rowspan=2>Sasaran Kerja</td>
                <td style="padding: 5px; font-weight: bold; width: 10%" class="text-center" rowspan=1 colspan=2>Target</td>
                <td style="padding: 5px; font-weight: bold; width: 10%" class="text-center" rowspan=1 colspan=2>Realisasi</td>
                <td style="padding: 5px; font-weight: bold; width: 10%" class="text-center" rowspan=2>Nilai Capaian</td>
            </tr>
            <tr>
                <td style="padding: 5px; font-weight: bold; width: 5%" class="text-center" rowspan=1>Kuantitas</td>
                <td style="padding: 5px; font-weight: bold; width: 5%" class="text-center" rowspan=1>Output</td>
                <td style="padding: 5px; font-weight: bold; width: 5%" class="text-center" rowspan=1>Kuantitas</td>
                <td style="padding: 5px; font-weight: bold; width: 5%" class="text-center" rowspan=1>Output</td>
            </tr>
            <?php $no=1; $akumulasi_nilai_capaian = 0; if($rencana_kinerja){ foreach($rencana_kinerja as $rk){
                $nilai_capaian = 0;    
                if(floatval($rk['total_realisasi']) > 0){
                    $nilai_capaian = (floatval($rk['total_realisasi']) / floatval($rk['target_kuantitas'])) * 100;
                }
                $akumulasi_nilai_capaian += $nilai_capaian;
            ?>
                <tr>
                    <td style="padding: 5px;" class="text-center"><?=$no++;?></td>
                    <td style="padding: 5px;"><?=$rk['tugas_jabatan']?></td>
                    <td style="padding: 5px;"><?=$rk['sasaran_kerja']?></td>
                    <td style="padding: 5px;" class="text-center"><?=$rk['target_kuantitas']?></td>
                    <td style="padding: 5px;" class="text-center"><?=$rk['satuan']?></td>
                    <td style="padding: 5px;" class="text-center"><?=$rk['total_realisasi'] ? $rk['total_realisasi'] : 0; ?></td>
                    <td style="padding: 5px;" class="text-center"><?=$rk['satuan']?></td>
                    <td style="padding: 5px;" class="text-center"><?=formatTwoMaxDecimal($nilai_capaian)?>%</td>
                </tr>
            <?php } }
                // $rata_rata = 0;
                // if(count($rencana_kinerja) != 0){
                //     $rata_rata = floatval($akumulasi_nilai_capaian) / count($rencana_kinerja);
                // }
                // $bobot = $rata_rata * 0.3;
                // if($bobot > 30){
                //     $bobot = 30;
                // }
                $kinerja = countNilaiSkp($rencana_kinerja); 
            ?>
            <tr>
                <td style="padding: 5px; text-align: right;" class="text-right;" colspan=7>CAPAIAN SASARAN KINERJA RATA-RATA</td>
                <td style="padding: 5px; text-align: center;" class="text-center;" colspan=1><strong><?=formatTwoMaxDecimal($kinerja['capaian'])?>%</strong></td>
            </tr>
            <tr>
                <td style="padding: 5px; text-align: right;" class="text-right;" colspan=7>BOBOT CAPAIAN</td>
                <td style="padding: 5px; text-align: center;" class="text-center;" colspan=1><strong><?=formatTwoMaxDecimal($kinerja['bobot'])?>%</strong></td>
            </tr>
        </table>
    </div>
    <div class="mt-4" id="footer_skp">
        <?php $data['width'] = '100'; $this->load->view('kinerja/V_FooterSkpBulanan', $data); ?>
    </div>
</div>
<!-- VIEW PENILAIAN KOMPONEN KERJA  -->
<div class="card card-default p-3 mt-3">
    <center>
        <span style="font-weight: bold; font-size: 16px;">PENILAIAN KOMPONEN KINERJA DARI PEJABAT PENILAI</span><br>
        <span style="font-weight: bold; font-size: 16px;"><?=strtoupper($pegawai['nm_unitkerja'])?></span><br>
        <span style="font-weight: bold; font-size: 14px;">BULAN <?=strtoupper(getNamaBulan($periode['bulan']))?> TAHUN <?=$periode['tahun']?></span>
    </center>
    <div id="header_skp">
        <?php $data['width'] = '100'; $this->load->view('kinerja/V_HeaderSkpBulanan', $data); ?>
    </div>
    <div class="mt-4" id="konten_skp">
        <table border=1 style="width: 100%;">
            <tr>
                <td style="padding: 5px; font-weight: bold; width: 5%; text-align: center;">NO</td>
                <td style="padding: 5px; font-weight: bold; width: 70%; text-align: center;">KOMPONEN KINERJA</td>
                <td style="padding: 5px; font-weight: bold; width: 25%; text-align: center;">NILAI</td>
            </tr>
            <tr>
                <td style="text-align: center; padding: 5px;">1</td>
                <td style="padding: 5px;">Efektivitas</td>
                <td class="text-center" style="padding: 5px;"><?=$nilai_komponen ? $nilai_komponen['efektivitas'] : ''?></td>
            </tr>
            <tr>
                <td style="text-align: center; padding: 5px;">2</td>
                <td style="padding: 5px;">Efisiensi</td>
                <td class="text-center" style="padding: 5px;"><?=$nilai_komponen ? $nilai_komponen['efisiensi'] : ''?></td>
            </tr>
            <tr>
                <td style="text-align: center; padding: 5px;">3</td>
                <td style="padding: 5px;">Inovasi</td>
                <td class="text-center" style="padding: 5px;"><?=$nilai_komponen ? $nilai_komponen['inovasi'] : ''?></td>
            </tr>
            <tr>
                <td style="text-align: center; padding: 5px;">4</td>
                <td style="padding: 5px;">Kerjasama</td>
                <td class="text-center" style="padding: 5px;"><?=$nilai_komponen ? $nilai_komponen['kerjasama'] : ''?></td>
            </tr>
            <tr>
                <td style="text-align: center; padding: 5px;">5</td>
                <td style="padding: 5px;">Kecepatan</td>
                <td class="text-center" style="padding: 5px;"><?=$nilai_komponen ? $nilai_komponen['kecepatan'] : ''?></td>
            </tr>
            <tr>
                <td style="text-align: center; padding: 5px;">6</td>
                <td style="padding: 5px;">Tanggung jawab</td>
                <td class="text-center" style="padding: 5px;"><?=$nilai_komponen ? $nilai_komponen['tanggungjawab'] : ''?></td>
            </tr>
            <tr>
                <td style="text-align: center; padding: 5px;">7</td>
                <td style="padding: 5px;">Ketaatan</td>
                <td class="text-center" style="padding: 5px;"><?=$nilai_komponen ? $nilai_komponen['ketaatan'] : ''?></td>
            </tr>
            <?php
                $capaian = null;
                $pembobotan = null;
                if($nilai_komponen){
                    list($capaian, $pembobotan) = countNilaiKomponen($nilai_komponen);
                    // $pembobotan = $pembobotan * 100;
                    // dd($p['created_by']);
                    // dd($this->general_library->getId());
                    $pembobotan = (formatTwoMaxDecimal($pembobotan)).'%';
                }
            ?>
            <tr>
                <td colspan=2 style="padding: 5px; text-align: right;"><strong>JUMLAH NILAI CAPAIAN</strong></td>
                <td class="text-center" style="padding: 5px; font-size: 18px; font-weight: bold;"><?=$capaian?></td>
            </tr>
            <tr>
                <td colspan=2 style="padding: 5px; text-align: right;"><i>HASIL PEMBOBOTAN</i></td>
                <td class="text-center" style="padding: 5px; font-size: 18px; font-weight: bold;"><i><?=$pembobotan?></i></td>
            </tr>
        </table>
    </div>
    <div class="mt-4" id="footer_skp">
        <?php $data['width'] = '100'; $data['flag_komponen_kinerja'] = true; $this->load->view('kinerja/V_FooterSkpBulanan', $data); ?>
    </div>
</div>