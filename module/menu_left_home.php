<section class="top-ct">

    <article class="dmsp2">

        <nav id="nav-wrap">

            <ul id="nav">
                <?php
                $cate=get_records("tbl_shop_category","status=0 AND  parent=2"," "," "," ");
                $i=1;
                while($row_cate=mysql_fetch_assoc($cate)){
                    ?>
                    <li>
                        <a href="<?php echo $linkrootshop?>/<?php echo $row_cate['subject'];?>.html"><?php echo $row_cate['name'];?></a>
                    </li>
                <?php }?>
            </ul>

            <div class="clear"></div>

            <script type="text/javascript">
                jQuery(document).ready(function($){

                    /* prepend menu icon */
                    $('#nav-wrap').prepend('<div id="menu-icon">Menu</div>');

                    /* toggle nav */
                    $("#menu-icon").on("click", function(){
                        $("#nav").slideToggle();
                        $(this).toggleClass("active");
                    });

                });
            </script>

        </nav>

    </article><!-- Responsive dmsp -->

</section><!-- End .top-ct -->

<section class="top-ct">
    <article class="dmsp">

        <div class="mn-dm fix-box-sizing">
            <h2 class="t-mn-dm">
                Danh mục sản phẩm
            </h2><!-- End .t-mn-dm -->
            <div class="m-mn-dm">
                <ul class="ul-dm">
                    <?php
                    $cate=get_records("tbl_shop_category","status=0 AND  parent=2"," ","0,8"," ");
                    $i=1;
                    while($row_cate=mysql_fetch_assoc($cate)){
                        ?>
                        <li>
                            <span class="icon-dm"><img src="<?php echo $linkroot?>/<?php echo $row_cate['image'];?>" /></span>
                            <a href="<?php echo $linkrootshop?>/<?php echo $row_cate['subject'];?>.html"><?php echo $row_cate['name'];?></a>
                            <span class="mask-sub-menu"></span>
                            <div id="s-mn<?php echo $i;?>" class="sub-menu">

                                <h4 class="t-sub-mn"><?php echo $row_cate['name'];?></h4><!-- End .t-sub-mn -->

                                <div class="m-sub-mn">
                                    <ul>
                                        <?php
                                        $cate1=get_records("tbl_shop_category","status=0 AND parent='".$row_cate['id']."'"," "," "," ");
                                        while($row_cate1=mysql_fetch_assoc($cate1)){
                                            ?>
                                            <li><a href="<?php echo $linkrootshop?>/<?php echo $row_cate1['subject'];?>.html"><?php echo $row_cate1['name'];?></a></li>
                                        <?php }?>
                                    </ul>
                                    <div class="clear"></div>
                                </div><!-- End .m-sub-mn -->
                                <?php
                                if($row_cate['image_large']!=""){
                                    ?>
                                    <img class="img-sty-sub" src="<?php echo $linkroot?>/<?php echo $row_cate['image_large']?>" alt="">
                                <?php }?>

                            </div><!-- End .sub-menu -->
                        </li>
                        <?php $i++; }?>

                </ul>
                <a class="readmore" href="<?php echo $linkrootshop?>/xem-tat-ca.html">Xem tất cả danh mục</a>
            </div><!-- End .m-mn-dm -->
        </div><!-- End .mn-dm -->

    </article><!-- End .dmsp -->

</section>

<div class="clear"></div>


