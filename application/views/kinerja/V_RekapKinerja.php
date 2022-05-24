
<div class="card card-default">
    <div class="card-header">
        <h3 class="card-title">Rekap Kinerja Pegawai</h3>
    </div>

    
    <div class="card-body">
    <div class="row">
        <div class="col-12 mb-3">
        <form id="formSearchRekapKinerja" class="form-inline" method="post" action="#">
  <div class="form-group">
    <label for="email" class="mr-2">Tahun </label>
    <input  class="form-control datepicker" id="tahun" name="tahun" value="<?=date('Y');?>">
  </div>
  <div class="form-group">
    <label for="pwd" class="mr-2 ml-3"> Bulan</label>
    <select class="form-control select2-navy" 
                 id="bulan" data-dropdown-css-class="select2-navy" name="bulan" id="bulan" required>
                 <option value="" selected>- Pilih Bulan -</option>
                 <option <?=date('m') == 1 ? 'selected' : '';?> value="1">Januari</option>
                 <option <?=date('m') == 2 ? 'selected' : '';?> value="2">Februari</option>
                 <option <?=date('m') == 3 ? 'selected' : '';?> value="3">Maret</option>
                 <option <?=date('m') == 4 ? 'selected' : '';?> value="4">April</option>
                 <option <?=date('m') == 5 ? 'selected' : '';?> value="5">Mei</option>
                 <option <?=date('m') == 6 ? 'selected' : '';?> value="6">Juni</option>
                 <option <?=date('m') == 7 ? 'selected' : '';?> value="7">Juli</option>
                 <option <?=date('m') == 8 ? 'selected' : '';?> value="8">Agustus</option>
                 <option <?=date('m') == 9 ? 'selected' : '';?> value="9">September</option>
                 <option <?=date('m') == 10 ? 'selected' : '';?> value="10">Oktober</option>
                 <option <?=date('m') == 11 ? 'selected' : '';?> value="11">November</option>
                 <option <?=date('m') == 12 ? 'selected' : '';?> value="12">Desember</option>
                 </select>
         </div>
        <!-- <button type="submit" class="btn btn-primary ml-3">Cari</button> -->
        </form>

        </div>
        </div>
    <div id="list_rekap_kinerja" class="row">   
    </div>



<script type="text/javascript">
    
    $(function(){
        loadRekapKinerja()
    })

     function loadRekapKinerja(){
         var tahun = '<?=date("Y")?>'
         var bulan = '<?=date("m")?>'
 
        $('#list_rekap_kinerja').html('')
        $('#list_rekap_kinerja').append(divLoaderNavy)
        $('#list_rekap_kinerja').load('<?=base_url("kinerja/C_Kinerja/LoadRekapKinerja/")?>'+tahun+'/'+bulan+'', function(){
            $('#loader').hide()
        })
    }

$('.datepicker2').datepicker({
    format: 'yyyy-mm-dd',
    startView: "months", 
    orientation: 'bottom',
    autoclose: true,
    todayBtn: true
});

$('#bulan').on('change', function(){
    searchListKegiatan();
    })

    $('#tahun').on('change', function(){
        searchListKegiatan();
    })


    function searchListKegiatan(){
        if($('#bulan').val() == '')  
        {  
        errortoast(" Pilih Bulan terlebih dahulu");  
        return false
        } 
        var tahun = $('#tahun').val(); 
        var bulan = $('#bulan').val();
        $('#list_rekap_kinerja').html(' ')
        $('#list_rekap_kinerja').append(divLoaderNavy)
        $('#list_rekap_kinerja').load('<?=base_url('kinerja/C_Kinerja/LoadRekapKinerja/')?>'+tahun+'/'+bulan+'', function(){
            $('#loader').hide()
           
        })
    }

    // $('#bulan').on('change', function(){
    //     $('#table_rekap_kinerja').hide()
    //     $('#list_kegiatan').hide()
    //     // $('#list_rekap_kinerja').append(divLoaderNavy)
    //     document.getElementById("formSearchRekapKinerja").submit();
    // })

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


