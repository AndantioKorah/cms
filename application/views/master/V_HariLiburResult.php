<?php if($result){ ?>
    <table class="table table-hover" id="table_hari_libur">
        <thead>
            <th class="text-center">No</th>
            <th class="text-center">Tanggal</th>
            <th class="text-left">Keterangan</th>
            <th class="text-center">Pilihan</th>
        </thead>
        <tbody>
            <?php $no=1; foreach($result as $rs){ ?>
                <tr>
                    <td class="text-center"><?=$no++;?></td>
                    <td class="text-center"><?=formatDateNamaBulan(formatDateOnly($rs['tanggal']))?></td>
                    <td class="text-left"><?=$rs['keterangan']?></td>
                    <td class="text-center">
                        <button onclick="deleteHariLibur('<?=$rs['id']?>')" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Hapus</button>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <script>
        $(function(){
            $('#table_hari_libur').dataTable()
        })

        function deleteHariLibur(id){
            $.ajax({
                url: '<?=base_url("master/C_Master/deleteApiHariLibur")?>'+'/'+id,
                method: 'post',
                data: {},
                success: function(){
                    successtoast('Berhasil')
                    loadHariLibur()
                }, error: function(e){
                    errortoast('Terjadi Kesalahan')
                }
            })
        }
    </script>
<?php } else { ?>
    <div class="col-12 text-center">
        <h5>Data Tidak Ditemukan <i class="fa fa-exclamation"></i></h5>
    </div>
<?php } ?>