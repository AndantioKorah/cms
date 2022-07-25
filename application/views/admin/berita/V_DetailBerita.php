<style>
    .container {
  max-width: 800px;
  background-color: black;
  margin: 0 auto;
  text-align: center;
  position: relative;
}
.container div {
  background-color: white;
  width: 100%;
  display: inline-block;
  display: none;
}
.container img {
  width: 100%;
  height: auto;
}



.next {
  right: 5px;
}

.prev {
  left: 5px;
}


/*
 * bootstrap-tagsinput v0.8.0
 * 
 */

.bootstrap-tagsinput {
  background-color: #fff;
  border: 1px solid #ccc;
  box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
  /* display: inline-block; */
  padding: 4px 6px;
  color: #555;
  vertical-align: middle;
  border-radius: 4px;
  max-width: 100%;
  line-height: 22px;
  
  cursor: text;
}
.bootstrap-tagsinput input {
  border: none;
  box-shadow: none;
  outline: none;
  background-color: transparent;
  padding: 0 6px;
  margin: 0;
  width: auto;
  max-width: inherit;
  height: 28px;
}
.bootstrap-tagsinput.form-control input::-moz-placeholder {
  color: #777;
  opacity: 1;
}
.bootstrap-tagsinput.form-control input:-ms-input-placeholder {
  color: #777;
}
.bootstrap-tagsinput.form-control input::-webkit-input-placeholder {
  color: #777;
}
.bootstrap-tagsinput input:focus {
  border: none;
  box-shadow: none;
}
.bootstrap-tagsinput .tag {
  margin-right: 2px;
  color: dark;
  background-color: aqua;
  border-radius: inherit;
  padding: 3px;
}
.bootstrap-tagsinput .tag [data-role="remove"] {
  margin-left: 8px;
  cursor: pointer;
}
.bootstrap-tagsinput .tag [data-role="remove"]:after {
  content: "x";
  padding: 0px 2px;
}
.bootstrap-tagsinput .tag [data-role="remove"]:hover {
  box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2), 0 1px 2px rgba(0, 0, 0, 0.05);
}
.bootstrap-tagsinput .tag [data-role="remove"]:hover:active {
  box-shadow: inset 0 3px 5px rgba(0, 0, 0, 0.125);
}
</style>
<?php if($berita){ ?>

  <script src="https://cdn.jsdelivr.net/bootstrap.tagsinput/0.8.0/bootstrap-tagsinput.min.js"></script>

 
<form id="" action="<?=base_url("admin/C_Admin/updateKontenBerita")?>" class="form-horizontal" method="post" enctype="multipart/form-data" role="form">
                     <div class="form-group">
                         <label class="col-lg-6 col-sm-6 control-label">Judul Berita (Indonesia)</label>
                         <div class="col-lg-12">
                         <input type="hidden"  class="form-control" id="id" name="id" value="<?=$berita['id']?>">
                             <textarea  class="form-control" id="detail_judul_ina" name="detail_judul_ina" ><?=$berita['judul_ina']?></textarea>
                         </div>
                     </div>
                   
                     <div class="form-group">
                     <label class="col-lg-6 col-sm-6 control-label">Tanggal Berita</label>
                         <div class="col-lg-12">
                             <input  class="form-control" id="detail_tanggal_berita" name="detail_tanggal_berita" value="<?=$berita['tanggal_berita']?>">
                         </div>
                     </div>

                       <div class="form-group">
                     <label class="col-lg-6 col-sm-6 control-label">Tag Berita</label>
                         <div class="col-lg-12">
                         <input  class="form-control "  data-role="tagsinput" value="<?= str_replace( array( '\'', '"','[',']'), ' ', $berita['tag_berita']) ?>"    name="detail_tag_berita" id="detail_tag_berita" required/>
                             <!-- <input  class="form-control "  data-role="tagsinput"    name="tag_berita" id="tag_berita" autocomplete="off" required/> -->
                         </div>
                     </div>
                     

                     <div class="form-group">
                     <label class="col-lg-6 col-sm-6 control-label">Gambar</label>
                   
                   
                         <div class="col-lg-12">
                         <!-- <input type="file"  class="form-control" id="image_file" name="image_file" multiple="multiple"> -->
                         <input type="hidden"  class="form-control" id="nama_gambar_lama" name="nama_gambar_lama">
                         <div id="uploadPreview"></div>
                        <div id="gambar_lama">
                       
                        <br>
                        <section class="demo">
                        <input style="position: absolute;" type="button" class="next btn btn-info" value="Next"></input>
                        <input style="position: absolute;" type="button" class="prev btn btn-info" value="Previous"></input>
                        <div class="container">
                        <?php   
                            $image = json_decode($berita['gambar']);
                            $ng = 1;
                            foreach($image as $image_name)
                                {
                                        if($ng==1){
                                            echo "<div style='display: inline-block;'><img style='width:800;height:500px;' src=".base_url('assets/admin/berita/'.$image_name.'')." style='width:100%'></div>";
                                        } else {
                                            echo "<div ><img style='width:800;height:500px;' src=".base_url('assets/admin/berita/'.$image_name.'')." style='width:100%'></div>";
                                        }
                                   $ng++;
                                } 
                            ?>
                           

                        </div>
                        </section>
                        </div>

                        <div class="ckarea" style="display:none;">Please enter Description</div>

                        <div class="form-group">
                         <label class="col-lg-2 col-sm-2 control-label">Isi Berita</label>
                         <div class="col-lg-12">
                          <textarea rows="10" class="form-control " id="detail_isi_berita" name="detail_isi_berita" ><?=$berita['isi_berita']?></textarea>
                         </div>
                     </div>
                     <div class="modal-footer">
              
              <button type="button" class="btn btn-warning" data-dismiss="modal"> Batal</button>
              <button class="btn btn-info" type="submit"> Ubah Data&nbsp;</button>
          </div>
                     <?php } else { ?>
    <div class="col-12 text-center">
        <h6><i class="fa fa-exclamation"></i> Data tidak ditemukan</h6>
    </div>
    <?php } ?>  

    <script>
