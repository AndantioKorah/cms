<?php if($result){ ?>
  <table style="width: 100%;" class="table-hover">
    <thead style="border: 1px solid black;">
      <th style="padding: 5px; border: 1px solid black;">JENIS LAYANAN</th>
      <th style="padding: 5px; border: 1px solid black;" class="text-center">HASIL</th>
      <th style="padding: 5px; border: 1px solid black;" class="text-center">CATATAN</th>
    </thead>
    <tbody>
      <?php
        $excluded_status = [1, 2, 3, 4, 5, 11, 12];
        foreach($result['pelayanan'] as $rs){ 
        $total = 0;
      ?>
        <tr style="border: 1px solid black;">
          <td colspan=3 style="padding: 5px; border: 1px solid black; background-color: #001f3f; color: white;">
            <!-- <span class="search_jenis_layanan"><?=$rs['nama_jenis_pelayanan']?></span> -->
            <span class="search_jenis_layanan"><?=$result['status'] >= 4 && $rs['no_sampel'] ? '('.$rs['no_sampel'].') ' : ''?><?=$rs['nama_jenis_pelayanan']?></span>
            <input value="<?=$rs['id_t_reservasi_online_detail']?>" name="detail[]" style="display: none;" />
          </td>
        </tr>
        <?php foreach($rs['parameter'] as $p){ if($p['checked'] == 1){ ?>
          <tr style="border: 1px solid black;">
            <td style="padding: 5px; width: 40%;">
              <span style="font-size: 11pt; color: black;"><?=$p['nama_parameter_jenis_pelayanan']?></span>
            </td>
            <td style="padding: 5px; width: 30%;">
              <input autocomplete="off" <?=$result['status'] != 6 ? 'disabled' : ''; ?> class="form-control form-control-sm" name="hasil_<?=$p['id_t_reservasi_online_parameter']?>" value="<?=$p['hasil_lab']?>" />
            </td>
            <td style="padding: 5px; width: 30%;">
              <input autocomplete="off" <?=$result['status'] != 6 ? 'disabled' : ''; ?> class="form-control form-control-sm" name="catatan_<?=$p['id_t_reservasi_online_parameter']?>" value="<?=$p['catatan_lab']?>"/>
            </td>
          </tr>
        <?php } }?>
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