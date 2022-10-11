
<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>

<?php if($result){ ?>
    <table class="table table-striped table-hover data_table">
        <thead>
            <th class="text-center">No</th>
            <th class="text-center">Parameter</th>
            <th class="text-center">Kategori</th>
            <th class="text-center">Jenis</th>
            <th class="text-center">Harga</th>
            <th class="text-center">Pilihan</th>
        </thead>
        <tbody>
            <?php $no=1; foreach($result as $rs){ ?>
                <tr>
                    <td class="text-center"><?=$no++;?></td>
                    <td class="text-left"><?=$rs['nama_parameter_jenis_pelayanan']?></td>
                    <td class="text-left"><?=$rs['nama_kategori_parameter']?></td>
                    <td class="text-left"><?=$rs['nama_jenis_parameter']?></td>
                    <td class="text-left"><?=formatCurrency($rs['harga'])?></td>
                    <td class="text-center">
                   <input type="checkbox" checked data-toggle="toggle" data-size="sm">
                        <button onclick="deleteParameter('<?=$rs['id']?>')" id="btn_save_<?=$rs['id']?>" class="btn btn-sm btn-danger" ><i class="fa fa-save"></i> Hapus</button>
                        <button style="display: none;" disabled id="btn_save_loading_<?=$rs['id']?>" class="btn btn-sm btn-danger" type="submit"><i class="fa fa-spin fa-spinner"></i> Menghapus...</button>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <script>
        $(function(){
            $('.data_table').dataTable()
        })

        function deleteParameter(id){
            $('#btn_save_'+id).hide()
            $('#btn_save_loading_'+id).show()
            if(confirm('Apakah Anda yakin ingin menghapus Parameter?')){
                $.ajax({
                    url: '<?=base_url("master/C_Master/deleteParameterJenisPelayanan/")?>'+id,
                    method: 'post',
                    data:$(this).serialize(),
                    success: function(res){
                        let rs = JSON.parse(res)
                        if(rs.code == 0){
                            successtoast('Data berhasil dihapus')
                            loadListParameter()
                            $('#btn_save_'+id).show()
                            $('#btn_save_loading_'+id).hide()
                        } else {
                            errortoast(rs.message)
                            $('#btn_save_'+id).show()
                            $('#btn_save_loading_'+id).hide()
                        }
                    }, error: function(e){
                        errortoast('Terjadi Kesalahan')
                    }
                })
            }
        }
    </script>
<?php } else { ?>
    <div class="text-center">
        <h5>Parameter Belum Ada <i class="fa fa-exclamation"></i></h5>
    </div>
<?php } ?>