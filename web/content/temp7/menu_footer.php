<div class="menu_f">
    <ul>
        <li><a href="" title="Trang chủ">Trang chủ</a></li>
        <li><a href="xem-tat-ca/" title="">sản phẩm</a></li>
        <?php
        $news=get_records("tbl_news_category","status=0 AND idshop='{$idshop}' "," "," "," ");
        while($row_news=mysql_fetch_assoc($news)){
        ?>
        <li><a href="chuyen-muc/<?php echo $row_news['subject'];?>.html" title=""><?php echo $row_news['name'];?></a></li>
       	<?php }?>
        <li><a href="lien-he.html" title="">Liện hệ</a></li>
    </ul>
    <div class="clear"></div>
</div><!-- End .menu_f -->

<div class="info_f">
    Copyright © <?php echo $row_shop['name'];?>. All rights reserved. Design by <a href="http://jbs.vn" title="" target="_blank">JBS.vn</a>
</div><!-- End .info_f -->