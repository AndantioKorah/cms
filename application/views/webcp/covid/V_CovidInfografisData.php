<style>
  .gallery-image-data{
    width: 100%;
    max-height: 338px;
    position: relative;
    border-top-right-radius: 5px;
    border-top-left-radius: 5px;
  }

  .div_image:hover{
    background-color: #f5f5f5;  
    border-radius: 3px;
    cursor: pointer;
    transition: .3s;
  }

  .image-name{
    width: 100%;
    background-color: var(--primary);
    border-bottom-left-radius: 5px;
    border-bottom-right-radius: 5px;
    text-align: center;
    padding: 5px;
    color: white;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
  }

</style>

<?php if($gambar){ foreach($gambar as $g) { ?>
  <div class="col-lg-6 p-3 col-md-12 div_image" data-toggle="modal" href="#modal_image_preview" onclick="openPreviewModal('<?=$g['id']?>')">
    <img id="img_<?=$g['id']?>" class="gallery-image-data b-lazy" src=data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw== 
    data-src="<?=$this->general_library->getGalleryImage($g['file'])?>" alt="<?=$g['judul']?>" />
    <div class="image-name">
      <span><?=$g['judul']?></span>
    </div>
  </div>
<?php } }?>
<script>
  window.bLazy = new Blazy({
    container: '.container',
    success: function(element){
      console.log("Element loaded: ", element.nodeName);
    }
  });  

  function openPreviewModal(img){
    $('#modal_image_preview').modal('show')
    $('#img_preview_modal').attr('src', ($('#img_'+img).attr('src')))
    $('#img_name').html($('#img_'+img).attr('alt'))
  }
</script>