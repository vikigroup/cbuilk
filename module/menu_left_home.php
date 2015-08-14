<article class="dmsp left-home">
    <div class="mn-dm fix-box-sizing">
        <div class="m-mn-dm">
            <ul class="ul-dm">
                <?php
                $arrayID = array('209', '210', '211', '390', '457', '458', '500');
                $cate = get_records("tbl_shop_category","status=0 AND parent=457 AND sort != 0 AND id NOT IN ( '" . implode($arrayID, "', '"). "' )","sort","12,27"," ");
                $i=1;
                while($row_cate = mysql_fetch_assoc($cate)){
                ?>
                <li>
                    <span class="icon-dm"><img src="<?php echo $linkroot; ?>/<?php echo $row_cate['image']; ?>" /></span>
                    <a href="<?php echo $linkrootshop; ?>/<?php echo $row_cate['subject'];?>.html"><?php echo $row_cate['name']; ?></a>
                    <span class="mask-sub-menu"></span>
                    <div id="s-mn<?php echo $i; ?>" class="sub-menu">
                        <h4 class="t-sub-mn"><?php echo $row_cate['name']; ?></h4><!-- End .t-sub-mn -->
                        <div class="m-sub-mn">
                            <ul>
                                <?php
                                $cate1=get_records("tbl_shop_category","status=0 AND parent='".$row_cate['id']."'"," "," "," ");
                                while($row_cate1=mysql_fetch_assoc($cate1)){
                                ?>
                                <li><a href="<?php echo $linkrootshop?>/<?php echo $row_cate1['subject'];?>.html"><?php echo $row_cate1['name']; ?></a></li>
                                <?php }?>
                            </ul>
                            <div class="clear"></div>
                        </div><!-- End .m-sub-mn -->
                        <?php if($row_cate['image_large'] != ""){ ?>
                            <img class="img-sty-sub" src="<?php echo $linkroot; ?>/<?php echo $row_cate['image_large']; ?>" alt="<?php echo $row_cate['title']; ?>">
                        <?php } ?>
                    </div><!-- End .sub-menu -->
                </li>
                <?php $i++;} ?>
            </ul>
        </div><!-- End .m-mn-dm -->
    </div><!-- End .mn-dm -->
</article><!-- End .dmsp -->
