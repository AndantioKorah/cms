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
<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="edit-data-galeri" class="modal fade">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body" id="modal_detail_download">
           
            <form action="<?=base_url("admin/C_Admin/updateKontenGaleriImages")?>" method="post" id="form_edit_gambar" align="center" enctype="multipart/form-data">  
            <input type="hidden" class="form-control " name="id_gambar" id="id_gambar"  autocomplete="off" required/>
                <div class="form-group text-left">
                <label class="bmd-label-floating">Judul Gambar</label>
                    <textarea class="form-control" name="edit_gambar_judul" id="edit_gambar_judul" rows="3" required></textarea>
                </div>
   
                <div class="form-group text-left">
                <label class="bmd-label-floating">Tanggal</label>
                    <input class="form-control datepicker" name="edit_gambar_tanggal" id="edit_gambar_tanggal"  autocomplete="off" required/>
                </div>


                <div class="col-lg-12 col-md-4 text-right mt-2">
                        <button class="btn btn-block btn-navy" id="btn_upload"><i class="fa fa-save"></i> SIMPAN</button>
                        </div>
                </form> 
                     
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


  $('#edit-data-galeri').on('show.bs.modal', function (event) {
          $('#edit_gambar_tanggal').val("");
          var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan
          var modal          = $(this)
          // Isi nilai pada field
          modal.find('#id_gambar').attr("value",div.data('id'));
          modal.find('#edit_gambar_judul').html(div.data('judul'));
          modal.find('#edit_gambar_tanggal').attr("value",div.data('tanggal'));
          $('#edit_gambar_tanggal').val(div.data('tanggal'));
         
      });


      $('.datetimepickerthis').datetimepicker({
            format: 'yyyy-mm-dd hh:ii:ss',
            autoclose: true,
            todayHighlight: true,
            todayBtn: true
        })

        $('.datepicker').datepicker({
        todayHighlight: true,
        todayBtn: "linked",
        keyboardNavigation:true,
        autoclose: true,
        format: 'yyyy-mm-dd',
    })



</script>