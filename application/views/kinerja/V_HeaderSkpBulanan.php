<table border=1 style="padding: 2px; width: <?=$width?>%;">
    <tr>
        <td style="font-weight: bold; width: 5%;" class="text-center">No</td>
        <td style="font-weight: bold; width: 45%;"class="text-center" colspan=2>ATASAN LANGSUNG</td>
        <td style="font-weight: bold; width: 5%;" class="text-center">No</td>
        <td style="font-weight: bold; width: 45%;" class="text-center" colspan=2>PEGAWAI YANG BERSANGKUTAN</td>
    </tr>
    <tr>
        <td class="text-center">1</td>
        <td>Nama</td>
        <td><?=strtoupper(getNamaPegawaiFull($atasan_pegawai))?></td>
        <td class="text-center">1</td>
        <td>Nama</td>
        <td><?=getNamaPegawaiFull($pegawai)?></td>
    </tr>
    <tr>
        <td class="text-center">2</td>
        <td>NIP</td>
        <td class=><?=formatNip($atasan_pegawai['nipbaru_ws'])?></td>
        <td class="text-center">2</td>
        <td>NIP</td>
        <td><?=formatNip($pegawai['nipbaru_ws'])?></td>
    </tr>
    <tr>
        <td style="width: 5%" class="text-center">3</td>
        <td style="width: 12%">Pangkat/Gol. Ruang</td>
        <td style="width: 33%"><?=$atasan_pegawai['nm_pangkat']?></td>
        <td style="width: 5%" class="text-center">3</td>
        <td style="width: 12%">Pangkat/Gol. Ruang</td>
        <td style="width: 33%"><?=$pegawai['nm_pangkat']?></td>
    </tr>
    <tr>
        <td class="text-center">4</td>
        <td>Jabatan</td>
        <td><?=$atasan_pegawai['nama_jabatan']?></td>
        <td class="text-center">4</td>
        <td>Jabatan</td>
        <td><?=$pegawai['nama_jabatan']?></td>
    </tr>
    <tr>
        <td class="text-center">5</td>
        <td>Unit Kerja</td>
        <td><?=$atasan_pegawai['nm_unitkerja']?></td>
        <td class="text-center">5</td>
        <td>Unit Kerja</td>
        <td><?=$pegawai['nm_unitkerja']?></td>
    </tr>
</table>