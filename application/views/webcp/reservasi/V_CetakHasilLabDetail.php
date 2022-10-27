<html>
  <head>
    <style>
      @page{
        size: F4;
        width: 210mm;
        height: 330mm;
        font-family: 'Times New Roman';
      }

      .pagebreak{ 
        page-break-before: always;
      }

      @media print {
        .pagebreak{ 
            page-break-before: always;
        }

        @page{
          size: F4;
          width: 210mm;
          height: 330mm;
        }

        .td-bg-color{
          background-color: #a8e8f9 !important;
          -webkit-print-color-adjust: exact; 
        }
      }

      .table_parameter td, .table_parameter tr{
        padding: 3px;
        font-size: 10px;
      }

      .table_header td, .table_header tr{
        font-size: 10px;
      }
    </style>
  </head>

  <body id="body_cetakan">
    <div class="pembungkus pagebreak">
      <div style="width: 100%;">
        <img style="width: 100%; height: 110px;" src="<?=base_url('assets/img/header_cetak_hasil.jpeg')?>" />
      </div>
      <div style="width: 100%;">
        <center>
          <span><u>LAPORAN HASIL PENGUJIAN</u></span><br>
          <span>No : </span>
        </center>
      </div><br>
      <!-- <span style="font-weight: 500;"></span> -->
      <table style='width: 100%;' class="table_header">
        <tr>
          <td style='width: 50%;'>
            <table style="width: 100%;">
              <tr>
                <td valign=top>Jenis Sampel</td>
                <td valign=top>:</td>
                <td valign=top><?=$result['jenis_sampel']?></td>
              </tr>
              <tr>
                <td valign=top>Nama Pelanggan</td>
                <td valign=top>:</td>
                <td valign=top><?=$result['nama_pelanggan']?></td>
              </tr>
              <tr>
                <td valign=top>Alamat Pelanggan</td>
                <td valign=top>:</td>
                <td valign=top><?=$result['alamat_pelanggan']?></td>
              </tr>
              <tr>
                <td valign=top>Lokasi Pengambilan</td>
                <td valign=top>:</td>
                <td valign=top><?=$result['lokasi_sampel']?></td>
              </tr>
              <tr>
                <td valign=top>No. Sampel</td>
                <td valign=top>:</td>
                <td valign=top><?=$result['no_sampel']?></td>
              </tr>
            </table>
          </td>
          <td style='width: 50%;'>
            <table style="width: 100%;">
              <tr>
                <td valign=top>Pengambil Sampel</td>
                <td valign=top>:</td>
                <td valign=top><?=$result['nama_pengambil_sampel']?></td>
              </tr>
              <tr>
                <td valign=top>Tgl. Pengambilan</td>
                <td valign=top>:</td>
                <td valign=top><?=formatDateNamaBulanWT($result['waktu_pengambilan_sampel'])?></td>
              </tr>
              <tr>
                <td valign=top>Tgl. Penerimaan</td>
                <td valign=top>:</td>
                <td valign=top><?=formatDateNamaBulan($result['tgl_penerimaan'])?></td>
              </tr>
              <tr>
                <td valign=top>Tgl. Diperiksa</td>
                <td valign=top>:</td>
                <td valign=top><?=formatDateNamaBulan($result['tgl_pemeriksaan'])?></td>
              </tr>
              <tr>
                <td valign=top style="color: white">.</td>
                <td valign=top></td>
                <td valign=top></td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
      <table style="width: 100%; border-collapse: collapse;" border=1 class="table_parameter">
        <thead>
          <th style="padding: 5px; text-align: center; width: 5%;">No</th>
          <th style="padding: 5px; text-align: center; width: 20%;">Parameter</th>
          <th style="padding: 5px; text-align: center; width: 10%;">Satuan</th>
          <th style="padding: 5px; text-align: center; width: 15%;">Baku Mutu</th>
          <th style="padding: 5px; text-align: center; width: 20%;">Hasil Analisa</th>
          <th style="padding: 5px; text-align: center; width: 30%;">Metode Pengujian</th>
        </thead>
        <tbody>
          <?php $p = $result['parameter'];
            if(isset($p['fisika'])){
          ?>
            <tr>
              <td style="text-align: left; background-color: #a8e8f9;" class="td-bg-color" colspan=6>FISIKA</td>
            </tr>
            <?php $no = 1; foreach($p['fisika'] as $dt){ ?>
              <tr>
                <td style="text-align: center;"><?=$no++;?></td>
                <td style="text-align: left;"><?=$dt['nama_parameter_jenis_pelayanan']?></td>
                <td style="text-align: center;"><?=$dt['satuan']?></td>
                <td style="text-align: center;"><?=$dt['baku_mutu']?></td>
                <td style="text-align: center;"><?=$dt['hasil_lab']?></td>
                <td style="text-align: center;"><?=$dt['metode']?></td>
              </tr>
            <?php } }
              if(isset($p['kimia'])){
            ?>
              <tr>
                <td style="text-align: left; background-color: #a8e8f9;" class="td-bg-color" colspan=6>KIMIA</td>
              </tr>
            <?php if(isset($p['kimia']['organik'])){ ?>
              <tr>
                <td style="text-align: left; background-color: #a8e8f9;" class="td-bg-color" colspan=6>Kimia Organik</td>
              </tr>
              <?php $no = 1; foreach($p['kimia']['organik'] as $dt){ ?>
                <tr>
                  <td style="text-align: center;"><?=$no++;?></td>
                  <td style="text-align: left;"><?=$dt['nama_parameter_jenis_pelayanan']?></td>
                  <td style="text-align: center;"><?=$dt['satuan']?></td>
                  <td style="text-align: center;"><?=$dt['baku_mutu']?></td>
                  <td style="text-align: center;"><?=$dt['hasil_lab']?></td>
                  <td style="text-align: center;"><?=$dt['metode']?></td>
                </tr>
              <?php } } if(isset($p['kimia']['anorganik'])){ ?>
              <tr>
                <td style="text-align: left; background-color: #a8e8f9;" class="td-bg-color" colspan=6>Kimia Anorganik</td>
              </tr>
              <?php $no = 1; foreach($p['kimia']['anorganik'] as $dt){ ?>
                <tr>
                  <td style="text-align: center;"><?=$no++;?></td>
                  <td style="text-align: left;"><?=$dt['nama_parameter_jenis_pelayanan']?></td>
                  <td style="text-align: center;"><?=$dt['satuan']?></td>
                  <td style="text-align: center;"><?=$dt['baku_mutu']?></td>
                  <td style="text-align: center;"><?=$dt['hasil_lab']?></td>
                  <td style="text-align: center;"><?=$dt['metode']?></td>
                </tr>
              <?php } } if(isset($p['kimia']['mikrobiologi'])){ ?>
              <tr>
                <td style="text-align: left; background-color: #a8e8f9;" class="td-bg-color" colspan=6>Mikrobiologi</td>
              </tr>
              <?php $no = 1; foreach($p['kimia']['mikrobiologi'] as $dt){ ?>
                <tr>
                  <td style="text-align: center;"><?=$no++;?></td>
                  <td style="text-align: left;"><?=$dt['nama_parameter_jenis_pelayanan']?></td>
                  <td style="text-align: center;"><?=$dt['satuan']?></td>
                  <td style="text-align: center;"><?=$dt['baku_mutu']?></td>
                  <td style="text-align: center;"><?=$dt['hasil_lab']?></td>
                  <td style="text-align: center;"><?=$dt['metode']?></td>
                </tr>
              <?php } } if(isset($p['kimia']['etc'])){ ?>
              <tr>
                <td style="text-align: left; background-color: #a8e8f9;" class="td-bg-color" colspan=6>Kimia Anorganik</td>
              </tr>
              <?php $no = 1; foreach($p['kimia']['anorganik'] as $dt){ ?>
                <tr>
                  <td style="text-align: center;"><?=$no++;?></td>
                  <td style="text-align: left;"><?=$dt['nama_parameter_jenis_pelayanan']?></td>
                  <td style="text-align: center;"><?=$dt['satuan']?></td>
                  <td style="text-align: center;"><?=$dt['baku_mutu']?></td>
                  <td style="text-align: center;"><?=$dt['hasil_lab']?></td>
                  <td style="text-align: center;"><?=$dt['metode']?></td>
                </tr>
              <?php } } ?>
            <?php } if(isset($p['etc'])){ $no=1; foreach($p['etc'] as $dt){ ?>
              <tr>
                <td style="text-align: center;"><?=$no++;?></td>
                <td style="text-align: left;"><?=$dt['nama_parameter_jenis_pelayanan']?></td>
                <td style="text-align: center;"><?=$dt['satuan']?></td>
                <td style="text-align: center;"><?=$dt['baku_mutu']?></td>
                <td style="text-align: center;"><?=$dt['hasil_lab']?></td>
                <td style="text-align: center;"><?=$dt['metode']?></td>
              </tr>
            <?php } } ?>
        </tbody>
      </table>
    </div>
  </body>

</html>