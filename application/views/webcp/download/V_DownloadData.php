<?php if($result){ ?>
  <div class="col-lg-12 table-responsive">
    <table class="data_table table table-sm table-hover">
      <thead>
        <th class="text-center">No</th>
        <th class="text-center">Tanggal</th>
        <th class="text-center">Judul</th>
        <th class="text-center">Keterangan</th>
        <th class="text-center">Pilihan</th>
      </thead>
      <tbody>
        <?php $no = 1; foreach($result as $rs){ ?>
          <tr>
            <td class="text-center"><?=$no++?></td>
            <td class="text-center"><?=formatDateOnly($rs['tanggal'])?></td>
            <td class="text-left"><?=($rs['judul'])?></td>
            <td class="text-left"><?=($rs['keterangan'])?></td>
            <td class="text-center">
              <a class="btn btn-sm btn-primary-color" target="_blank" href="<?=base_url('./assets/admin/download/'.$rs['file'])?>">Download <i class="fa fa-download"></i></a>
            </td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
  <script>
    $(function(){
      $('.data_table').dataTable()
    })
  </script>
<?php } else { ?>
  <div class="col-lg-12 text-center">
    <h6>Data Tidak Ditemukan <i class="fa fa-exclamation"></i></h6>
  </div>
<?php } ?>