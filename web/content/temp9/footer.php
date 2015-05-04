

<style>
	.info_footer a { color:#00F;}
</style>
<div class="info_footer">
	<?php echo $row_shop['name'];?><br />
    Địa chỉ: <?php echo $row_shop['address'];?><br />
    Điện thoại:<?php echo $row_shop['telephone'];?><br />
    Email: <?php echo $row_shop['email'];?><br />
    
    <?php //include("content/".$template."/alexa.php");?>
    
    <div class="lienhe">
    <?php echo $row_shop['detail'];?>
    
    </div>

</div><!-- End .info_footer -->