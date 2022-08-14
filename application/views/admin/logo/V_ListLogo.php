<?php if($list_logo){ ?>
    <div class="table-responsive">
    <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Aplikasi</th>
                <th>Logo</th>
                
                <th></th>
            </tr>
        </thead>
        <tbody>
        <?php $no=1; foreach($list_logo as $lb){ ?>
                   <tr>
                    <td><?=$no++;?></td>
                    <td><?=$lb['nama_aplikasi'];?></td>
                    <td>
                        <img  style="width:900;height:300px;"  src="<?=$lb['logo'];?>" alt="">
                        </td>
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
                   url: '<?=base_url("admin/C_Admin/deleteLogo/")?>'+id,
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