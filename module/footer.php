<?php if($_SESSION['kt_login_level'] == 3){ ?>
    <div id="basic" class="well">
        <h4>Chỉnh sửa hệ thống</h4>
        <form class="pure-form pure-form-aligned" id="popSystemForm">
            <fieldset>
                <div class="pure-control-group">
                    <label for="popSystemName" class="button-secondary">Tên liên kết</label>
                    <input id="popSystemName" type="text" value="<?php echo $row_sanpham['brand_name']; ?>" required>
                </div>
                <div class="pure-control-group">
                    <label for="popSystemLink" class="button-secondary">Đường dẫn</label>
                    <input id="popSystemLink" type="text" value="<?php echo $row_sanpham['brand_link']; ?>" required onchange="addhttp(this.id, this.value);">
                </div>
                <div class="pure-control-group">
                    <label for="popSystemBG" class="button-secondary">Màu nền</label>
                    <input type="text" id="popSystemBG" value="<?php if($brand_background != ''){echo $brand_background;}else{echo "#000000";} ?>" onchange="$('#popSystemColorBG').val($('#popSystemBG').val());"/>
                    <input type="color" id="popSystemColorBG" value="<?php if($brand_background != ''){echo $brand_background;}else{echo "#000000";} ?>" onchange="$('#popSystemBG').val(this.value);">
                </div>
                <div class="pure-control-group">
                    <label for="popSystemFC" class="button-secondary">Màu chữ</label>
                    <input type="text" id="popSystemFC" value="<?php if($brand_color != ''){echo $brand_color;}else{echo "#ffffff";} ?>" onchange="$('#popSystemColorFC').val($('#popSystemFC').val());"/>
                    <input type="color" id="popSystemColorFC" value="<?php if($brand_color != ''){echo $brand_color;}else{echo "#ffffff";} ?>" onchange="$('#popSystemFC').val(this.value);">
                </div>
                <div class="pure-control-group">
                    <label for="popSystemDisplay" class="button-secondary btn-float-left">Hiển thị</label>
                    <div class="container">
                        <label class="switch switch-green">
                            <input type="checkbox" class="switch-input" checked>
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
                            <li><a href="<?php echo $linkrootshop?>/thong-tin/<?=get_field('viki_tin','id',1,'subject');?>.html"><?=get_field('viki_tin','id',1,'name');?></a></li>
                            <li><a href="<?php echo $linkrootshop?>/thong-tin/<?=get_field('viki_tin','id',2,'subject');?>.html"><?=get_field('viki_tin','id',2,'name');?></a></li>
                            <li><a href="<?php echo $linkrootshop?>/thong-tin/<?=get_field('viki_tin','id',3,'subject');?>.html"><?=get_field('viki_tin','id',3,'name');?></a></li>
                        </ul>
                    </div><!-- End .m-ifoot -->
                </li>                    
                <li>
                    <h4 class="t-ifoot">Dành cho người bán</h4><!-- End .t-ifoot -->
                    <div class="m-ifoot">
                        <ul class="news">
                             <li><a href="<?php echo $linkrootshop?>/thong-tin/<?=get_field('viki_tin','id',6,'subject');?>.html"><?=get_field('viki_tin','id',6,'name');?></a></li>
                            <li><a href="<?php echo $linkrootshop?>/thong-tin/<?=get_field('viki_tin','id',7,'subject');?>.html"><?=get_field('viki_tin','id',7,'name');?></a></li>
                            <li><a href="<?php echo $linkrootshop?>/thong-tin/<?=get_field('viki_tin','id',8,'subject');?>.html"><?=get_field('viki_tin','id',8,'name');?></a></li>
                        </ul>
                    </div><!-- End .m-ifoot -->
                </li>                    
                <li>
                    <h4 class="t-ifoot">Dành cho người mua</h4><!-- End .t-ifoot -->
                    <div class="m-ifoot">
                        <ul class="news">
                             <li><a href="<?php echo $linkrootshop?>/thong-tin/<?=get_field('viki_tin','id',9,'subject');?>.html"><?=get_field('viki_tin','id',9,'name');?></a></li>
                            <li><a href="<?php echo $linkrootshop?>/thong-tin/<?=get_field('viki_tin','id',10,'subject');?>.html"><?=get_field('viki_tin','id',10,'name');?></a></li>
                            <li><a href="<?php echo $linkrootshop?>/thong-tin/<?=get_field('viki_tin','id',11,'subject');?>.html"><?=get_field('viki_tin','id',11,'name');?></a></li>
                        </ul>
                    </div><!-- End .m-ifoot -->
                </li>
                <li>
                    <h4 class="t-ifoot">Hỗ trợ trực tuyến</h4><!-- End .t-ifoot -->
                    <div class="m-ifoot">
                        <ul class="news">
                            <li><a href="<?php echo $linkrootshop?>/thong-tin/<?=get_field('viki_tin','id',12,'subject');?>.html"><?=get_field('viki_tin','id',12,'name');?></a></li>
                            <li><a href="<?php echo $linkrootshop?>/thong-tin/<?=get_field('viki_tin','id',13,'subject');?>.html"><?=get_field('viki_tin','id',13,'name');?></a></li>
                            <li><a href="<?php echo $linkrootshop?>/thong-tin/<?=get_field('viki_tin','id',14,'subject');?>.html"><?=get_field('viki_tin','id',14,'name');?></a></li>
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
