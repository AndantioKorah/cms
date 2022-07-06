<style>

body {
  position: relative;
}
body .dribbble {
  /* position: fixed; */
  /* display: block;
  right: 20px; */
  /* bottom: 20px; */
}
body .dribbble img {
  display: block;
  /* height: 28px; */
}

.image_loader{
  top: 40%;
  left: 46%;
  position: relative;
  animation: rotation 3s infinite linear;
}

@keyframes rotation {
  from {
    transform: rotate(0deg);
  }
  to {
    transform: rotate(359deg);
  }
}

</style>

<img class="image_loader" style="width: 150px; height: 150px;" src="<?=base_url('assets/new_login/images/circle-logo-navy-white-with-text.png')?>" />