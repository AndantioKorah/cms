<?php if($list_galeri){ ?>
    <div class="table-responsive">
    <table id="datatable" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>No</th>
                <th>Judul Gambar</th>
                <th>Tanggal</th>
                <th>Gambar</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        <?php $no=1; $link = "https://www.youtube.com/watch?v=dlFA0Zq1k2A&list=RDwinCuC8dYdA&index=8&ab_channel=KANABOONVEVO"; foreach($list_galeri as $lb){ ?>
                   <tr>
                    <td><?= $no++;?> </td>
                    <td><?=$lb['nama'];?></td>
                    <td><?= formatDateOnly($lb['tanggal']);?></td>
                    <td> <img style='width:800;height:300px;' src="<?=base_url('assets/admin/galeri/'.$lb['isi_galeri'].'')?>"> </td>
                  <td> <button onclick="deleteGaleri('<?=$lb['id']?>')" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Hapus"><i class="fa fa-trash" ></i></button></td>
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

$(document).ready(function() {
        $('#datatable').DataTable();
    });

        function deleteGaleri(id){
           
           if(confirm('Apakah Anda yakin ingin menghapus data?')){
               $.ajax({
                   url: '<?=base_url("admin/C_admin/deleteGaleri/")?>'+id,
                   method: 'post',
                   data: null,
                   success: function(){
                       successtoast('Data sudah terhapus')
                       loadListGaleri()
                   }, error: function(e){
                       errortoast('Terjadi Kesalahan')
                   }
               })
           }
       }
</script>