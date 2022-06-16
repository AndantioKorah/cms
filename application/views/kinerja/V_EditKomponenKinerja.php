<div class="row">
    <div class="col-12">
        <table style="width: 100%;">
            <thead>
                <tr>
                    <td>Nama</td>
                    <td>:</td>
                    <td style="font-weight: bold;"><?=getNamaPegawaiFull($pegawai)?></td>
                </tr>
                <tr>
                    <td>NIP</td>
                    <td>:</td>
                    <td style="font-weight: bold;"><?=formatNip($pegawai['nipbaru'])?></td>
                </tr>
                <tr>
                    <td>Pangkat</td>
                    <td>:</td>
                    <td style="font-weight: bold;"><?=$pegawai['nm_pangkat']?></td>
                </tr>
                <tr>
                    <td>Jabatan</td>
                    <td>:</td>
                    <td style="font-weight: bold;"><?=$pegawai['nama_jabatan']?></td>
                </tr>
            </thead>
        </table>
        <hr>
        <form id="form_nilai_komponen">
            <input style="display: none;" name="id_m_user" value="<?=$pegawai['id_m_user']?>" />
            <input style="display: none;" name="tahun" value="<?=$tahun?>" />
            <input style="display: none;" name="bulan" value="<?=$bulan?>" />
            <input style="display: none;" name="id_t_komponen_kinerja" value="<?=$result ? $result['id_t_komponen_kinerja'] : null ?>" />

            <table border=1 style="width: 100%;" class="table table-hover table-striped">
                <tr>
                    <td style="padding: 5px; font-weight: bold; width: 5%; text-align: center;">NO</td>
                    <td style="padding: 5px; font-weight: bold; width: 70%; text-align: center;">KOMPONEN KINERJA</td>
                    <td style="padding: 5px; font-weight: bold; width: 25%; text-align: center;">NILAI</td>
                </tr>
                <tr>
                    <td style="text-align: center; padding: 5px;">1</td>
                    <td style="padding: 5px;">Efektivitas</td>
                    <td oninput="countNilaiKomponen()" style="padding: 5px;"><input type="number" id="efektivitas_input" class="form-control form-control-sm"
                    name="efektivitas" max="100" value="<?=$result['efektivitas'] ? $result['efektivitas'] : 97;?>" /></td>
                </tr>
                <tr>
                    <td style="text-align: center; padding: 5px;">2</td>
                    <td style="padding: 5px;">Efisiensi</td>
                    <td oninput="countNilaiKomponen()" style="padding: 5px;"><input type="number" id="efisiensi_input" class="form-control form-control-sm"
                    name="efisiensi" max="100" value="<?=$result['efisiensi'] ? $result['efisiensi'] : 97;?>" /></td>
                </tr>
                <tr>
                    <td style="text-align: center; padding: 5px;">3</td>
                    <td style="padding: 5px;">Inovasi</td>
                    <td oninput="countNilaiKomponen()" style="padding: 5px;"><input type="number" id="inovasi_input" class="form-control form-control-sm"
                    name="inovasi" max="100" value="<?=$result['inovasi'] ? $result['inovasi'] : 97;?>" /></td>
                </tr>
                <tr>
                    <td style="text-align: center; padding: 5px;">4</td>
                    <td style="padding: 5px;">Kerjasama</td>
                    <td oninput="countNilaiKomponen()" style="padding: 5px;"><input type="number" id="kerjasama_input" class="form-control form-control-sm"
                    name="kerjasama" max="100" value="<?=$result['kerjasama'] ? $result['kerjasama'] : 97;?>" /></td>
                </tr>
                <tr>
                    <td style="text-align: center; padding: 5px;">5</td>
                    <td style="padding: 5px;">Kecepatan</td>
                    <td oninput="countNilaiKomponen()" style="padding: 5px;"><input type="number" id="kecepatan_input" class="form-control form-control-sm"
                    name="kecepatan" max="100" value="<?=$result['kecepatan'] ? $result['kecepatan'] : 97;?>" /></td>
                </tr>
                <tr>
                    <td style="text-align: center; padding: 5px;">6</td>
                    <td style="padding: 5px;">Tanggung jawab</td>
                    <td oninput="countNilaiKomponen()" style="padding: 5px;"><input type="number" id="tanggungjawab_input" class="form-control form-control-sm"
                    name="tanggungjawab" max="100" value="<?=$result['tanggungjawab'] ? $result['tanggungjawab'] : 97;?>" /></td>
                </tr>
                <tr>
                    <td style="text-align: center; padding: 5px;">7</td>
                    <td style="padding: 5px;">Ketaatan</td>
                    <td oninput="countNilaiKomponen()" style="padding: 5px;"><input type="number" id="ketaatan_input" class="form-control form-control-sm"
                    name="ketaatan" value="<?=$result['ketaatan'] ? $result['ketaatan'] : 97;?>" /></td>
                </tr>
                <tr>
                    <td colspan=2 style="padding: 5px; text-align: right;"><strong>JUMLAH NILAI CAPAIAN</strong></td>
                    <td class="text-center" style="padding: 5px;"><span style="font-weight:bold; font-size: 20px;" id="capaian"></span></td>
                </tr>
                <tr>
                    <td colspan=2 style="padding: 5px; text-align: right;"><i>HASIL PEMBOBOTAN</i></td>
                    <td class="text-center" style="padding: 5px;"><i><span style="font-weight:bold; font-size: 18px;" id="bobot"></span></i></td>
                </tr>
                <tr>
                    <td colspan="3" class="text-right">
                        <button id="btn_submit" type="submit" class="btn btn-sm btn-navy"><i class="fa fa-save"></i> Simpan Nilai Komponen</button>
                        <button id="btn_loading" style="display: none;" disabled class="btn btn-sm btn-navy"><i class="fa fa-spin fa-spinner"></i> Menyimpan....</button>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
<script>
    $(function(){
        countNilaiKomponen()
    })

    function countNilaiKomponen(){
        let capaian = parseInt($('#efektivitas_input').val())
                    + parseInt($('#efisiensi_input').val())
                    + parseInt($('#inovasi_input').val())
                    + parseInt($('#kerjasama_input').val())
                    + parseInt($('#kecepatan_input').val())
                    + parseInt($('#tanggungjawab_input').val())
                    + parseInt($('#ketaatan_input').val())
        $('#capaian').html(capaian)
        $('#bobot').html(countBobotNilaiKomponenKinerja(capaian).toFixed(2)+'%')
    }

    $('#form_nilai_komponen').on('submit', function(e){
        $('#btn_submit').hide()
        $('#btn_loading').show()
        e.preventDefault()
        $.ajax({
            url: '<?=base_url("kinerja/C_Kinerja/saveNilaiKomponenKinerja")?>',
            method: 'post',
            data: $(this).serialize(),
            success: function(data){
                let res = JSON.parse(data)
                if(res.code != 0){
                    errortoast(res.message)
                } else {
                    successtoast('Data berhasil disimpan')
                    $('#capaian_<?=$pegawai['id_m_user']?>').html(res.data.capaian)
                    $('#pembobotan_<?=$pegawai['id_m_user']?>').html(countBobotNilaiKomponenKinerja(res.data.capaian).toFixed(2)+'%')
                    $('#btn_submit').show()
                    $('#btn_loading').hide()
                }
            }, error: function(e){
                errortoast('Terjadi Kesalahan')
            }
        })
    })
</script>