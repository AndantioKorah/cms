<?php if($list_logo){ ?>
    <div class="table-responsive">
    <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Aplikasi</th>
                <th>URL</th>
                <th>Logo</th>
                
                <th></th>
            </tr>
        </thead>
        <tbody>
        <?php $no=1; foreach($list_logo as $lb){ ?>
                   <tr>
                    <td><?=$no++;?></td>
                    <td><?=$lb['nama_aplikasi'];?></td>
                    <td> <a href="<?=$lb['url'];?>" target="_blank"> <?=$lb['url'];?></a> </td>
                    <td>
                        <img  style="width:900;height:300px;"  src="<?php echo base_url('assets/admin/logo/'.$lb['logo']) ;?>" alt="">
                        </td>
                  <td> 
                  <a 
                    href="javascript:;"
                    data-id="<?php echo $lb['id'] ?>"
                    data-nama="<?php echo $lb['nama_aplikasi'] ?>"
                    data-url="<?php echo $lb['url'] ?>"
                    data-toggle="modal" data-target="#edit-data-ap">
                    <button  data-toggle="modal" class="btn btn-sm btn-info" title="edit"><i class="fa fa-edit" ></i></button>
                </a>
                      <button onclick="deleteCovid19('<?=$lb['id']?>')" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Hapus"><i class="fa fa-trash" ></i></button></td>
                   </tr>
                <?php } ?>
        </tfoot>
    </table>
    </div>
        <!-- Modal Ubah -->
<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="edit-data-ap" class="modal fade">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body" id="modal_detail_download">
           
            <form action="<?=base_url("admin/C_Admin/updateAplikasiPublik")?>" method="post" id="form_download" align="center" enctype="multipart/form-data">  
            <input type="hidden" class="form-control datetimepickerthis" name="id_ap" id="id_ap"  autocomplete="off" required/>
                <div class="form-group text-left">
                <label class="bmd-label-floating">Nama Aplikasi</label>
                    <textarea class="form-control" name="edit_ap_nama" id="edit_ap_nama" rows="3" required></textarea>
                </div>
                <div class="form-group text-left">
                <label class="bmd-label-floating">URL</label>
                    <textarea class="form-control" name="edit_ap_url" id="edit_ap_url" rows="3" ></textarea>
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

       $('#edit-data-ap').on('show.bs.modal', function (event) {
          
          var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan
          var modal          = $(this)

          // Isi nilai pada field
          modal.find('#id_ap').attr("value",div.data('id'));
          modal.find('#edit_ap_nama').html(div.data('nama'));
          modal.find('#edit_ap_url').html(div.data('url'));
         
      });
</script>