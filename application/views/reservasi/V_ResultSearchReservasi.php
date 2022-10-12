<?php if($result){ ?>
  <style>
    .result_item{
      background-color: white;
      border: 1px solid black;
      border-radius: 5px;
      padding: 5px;
      color: black;
      margin-bottom: 5px;
      font-family: "Tahoma" !important;
    }

    .result_item:hover{
      background-color: grey;
      cursor: pointer;
      color: white;
      transition: .2s;
    }

    .result_text{
      font-size: 10pt;
      /* font-weight: bold; */
    }

    .result_text_notiket{
      font-size: 12pt;
      font-weight: bold;
    }
  </style>
    <!-- <?php foreach($result as $rs){ ?>
      <div class="col-lg-12 result_item" onclick="openReceipt('<?=$rs['id']?>')">
        <div class="row">
          <div class="col-lg-3 text-center">
            <span class="result_text_notiket"><?=$rs['nomor_tiket']?></span>
          </div>
          <div class="col-lg-4 text-center">
            <span class="result_text"><?=formatDateNamaBulanWT($rs['created_date'])?></span>
          </div>
          <div class="col-lg-2 text-center">
            <span class="result_text total_biaya_<?=$rs['id']?>"><?=formatCurrency($rs['total_biaya'])?></span>
          </div>
          <div class="col-lg-3 text-center">
            <span class="result_text status_<?=$rs['id']?>"><?=$rs['nama_status']?></span>
          </div>
        </div>
      </div>
    <?php } ?> -->
    <table class="table table-hover datatable">
      <thead>
        <th class="text-center">No</th>
        <th class="text-center">Nomor Tiket</th>
        <th class="text-center">Tanggal</th>
        <th class="text-center">Biaya</th>
        <th class="text-center">Status</th>
      </thead>
      <tbody>
        <?php $no=1; foreach($result as $rs){ ?>
          <tr onclick="openReceipt('<?=$rs['id']?>')" style="cursor: pointer;">
            <td class="text-center"><?=$no++;?></td>
            <td class="text-center"><?=$rs['nomor_tiket']?></td>
            <td class="text-center"><?=formatDateNamaBulanWT($rs['created_date'])?></td>
            <td class="text-center"><span class="total_biaya_<?=$rs['id']?>"><?=formatCurrency($rs['total_biaya'])?></span></td>
            <td class="text-center"><span class="status_<?=$rs['id']?>"><?=$rs['nama_status']?></span></td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
    <script>
      $(function(){
        $('.datatable').dataTable()
      })
    </script>
<?php } else { ?>
  <div class="col-lg-12 text-center">
    <h5>Data tidak ditemukan <i class="fa fa-exclamation"></i></h5>
  </div>
<?php } ?>