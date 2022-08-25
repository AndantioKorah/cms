<style>
    .detail_dokumen_title{
        font-size: 1.5rem;
        color: black !important;
        /* overflow: hidden;
        text-overflow: ellipsis;
        display: -webkit-box;
        -webkit-line-clamp: 1;
        -webkit-box-orient: vertical; */
        /* text-align: justify; */
    }

    .detail_dokumen_keterangan{
        font-size: 1rem;
        color: black !important;
    }

    .detail_dokumen_meta{
        font-size: .8rem;
    }

    .detail_dokumen_title:hover{
        color: white !important;
    }

    .send-commend{
        font-size: 1.3rem;
        border: 0px;
        background-color: white;
    }

    .send-commend:hover{
        background-color: #0769cf;
        border-radius: 20px;
        color: white !important;
        transition: .3s;
    }

    .input-comment{
        border-radius: 10px;
        /* height: 10vh !important; */
        overflow:hidden;
        overflow-wrap: break-word;
    }

    #content_komentar{
        padding: 10px;
        width: 100%;
        height: 70vh;
        background-color: #f5f5f5;
        border-radius: 5px;
        position: relative;
    }
</style>

<div class="row">
    <div class="col-lg-8" style="border-right: 1px solid grey; min-height: 60vh;">
        <?php if($result['main']){ $main = $result['main'];
        $file = explode(".", $main['file']);
        $fa = 'fa fa-file';
        switch($file[count($file)-1]){
          case 'pdf' : $fa = 'fa fa-file-pdf'; break;
          case 'xls' : $fa = 'fa fa-file-excel'; break;
          case 'xlsx' : $fa = 'fa fa-file-excel'; break;
          case 'png' : $fa = 'fa fa-file-image'; break;
          case 'jpg' : $fa = 'fa fa-file-image'; break;
          case 'jpeg' : $fa = 'fa fa-file-image'; break;
        }
        ?>
            <iframe onload="resizeIframe(this)" frameborder="0" style="border-radius: 5px; width: 100%;
                min-height: 400px;
                max-height: 800px;" src="<?=base_url('assets/admin/dokumen/'.$main['file'])?>">
            </iframe>
            <span title="<?=$main['judul']?>" class="detail_dokumen_title"><a style="color: black;" target="_blank" href="<?=base_url('assets/admin/dokumen/'.$main['file'].'')?>">
                <?=$main['judul']?></a>
            </span><br>
            <span clsas="detail_dokumen_meta">
                <i class="fa fa-clock"></i> <?=formatDateLive($main['tanggal'])?> &nbsp; &nbsp; &nbsp; 
                <i class="fa fa-pen"></i> <?=($main['nama'])?>
            </span>
            <hr>
            <span title="<?=$main['judul']?>" class="detail_dokumen_keterangan"><?=$main['keterangan']?>
            </span>
        <?php } ?>
    </div>
    <div class="col-lg-4">
        <!-- <span class="komentar-title"><i class="fa fa-comments"></i> Komentar</span>
        <hr> -->
        <div class="row" style="padding-left: 10px;">
            <div class="col-lg-12" id="content_komentar">
            </div>
            <form id="send_commend_form" class="form" style="width: 100%; margin-top: 20px;">
                <table style="padding: 0; bottom: 0; width: 100%;">
                    <tr>
                        <td style="width: 100%;">
                            <input autocomplete="off" oninput="commentTyping()" name="komentar" id="komentar" placeholder="Tulis komentar disini..." class="input-comment form-control" />
                        </td>
                        <td style="width: 10%; text-align: right">
                            <button type="submit" style="display: none;" class="send-commend text-navy"><i class="fa fa-paper-plane"></i></button>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>

<script>
    $(function(){
        loadKomentar('<?=$main['id']?>')
    })

    function loadKomentar(id){
        // $('#content_komentar').html('')
        // $('#content_komentar').append(divLoaderNavy)
        $('#content_komentar').load('<?=base_url('admin/C_Admin/loadKomentarDokumen/')?>'+id, function(){
            $('loader').hide()
        })
    }

    function resizeIframe(obj) {
        obj.style.height = obj.contentWindow.document.documentElement.scrollHeight + 'px';
    }

    function commentTyping(){
        if($('#komentar').val() != ''){
            $('.send-commend').show()
        } else {
            $('.send-commend').hide()
        }
    }

    $('#send_commend_form').submit(function(e){
        e.preventDefault()
        $.ajax({
            url: '<?=base_url('admin/C_Admin/sendCommend/'.$main['id'])?>',
            method: 'post',
            data: $(this).serialize(),
            success: function(data){
                let rs = JSON.parse(data)
                if(rs.code == 1){
                    errortoast(rs.message)
                } else {
                    loadKomentar('<?=$main['id']?>')
                    $('#komentar').val('')
                    $('#komentar').html('')
                    $('.send-commend').hide()
                }
            }, error: function(e){
                errortoast(e)
            }
        })
    })
</script>