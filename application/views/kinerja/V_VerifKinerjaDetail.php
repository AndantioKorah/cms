<style>
    .file-wrapper:hover{
        background-color: #dddddd;
        border-radius: 5px;
        cursor: pointer;
    }
    @media screen and (max-width: 600px) {
        .status-verif{
            padding: 3px !important;
            /* font-size: 10px; */
        }
    }
</style>
<div class="modal-header">
    <h5>Detail Kegiatan</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <div class="row">
        <div class="col-6">
            <span style="font-size: 20px; font-weight: bold;"><?=$result['nama_pegawai']?></span><br>
            <span style="font-size: 16px;">NIP. <?=formatnip($result['nip_pegawai'])?></span>
        </div>
        <div class="col-6 text-right">
            <span style="font-size: 14px;">Tanggal Kegiatan:</span><br>
            <span style="font-size: 18px; font-weight: bold;"><?=formatDateNamaBulan($result['tanggal_kegiatan'])?></span>
        </div>
        <div class="col-12"><hr></div>
        <div class="col-12">
            <table class="table" border=1>
                <thead>
                    <tr>
                        <th style="width: 50%;" colspan=2 class="text-center">Kegiatan</th>
                        <th style="width: 50%;" colspan=3 class="text-center">Rencana Kegiatan</th>
                    </tr>
                    <tr>
                        <th style="width: 40%;" colspan=1>Nama Kegiatan</th>
                        <th class="text-center" style="width: 10%;" colspan=1>Realisasi</th>
                        <th style="width: 30%;" colspan=1>Nama Rencana Kegiatan</th>
                        <th class="text-center" style="width: 10%;" colspan=1>Target</th>
                        <th class="text-center" style="width: 10%;" colspan=1>Satuan</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="font-size: 16px; font-weight: bold;"><?=$result['deskripsi_kegiatan']?></td>
                        <td class="text-center" style="font-size: 16px;"><?=formatcurrencywithoutrp($result['realisasi_target_kuantitas'])?></td>
                        <td style="font-size: 16px; font-weight: bold;"><?=$result['tugas_jabatan']?></td>
                        <td class="text-center" style="font-size: 16px;"><?=formatcurrencywithoutrp($result['target_kuantitas'])?></td>
                        <td class="text-center" style="font-size: 16px;"><?=($result['satuan'])?></td>
                    </tr>
                    <tr>
                        <td colspan=5 class="text-center"><span style="font-weight: bold;">BUKTI KEGIATAN</span></td>
                    </tr>
                    <tr>
                        <td colspan=5>
                            <div class="row p-3">
                                <?php
                                    if($result['bukti_kegiatan']){
                                        $bukti = json_decode($result['bukti_kegiatan']);
                                            foreach($bukti as $bk){
                                            $explode = explode(".", $bk);
                                            $ext = $explode[count($explode) - 1];
                                            $icon = "file";
                                            if($ext == 'doc' || $ext == 'docx'){
                                                $icon = "file-word";
                                            } else if($ext == 'xls' || $ext == 'xlsx'){
                                                $icon = "file-excel";
                                            } else if($ext == 'pdf'){
                                                $icon = "file-pdf";
                                            } else if($ext == 'png' || $ext == 'jpg' || $ext == 'jpeg'){
                                                $icon = "file-image";
                                            }
                                            ?>
                                            <?php if($bk) {?>
                                            <div class="col text-center">
                                                <a style="color: black;" target="_blank" href="<?=base_url(URI_UPLOAD.'bukti_kegiatan/'.$bk)?>">
                                                    <div style="width: 80%;" class="file-wrapper p-3">
                                                        <span>
                                                            <i class="fa fa-3x fa-<?=$icon?>"></i><br>
                                                            <?=$bk?>
                                                        </span>
                                                    </div>
                                                </a>
                                            </div>
                                            <?php }
                                        }
                                    }
                                ?>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
            <hr>
            <table class="table table-hover" border=1>
                <thead>
                    <tr>
                        <th style="width: 100%;" colspan=4 class="text-center">Verifikasi</th>
                    </tr>
                    <tr>
                        <th style="width: 20%;" colspan=1>Status</th>
                        <th style="width: 30%;" colspan=1>Nama Verifikator</th>
                        <th style="width: 35%;" colspan=1>Keterangan</th>
                        <th style="width: 15%;" colspan=1>Tanggal Verifikasi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <?php
                            $status_verif = '<span class="status-verif" style="font-weight: bold; color: white; padding: 10px; background-color: grey;"><i class="fa fa-dot-circle"></i> Belum Verif</span>';
                            if($result['status_verif'] == 1){
                                $status_verif = '<span class="status-verif" style="font-weight: bold; color: white; padding: 10px; background-color: green;"><i class="fa fa-check-circle"></i> Diterima</span>';
                            } else if($result['status_verif'] == 2){
                                $status_verif = '<span class="status-verif" style="font-weight: bold; color: white; padding: 10px; background-color: red;"><i class="fa fa-times-circle"></i> Ditolak</span>';
                            } else if($result['status_verif'] == 3){
                                $status_verif = '<span class="status-verif" style="font-weight: bold; color: black; padding: 10px; background-color: yellow;"><i class="fa fa-minus-circle"></i> Verifikasi Dibatalkan</span>';
                            }
                        ?>
                        <td><?=$status_verif?></td>
                        <td><?=$result['status_verif'] != 0 ? $result['nama_pegawai_verif'] : '-'?></td>
                        <td>
                            <?php if($result['status_verif'] == 0 || $result['status_verif'] == 3){ ?>
                                <textarea class="form-control" rows=5 id="keterangan_verif_modal_<?=$result['id_t_kegiatan']?>"></textarea>
                            <?php } else { ?>
                                <span id="text_keterangan_verif_modal_<?=$result['id_t_kegiatan']?>"><?=$result['status_verif'] == 1 || $result['status_verif'] == 2 ? $result['keterangan_verif'] : '-'?></span>
                            <?php } ?>
                        </td>
                        <td><?=$result['status_verif'] != 0 ? formatDate($result['tanggal_verif']) : '-'?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary mr-auto" data-dismiss="modal">Tutup</button>
    <?php if($result['status_verif'] == 0 || $result['status_verif'] == 3){ ?>
        <button onclick="checkVerifModal(1, '<?=$result['id_t_kegiatan']?>')" title="Terima" class="btn btn_verif_modal_<?=$result['id_t_kegiatan']?> btn-sm btn-success"><i class="fa fa-check"></i> Terima</button>
        <button onclick="checkVerifModal(2, '<?=$result['id_t_kegiatan']?>')" title="Tolak" class="btn btn_verif_modal_<?=$result['id_t_kegiatan']?> btn-sm btn-danger"><i class="fa fa-times"></i> Tolak</button>
    <?php } else { ?>
        <button onclick="checkVerifModal(3, '<?=$result['id_t_kegiatan']?>')" title="Batal Verif" class="btn btn_batal_verif_modal_<?=$result['id_t_kegiatan']?> btn-sm btn-danger"><i class="fa fa-trash"></i> Batal Verif</button>
    <?php } ?>
    <button style="display: none;" disabled class="btn_loading_modal btn btn-sm btn-warning"><i class="fa fa-spin fa-spinner"></i> Loading...</button>
