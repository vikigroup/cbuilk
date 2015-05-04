<div class="info_f2" style="position:relative" >
    Địa chỉ : <?php echo $row_shop['address'];?><br />
    Điện thoại : <?php echo $row_shop['telephone'];?>    Hotline : <?php echo $row_shop['hotline'];?><br />
    Email :  <?php echo $row_shop['email'];?> - Fax :  <?php echo $row_shop['fax'];?>
    <div style="position:absolute;right:-120px; top:20px;">
    	<?php include("content/".$template."/alexa.php");?>
    </div>
    <div class="lienhe">
    
     <?php echo $row_shop['detail'];?>
    
    </div>
    
</div><!-- End .info_f2 -->