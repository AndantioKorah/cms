<?php if($list_downlaod){ ?>
    <div class="table-responsive">
    <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>No</th>
                <th>Judul</th>
                <th>Keterangan</th>
                <th>Tanggal</th>
                <th>Jenis Downlaod</th>
                <th>File</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        <?php $no=1; foreach($list_downlaod as $lb){ ?>
                   <tr>
                    <td><?=$no++;?></td>
                    <td><?=$lb['judul'];?></td>
                    <td><?=$lb['keterangan'];?></td>
                    <td><?=$lb['tanggal'];?></td>
                    <td><?=$lb['jenis_download'];?></td>
                    <td> <a style='width:800;height:300px;' href="<?=base_url('assets/admin/download/'.$lb['file'].'')?>" target="_blank"><i class="fa fa-file" aria-hidden="true"></i></a> </td>



                   
                  <td>
                  <a 
                    href="javascript:;"
                    data-id="<?php echo $lb['id'] ?>"
                    data-tanggal="<?php echo $lb['tanggal'] ?>"
                    data-judul="<?php echo $lb['judul'] ?>"
                    data-keterangan="<?php echo $lb['keterangan'] ?>"
                    data-toggle="modal" data-target="#edit-data-download">
                    <button  data-toggle="modal" class="btn btn-sm btn-info" title="edit"><i class="fa fa-edit" ></i></button>
                </a>
                     <button onclick="deleteDownload('<?=$lb['id']?>')" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Hapus"><i class="fa fa-trash" ></i></button></td>
                   </tr>
                <?php } ?>
        </tfoot>
    </table>
    </div>
        <!-- Modal Ubah -->
<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="edit-data-download" class="modal fade">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body" id="modal_detail_download">
           
            <form action="<?=base_url("admin/C_Admin/updateKontenDownload")?>" method="post" id="form_download" align="center" enctype="multipart/form-data">  
            <input type="hidden" class="form-control datetimepickerthis" name="id_download" id="id_download"  autocomplete="off" required/>
                <div class="form-group text-left">
                <label class="bmd-label-floating">Judul</label>
                    <textarea class="form-control" name="edit_download_judul" id="edit_download_judul" rows="3" required></textarea>
                </div>
                <div class="form-group text-left">
                <label class="bmd-label-floating">Keterangan</label>
                    <textarea class="form-control" name="edit_download_keterangan" id="edit_download_keterangan" rows="3" ></textarea>
                </div>
                <div class="form-group text-left">
                <label class="bmd-label-floating">Tanggal</label>
                    <input class="form-control datetimepickerthis" name="edit_download_tanggal" id="edit_download_tanggal"  autocomplete="off" required/>
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
        function deleteDownload(id){
           
           if(confirm('Apakah Anda yakin ingin menghapus data?')){
               $.ajax({
                   url: '<?=base_url("admin/C_Admin/deleteDownload/")?>'+id,
                   method: 'post',
                   data: null,
                   success: function(){
                       successtoast('Data sudah terhapus')
                       loadListDownload()
                   }, error: function(e){
                       errortoast('Terjadi Kesalahan')
                   }
               })
           }
       }

       $('#edit-data-download').on('show.bs.modal', function (event) {
          
            var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan
            var modal          = $(this)

            // Isi nilai pada field
            modal.find('#id_download').attr("value",div.data('id'));
            modal.find('#edit_download_judul').html(div.data('judul'));
            modal.find('#edit_download_keterangan').html(div.data('keterangan'));
            modal.find('#edit_download_tanggal').attr("value",div.data('tanggal'));
           
        });

        $('.datetimepickerthis').datetimepicker({
            format: 'yyyy-mm-dd hh:ii:ss',
            autoclose: true,
            todayHighlight: true,
            todayBtn: true
        })
</script>