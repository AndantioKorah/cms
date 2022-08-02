

<div class="card card-default">
<div class="card-header">
            <div class="row">
                <div class="col-12">
                    <h3 class="card-title">FORM INPUT MASTER JENIS PPID</h3>
                </div>
            </div>
        </div>
        <div class="card-body">
    <form action="#" method="post" id="form_jenis_ppid" align="center" enctype="multipart/form-data">  

  <div class="form-group text-left">
  <label class="bmd-label-floating">Nama Jenis</label>
    <input class="form-control " name="nama_jenis_ppid" id="nama_jenis_ppid"  autocomplete="off" required/>
  </div>

  <div class="form-group text-left">
  <label class="bmd-label-floating">Kategori PPID</label>
  <select class="form-control select2-navy" style="width: 100%"
                 id="id_kategori_ppid" data-dropdown-css-class="select2-navy" name="id_kategori_ppid" required>
                 <option value="" selected>- Pilih Kategori -</option>
                 <?php if($list_master_kategori_ppid){
                                foreach($list_master_kategori_ppid as $ljp){
                                ?>
                                <option value="<?=$ljp['id']?>">
                                    <?=$ljp['nama_kategori']?>
                                </option>
                            <?php } } ?>
                 </select>
  </div>




  <div class="col-lg-12 col-md-4 text-right mt-2">
        <button class="btn btn-block btn-navy" id="btn_upload"><i class="fa fa-save"></i> SIMPAN</button>
        </div>
</form>
<div class="card card-default" style="margin-top:20px;">
            <div class="card-header">
                        <div class="row">
                            <div class="col-12">
                                <h3 class="card-title">LIST JENIS PPID</h3>
                            </div>
                        </div>
                    <div class="card-body" id="list_jenis">
                    
                                
                    </div>                
                     </div>
                    </div>
    </div>
  </div>

  <script>
        $(document).ready(function(){  
            loadListMasterJenisPpid()
 });  

 function loadListMasterJenisPpid(){
        $('#list_jenis').html('')
        $('#list_jenis').load('<?=base_url("master/C_Master/loadListMasterJenisPpid/")?>', function(){
            $('#loader').hide()
        })
    }


     $('#form_jenis_ppid').on('submit', function(e){  
        $('#btn_upload').prop('disabled', true);
          $('#btn_upload').html('SIMPAN.. <i class="fas fa-spinner fa-spin"></i>')
          e.preventDefault();  
          if($('#nama_jenis_ppid').val() == '')  
          {  
               alert("Silahkan Isi Kategori");  
          }  
          else  
          {  
               $.ajax({  
                   url:"<?=base_url("master/C_Master/submitMasterJenisPpid")?>",  
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
                           document.getElementById("form_jenis_ppid").reset();  
                           $('#btn_upload').prop('disabled', false);
                           $('#btn_upload').html('<i class="fa fa-save"></i>  SIMPAN')
                           loadListMasterJenisPpid()                          
                       } else {
                           errortoast(result.msg)
                           return false;
                       }
                    }  
               });  
          }  
     });

     $('.datepicker').datepicker({
        todayHighlight: true,
        todayBtn: "linked",
        keyboardNavigation:true,
        autoclose: true,
        format: 'yyyy-mm-dd',
    })

</script>