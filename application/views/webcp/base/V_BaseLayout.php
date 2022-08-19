<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title><?=TITLES?></title>
  <link rel="shortcut icon" href="<?=base_url('assets/webcp/assets/img/logo-kemenkes-only.png')?>" />
  <meta name="title" content="BTKLPP Kelas I Manado">
  <meta name="description" content="BTKLPP Kelas I Manado">

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

  <link rel="stylesheet" href="<?=base_url('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')?>">  
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
        $this->load->view('webcp/partials/V_NavBar', $data);
    ?>
    <!-- End Header -->
    <div class="content-wrapper" style="padding-top: 117px;">
      <?php (isset($page_content)) ? $this->load->view($page_content) : ''?>
    </div>

    <!-- ======= Footer ======= -->
    <?php $this->load->view('webcp/partials/V_Footer') ?>
    <!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <script>
      var timertoast = 2500

      $(function(){
        $('.select2_this').select2()
        startTime()
      })

      function formatRupiah(val) {
        var sign = 1;
        if (val < 0) {
          sign = -1;
          val = -val;
        }
        // trim the number decimal point if it exists
        let num = val.toString().includes('.') ? val.toString().split('.')[0] : val.toString();
        let len = num.toString().length;
        let result = '';
        let count = 1;

        for (let i = len - 1; i >= 0; i--) {
          result = num.toString()[i] + result;
          if (count % 3 === 0 && count !== 0 && i !== 0) {
            result = '.' + result;
          }
          count++;
        }

        // add number after decimal point
        if (val.toString().includes('.')) {
          result = result + '.' + val.toString().split('.')[1];
        }
        // return result with - sign if negative
        return sign < 0 ? '-' + result : result;
      }

      function successtoast(message = ''){
        const Toast = Swal.mixin({
          toast: true,
          position: 'top',
          showConfirmButton: false,
          timer: timertoast
        });

        Toast.fire({
          icon: 'success',
          title: message
        })
      }

      function errortoast(message = ''){
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

      function checkTime(i) {
        if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
        return i;
      }

      function startTime() {
        var weekday = new Array(7);
        weekday[0] = "Minggu";
        weekday[1] = "Senin";
        weekday[2] = "Selasa";
        weekday[3] = "Rabu";
        weekday[4] = "Kamis";
        weekday[5] = "Jumat";
        weekday[6] = "Sabtu";

        var monthName = new Array(12);
        monthName[1] = "Januari";
        monthName[2] = "Februari";
        monthName[3] = "Maret";
        monthName[4] = "April";
        monthName[5] = "Mei";
        monthName[6] = "Juni";
        monthName[7] = "Juli";
        monthName[8] = "Agustus";
        monthName[9] = "September";
        monthName[10] = "Oktober";
        monthName[11] = "November";
        monthName[12] = "Desember";

        var today = new Date();
        var D = String(today.getDate()).padStart(2, '0');
        var M = String(today.getMonth() + 1).padStart(2, '0');
        var Y = today.getFullYear();
        var h = today.getHours();
        var m = today.getMinutes();
        var s = today.getSeconds();
        m = checkTime(m);
        s = checkTime(s);
        h = checkTime(h);
        live_date_time = weekday[today.getDay()] + ', ' + D + ' ' + monthName[today.getMonth() + 1] + ' ' + Y + ' / ' + h + ":" + m + ":" + s
        $('.live_date_time').html(live_date_time)
        var t = setTimeout(startTime, 500);
      }
      
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
    <script src="<?=base_url('plugins/sweetalert2/sweetalert2.min.js')?>"></script>
    <script src="<?=base_url('assets/webcp/assets/vendor/php-email-form/validate.js')?>"></script>
    <script src="<?=base_url('assets/webcp/assets/js/blazy-master/blazy.js')?>"></script>
    <script src="<?=base_url('assets/webcp/assets/js/blazy-master/polyfills/closest.js')?>"></script>
    <script src="<?=base_url('assets/js/select2.min.js')?>"></script>
    <script src="<?=base_url('assets/js/jquery.dataTables.min.js')?>"></script>
    <script src="https://cdn2.woxo.tech/a.js#62f75aa615bd39c3de340152" async data-usrc></script>

    <!-- Template Main JS File -->
    <link href="<?=base_url('assets/css/select2.min.css')?>" rel="stylesheet" />
    <script src="<?=base_url('assets/webcp/assets/js/main.js')?>"></script>
</body>

</html>