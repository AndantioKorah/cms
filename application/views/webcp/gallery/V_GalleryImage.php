<style>
  .gallery-image-data{
    width: 100%;
    max-height: 338px;
    position: relative;
  }
</style>

<?php if($image){ foreach($gambar as $g) { ?>
  <div class="col-lg-4 col-md-6" class="gallery-image-data">
    <img class="gallery-image-data b-lazy" src=data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw== data-src="<?=$this->general_library->getGalleryImage($g['isi_galeri'])?>" alt="Lazy load images example 3 image 1" />
  </div>
<?php } }?>
<script>
  window.bLazy = new Blazy({
    container: '.container',
    success: function(element){
      console.log("Element loaded: ", element.nodeName);
    }
  });  
</script>