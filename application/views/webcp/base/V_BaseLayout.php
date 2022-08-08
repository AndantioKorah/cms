<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title><?=TITLES?></title>
  <link rel="shortcut icon" href="<?=base_url('assets/webcp/assets/img/logo-kemenkes-only.png')?>" />
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <!-- <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon"> -->

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
	<link rel="stylesheet" href="<?=base_url('plugins/fontawesome-free/css/all.min.css')?>">
  <link href="<?=base_url('assets/webcp/assets/vendor/animate.css/animate.min.css')?>" rel="stylesheet">
  <link href="<?=base_url('assets/webcp/assets/vendor/bootstrap/css/bootstrap.min.css')?>" rel="stylesheet">
  <link href="<?=base_url('assets/webcp/assets/vendor/bootstrap-icons/bootstrap-icons.css')?>" rel="stylesheet">
  <link href="<?=base_url('assets/webcp/assets/vendor/boxicons/css/boxicons.min.css')?>" rel="stylesheet">
  <link href="<?=base_url('assets/webcp/assets/vendor/glightbox/css/glightbox.min.css')?>" rel="stylesheet">
  <link href="<?=base_url('assets/webcp/assets/vendor/swiper/swiper-bundle.min.css')?>" rel="stylesheet">
  <link rel="stylesheet" href="<?=base_url('assets/css/datatable.css')?>">
	<link rel="stylesheet" href="<?=base_url('assets/css/jquery.dataTables.min.css')?>">
	<link rel="stylesheet" href="<?=base_url('assets/css/responsive.dataTables.min.css')?>">
	<link rel="stylesheet" href="<?=base_url('assets/css/datatable.bootstrap.min.css')?>">

  <!-- JS -->
  <script src="<?=base_url('plugins/jquery/jquery.js')?>"></script>
  <script src="<?=base_url('plugins/jquery-ui/jquery-ui.js')?>"></script>
  <script src="<?=base_url('assets/webcp/assets/js/blazy-master/blazy.js')?>"></script>

  <!-- Template Main CSS File -->
  <link href="<?=base_url('assets/webcp/assets/css/style.css')?>" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Sailor - v4.7.0
  * Template URL: https://bootstrapmade.com/sailor-free-bootstrap-theme/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

    <!-- ======= Header ======= -->
    
    <?php
        $data['menu'] = $this->general_library->refreshMenuWebcp();
        $this->load->view('webcp/partials/V_Navbar', $data) 
    ?>
    <!-- End Header -->

    <?php (isset($page_content)) ? $this->load->view($page_content) : ''?>

    <!-- ======= Footer ======= -->
    <?php $this->load->view('webcp/partials/V_Footer') ?>
    <!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <script>
        $(function(){
          $('.select2_this').select2()
        })
        
        function divLoaderNavy(message = 'Loading'){
          return '<div class="col-12 text-center" style="height: 100%; id="loader"> <i style="color: #001f3f;" class="fas fa-3x fa-spin fa-sync-alt"></i> </div>'
        }
    </script>

    <!-- Vendor JS Files -->
    <script src="<?=base_url('assets/webcp/assets/vendor/bootstrap/js/bootstrap.bundle.min.js')?>"></script>
    <script src="<?=base_url('assets/webcp/assets/vendor/glightbox/js/glightbox.min.js')?>"></script>
    <script src="<?=base_url('assets/webcp/assets/vendor/isotope-layout/isotope.pkgd.min.js')?>"></script>
    <script src="<?=base_url('assets/webcp/assets/vendor/waypoints/noframework.waypoints.js')?>"></script>
    <script src="<?=base_url('assets/webcp/assets/vendor/bootstrap/js/bootstrap.bundle.min.js')?>"></script>
    <script src="<?=base_url('assets/webcp/assets/vendor/php-email-form/validate.js')?>"></script>
    <script src="<?=base_url('assets/webcp/assets/js/blazy-master/blazy.js')?>"></script>
    <script src="<?=base_url('assets/webcp/assets/js/blazy-master/polyfills/closest.js')?>"></script>
    <script src="<?=base_url('assets/js/select2.min.js')?>"></script>
    <script src="<?=base_url('assets/js/jquery.dataTables.min.js')?>"></script>
    

    <!-- Template Main JS File -->
    <link href="<?=base_url('assets/css/select2.min.css')?>" rel="stylesheet" />
    <script src="<?=base_url('assets/webcp/assets/js/main.js')?>"></script>
</body>

</html>