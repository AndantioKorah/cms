
<?php if($this->general_library->isWalikota() || $this->general_library->isSetda()){ ?>
    <div class="card card-default">
        <div class="row p-3">
            <div class="col">
                <label class="bmd-label-floating">Pilih SKPD</label>
                <select class="form-control select2-navy" style="width: 100%"
                    id="skpd" data-dropdown-css-class="select2-navy" name="skpd">
                    <?php if($list_skpd){ foreach($list_skpd as $l){ ?>
                        <option value="<?=$l['id_unitkerja']?>"><?=$l['nm_unitkerja']?></option>
                    <?php } } ?>
                </select>
            </div>
        </div>
    </div>
<?php } ?>

<div id="data_skpd_dashboard">
</div>
<div id="data_dashboard">
</div>

<script>
    $(function(){
        loadDataSkpdDashboard()
        <?php if($this->general_library->isWalikota() || $this->general_library->isSetda()){ ?>
            $('#skpd').select2()
        <?php } ?>
    })

    $('#skpd').on('change', function(){
        loadDataSkpdDashboard()
    })

    function loadDataSkpdDashboard(){
        $('#data_skpd_dashboard').html('')
        $('#data_skpd_dashboard').append(divLoaderNavy)
        <?php if($this->general_library->isWalikota() || $this->general_library->isSetda()){ ?>
            $('#data_skpd_dashboard').load('dashboard/C_Dashboard/loadDataSkpdDashboard/'+$('#skpd').val(), function(){
                $('#loader').hide()
            })
        <?php } else { ?>
            $('#data_skpd_dashboard').load('dashboard/C_Dashboard/loadDataSkpdDashboard/', function(){
                $('#loader').hide()
            })
        <?php } ?>
        $('#data_dashboard').html('')
    }

</script>