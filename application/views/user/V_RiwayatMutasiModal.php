<?php
    if($riwayat){
?>
    <div class="row p-2">
        <div class="col-12">

        <div class="tab-content col-12" id="myTabContent">
            <div class="tab-pane show active" id="role_tab">
                <div class="row">
                    <div class="col-12 table-responsive">
            <table class="table table-hover table-striped" style="width:100%;" id="data_table_riwayat">
            <thead>
                <th class="text-center">No</th>
                <th>Nama</th>
                <th>Unit Kerja Asal Mutasi</th>   
                <th>Unit Kerja Tujuan Mutasi</th>
            </thead>
            <tbody>
                <?php $no = 1; foreach($riwayat as $rs){ ?>
                    <tr>
                        <td align="center"><?=$no++;?></td>
                        <td><?=$rs['nama'];?></td>
                        <td><?=$rs['unit_kerja_asal'];?></td>
                        <td><?=$rs['unit_kerja_tujuan'];?></td>
                       
                
                    </tr>
                <?php } ?>
            </tbody>
                    </div>
                    <div class="col-12"><hr></div>
                
                </div>
            </div>
            
           
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php } else { ?>
    <div class="col-12 text-center">
        <h6><i class="fa fa-exclamation"></i> Data tidak ditemukan</h6>
    </div>
<?php } ?>  

<!-- <script>
          let table = $('#data_table_riwayat').DataTable({
                responsive: false
            });
</script> -->
<script>
    $('#data_table_riwayat').DataTable({
    "ordering": false
     } );
    
    $(function () {
    $('[data-toggle="tooltip"]').tooltip()
    })
</script>