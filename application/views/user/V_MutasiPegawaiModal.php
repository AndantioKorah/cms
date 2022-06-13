<?php
    if($pegawai){
?>
    <div class="row p-2">
        <div class="col-12">

        <div class="tab-content col-12" id="myTabContent">
            <div class="tab-pane show active" id="role_tab">
                <div class="row">
                    <div class="col-12">
                        <form id="form_mutasi_pegawai">
                            <h4><?=$pegawai[0]['nama_pegawai']?></h4>
                            <label>Pilih SKPD Tujuan Mutasi:</label>
                            
                            <select class="form-control select2-navy" style="width: 100%;"
                             id="select_search_skpd_modal" data-dropdown-css-class="select2-navy" name="select_search_skpd_modal">
                            <?php if($list_skpd){
                                foreach($list_skpd as $ls){
                                ?>
                                <option value="<?=$ls['id_unitkerja']?>">
                                    <?=$ls['nm_unitkerja']?>
                                </option>
                                <?php } } ?>
                            </select>
                   <input style="display: none;"  class="form-control form-control-sm" name="skpd" value="<?=$pegawai[0]['skpd']?>"/>
                   <input style="display: none;"  class="form-control form-control-sm" name="nip" value="<?=$pegawai[0]['nipbaru']?>"/>
                            <input style="display: none;" class="form-control form-control-sm" name="id_peg" value="<?=$pegawai[0]['id_peg']?>"/>
                            <button class="btn btn-sm btn-navy float-right mt-3"><i class="fa fa-save"></i> Simpan</button>
                        </form>
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
<?php } ?>
<script>

    $(function(){
        $('.select2_this').select2()
        $('#select_search_skpd_modal').select2()
      
    })


    $('#form_mutasi_pegawai').on('submit', function(e){
            e.preventDefault()
            $.ajax({
                url: '<?=base_url("user/C_User/mutasiPegawaiSubmit")?>',
                method: 'post',
                data: $(this).serialize(),
                success: function(datares){
                   let res = JSON.parse(datares)
                   if(res.code == 0){
                        successtoast('Berhasil')
                        $('#mutasi_pegawai_modal').modal('hide')
                        const myTimeout = setTimeout(loadPegawai, 500);
                            // loadPegawai()
                   } else {
                       errortoast(res.message)
                   }
                }, error: function(e){
                    errortoast('Terjadi Kesalahan')
                }
            })
        })

    
</script>