<div class="block_ct">                    

    <div class="main_adv">
        
        <h1 class="title_adv">
            <?php echo module_keyword($mang11,$mang22,"box_ad");?>
        </h1><!-- End .title_adv -->

        
            <ul>
				<?php
                $gt=get_records("tbl_ad","status=0 and cate=0 AND idshop='{$idshop}'"," "," "," ");
                while($row_ad=mysql_fetch_assoc($gt)){
                ?>
                <li>
                <?php
                $k=$row_ad['image'];
                $GT = explode(".",$k);
                $name=$GT[0];
                $kieu=$GT[1];
                if($kieu=='swf' || $kieu=='SWF'){
				$chuoi = explode("-",$row_ad['ad_info']);
                ?>
                <a href="<?php echo $row_ad['link'] ?>" title="<?php echo $row_ad['name'] ?>">
                    <object width="<?php echo $chuoi['0']?>" height="<?php echo $chuoi['1']?>" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000">
                        <param value="sameDomain" name="allowScriptAccess" />
                        <param value="<?php echo $linkroot ;?>/<?php echo $row_ad['image']?>" name="movie" />
                        <param value="best" name="quality" />
                        <param value="transparent" name="wmode" />
                        <embed width="<?php echo $chuoi['0']?>" height="<?php echo $chuoi['1']?>" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" allowscriptaccess="sameDomain" name="tta" wmode="transparent" quality="best" src="<?php echo $linkroot ;?>/<?php echo $row_ad['image']?>"> </embed>
                    </object>
                </a>
                <?php } else {?>
                    <a href="<?php echo $row_ad['link'] ?>" title="<?php echo $row_ad['name'] ?>">
                    <img src="<?php echo $linkroot ;?>/<?php echo $row_ad['image'] ?>"  title="<?php echo $row_ad['tomtat'] ?>" />
                    </a>
                <?php }?>
                </li>
                <?php }//kiemtralinkxoa?> 

            </ul>
            

    </div><!-- End .main_adv -->

</div><!-- End .block_ct -->