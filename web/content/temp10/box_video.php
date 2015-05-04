<?php
$so=1;
$video=get_records("tbl_video","status=0 AND idshop='{$idshop}' "," "," "," ");
$rs_video=mysql_fetch_assoc($video);

$LK1 = explode("=",$rs_video['link']);
	$ls1=$LK1[1];
$LK2 = explode("&",$ls1);
	$kq_video=$LK2[0];	
?>
<div class="block_ct">                    

    <div class="main_adv">
        
        <h1 class="title_adv">
              <?php echo module_keyword($mang11,$mang22,"box_video");?>  
        </h1><!-- End .title_adv -->
        
        <?php if($rs_video['link']!=""){ ?>                     
        <embed width="180" height="160" scale="exactfit" quality="high" wmode="transparent" type="application/x-shockwave-flash" src="http://www.youtube.com/v/<?php echo $kq_video; ?>&amp;autoplay=<?php echo $rs_video['tudong']?>" pluginspage="http://www.macromedia.com/go/getflashplayer"></embed> 
        <?php }?>
    </div><!-- End .main_adv -->

</div><!-- End .block_ct -->