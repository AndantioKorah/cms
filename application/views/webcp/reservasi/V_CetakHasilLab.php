<?php if($result){ ?>
  <?php foreach($result as $rs){ ?>
    <?php $this->load->view('webcp/reservasi/V_CetakHasilLabDetail', $rs); ?>
  <?php } ?>
<?php } else { ?>
  <div class="col-lg-12 text-center">
    <h5>Data Tidak Ditemukan <i class="fa fa-exclamation"></i></h5>
  </div>
<?php } ?>