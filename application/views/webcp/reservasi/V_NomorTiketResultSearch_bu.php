<?php if($result){ ?>
  <style>
    .result_item{
      background-color: white;
      border: 1px solid var(--primary);
      border-radius: 5px;
      padding: 5px;
      color: black;
      margin-bottom: 10px;
      font-family: "Poppins", "sans-serif";
    }

    .result_item:hover{
      background-color: var(--primary-hover);
      cursor: pointer;
      color: white;
      transition: .2s;
    }

    .result_text{
      font-size: 10pt;
      /* font-weight: bold; */
    }

    .result_text_notiket{
      font-size: 14pt;
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
            <span class="result_text"><?=formatDateNamaBulanWT($rs['updated_date'])?></span>
          </div>
          <div class="col-lg-2 text-center">
            <span class="result_text"><?=formatCurrency($rs['total_biaya'])?></span>
          </div>
          <div class="col-lg-3 text-center">
            <span class="result_text"><?=$rs['nama_status']?></span>
          </div>
        </div>
      </div>
    <?php } ?>
    <script>
      function openReceipt(id){

      }
    </script>
<?php } else { ?>
  <div class="col-lg-12 text-center">
    <h5>Nomor Tiket tidak ditemukan <i class="fa fa-exclamation"></i></h5>
  </div>
<?php } ?>