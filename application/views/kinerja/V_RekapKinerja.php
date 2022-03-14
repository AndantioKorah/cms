
<div class="card card-default">
    <div class="card-header">
        <h3 class="card-title">Rekap Kinerja Pegawai</h3>
    </div>

    
    <div class="card-body">
    <div class="row">
        <div class="col-12 mb-3">
        <form id="formSearchRekapKinerja" class="form-inline" method="post" action="<?=base_url('kinerja/rekap');?>">
  <div class="form-group">
    <label for="email" class="mr-2">Tahun </label>
    <input  class="form-control datepicker" id="tahun" name="tahun" value="<?=date('Y');?>">
  </div>
  <div class="form-group">
    <label for="pwd" class="mr-2 ml-3"> Bulan</label>
    <select class="form-control select2-navy" 
                 id="bulan" data-dropdown-css-class="select2-navy" name="bulan" id="bulan" required>
                 <option value="" selected>- Pilih Bulan -</option>
                 <option value="1">Januari</option>
                 <option value="2">Februari</option>
                 <option value="3">Maret</option>
                 <option value="4">April</option>
                 <option value="5">Mei</option>
                 <option value="6">Juni</option>
                 <option value="7">Juli</option>
                 <option value="8">Agustus</option>
                 <option value="9">September</option>
                 <option value="10">Oktober</option>
                 <option value="10">November</option>
                 <option value="10">Desember</option>
                 </select>
         </div>
        <!-- <button type="submit" class="btn btn-primary ml-3">Cari</button> -->
        </form>

        </div>
        </div>
    <div class="row" >
        
    <?php if($list_rekap_kinerja){ ?>
    <div class="col-12" id="list_rekap_kinerja">
    <table border="3"  class="table table-hover table-striped" id="table_rekap_kinerja">
    <tbody><tr height="20" style="height:15.0pt">
    <th rowspan="2" height="40" >No</th>
    <th rowspan="2" >Kegiatan Tugas Jabatan</th>
    <th rowspan="2" >Tahun</th>
    <th rowspan="2" >Bulan</th>
    <th colspan="3" class="text-center" width="265" style="border-left:none;width:199pt">Target<span style="mso-spacerun:yes">&nbsp;</span></th>
    <th colspan="3" class="text-center" width="192" style="border-left:none;width:144pt">Realisasi</th>
    </tr>
 <tr height="20" style="height:15.0pt">
  <td height="20" class="xl67" style="height:15.0pt;border-top:none;border-left:
  none"> Kuantitas</td>
  <td class="xl67" style="border-top:none;border-left:none">Satuan</td>
  <td class="xl67" style="border-top:none;border-left:none">Capaian</td>
  <td class="xl67" style="border-top:none;border-left:none">Kuantitas</td>
  <td class="xl67" style="border-top:none;border-left:none">Satuan</td>
  <td class="xl67" style="border-top:none;border-left:none">Capaian</td>
 </tr>

 <!--[if supportMisalignedColumns]-->
 <?php $no=1; 
           
            foreach($list_rekap_kinerja as $lp){ ?>
            
                <?php
                
                // $realisasi_kualitas = $lp['realisasi_target_kuantitas']/$lp['target_kuantitas'] * 100;
                $progress = (floatval($lp['realisasi_target_kuantitas'])/floatval($lp['target_kuantitas'])) * 100;
                $progress = formatTwoMaxDecimal($progress);
                ?>
                    <tr onclick="openListKegiatan('<?=$lp['id']?>')">
                        <td class="text-left"><?=$no++;?></td>
                        <td class="text-left"><?=$lp['tugas_jabatan']?></td>
                        <td class="text-left"><?=$lp['tahun']?></td>
                        <td class="text-left"><?= getNamaBulan($lp['bulan'])?></td>
                        <td class="text-left"><?=$lp['target_kuantitas']?></td>                       
                        <td class="text-left"><?=$lp['satuan']?></td>
                        <td class="text-left"><?=$lp['target_kualitas']?>%</td>
                        <td class="text-left">
                            <?=$lp['realisasi_target_kuantitas'] == '' ? '0' : $lp['realisasi_target_kuantitas']?></td>
                        <td class="text-left"><?=$lp['satuan']?></td>
                        <td class="text-left">
                        <div class="text-center" style="border: 2px solid #80808082; border-radius: 5px; width: 100%; height: 30px; padding-bottom: 27px;">
                                        <div class="text-center" style="border-radius: 3px; background-color: <?=getProgressBarColor($progress)?>; overflow: show; white-space: nowrap; width: <?=$progress.'%'?>; height: 27px;">
                                            <strong style="font-size: 18px; color: <?=$progress == 25 || $progress == 100 ? 'white' : 'black'?>;"><?=$progress.' %';?></td></strong>
                                        </div>
                                    </div>
                        </td>
                    </tr>
                <?php } ?>
 <!--[endif]-->
</tbody></table>


       
    </div>
    <div class="col-12" id="list_kegiatan" style="display: none;">
            </div>
<?php } else { ?>
    <div class="row">
        <div class="col-12">
            <h5 style="text-center">DATA TIDAK DITEMUKAN <i class="fa fa-exclamation"></i></h5>
        </div>
    </div>
<?php } ?>
        </div>
    </div>
