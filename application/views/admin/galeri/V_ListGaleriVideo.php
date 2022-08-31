<?php if($list_galeri_video){ ?>
    <div class="table-responsive">
    <table id="datatable2" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>No</th>
                <th>Judul Video</th>
                <th>Tanggal</th>
                <th>Link Video</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        <?php $no=1; foreach($list_galeri_video as $lb){ ?>
                   <tr>
                    <td><?=$no++;?></td>
                    <td><?=$lb['nama'];?></td>
                    <td><?= formatDateNamaBulan($lb['tanggal']);?></td>
                    <td><a href="<?=$lb['isi_galeri'];?>" target="_blank"><h5><span class="badge badge-secondary"><i class="fas fa-link"></i> <?=$lb['isi_galeri'];?></span></h5></a> 
                <?= preg_replace("/\s*[a-zA-Z\/\/:\.]*youtube.com\/watch\?v=([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i","<iframe class==\"b-lazy\" width=\"420\" height=\"315\" src=\"//www.youtube.com/embed/$1\" frameborder=\"0\" allowfullscreen></iframe>",$lb['isi_galeri']); ?>
                </td>
                  <td> 
                  <a 
                    href="javascript:;"
                    data-id="<?php echo $lb['id'] ?>"
                    data-tanggal="<?php echo formatDateOnlyForEdit($lb['tanggal']) ?>"
                    data-judul="<?php echo $lb['nama'] ?>"
                    data-link="<?php echo $lb['isi_galeri'] ?>"
                    data-toggle="modal" data-target="#edit-data-galeri-video">
                    <button  data-toggle="modal" class="btn btn-sm btn-info" title="edit"><i class="fa fa-edit" ></i></button>
                </a>
                      
                  <button onclick="deleteGaleri('<?=$lb['id']?>')" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Hapus"><i class="fa fa-trash" ></i></button></td>
                   </tr>
                <?php } ?>
        </tfoot>
    </table>
        </div>
          <!-- Modal Ubah -->
<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="edit-data-galeri-video" class="modal fade">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body" id="modal_detail_download">
           
            <form action="#" method="post" id="form_edit_video" align="center" enctype="multipart/form-data">  
            <input type="hidden" class="form-control " name="id_video" id="id_video"  autocomplete="off" required/>
                <div class="form-group text-left">
                <label class="bmd-label-floating">Judul Gambar</label>
                    <textarea class="form-control" name="edit_video_judul" id="edit_video_judul" rows="3" required></textarea>
                </div>
   
                <div class="form-group text-left">
                <label class="bmd-label-floating">Tanggal</label>
                    <input class="form-control datepicker" name="edit_video_tanggal" id="edit_video_tanggal"  autocomplete="off" required/>
                </div>

                
                <div class="form-group text-left">
                <label class="bmd-label-floating">Link Video</label>
                    <input class="form-control" name="edit_video_link" id="edit_video_link"  autocomplete="off" required/>
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
      window.bLazy = new Blazy({
    container: '.container',
    success: function(element){
      console.log("Element loaded: ", element.nodeName);
    }
  }); 

    $(document).ready(function() {
        $('#datatable2').DataTable();
    });
        function deleteGaleri(id){
           
           if(confirm('Apakah Anda yakin ingin menghapus data?')){
               $.ajax({
                   url: '<?=base_url("admin/C_Admin/deleteGaleri/")?>'+id,
                   method: 'post',
                   data: null,
                   success: function(){
                       successtoast('Data sudah terhapus')
                       loadListGaleriVideo()
                   }, error: function(e){
                       errortoast('Terjadi Kesalahan')
                   }
               })
           }
       }


       $('#edit-data-galeri-video').on('show.bs.modal', function (event) {
          
          var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan
          var modal          = $(this)

          // Isi nilai pada field
          modal.find('#id_video').attr("value",div.data('id'));
          modal.find('#edit_video_judul').html(div.data('judul'));
          modal.find('#edit_video_link').attr("value",div.data('link'));
          modal.find('#edit_video_tanggal').attr("value",div.data('tanggal'));
         
      });


      $('#form_edit_video').on('submit', function(e){ 
         
    
          e.preventDefault();    
               $.ajax({  
                   url:"<?=base_url("admin/C_Admin/updateKontenGaleriVideo")?>",  
                    method:"POST",  
                    data:new FormData(this),  
                    contentType: false,  
                    cache: false,  
                    processData:false,  
                    success:function(res)  
                    {  
                       
                       var result = JSON.parse(res); 
                    
                       if(result.success == true){
                           successtoast(result.msg)
                        //    document.getElementById("form_galeri_video").reset(); 
                        
                        $('#edit-data-galeri-video').modal('hide')
                        const myTimeout = setTimeout(loadListGaleriVideo, 1000); 
                        
                        //    loadListGaleriVideo()                          
                       } else {
                           errortoast(result.msg)
                           return false;
                       }
                    }  
               });  
            
     });

     $('.datepicker').datepicker({
        todayHighlight: true,
        todayBtn: "linked",
        keyboardNavigation:true,
        autoclose: true,
        format: 'yyyy-mm-dd',
    })

</script>