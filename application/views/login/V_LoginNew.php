<!DOCTYPE html>
<html lang="en">
<head>
	<title><?=TITLES?></title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="shortcut icon" href="<?=base_url('assets/new_login/images/logo-bulatan.png')?>" />
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets/new_login/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets/new_login/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets/new_login/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets/new_login/fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets/new_login/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="assets/new_login/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets/new_login/vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets/new_login/vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="assets/new_login/vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets/new_login/css/util.css">
	<link rel="stylesheet" type="text/css" href="assets/new_login/css/main.css">
	<link rel="stylesheet" href="<?=base_url('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')?>">
<!--===============================================================================================-->
</head>
<body style="background-color: #ebebeb;">
	
	<div class="limiter">
		<div class="container-login100">
			<div class="login100-more" style="background-image: url('assets/new_login/images/bg-efort.jpg');"></div>

			<div class="wrap-login100 p-l-50 p-r-50 p-t-100">
				<form class="login100-form validate-form" action="<?=base_url('login/C_Login/authenticateAdmin')?>" method="post">
					<div style="width: 100%;">
						<center>
							<span class="login100-form-title p-b-59">
								Selamat Datang!
							</span>
							<!-- <span class="login100-form-title p-b-59">
								APLIKASI PENILAIAN KINERJA PEGAWAI
							</span> -->
							<img src="assets/new_login/images/logo-bidik-png.png" style="height: 150px; width: 400px;"/>
						</center>
					</div>

					<!-- <span class="login100-form-title">
						Selamat datang!
					</span> -->

					<!-- <div class="wrap-input100 validate-input" data-validate="Name is required">
						<span class="label-input100">Full Name</span>
						<input class="input100" type="text" name="name" placeholder="Name...">
						<span class="focus-input100"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
						<span class="label-input100">Email</span>
						<input class="input100" type="text" name="email" placeholder="Email addess...">
						<span class="focus-input100"></span>
					</div> -->

					<div class="wrap-input100 p-t-50 validate-input" data-validate="Username is required">
						<span class="label-input100">Username</span>
						<input class="input100" autocomplete="off" type="text" name="username" placeholder="Username">
						<span class="focus-input100"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Password is required">
						<span class="label-input100">Password</span>
						<input class="input100" autocomplete="off" type="password" name="password" placeholder="*************">
						<span class="focus-input100"></span>
					</div>

					<!-- <div class="wrap-input100 validate-input" data-validate = "Repeat Password is required">
						<span class="label-input100">Repeat Password</span>
						<input class="input100" type="text" name="repeat-pass" placeholder="*************">
						<span class="focus-input100"></span>
					</div> -->

					<!-- <div class="flex-m w-full p-b-33">
						<div class="contact100-form-checkbox">
							<input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
							<label class="label-checkbox100" for="ckb1">
								<span class="txt1">
									I agree to the
									<a href="assets/new_login/#" class="txt2 hov1">
										Terms of User
									</a>
								</span>
							</label>
						</div>
					</div> -->

					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button type="submit" class="login100-form-btn">
								Sign In
								<i class="fa fa-long-arrow-right m-l-5"></i>
							</button>
						</div>

						<!-- <a href="assets/new_login/#" class="dis-block txt3 hov1 p-r-30 p-t-10 p-b-10 p-l-30">
							Sign in
							<i class="fa fa-long-arrow-right m-l-5"></i>
						</a> -->
					</div>
				</form>
				<div style="width: 100%; position: relative; float: bottom;" class="p-t-30">
					<center>
						<span class="login100-form-title-footer">
							<?=COPYRIGHT?>
						</span>
					</center>
				</div>
			</div>
		</div>
	</div>
	
<!--===============================================================================================-->
	<script src="assets/new_login/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="assets/new_login/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="assets/new_login/vendor/bootstrap/js/popper.js"></script>
	<script src="assets/new_login/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="assets/new_login/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="assets/new_login/vendor/daterangepicker/moment.min.js"></script>
	<script src="assets/new_login/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="assets/new_login/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="assets/new_login/js/main.js"></script>

</body>
</html>
<script src="<?=base_url('plugins/sweetalert2/sweetalert2.min.js')?>"></script>
<script>

  $(function(){
	function errortoast(message = '', timertoast = 3000){
		const Toast = Swal.mixin({
		toast: true,
		position: 'top',
		showConfirmButton: false,
		timer: timertoast
		});

		Toast.fire({
		icon: 'error',
		title: message
		})
	}
    <?php if($this->session->flashdata('message')){ ?>
		errortoast("<?=$this->session->flashdata('message')?>");
    //   $('#error_div').show()
    //   $('#error_div').append('<label>'+'<?=$this->session->flashdata('message')?>'+'</label>')
    <?php
      $this->session->set_flashdata('message', null);
    } ?>
  })

  function errortoast(message = '', timertoast = 3000){
    const Toast = Swal.mixin({
      toast: true,
      position: 'top',
      showConfirmButton: false,
      timer: timertoast
    });

    Toast.fire({
      icon: 'error',
      title: message
    })
  }

</script>