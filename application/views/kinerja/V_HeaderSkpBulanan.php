<table border=1 style="padding: 2px; width: <?=$width?>%;">
    <tr>
        <td style="padding: 5px; font-weight: bold; width: 5%;" class="text-center">No</td>
        <td style="padding: 5px; font-weight: bold; width: 45%;"class="text-center" colspan=2>ATASAN LANGSUNG</td>
        <td style="padding: 5px; font-weight: bold; width: 5%;" class="text-center">No</td>
        <td style="padding: 5px; font-weight: bold; width: 45%;" class="text-center" colspan=2>PEGAWAI YANG BERSANGKUTAN</td>
    </tr>
    <tr>
        <td style="padding: 5px;" class="text-center">1</td>
        <td style="padding: 5px;">Nama</td>
        <td style="padding: 5px;"><?=strtoupper(getNamaPegawaiFull($atasan_pegawai))?></td>
        <td style="padding: 5px;" class="text-center">1</td>
        <td style="padding: 5px;">Nama</td>
        <td style="padding: 5px;"><?=getNamaPegawaiFull($pegawai)?></td>
    </tr>
    <tr>
        <td style="padding: 5px;" class="text-center">2</td>
        <td style="padding: 5px;">NIP</td>
        <td style="padding: 5px;" class=><?=formatNip($atasan_pegawai['nipbaru_ws'])?></td>
        <td style="padding: 5px;" class="text-center">2</td>
        <td style="padding: 5px;">NIP</td>
        <td style="padding: 5px;"><?=formatNip($pegawai['nipbaru_ws'])?></td>
    </tr>
    <tr>
        <td style="padding: 5px;" style="width: 5%" class="text-center">3</td>
        <td style="padding: 5px;" style="width: 12%">Pangkat/Gol. Ruang</td>
        <td style="padding: 5px;" style="width: 33%"><?=$atasan_pegawai['nm_pangkat']?></td>
        <td style="padding: 5px;" style="width: 5%" class="text-center">3</td>
        <td style="padding: 5px;" style="width: 12%">Pangkat/Gol. Ruang</td>
        <td style="padding: 5px;" style="width: 33%"><?=$pegawai['nm_pangkat']?></td>
    </tr>
    <tr>
        <td style="padding: 5px;" class="text-center">4</td>
        <td style="padding: 5px;">Jabatan</td>
        <td style="padding: 5px;"><?=$atasan_pegawai['nama_jabatan']?></td>
        <td style="padding: 5px;" class="text-center">4</td>
        <td style="padding: 5px;">Jabatan</td>
        <td style="padding: 5px;"><?=$pegawai['nama_jabatan']?></td>
    </tr>
    <tr>
        <td style="padding: 5px;" class="text-center">5</td>
        <td style="padding: 5px;">Unit Kerja</td>
        <td style="padding: 5px;"><?=$atasan_pegawai['nm_unitkerja']?></td>
        <td style="padding: 5px;" class="text-center">5</td>
        <td style="padding: 5px;">Unit Kerja</td>
        <td style="padding: 5px;"><?=$pegawai['nm_unitkerja']?></td>
    </tr>
</table>