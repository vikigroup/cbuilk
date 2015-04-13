<?php include("module/menu_left_home.php") ;?>

<div class="row">
    <?php include("module/khuyenmai_home.php") ;?>
</div>

<?php
$gt=get_records("tbl_adv","status=0","id DESC","0,2"," ");
$row_slide=mysql_fetch_assoc($gt);
if($row_slide['id']>0){
?>
<section class="Adv">
	<a href="<?php echo $row_slide['link']?>" target="_blank">
		<img src="<?php echo $linkroot ;?>/<?php echo $row_slide['image']?>" alt="">
	</a>
</section><!-- End .Adv -->
<?php }?>

<?php include("module/product_new.php") ;?>
<?
$row_slide=mysql_fetch_assoc($gt);
if($row_slide['id']>0){
?>
<section class="Adv">
	<a href="<?php echo $row_slide['link']?>" target="_blank">
		<img src="<?php echo $linkroot ;?>/<?php echo $row_slide['image']?>" alt="">
	</a>
</section><!-- End .Adv -->
<?php }?>