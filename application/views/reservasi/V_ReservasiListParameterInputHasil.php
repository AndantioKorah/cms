<?php if($result){ ?>
    <form id="form_input_hasil">
        <div style="max-height: 60vh; overflow-y: auto;" class="table-responsive">
            <span>Total Data : </span><span style="font-weight: bold;"><?=count($result)?></span>
            <table class="table table-hover">
                <thead>
                    <th class="text-center">No</th>
                    <th class="text-center">Jenis Sampel</th>
                    <th class="text-center">No. Sampel</th>
                    <th class="text-center">Tgl. Pngmblm Sampel</th>
                    <!-- <th class="text-center">Lok. Pngmblm Sampel</th> -->
                    <!-- <th class="text-center">Nama Parameter</th> -->
                    <th class="text-center">Satuan</th>
                    <th class="text-center">Hasil</th>
                </thead>
                <tbody>
                    <?php $no = 1; foreach($result as $rs){ ?>
                        <tr>
                            <td class="text-center"><?=$no++;?></td>
                            <td class="text-center"><?=$rs['nama_jenis_pelayanan']?></td>
                            <td class="text-center"><?=$rs['no_sampel']?></td>
                            <td class="text-center"><?= $rs['waktu_pengambilan_sampel'] ? formatDate($rs['waktu_pengambilan_sampel']) : ''?></td>
                            <!-- <td class="text-center"><?=$rs['lokasi_pengambilan_sampel']?></td> -->
                            <!-- <td class="text-center"><?=$rs['nama_parameter_jenis_pelayanan']?></td> -->
                            <td class="text-center"><?=$rs['satuan']?></td>
                            <td class="text-center">
                                <input class="form-control form-control-sm" 
                                name="hasil_lab_<?=$rs['id']?>" 
                                value="<?=$rs['hasil_lab']?>" />
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <hr>
        <div class="text-right">
            <button id="btn_save" class="btn btn-sm btn-navy"></i class="fa fa-save"></i> Simpan Data Hasil</button>
            <button id="btn_loading" style="display: none;" disabled class="btn btn-sm btn-navy"></i class="fa fa-spin fa-spinner"></i> Menyimpan Data...</button>
        </div>
    </form>
    <script>
        $('#form_input_hasil').on('submit', function(e){
            e.preventDefault()
            // $('#btn_save').hide()
            // $('#btn_loading').show()
            $.ajax({
                url: '<?=base_url('reservasi/C_Reservasi/simpanInputHasil')?>',
                method: 'POST',
                data: $(this).serialize(),
                success: function(res){
                    let rs = JSON.parse(res)
                    if(rs.code == 0){
                        successtoast('Berhasil Menyimpan Hasil')
                    } else {
                        errortoast(rs.message)
                    }
                    // $('#btn_save').show()
                    // $('#btn_loading').hide()
                }, error: function(e){
                    errortoast(e)
                }
            })
        })
    </script>
<?php } else { ?>
    <div class="text-center">
        <h5>Data Tidak Ditemukan <i class="fa fa-exclamation"></i></h5>
    </div>
<?php } ?>