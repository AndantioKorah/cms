<style>
    .div_image:hover{
    background-color: #f5f5f5;  
    border-radius: 3px;
    cursor: pointer;
    transition: .3s;
  }

  .image-name{
    width: 100%;
    background-color: var(--primary);
    border-bottom-left-radius: 5px;
    border-bottom-right-radius: 5px;
    text-align: center;
    padding: 5px;
    color: white;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
  }
</style>
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
        <!-- <?php $no=1; foreach($list_galeri as $lb){ ?>
                   <tr>
                    <td><?= $no++;?> </td>
                    <td><?=$lb['nama'];?></td>
                    <td><?= formatDateOnly($lb['tanggal']);?></td>
                    <td>
                    <div class="col-lg-4 p-3 col-md-6 div_image" data-toggle="modal" href="#modal_image_preview"  onclick="openPreviewModal('<?=$lb['id']?>')">  
                    <img style='width:600;height:100px;' id="img_<?=$lb['id']?>" class="gallery-image-data b-lazy" src="<?=base_url('assets/admin/galeri/'.$lb['isi_galeri'].'')?>"
                    alt="<?=$lb['nama']?>" />
                        </div>
                </td>
                  <td> <button onclick="deleteGaleri('<?=$lb['id']?>')" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Hapus"><i class="fa fa-trash" ></i></button></td>
                   </tr>
                <?php } ?> -->
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

    window.bLazy = new Blazy({
    container: '.container',
    success: function(element){
      console.log("Element loaded: ", element.nodeName);
    }
  }); 

//   $('#datatable').DataTable();

    $('#datatable').DataTable({
        "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json"
            },
        "processing": true,
            "serverSide": true,
            // "order": [],
            "ajax": {
                //panggil method ajax list dengan ajax
                "url": '<?=base_url("admin/C_Admin/ajax_list")?>',
                "type": "POST"
            }
    });
    });

   
    function deleteGaleri(id){
           
           if(confirm('Apakah Anda yakin ingin menghapus data?')){
               $.ajax({
                   url: '<?=base_url("admin/C_Admin/deleteGaleri/")?>'+id,
                   method: 'post',
                   data: null,
                   success: function(res){
                       successtoast('Data sudah terhapus')
                       loadListGaleri()
                   }, error: function(e){
                       errortoast('Terjadi Kesalahan')
                   }
               })
           }
       }

function openPreviewModal(img){
    $('#img_preview_modal').attr('src', (''))
    $('#img_name').html('')
    $('#modal_image_preview').modal('show')
    $.ajax({
                   url: '<?=base_url("admin/C_Admin/getGaleriById/")?>'+img,
                   method: 'post',
                   data: null,
                   
                   success: function(res){
                    var result = JSON.parse(res); 
                       console.log(result.isi_galeri)
                    $('#img_preview_modal').attr('src', ('<?=base_url()?>'+'assets/admin/galeri/'+result.isi_galeri))
                    $('#img_name').html(result.nama)
                   }, error: function(e){
                       errortoast('Terjadi Kesalahan')
                   }
               })
    
  }


</script>