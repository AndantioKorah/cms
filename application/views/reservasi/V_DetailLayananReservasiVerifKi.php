<?php if($result){ ?>
  <table style="width: 100%; padding: 10px;">
    <thead style="border: 1px solid black;">
      <th style="padding: 10px; border: 1px solid black;">JENIS LAYANAN</th>
      <th class="text-center">CATATAN</th>
    </thead>
    <tbody>
      <?php
        $excluded_status = [1, 2, 3, 4, 5, 11, 12];
        foreach($result['pelayanan'] as $rs){ 
        $total = 0;
      ?>
        <tr style="border: 1px solid black;">
          <td style="padding: 10px; width: 70%; border: 1px solid black;">
            <div class="row">
              <div class="col-lg-12">
                <!-- <span class="search_jenis_layanan"><?=$rs['nama_jenis_pelayanan']?></span> -->
                <span class="search_jenis_layanan"><?=$result['status'] >= 4 && $rs['no_sampel'] ? '('.$rs['no_sampel'].') ' : ''?><?=$rs['nama_jenis_pelayanan']?></span>
                <input value="<?=$rs['id_t_reservasi_online_detail']?>" name="detail[]" style="display: none;" />
              </div>
              <div class="col-lg-12">
                <?php $comma = ', '; $i = 0; foreach($rs['parameter'] as $p){ if($p['checked'] == 1){
                  if($i == count($rs['parameter']) - 1){
                    $comma = '';
                  }

                  if($p['checked'] == 1){
                    $total += $p['harga'];
                  }
                ?>
                  <span style="font-size: 10pt; color: grey;"><?=$p['nama_parameter_jenis_pelayanan'].$comma;?></span>
                <?php $i++; } }?>
              </div>
            </div>
          </td>
          <td style="width: 30%; padding: 5px; border: 1px solid black;" class="text-center">
            <textarea rows=5 name="catatan_<?=$rs['id_t_reservasi_online_detail']?>" class="form-control" <?= in_array($result['status'], $excluded_status) ? '' : 'disabled' ?> ><?= in_array($result['status'], $excluded_status) ? '' : $rs['catatan_kepala_instalasi'] ?></textarea>
          </td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
  <script>
    $(function(){
      
    })
  </script>
<?php } else { ?>
  <div class="text-center">
    <h6>Tidak ada data <i class="fa fa-exclamation"></i></h6>
  </div>
<?php } ?>