// CKEDITOR.replace( 'detail_isi_berita' );
  $('#form_update_berita').on('submit', function(e){ 
    // var description = CKEDITOR.instances['detail_isi_berita'].getData().replace(/<[^>]*>/gi, '').length;
    // if (!description) {
    //     $(".ckarea").show();
    //     alert(2)
    //     return false;
    // }
  // const myTimeout = setTimeout(alert($('#detail_isi_berita').val()), 5000);
  var editorText = CKEDITOR.instances.detail_isi_berita.getData();
      return false;
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
        var w = this.width,
        h = this.height,
        t = file.type, // ext only: // file.type.split('/')[1],
        n = file.name,
        s = ~~(file.size/1024) +'KB';
        $('#uploadPreview').append('<img class="img-fluid" alt="Responsive image"  src="' + this.src + '" class="thumb">');
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

<script>
var currentIndex = 0,
  items = $('.container div'),
  itemAmt = items.length;

function cycleItems() {
  var item = $('.container div').eq(currentIndex);
  items.hide();
  item.css('display','inline-block');
}

// var autoSlide = setInterval(function() {
//   currentIndex += 1;
//   if (currentIndex > itemAmt - 1) {
//     currentIndex = 0;
//   }
//   cycleItems();
// }, 3000);

$('.next').click(function() {
//   clearInterval(autoSlide);
  currentIndex += 1;
  if (currentIndex > itemAmt - 1) {
    currentIndex = 0;
  }
  cycleItems();
});

$('.prev').click(function() {
//   clearInterval(autoSlide);
  currentIndex -= 1;
  if (currentIndex < 0) {
    currentIndex = itemAmt - 1;
  }
  cycleItems();
});


ClassicEditor
		.create( document.querySelector( '#detail_isi_berita' ), {
			// toolbar: [ 'heading', '|', 'bold', 'italic', 'link' ]
		} )
		.then( editor => {
			window.editor = editor;
		} )
		.catch( err => {
			console.error( err.stack );
		} );

</script>