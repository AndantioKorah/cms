<?php if($list_covid19){ ?>
    <div class="table-responsive">
    <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>No</th>
                <th>Judul </th>
                <th>Tanggal</th>
                <th>File</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        <?php $no=1; foreach($list_covid19 as $lb){ ?>
                   <tr>
                    <td><?=$no++;?></td>
                    <td><?=$lb['judul'];?></td>
                    <td><?= formatDateOnly($lb['tanggal']);?></td>
                    <td> <a style='width:800;height:300px;' href="<?=base_url('assets/admin/covid19/'.$lb['file'].'')?>" target="_blank"><i class="fa fa-file" aria-hidden="true"></i></a> </td>
                  <td> <button onclick="deleteCovid19('<?=$lb['id']?>')" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Hapus"><i class="fa fa-trash" ></i></button></td>
                   </tr>
                <?php } ?>
        </tfoot>
    </table>
    </div>
        <!-- Modal Ubah -->
<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="edit-data" class="modal fade">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body" id="modal_detail_berita">
            
                     
                     
                 </div>
                
               
            </div>
        </div>
    </div>
</div>
<!-- END Modal Ubah -->
    <?php } else { ?>
    <div class="row">
        <div class="col-12">
            <h5 style="text-center">BELUM ADA DATA <i class="fa fa-exclamation"></i></h5>
        </div>
    </div>
<?php } ?>
<script>
     $('#example').DataTable();
        function deleteCovid19(id){
           
           if(confirm('Apakah Anda yakin ingin menghapus data?')){
               $.ajax({
                   url: '<?=base_url("admin/C_Admin/deleteCovid19Regulasi/")?>'+id,
                   method: 'post',
                   data: null,
                   success: function(){
                       successtoast('Data sudah terhapus')
                       loadListCovid19()
                   }, error: function(e){
                       errortoast('Terjadi Kesalahan')
                   }
               })
           }
       }
</script>