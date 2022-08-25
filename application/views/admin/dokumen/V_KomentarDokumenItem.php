<?php if($result){ ?>
    <style>
        .chat_name{
            font-size: .8rem;
            font-weight: bold;
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 1;
            -webkit-box-orient: vertical;
        }

        .comment_container{
            border-radius: 10px;
            background-color: white;
            max-width: 85%;
            padding-left: 7px;
            padding-right: 7px;
            padding-top: 3px;
            padding-bottom: 3px;
            float: left;
        }

        .comment_text{
            /* margin-top: 10px; */
            font-size: 1rem;
            line-height: 20px;
            font-weight: 500;
            margin-right: 10px;
            /* margin: 0; */
            /* margin-top: 5px; */
            /* margin-bottom: 5px; */
        }

        .comment_time{
            color: #858585;
            font-size: .7rem;
            float: right;
            font-weight: bold;
            margin-top: 7px;
        }

        .container_user_chats{
            position: relative;
        }

        .my_comment{
            background-color: #1b2a3c;
            color: white;
            float: right !important;
        }

        .my_comment_time{
            color: #cfcfcf !important;
        }

        .same_user_chat_margin{
            margin-top: -5px;
        }
    </style>
    <div class="row" id="comment_item" style="padding-left: 10px; padding-right: 10px; max-height: 68vh; overflow-y: auto;">
        <?php $i=0; $temp = null; foreach($result as $rs){ ?>
            <div class="col-lg-12 <?=($temp && $rs['created_by'] != $temp['created_by']) ? 'mt-4' : 'same_user_chat_margin'?>">
                <div class="row">
                    <div class="col-lg-12 container_user_chats mb-2">
                        <?php if(($rs['created_by'] != $this->general_library->getId() && ($temp && $rs['created_by'] != $temp['created_by']))) { ?>
                            <table style="width: 100%;">
                                <tr>
                                    <td style="width: 5%;">
                                        <img class="img-circle elevation-2" class="profile_pict" style="max-width: 30px; max-height: 30px;" 
                                        src="<?=$this->general_library->getProfilePictChat($rs['profile_picture'])?>" alt="User Image">
                                    </td>
                                    <td style="width: 100%;">
                                        <span class="chat_name"><?=$rs['nama']?></span>
                                    </td>
                                </tr>
                            </table>
                        <?php } else if(($rs['created_by'] == $this->general_library->getId() && ($temp && $rs['created_by'] != $temp['created_by'])) || $i == 0) { ?>
                            <span class="chat_name" style="float: right; margin-bottom: -5px;">Saya</span>
                        <?php } ?>
                    </div>
                    <!-- <?php if($rs['created_by'] == $this->general_library->getId()){ ?>
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2"></div>
                    <?php } ?>
                    <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10 comment_container <?=$rs['created_by'] == $this->general_library->getId() ? 'my_comment' : '';?>">
                        <span class="comment_text"><?=$rs['komentar']?></span>
                        <span class="comment_time <?=$rs['created_by'] == $this->general_library->getId() ? 'my_comment_time' : '';?>"><?=formatDateLive($rs['tanggal'])?></span>
                    </div> -->
                    <div class="col-lg-12">
                        <div class="comment_container <?=$rs['created_by'] == $this->general_library->getId() ? 'my_comment' : '';?>">
                            <span class="comment_text"><?=$rs['komentar']?></span>
                            <span class="comment_time <?=$rs['created_by'] == $this->general_library->getId() ? 'my_comment_time' : '';?>"><?=formatDateLive($rs['tanggal'])?></span>
                        </div>
                    </div>
                </div>
            </div>
        <?php $temp = $rs; $i++; } ?>
    </div>
    <script>
        $(function(){
            $('#comment_item').scrollTop($('#comment_item')[0].scrollHeight);
            
        })
    </script>
<?php } else { ?>
    <div class="col-12 text-center">
        <h6>Belum ada komentar</h6>
    </div>
<?php } ?>