<?php if($flag_komponen_kinerja){ ?>
    <table style="width: 100%;">
        <tr>
            <td style="width: 50%; text-align: center;">
                Pegawai Yang Dinilai,
            </td>
            <td style="width: 50%; text-align: center;">
                Pejabat Penilai,
            </td>
        </tr>
        <tr>
            <td><br><br><br></td>
        </tr>
        <tr>
            <td style="width: 50%; text-align: center;">
                <u><?=strtoupper(getNamaPegawaiFull($pegawai))?></u><br>
                NIP. <?=formatNip($pegawai['nipbaru_ws'])?>
            </td>
            <td style="width: 50%; text-align: center;">
                <u><?=strtoupper(getNamaPegawaiFull($atasan_pegawai))?></u><br>
                NIP. <?=formatNip($atasan_pegawai['nipbaru_ws'])?>
            </td>
        </tr>
        <table style="width: 100%;">
            <tr>
                <td style="width: 100%; text-align: center;">Menyetujui,</td>
            </tr>
            <tr>
                <td style="width: 100%; text-align: center;">Kepala Perangkat Daerah</td>
            </tr>
            <tr>
                <td><br><br><br></td>
            </tr>
            <?php // if($atasan_pegawai['nipbaru_ws'] != $kepala_pd['nipbaru_ws']){ ?>
                <tr>
                    <td style="width: 100%; text-align: center;">
                        <u><?=strtoupper(getNamaPegawaiFull($kepala_pd))?></u><br>
                        NIP. <?=formatNip($kepala_pd['nipbaru_ws'])?>
                    </td>
                </tr>
            <?php // } ?>
        </table>
    </table>
<?php } else { ?>
    <table style="width: 100%;">
        <tr>
            <td style="width: 50%; text-align: center;">
                Atasan Langsung,
            </td>
            <td style="width: 50%; text-align: center;">
                Pegawai Yang Bersangkutan,
            </td>
        </tr>
        <tr>
            <td><br><br><br></td>
        </tr>
        <tr>
            <td style="width: 50%; text-align: center;">
                <u><?=strtoupper(getNamaPegawaiFull($atasan_pegawai))?></u><br>
                NIP. <?=formatNip($atasan_pegawai['nipbaru_ws'])?>
            </td>
            <td style="width: 50%;" class="text-center">
                <u><?=strtoupper(getNamaPegawaiFull($pegawai))?></u><br>
                NIP. <?=formatNip($pegawai['nipbaru_ws'])?>
            </td>
        </tr>
    </table>
<?php } ?>