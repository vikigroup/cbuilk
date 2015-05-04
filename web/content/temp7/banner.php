<div id="header">
    <!--<img src="skin/temp<?php echo $url;?>/imgs/layout/banner.png" alt=""/>-->
    <center>
		<?php   
		if($row_shop['banner']!="") {             
		$k=$row_shop['banner'];
		$GT = explode(".",$k);
		$ten=$GT[0];
		$kieu=$GT[1];
                    
        if($kieu=='swf' || $kieu=='SWF'){
			$chuoi = explode("-",$row_shop['banner_info']);
        ?>
        <OBJECT
            CLASSID="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"
            WIDTH="1000px"
            HEIGHT="<?php echo $chuoi['1'];?>"
            CODEBASE="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab">
        
            <PARAM NAME="MOVIE" VALUE="<?php echo $linkroot ;?>/<?php echo $row_shop['banner']?>">
            <PARAM NAME="PLAY" VALUE="true">
            <PARAM NAME="LOOP" VALUE="true">
            <PARAM NAME="QUALITY" VALUE="high">
            <param value="transparent" name="wmode" />
            <PARAM NAME="SCALE" VALUE="EXACTFIT">
        
            <EMBED
            SRC="<?php echo $linkroot ;?>/<?php echo $row_shop['banner']?>"
            WIDTH="1000px"
            HEIGHT="<?php echo $chuoi['1'];?>"
            PLAY="true" 
            LOOP="true"
            QUALITY="high"
            wmode="transparent"
            SCALE="EXACTFIT" 
            PLUGINSPAGE="http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=Shockwaveflash">
            </EMBED>
        </OBJECT>
        
        <?php } else {?>
        <img src="<?php echo $linkroot ;?>/<?php echo $row_shop['banner']; ?>"  title=" " />
    	<?php }
		}
		?>
	</center> 
</div><!-- End #header -->