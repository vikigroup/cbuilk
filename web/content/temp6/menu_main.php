<div class="menu_w">
    <ul>
        <li><a href="<?php echo $linkroot ;?>/<?php echo $shop;?>"><?php echo module_keyword($mang11,$mang22,"home");?></a></li>
        <li>/</li>
        
        <li><a href="#"><?php echo module_keyword($mang11,$mang22,"products");?></a>
            <ul class="mn_children">
                <?php
				$cate=get_records("tbl_item_category","status=0 AND cate=0 AND parent=2 AND idshop='".$idshop."'"," "," "," ");
				while($row_cate=mysql_fetch_assoc($cate)){
				?>
					<li><a href="<?php echo $row_cate['subject']?>.html" title="<?php echo $row_cate['name'];?>"><?php echo $row_cate['name'];?></a>
						<?php 
						$cate1=get_records("tbl_item_category","status=0 AND parent='".$row_cate['id']."' AND idshop='".$idshop."'"," "," "," ");
						$sl=mysql_num_rows($cate1);
						if($sl>0){
						?>
						<ul class="menu_2_child">
							<?php
							while($row_cate1=mysql_fetch_assoc($cate1)){
							?>
							<li><a href="<?php echo $row_cate1['subject']?>.html" title=""><?php echo $row_cate1['name'];?></a></li>
							<?php } ?>
						</ul><!-- End .menu_2_child -->
						<?php }?>
					</li>
			   	<?php } ?>
            </ul><!-- End .mn_children -->
        </li>
        <li>/</li>
        
        <?php
        $news=get_records("tbl_item_category","status=0 AND cate=1 AND idshop='{$idshop}' "," "," "," ");
        while($row_news=mysql_fetch_assoc($news)){
        ?>
        <li><a href="<?php echo $row_news['subject'];?>.html" title=""><?php echo $row_news['name'];?></a></li>
        <li>/</li>
		 <?php }?>
         
        <li><a href="lien-he.html"><?php echo module_keyword($mang11,$mang22,"contact");?></a></li>
    </ul>
</div><!-- End .menu_w -->