<style>
  .text-ppid{
    overflow: hidden;
    text-overflow: ellipsis;
    display: -webkit-box;
    -webkit-line-clamp: 1;
    -webkit-box-orient: vertical;
  }
</style>
<?php if($result){ ?>
  <div class="col-lg-12 col-md-12">
    <table id="table_result_ppid" class="table table-hover" border=1>
      <thead>
        <th class="text-center">No</th>
        <th class="text-center">Tanggal</th>
        <th class="text-left">Judul</th>
        <th class="text-left">Keterangan</th>
        <th class="text-center">Download</th>
      </thead>
      <tbody>
        <?php $no=1; foreach($result as $rs){ ?>
          <tr>
            <td style="width: 5%;" class="text-center"><?=$no++;?></td>
            <td style="width: 20%;" class="text-center"><?=formatDateNamaBulanWT($rs['tanggal'])?></td>
            <td style="width: 35%;" class="text-left"><span class="text-ppid" title="<?=$rs['judul']?>"><?=$rs['judul']?></span></td>
            <td style="width: 35%;" class="text-left"><span class="text-ppid" title="<?=$rs['keterangan']?>"><?=$rs['keterangan']?></span></td>
            <td style="width: 5%;" class="text-center">
              <a target="_blank" href="<?=base_url(URI_PPID.$rs['file'])?>" class="btn btn-primary-color btn-sm"><i class="fa fa-download"></i></a>
            </td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
<?php } else { ?>
  <div class="col-lg-12 col-md-12 text-center">
    <h5>Data Tidak Ditemukan <i class="fa fa-exclamation"></i></h5>
  </div>
<?php } ?>