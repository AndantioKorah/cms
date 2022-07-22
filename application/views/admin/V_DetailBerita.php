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
</style>
<?php if($berita){ ?>

  


<form id="form_update_berita" class="form-horizontal" method="post" enctype="multipart/form-data" role="form">
                     <div class="form-group">
                         <label class="col-lg-6 col-sm-6 control-label">Judul Berita (Indonesia)</label>
                         <div class="col-lg-12">
                         <input type="hidden"  class="form-control" id="id" name="id">
                             <textarea  class="form-control" id="detail_judul_ina" name="detail_judul_ina" ><?=$berita['judul_ina']?></textarea>
                         </div>
                     </div>
                     <!-- <div class="form-group">
                     <label class="col-lg-6 col-sm-6 control-label">Judul Berita (English)</label>
                         <div class="col-lg-12">
                             <textarea  class="form-control" id="detail_judul_eng" name="detail_judul_eng" ></textarea>
                         </div>
                     </div> -->
                     <div class="form-group">
                     <label class="col-lg-6 col-sm-6 control-label">Tanggal Berita</label>
                         <div class="col-lg-12">
                             <input  class="form-control" id="detail_tanggal_berita" name="detail_tanggal_berita" value="<?=$berita['tanggal_berita']?>">
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
                        <input style="position: absolute;" type="button" class="next" value="Next"></input>
                        <input style="position: absolute;" type="button" class="prev" value="Previous"></input>
                        <div class="container">
                        <?php   
                            $image = json_decode($berita['gambar']);
                            $ng = 1;
                            foreach($image as $image_name)
                                {
                                        if($ng==1){
                                            echo "<div style='display: inline-block;'><img style='width:800;height:500px;' src=".base_url('assets/berita/'.$image_name.'')." style='width:100%'></div>";
                                        } else {
                                            echo "<div ><img style='width:800;height:500px;' src=".base_url('assets/berita/'.$image_name.'')." style='width:100%'></div>";
                                        }
                                   $ng++;
                                } 
                            ?>
                           

                        </div>
                        </section>
                        </div>
                        <div class="form-group">
                         <label class="col-lg-2 col-sm-2 control-label">Isi Berita</label>
                         <div class="col-lg-12">
                          <textarea rows="10" class="form-control ckeditor" id="detail_isi_berita" name="detail_isi_berita" ><?=$berita['isi_berita']?></textarea>
                         </div>
                     </div>
                     <?php } else { ?>
    <div class="col-12 text-center">
        <h6><i class="fa fa-exclamation"></i> Data tidak ditemukan</h6>
    </div>
    <?php } ?>  

    <script>

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
</script>