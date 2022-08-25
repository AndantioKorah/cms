<?php if($list_dokumen){ ?>
    <div class="table-responsive">
    <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th class="text-center">No</th>
                <th>User Upload</th>
                <th>Judul</th>
                <th>Keterangan</th>
                <th class="text-center">Tanggal</th>
                <th class="text-center">File</th>
                <th class="text-center">Pilihan</th>
            </tr>
        </thead>
        <tbody>
        <?php $no=1; foreach($list_dokumen as $lb){ ?>
                   <tr>
                        <td class="text-center"><?=$no++;?></td>
                        <td><?=$lb['nama'];?></td>
                        <td><?=$lb['judul'];?></td>
                        <td><?=$lb['keterangan'];?></td>
                        <td class="text-center"><?= formatDate($lb['tanggal']);?></td>
                        <td class="text-center">
                            <a class="btn btn-info btn-sm" href="<?=base_url('assets/admin/dokumen/'.$lb['file'].'')?>" target="_blank">
                            Lihat Dokumen <i class="fa fa-eye" aria-hidden="true"></i></a>
                        </td class="text-center">
                        <td class="text-center"> 
                            <button data-toggle="modal" href="#modal_detail_dokumen" onclick="openDetailDokumen('<?=$lb['id']?>')" class="btn btn-navy btn-sm"><i class="fa fa-search"></i> Detail</button>
                            <?php if($lb['created_by'] == $this->general_library->getId()){ ?>
                                <button onclick="deleteDokumen('<?=$lb['id']?>')" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Hapus"><i class="fa fa-trash" ></i> Hapus</button>
                            <?php } ?>
                        </td>
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
<div class="modal fade" id="modal_detail_dokumen" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div id="modal-dialog" class="modal-dialog modal-xl">
      <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">DETAIL DOKUMEN</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="min-height: 40vh;" id="modal_detail_dokumen_konten">
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
        function deleteDokumen(id){
           
           if(confirm('Apakah Anda yakin ingin menghapus data?')){
               $.ajax({
                   url: '<?=base_url("admin/C_Admin/deleteDokumen/")?>'+id,
                   method: 'post',
                   data: null,
                   success: function(){
                       successtoast('Data sudah terhapus')
                       loadListDokumen()
                   }, error: function(e){
                       errortoast('Terjadi Kesalahan')
                   }
               })
           }
       }
    
    function openDetailDokumen(id){
        $('#modal_detail_dokumen_konten').html('')
        $('#modal_detail_dokumen_konten').append(divLoaderNavy)
        $('#modal_detail_dokumen_konten').load('<?=base_url("admin/C_Admin/openDokumenDetail/")?>'+id, function(){
            $('#loader').hide()
        })
    }
</script>