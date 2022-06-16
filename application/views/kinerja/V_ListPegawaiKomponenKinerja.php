<?php if($list_pegawai){ ?>
    <div class="col-lg-12 table-responsive">
        <table class="table table-hover" border=1>
            <thead>
                <th class="text-center">No</th>
                <th class="text-center">Nama Pegawai</th>
                <th class="text-center">Jumlah Nilai Capaian</th>
                <th class="text-center">Pembobotan</th>
                <th class="text-center">Pilihan</th>
            </thead>
            <?php $no=1; foreach($list_pegawai as $p){
                $capaian = null;
                $pembobotan = null;
                if(isset($p['komponen_kinerja'])){
                    list($capaian, $pembobotan) = countNilaiKomponen($p['komponen_kinerja']);
                    // $pembobotan = $pembobotan * 100;
                    $pembobotan = (formatTwoMaxDecimal($pembobotan)).'%';
                }
            ?>
                <tr>
                    <td class="text-center"><?=$no++;?></td>
                    <td><?=getNamaPegawaiFull($p)?></td>
                    <td class="text-center"><span id="capaian_<?=$p['id_m_user']?>"><?=$capaian?></span></td>
                    <td class="text-center"><span id="pembobotan_<?=$p['id_m_user']?>"><?=$pembobotan?></span></td>
                    <td class="text-center">
                        <button data-toggle="modal" href="#modal_edit_data_nilai" onclick="editNilaiKomponen('<?=$p['id_m_user']?>')" 
                        class="btn btn-sm btn-navy"><i class="fa fa-edit"></i> Edit Nilai</button>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>
    <div class="modal fade" id="modal_edit_data_nilai" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div id="modal-dialog" class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">Nilai Komponen Kinerja Pegawai</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="modal_edit_data_nilai_content">
                </div>
            </div>
        </div>
    </div>
    <script>
        function editNilaiKomponen(id){
            let bulan = "<?=$periode['bulan']?>"
            let tahun = "<?=$periode['tahun']?>"
            $('#modal_edit_data_nilai_content').html('')
            $('#modal_edit_data_nilai_content').append(divLoaderNavy)
            $('#modal_edit_data_nilai_content').load('<?=base_url("kinerja/C_Kinerja/editNilaiKomponen/")?>'+id+'/'+bulan+'/'+tahun, function(){
                $('#loader').hide()
            })
        }
    </script>
<?php } else { ?>
<?php } ?>