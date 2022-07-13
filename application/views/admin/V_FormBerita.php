<form id="form_berita">
                <div class="row">
                    <div class="col-lg-4 col-md-3">
                        <div class="form-group">
                            <label class="bmd-label-floating">Judul (Indonesia)</label>
                            <textarea class="form-control" name="berita_judul_ina" id="berita_judul_ina" rows="3"></textarea>
                            <!-- <input required class="form-control" autocomplete="off" name="berita_judul" id="berita_judul"/> -->
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-3">
                        <div class="form-group">
                            <label class="bmd-label-floating">Judul (English)</label>
                            <textarea class="form-control" name="berita_judul_eng" id="berita_judul_eng" rows="3"></textarea>
                            <!-- <input required class="form-control" autocomplete="off" name="" id=""/> -->
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-3">
                        <div class="form-group">
                            <label class="bmd-label-floating">Tanggal Berita</label>
                            <input required class="form-control datepicker"  name="" id=""/>
                        </div>
                    </div>
                  
                    <div class="col-lg-6 col-md-3">
                        <div class="form-group">
                            <label class="bmd-label-floating">Dokumen</label>
                            <input type="file" required class="form-control" autocomplete="off" name="" id=""/>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-3">
                        <div class="form-group">
                            <label class="bmd-label-floating">Thumbnails</label>
                            <input type="file" required class="form-control" autocomplete="off" name="" id=""/>
                        </div>
                    </div>
                
                    
                  
                    <div class="col-lg-8 col-md-8"></div>
                    <div class="col-lg-4 col-md-4 text-right mt-2">
                        <button class="btn btn-sm btn-navy" type="submit"><i class="fa fa-save"></i> SIMPAN</button>
                    </div>
                </div>
            </form>
<script>
  $('.datepicker').datepicker({
    format: 'dd/mm/yyyy',
    todayHighlight: true,
    todayBtn: "linked",
    keyboardNavigation:true,
    autoclose: true,
    orientation: "bottom auto"
});
</script>