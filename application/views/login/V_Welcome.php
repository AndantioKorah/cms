<?php
  $params_exp_app = $this->general_library->getParams('PARAM_EXP_APP');
  $list_role = $this->general_library->getListRole();
  $active_role = $this->general_library->getActiveRole();
?>
<style>
#profile_pict {
    max-width: 150px;
    max-height: 150px;
    animation: zoom-in-zoom-out 5s ease infinite;
}

@keyframes zoom-in-zoom-out {
  0% {
    transform: scale(1, 1);
  }
  50% {
    transform: scale(1.1, 1.1);
  }
  100% {
    transform: scale(1, 1);
  }
}
</style>
<div class="row" style="position: fixed;
  top: 50%;
  left: 53%;
  transform: translate(-50%, -50%);">
    <div class="col-12 text-center">
    
          
       <style>

        img.logo {
          height: 200px; width: 400px; margin-bottom:20px;
         }
        @media screen and (max-width: 600px) {
        h4 {
        font-size: 17px;
        /* display:none; */
        }

        img.logo {
          height: 150px; 
          width: 300px; 
          /* height: 100%; 
          width: 200%; */
          /* margin-left: 50;  */
          margin-bottom:20px;
           /* display:none; */
        }
     
       }

       </style>
       <!-- tyle="height: 150px; width: 400px; margin-bottom:20px;" -->
        <h3>Welcome to</h3>
        <center>
							<img class="logo" src="assets/new_login/images/logo-bidik-2.png" />
						</center>
        <h4><strong class="nmuser"><?=$this->general_library->getNamaUser();?></strong></h4>
        <img class="img-circle elevation-2" id="profile_pict" style="max-width: 150px; max-height: 150px;" src="<?=$this->general_library->getProfilePicture()?>" alt="User Image">
    </div>
    <div class="col-12 text-center">
        <h4 style="font-weight: bold;" id="live_date_time_welcome" class="nav-link"></h4>
    </div>
    <!-- <div class="col-12 text-center mt-3">
        <div class="row">
            <?php foreach($list_role as $lr){ ?>
                <div class="col-2">
                    <button class="btn btn-navy btn-block"><?=$lr['nama']?></button>
                </div>
            <?php } ?>
        </div>
    </div> -->
</div>