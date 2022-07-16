<?php if($list_berita){ ?>
    <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>No</th>
                <th>Judul Berita (Indonesia)</th>
                <th>Judul Berita (English)</th>
                <th>Tanggal Berita</th>
                <th>Isi Berita</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        <?php $no=1; foreach($list_berita as $lb){ ?>
                   <tr>
                    <td><?=$no++;?></td>
                    <td><?=$lb['judul_ina'];?></td>
                    <td><?=$lb['judul_eng'];?></td>
                    <td><?=$lb['tanggal_berita'];?></td>
                    <td><?=
                    substr($lb['isi_berita'], 0, 450);?>...
                    <p style="margin-top:10px;">
                    <a 
                    href="javascript:;"
                    data-id="<?php echo $lb['id'] ?>"
                    data-judul_ina="<?php echo $lb['judul_ina'] ?>"
                    data-judul_eng="<?php echo $lb['judul_eng'] ?>"
                    data-tanggal_berita="<?php echo $lb['tanggal_berita'] ?>"
                    data-isi_berita="<?php echo $lb['isi_berita'] ?>"
                    data-gambar="<?php echo $lb['gambar'] ?>"
                    data-toggle="modal" data-target="#edit-data">
                    <button  data-toggle="modal" data-target="#ubah-data" class="btn btn-info">Read More</button>
                </a>
                </p>
                    </td>
                  <td> <button onclick="deleteKegiatan('<?=$lb['id']?>')" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Hapus"><i class="fa fa-trash" ></i></button></td>
                   </tr>
                <?php } ?>
           
        </tfoot>
    </table>
   
        <!-- Modal Ubah -->
<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="edit-data" class="modal fade">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                <h4 class="modal-title"></h4>
            </div>
            <form id="form_update_berita" class="form-horizontal" method="post" enctype="multipart/form-data" role="form">
             <div class="modal-body">
                     <div class="form-group">
                         <label class="col-lg-6 col-sm-6 control-label">Judul Berita (Indonesia)</label>
                         <div class="col-lg-12">
                         <input type="hidden"  class="form-control" id="id" name="id">
                             <textarea  class="form-control" id="detail_judul_ina" name="detail_judul_ina" ></textarea>
                         </div>
                     </div>
                     <div class="form-group">
                     <label class="col-lg-6 col-sm-6 control-label">Judul Berita (English)</label>
                         <div class="col-lg-12">
                             <textarea  class="form-control" id="detail_judul_eng" name="detail_judul_eng" ></textarea>
                         </div>
                     </div>
                     <div class="form-group">
                     <label class="col-lg-6 col-sm-6 control-label">Tanggal Berita</label>
                         <div class="col-lg-12">
                             <input  class="form-control" id="detail_tanggal_berita" name="detail_tanggal_berita">
                         </div>
                     </div>
                     <div class="form-group">
                     <label class="col-lg-6 col-sm-6 control-label">Gambar</label>
                         <div class="col-lg-12">
                         <input type="file"  class="form-control" id="image_file" name="image_file">
                         <input type="hidden"  class="form-control" id="nama_gambar_lama" name="nama_gambar_lama">
                         <div id="uploadPreview"></div>
                        <div id="gambar_lama">
                        
                      
                         <!-- <img src="" class="img-fluid" alt="Responsive image"> -->
                        </div>
                         </div>
                     </div>
                    
                     <div class="form-group">
                         <label class="col-lg-2 col-sm-2 control-label">Isi Berita</label>
                         <div class="col-lg-12">
                          <textarea rows="10" class="form-control" id="detail_isi_berita" name="detail_isi_berita" ></textarea>
                         </div>
                     </div>
                     
                 </div>
                 <div class="modal-footer">
              
                     <button type="button" class="btn btn-warning" data-dismiss="modal"> Batal</button>
                     <button class="btn btn-info" type="submit"> Ubah Data&nbsp;</button>
                 </div>
                </form>
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
        $('#example').DataTable();
        // Untuk sunting
 
            
        $('#edit-data').on('show.bs.modal', function (event) {
            $('#gambar_lama').html('');
            var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan
            var modal          = $(this)

            // Isi nilai pada field
            modal.find('#id').attr("value",div.data('id'));
            modal.find('#detail_judul_ina').html(div.data('judul_ina'));
            modal.find('#detail_judul_eng').html(div.data('judul_eng'));
            modal.find('#detail_isi_berita').html(div.data('isi_berita'));
            modal.find('#detail_tanggal_berita').attr("value",div.data('tanggal_berita'));
            modal.find('#nama_gambar_lama').attr("value",div.data('gambar'));
            console.log(div.data('gambar'))
            $('#gambar_lama').append('<img class="img-fluid" alt="Responsive image" style="width:1100px;height:500px;" src="<?php echo base_url();?>/assets/berita/'+div.data('gambar')+'" class="thumb">');
            
        });
    });


    $('#form_update_berita').on('submit', function(e){ 
      
           e.preventDefault();  
                $.ajax({  
                    url:"<?=base_url("admin/C_Admin/updateKontenBerita")?>",  
                     //base_url() = http://localhost/tutorial/codeigniter  
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
                            $('#edit-data').modal('hide')
                            const myTimeout = setTimeout(loadListBerita, 500);                    
                        } else {
                            errortoast(result.msg)
                            return false;
                        }
                     }  
                });  
             
      }); 


      function deleteKegiatan(id){
           
           if(confirm('Apakah Anda yakin ingin menghapus data?')){
               $.ajax({
                   url: '<?=base_url("admin/C_admin/deleteBerita/")?>'+id,
                   method: 'post',
                   data: null,
                   success: function(){
                       successtoast('Data sudah terhapus')
                       loadListBerita()
                   }, error: function(e){
                       errortoast('Terjadi Kesalahan')
                   }
               })
           }
       }

       function readImage(file) {
        $('#uploadPreview').html('');
        $('#gambar_lama').html('');
        var reader = new FileReader();
        var image  = new Image();
        reader.readAsDataURL(file);  
        reader.onload = function(_file) {
        image.src = _file.target.result; // url.createObjectURL(file);
        image.onload = function() {
            console.log('ukuran');
            console.log(this.width + 'x' + this.height);
        var w = 1000,
        h = 500,
        t = file.type, // ext only: // file.type.split('/')[1],
        n = file.name,
        s = ~~(file.size/1024) +'KB';
        $('#uploadPreview').append('<img class="img-fluid" alt="Responsive image" style="width:1100px;height:500px;" src="' + this.src + '" class="thumb">');
        };
        // image.onerror= function() {
        // alert('Invalid file type: '+ file.type);
        // };      
        };
        }
        $("#image_file").change(function (e) {
        if(this.disabled) {
        return alert('File upload not supported!');
        }
        var F = this.files;
        if (F && F[0]) {
        for (var i = 0; i < F.length; i++) {
        readImage(F[i]);
        }
        }
        });


</script>