</div>
<script>
    function checkVerifModal(status, id){
        $('.btn_verif_modal_'+id).hide()
        $('.btn_loading_modal').show()
        $('.btn_batal_verif_modal_'+id).hide()
        $.ajax({
            url: '<?=base_url("kinerja/C_VerifKinerja/checkVerif")?>'+'/'+status+'/'+id,
            method: 'post',
            data: {
                'keterangan_verif' : $('#keterangan_verif_modal_'+id).val()
            },
            success: function(data){
                let rs = JSON.parse(data)
                if(rs.code == 0){
                    if(rs.status == 0){
                        $('#status_belum_verif_'+id).show()
                        $('#status_sudah_verif_'+id).hide()
                        $('#status_tolak_verif_'+id).hide()
                        $('#status_batal_verif_'+id).hide()
                    } else if(rs.status == 1){
                        $('#status_belum_verif_'+id).hide()
                        $('#status_sudah_verif_'+id).show()
                        $('#status_tolak_verif_'+id).hide()
                        $('#status_batal_verif_'+id).hide()
                    } else if(rs.status == 2){
                        $('#status_belum_verif_'+id).hide()
                        $('#status_sudah_verif_'+id).hide()
                        $('#status_tolak_verif_'+id).show()
                        $('#status_batal_verif_'+id).hide()
                    } else if(rs.status == 3){
                        $('#status_belum_verif_'+id).hide()
                        $('#status_sudah_verif_'+id).hide()
                        $('#status_tolak_verif_'+id).hide()
                        $('#status_batal_verif_'+id).show()
                    }
                    if(rs.status == 1 || rs.status == 2){
                        $('.btn_verif_'+id).hide()
                        $('.btn_loading_'+id).hide()
                        $('.btn_batal_verif_'+id).show()
                        $('#text_keterangan_verif_'+id).html($('#keterangan_verif_modal_'+id).val())
                        
                        $('#text_keterangan_verif_'+id).show()
                        $('#keterangan_verif_'+id).hide()
                        $('#keterangan_verif_'+id).val('')
                    } else if(rs.status == 3){
                        $('.btn_verif_'+id).show()
                        $('.btn_loading_'+id).hide()
                        $('.btn_batal_verif_'+id).hide()

                        $('#text_keterangan_verif_'+id).html()
                        $('#text_keterangan_verif_'+id).hide()
                        $('#keterangan_verif_'+id).val('')
                        $('#keterangan_verif_'+id).show()
                    }
                    loadDetailKegiatan('<?=$result['id_t_kegiatan']?>')
                } else {
                    errortoast(rs.message)
                }
            }, error: function(e){
                errortoast('Terjadi Kesalahan')
            }
        })
    }
</script>