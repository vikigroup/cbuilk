<?php
$so=1;
$video=get_records("tbl_video","status=0 AND idshop='{$idshop}' "," "," "," ");
$rs_video=mysql_fetch_assoc($video);

$LK1 = explode("=",$rs_video['link']);
	$ls1=$LK1[1];
$LK2 = explode("&",$ls1);
	$kq_video=$LK2[0];	
?>
<div class="qc_tai">
	<div class="title_cate_w">
        <?php echo module_keyword($mang11,$mang22,"box_video");?>
    </div><!-- End .title_cate_w -->
    <div>
		<?php if($rs_video['link']!=""){ ?>                     
        	<embed width="220" height="160" scale="exactfit" quality="high" wmode="transparent" type="application/x-shockwave-flash" src="http://www.youtube.com/v/<?php echo $kq_video; ?>&amp;autoplay=<?php echo $rs_video['tudong']?>" pluginspage="http://www.macromedia.com/go/getflashplayer"></embed> 
        <?php }?>
    </div>
</div>