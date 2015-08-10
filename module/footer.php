<?php if($_SESSION['kt_login_level'] == 3){ ?>
    <div id="basic" class="well">
        <h4>Chỉnh sửa hệ thống</h4>
        <form class="pure-form pure-form-aligned" id="popSystemForm">
            <fieldset>
                <div class="pure-control-group" id="popSystemContent">
                    <?php include("system_edit.php"); ?>
                </div>
                <input type="hidden" id="popSystemID">
                <div class="pure-control-group">
                    <label for="popSystemName" class="button-secondary">Tên thay thế</label>
                    <input id="popSystemName" type="text" required>
                </div>
                <div class="pure-control-group">
                    <label for="popSystemLink" class="button-secondary">Đường dẫn</label>
                    <input id="popSystemLink" type="text" required onchange="addhttp(this.id, this.value);">
                </div>
                <div class="pure-control-group">
                    <label for="popSystemBG" class="button-secondary">Màu nền</label>
                    <input type="text" id="popSystemBG" onchange="$('#popSystemColorBG').val($('#popSystemBG').val());"/>
                    <input type="color" id="popSystemColorBG" onchange="$('#popSystemBG').val(this.value);">
                </div>
                <div class="pure-control-group">
                    <label for="popSystemFC" class="button-secondary">Màu chữ</label>
                    <input type="text" id="popSystemFC" onchange="$('#popSystemColorFC').val($('#popSystemFC').val());"/>
                    <input type="color" id="popSystemColorFC" onchange="$('#popSystemFC').val(this.value);">
                </div>
                <div class="pure-control-group">
                    <label for="popSystemDisplay" class="button-secondary btn-float-left">Hiển thị</label>
                    <div class="container">
                        <label class="switch switch-green">
                            <input id="popSystemDisplay" type="checkbox" class="switch-input">
                            <span class="switch-label" data-on="On" data-off="Off"></span>
                            <span class="switch-handle"></span>
                        </label>
                    </div>
                </div>
            </fieldset>
            <button type="submit" class="button-success pure-button" id="popSystemSubmit">Hoàn tất</button>
            <button class="basic_close button-error pure-button" id="popSystemClose">Đóng</button>
        </form>

    </div>
<?php } ?>

<div class="light" id="lightConfirm">
    <div class="lightTitle">
        <p class="pTitle">THÔNG BÁO</p>
        <div id="divConfirm"></div>
    </div>
    <p class="pCloseConfirm" onclick='lightbox_close("lightConfirm", "fadeConfirm");'>Đóng cửa sổ</p>
</div>
<div class="fade" id="fadeConfirm"></div>
<div class="clear"></div>

<footer>
<div class="m-wrap">
    <div class="i-foot">
        <div class="bg-ifoot">
            <ul class="ul-ifoot">
                <li>
                    <h4 class="t-ifoot">Giới thiệu</h4><!-- End .t-ifoot -->
                    <div class="m-ifoot">
                        <ul class="news">
                            <?php
                            $result1 = get_records("viki_tin","status = 0 AND pos = 1","sort, date_added DESC"," "," ");
                            while($row_result1 = mysql_fetch_assoc($result1)){
                            ?>
                            <li><a href="<?php echo $root; ?>/thong-tin/<?php echo $row_result1['subject'];?>.html"><?php echo $row_result1['name'];?></a></li>
                            <?php } ?>
                        </ul>
                    </div><!-- End .m-ifoot -->
                </li>                    
                <li>
                    <h4 class="t-ifoot">Dành cho người bán</h4><!-- End .t-ifoot -->
                    <div class="m-ifoot">
                        <ul class="news">
                            <?php
                            $result2 = get_records("viki_tin","status = 0 AND pos = 2","sort, date_added DESC"," "," ");
                            while($row_result2 = mysql_fetch_assoc($result2)){
                            ?>
                            <li><a href="<?php echo $root; ?>/thong-tin/<?php echo $row_result2['subject'];?>.html"><?php echo $row_result2['name'];?></a></li>
                            <?php } ?>
                        </ul>
                    </div><!-- End .m-ifoot -->
                </li>                    
                <li>
                    <h4 class="t-ifoot">Dành cho người mua</h4><!-- End .t-ifoot -->
                    <div class="m-ifoot">
                        <ul class="news">
                            <?php
                            $result3 = get_records("viki_tin","status = 0 AND pos = 3","sort, date_added DESC"," "," ");
                            while($row_result3 = mysql_fetch_assoc($result3)){
                            ?>
                            <li><a href="<?php echo $root; ?>/thong-tin/<?php echo $row_result3['subject'];?>.html"><?php echo $row_result3['name'];?></a></li>
                            <?php } ?>
                        </ul>
                    </div><!-- End .m-ifoot -->
                </li>
                <li>
                    <h4 class="t-ifoot">Hỗ trợ trực tuyến</h4><!-- End .t-ifoot -->
                    <div class="m-ifoot">
                        <ul class="news">
                            <?php
                            $result4 = get_records("viki_tin","status = 0 AND pos = 4","sort, date_added DESC"," "," ");
                            while($row_result4 = mysql_fetch_assoc($result4)){
                            ?>
                            <li><a href="<?php echo $root; ?>/thong-tin/<?php echo $row_result4['subject'];?>.html"><?php echo $row_result4['name'];?></a></li>
                            <?php } ?>
                        </ul>
                    </div><!-- End .m-ifoot -->
                </li>
            </ul>
            <div class="clear"></div>
        </div><!-- End .bg-ifoot -->
    </div><!-- End .i-foot -->
    
    <div class="text-foot">
        <span>Bản quyền © 2015  <b> <a href="http://<?php echo $sub; ?>/"><?php echo $sub; ?></a></span><br/>
        <span><?php echo get_field('tbl_config','id',2,'tenkh'); ?></span><br/>
        <span>Trụ sở: <?php echo get_field('tbl_config','id',2,'dckh'); ?></span><br/>
        <span>Giấy phép: <?php echo get_field('tbl_config','id',2,'faxkh'); ?></span><br/>
        <?php if(get_field('tbl_config','id',2,'contentkh') != ''){ ?>
            <span>Chịu trách nhiệm nội dung: <?php echo get_field('tbl_config','id',2,'contentkh'); ?></span><br/>
        <?php } ?>
        <br/>
        <p><a href="<?php echo $root; ?>/<?php echo get_field('tbl_shop_category','id',458,'subject'); ?>.html"><span class="hotline">QUẢNG CÁO</span></a></p>
    </div><!-- End .text-foot -->
</div><!-- End .m-wrap -->
</footer>
