<?php if($result){ ?>
    <div class="row p-3">
        <div class="col-12">
            <h6><strong><?=strtoupper($skpd)?></strong></h6>
        </div>
        <div class="col-12">
            <table class="table table-sm">
                <thead>
                    <th class="text-center" style="width: 10%;">No</th>
                    <th style="width: 20%;">Nama Bidang</th>
                    <th style="width: 70%;">Nama Sub Bidang</th>
                </thead>
                <tbody>
                    <?php $no = 1; foreach($result as $rs){ ?>
                        <tr>
                            <td class="text-center"><?=$no++?></td>
                            <td colspan=2><?=$rs['nama_bidang']?></td>
                        </tr>
                        <?php $no_sub = 1; foreach($rs['sub_bidang'] as $sb){ ?>
                            <tr>
                                <td colspan=2></td>
                                <td><?=$sb?></td>
                            </tr>
                        <?php } ?>
                    <?php } ?>
                </tbody>
            </table>
            <hr>
        </div>
        <div class="col-9"></div>
        <div class="col-3">
            <button id="btn_import_item" class="btn btn-block btn-navy"><i class="fa fa-file-import"></i> Import</button>
            <button style="display: none;" disabled id="btn_loading_import" class="btn btn-block btn-navy"><i class="fa fa-spin fa-spinner"></i> Loading...</button>
        </div>
    </div>

    <script>
        $('#btn_import_item').on('click', function(){
            $('#btn_loading_import').show()
            $(this).hide()
            $.ajax({
                url: '<?=base_url("master/C_Master/saveImportBidang")?>',
                method: 'post',
                data: $(this).serialize(),
                success: function(data){
                    let resp = JSON.parse(data)
                    if(resp.code == 0){
                        loadMasterBidang()
                    } else {
                        errortoast(resp.message)
                    }
                    $('#btn_loading_import').hide()
                    $('#btn_import_item').show()
                }, error: function(e){
                    $('#btn_loading_import').hide()
                    $('#btn_import_item').show()
                    errortoast('Terjadi Kesalahan')
                }
            })
        })
    </script>
<?php } else { ?>
    <div class="col-12 p-3">
        <h6>DATA TIDAK DITEMUKAN !</h6>
    </div>
<?php } ?>