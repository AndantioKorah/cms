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
    <?php foreach($result as $rs){ ?>
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
    <?php } ?>
    <script>

    </script>
<?php } else { ?>
  <div class="col-lg-12 text-center">
    <h5>Data tidak ditemukan <i class="fa fa-exclamation"></i></h5>
  </div>
<?php } ?>