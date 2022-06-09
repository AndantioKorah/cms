<?php if($list_pegawai_export){ ?>
    <div class="row p-3">
        <div class="col-lg-12 col-md-12 table-responsive">
            <table class="table table-sm" id="table_import_pegawai">
                <thead>
                    <th class="text-center">No</th>
                    <th class="text-center">Nama Pegawai</th>
                    <th class="text-center">NIP</th>
                    <th class="text-center">SKPD</th>
                    <th class="text-center">Pilihan</th>
                </thead>
                <tbody>
                    <?php $no = 1; foreach($list_pegawai_export as $e){ ?>
                        <tr>
                            <td class="text-center"><?=$no++;?></td>
                            <td><?=getNamaPegawaiFull($e)?></td>
                            <td class="text-center"><?=$e['nipbaru']?></td>
                            <td><?=$e['nm_unitkerja']?></td>
                            <td class="text-center">
                                <button id="btn_export_<?=$e['id_peg']?>" onclick="exportOne('<?=$e['id_peg']?>')" class="btn btn-sm btn-info"><i class="fa fa-file-export"></i> Export</button>
                                <button style="display: none;" id="btn_loading_export_<?=$e['id_peg']?>" disabled class="btn btn-sm btn-info"><i class="fa fa-spin fa-spinner"></i> Loading...</button>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <div class="col-lg-8 col-md-8">
        </div>
        <div class="col-lg-4 col-md-4 text-right">
            <button id="btn_export_all" class="btn btn-block btn-navy">Export Semua</button>
            <button disabled style="display: none;" id="btn_loading_export_all" class="btn btn-block btn-navy"><i class="fa fa-spin fa-spinner"></i> Loading...</button>
        </div>
    </div>

    <script>
        $(function(){
            $('#table_import_pegawai').dataTable()
        })

        function exportOne(id){
            $('#btn_export_'+id).hide()
            $('#btn_loading_export_'+id).show()
            $.ajax({
                url: '<?=base_url("user/C_User/exportOne/")?>'+id,
                method: 'post',
                data: null,
                success: function(data){
                    let resp = JSON.parse(data)
                    if(resp.code == 0){
                        successtoast('Export Berhasil')
                        loadDataPegawaiFromNewDb()
                    } else {
                        errortoast(resp.message)
                    }
                }, error: function(e){
                    errortoast('Terjadi Kesalahan')
                }
            })
        }

        $('#btn_export_all').on('click', function(){
            $('#btn_export_all').hide()
            $('#btn_loading_export_all').show()
            $.ajax({
                url: '<?=base_url("user/C_User/exportAll")?>',
                method: 'post',
                data: null,
                success: function(data){
                    let resp = JSON.parse(data)
                    if(resp.code == 0){
                        successtoast('Export Berhasil')
                        loadDataPegawaiFromNewDb()
                    } else {
                        errortoast(resp.message)
                    }
                }, error: function(e){
                    errortoast('Terjadi Kesalahan')
                }
            })
        })
    </script>
<?php } else { ?>
    <div class="col-lg-12 text-center">
        <h6>TIDAK ADA DATA PEGAWAI BARU <i class="fa fa-exclamation"></i></h6>
    </div>
<?php } ?>