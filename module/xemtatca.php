<section class="list-cate">

    <h2 class="t-mn-dm">
        Tất cả danh mục
    </h2><!-- End .t-mn-dm -->

    <div class="f-list">
        <ul class="ul-list">
            <?php
            $cate=get_records("tbl_shop_category","status=0 AND  parent=2","sort ASC"," "," ");
            $t=mysql_num_rows($cate);
            $k=1;
            $n=1;
            while($row_cate=mysql_fetch_assoc($cate)){
                ?>
                <li class="fix-box-sizing">

                    <a href="<?php echo $linkrootshop?>/<?php echo $row_cate['subject'];?>.html"  title="<?php echo $row_cate['name'];?>">
                       <img class="imgAllProduct" src="<?php echo $linkrootshop?>/web/<?php echo $row_cate['image']; ?>"> <?php echo $row_cate['name'];?>
                    </a>
                    <ul>
                        <?php
                        $cate1=get_records("tbl_shop_category","status=0 AND parent='".$row_cate['id']."'","sort DESC"," "," ");
                        while($row_cate1=mysql_fetch_assoc($cate1)){
                            ?>
                            <li>
                                <a href="<?php echo $linkrootshop?>/<?php echo $row_cate1['subject'];?>.html" title=""><?php echo $row_cate1['name'];?>
                                    <img class="imgAllProduct1" src="<?php echo $linkrootshop?>/web/<?php echo $row_cate1['image'];?>
                                </a>
                            </li>
                        <?php }?>
                    </ul>
                </li>
            <?php }?>
        </ul>
        <div class="clear"></div>
    </div><!-- End .f-list -->

</section>
