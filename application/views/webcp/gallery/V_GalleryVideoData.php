<style>
  .gallery-video-data{
    width: 100%;
    height: 338px;
    position: relative;
    border-top-right-radius: 5px;
    border-top-left-radius: 5px;
  }

  .video-name{
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

<?php if($video){ foreach($video as $v) { ?>
  <div class="col-lg-6 p-3 col-md-6 div_video">
    <iframe class="b-lazy gallery-video-data" 
	    data-src="<?=preg_replace("/\s*[a-zA-Z\/\/:\.]youtube.com\/watch\?v=([a-zA-Z0-9\-]+)([a-zA-Z0-9\/\*\-\\-\_\?\&\;\%\=\.]*)/i",".youtube.com/embed/$1",$v['isi_galeri']);?>" 
	    frameborder="0" 
	    allowfullscreen>
    </iframe>
    <div class="video-name">
      <span title="<?=$v['nama']?>"><?=$v['nama']?></span>
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
</script>