<div class="card card-default">
    <div class="card-header"  style="display: block;">
        <h3 class="card-title">Rekap Absensi</h3>
    </div>
    <div class="card-body" style="display: block;">
        <!-- <form id="form_upload_file" enctype="multipart/form-data" method="post"> -->
        <form target="_blank" id="form_upload_file" enctype="multipart/form-data" method="post" action="<?=base_url("rekap/C_Rekap/readAbsensiExcel")?>">
            <div class="row">
                <div class="col-4">
                    <label>Pilih File</label>
                    <input type="file" class="form-control" name="file_excel" id="file_excel" />
                </div>
                <div class="col-4 text-left">
                    <br>
                    <button class="btn btn-sm btn-navy" style="margin-top: 12px;" type="submit"><i class="fa fa-save"></i> UPLOAD</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="card card-default">
    <div class="card-header">
        <h3 class="card-title">LIST MENU</h3>
    </div>
    <div class="card-body">
        <div id="list_menu" class="row">
        </div>
    </div>
</div>

<script>
    $(function(){
        loadMenu()
    })

    function loadMenu(){
        // $('#list_menu').html('')
        // $('#list_menu').append(divLoaderNavy)
        // $('#list_menu').load('<?=base_url("user/C_User/loadMenu")?>', function(){
        //     $('#loader').hide()
        // })
    }

    // $('#form_upload_file').on('submit', function(e){
    //     e.preventDefault();
    //     $.ajax({
    //         url: '<?=base_url("rekap/C_Rekap/readAbsensiExcel")?>',
    //         method: 'post',
    //         data: new FormData(this),
    //         contentType: false,  
    //         cache: false,  
    //         processData:false,  
    //         success: function(data){
    //             let rs = JSON.parse(data)
    //             if(rs.code == 0){
                   
    //             } else {
    //                 errortoast(rs.message)
    //             }
    //         }, error: function(e){
    //             errortoast('Terjadi Kesalahan')
    //         }
    //     })
    // })
</script>