</div>




<script type="text/javascript">
    

$('.datepicker2').datepicker({
    format: 'yyyy-mm-dd',
    startView: "months", 
    orientation: 'bottom',
    autoclose: true,
    todayBtn: true
});

    $('#bulan').on('change', function(){
        $('#table_rekap_kinerja').hide()
        $('#list_kegiatan').hide()
        // $('#list_rekap_kinerja').append(divLoaderNavy)
        document.getElementById("formSearchRekapKinerja").submit();
    })

    // $('#tahun').on('change', function(){
    //     $('#table_rekap_kinerja').hide()
    //     $('#list_rekap_kinerja').append(divLoaderNavy)
    //     document.getElementById("formSearchRekapKinerja").submit();
    // })
 

    function openListKegiatan(id){
            $('.tr_rekap_realisasi').removeClass('tr_rekap_active')
            $('#tr_rekap_'+id).addClass('tr_rekap_active')

            $('#list_kegiatan').show()
            $('#list_kegiatan').html('')
            $('#list_kegiatan').append(divLoaderNavy)
            $('#list_kegiatan').load('<?=base_url("kinerja/C_VerifKinerja/loadListKegiatanRencanaKinerja")?>'+'/'+id, function(){
                $('#loader').hide()
            })
        } 

</script>



 <script type="text/javascript">
// $(document).ready(function(){  
// $('#upload_form').on('submit', function(e){  
// e.preventDefault();  
// if($('#image_file').val() == '')  
// {  
// alert("Please Select the File");  
// }  
// else 
// {  
// var form_data = new FormData();
// var ins = document.getElementById('image_file').files.length;
// for (var x = 0; x < ins; x++) {
// form_data.append("files[]", document.getElementById('image_file').files[x]);
// }
// $.ajax({  
// url:"<?=base_url("kinerja/C_Kinerja/createLaporanKegiatan")?>",    
// method:"POST",  
// data:form_data,  
// contentType: false,  
// cache: false,  
// processData:false,  
// dataType: "json",
// success:function(res)  
// {  
// console.log(res.success);
// if(res.success == true){
// $('#image_file').val('');
// // $('#uploadPreview').html('');   
// // $('#msg').html(res.msg);   
// // $('#divMsg').show();   
// }
// else if(res.success == false){
// $('#msg').html(res.msg); 
// $('#divMsg').show(); 
// }
// setTimeout(function(){
// $('#msg').html('');
// $('#divMsg').hide(); 
// }, 3000);
// }  
// });  
// }  
// });  
// }); 
// // var url = window.URL || window.webkitURL; // alternate use
// function readImage(file) {
// var reader = new FileReader();
// var image  = new Image();
// reader.readAsDataURL(file);  
// reader.onload = function(_file) {
// image.src = _file.target.result; // url.createObjectURL(file);
// image.onload = function() {
// var w = this.width,
// h = this.height,
// t = file.type, // ext only: // file.type.split('/')[1],
// n = file.name,
// s = ~~(file.size/1024) +'KB';
// $('#uploadPreview').append('<img src="' + this.src + '" class="thumb">');
// };
// image.onerror= function() {
// alert('Invalid file type: '+ file.type);
// };      
// };
// }
// $("#image_file").change(function (e) {
// if(this.disabled) {
// return alert('File upload not supported!');
// }
// var F = this.files;
// if (F && F[0]) {
// for (var i = 0; i < F.length; i++) {
// // readImage(F[i]);
// }
// }
// });
</script>

<script>

    // $('#form_tambah_kegiatan').on('submit', function(e){
    //     e.preventDefault();
    //     $.ajax({
    //         url: '<?=base_url("kinerja/C_Kinerja/createLaporanKegiatan")?>',
    //         method: 'post',
    //         data: $(this).serialize(),
    //         success: function(){
    //             successtoast('Data berhasil ditambahkan')
                
    //         }, error: function(e){
    //             errortoast('Terjadi Kesalahan')
    //         }
    //     })
    // })

</script>


