<style>
  .gallery-video-data{
    width: 100%;
    max-height: 338px;
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
  <div class="col-lg-4 p-3 col-md-6 div_video">
    <iframe class="b-lazy gallery-video-data" 
	    data-src="https://www.youtube.com/embed/ApXoWvfEYVU" 
	    frameborder="0" 
	    allowfullscreen>
    </iframe>
    <div class="video-name">
      <span><?=$v['nama']?></span>
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