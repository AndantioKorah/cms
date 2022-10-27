<?php if($hasil){
?>
  <?php foreach($hasil as $rs){
    $data['result'] = $rs;
  ?>
    <?php $this->load->view('webcp/reservasi/V_CetakHasilLabDetail', $data); ?>
  <?php } ?>
<?php } else { ?>
  <div class="col-lg-12 text-center">
    <h5>Data Tidak Ditemukan <i class="fa fa-exclamation"></i></h5>
  </div>
<?php } ?>