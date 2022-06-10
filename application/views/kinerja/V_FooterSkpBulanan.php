<table style="width: 100%;">
    <tr>
        <td style="width: 50%;" class="text-center">
            Atasan Langsung,
        </td>
        <td style="width: 50%;" class="text-center">
            Pegawai Yang Bersangkutan,
        </td>
    </tr>
    <tr>
        <td><br><br><br></td>
    </tr>
    <tr>
        <td style="width: 50%;" class="text-center">
            <u><?=strtoupper(getNamaPegawaiFull($atasan_pegawai))?></u><br>
            NIP. <?=formatNip($atasan_pegawai['nipbaru_ws'])?>
        </td>
        <td style="width: 50%;" class="text-center">
            <u><?=strtoupper(getNamaPegawaiFull($pegawai))?></u><br>
            NIP. <?=formatNip($pegawai['nipbaru_ws'])?>
        </td>
    </tr>
</table>