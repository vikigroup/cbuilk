<div id="footer_w">
    <div class="main_fw">
        
        <div class="info_fw">
            Copyright © <?php echo $row_shop['name'];?>. All rights reserved. Design by cbuilk.com<br />
            Địa chỉ : <?php echo $row_shop['address'];?><br />
            Email : <?php echo $row_shop['email'];?><br />
            ĐT : <?php echo $row_shop['telephone'];?>- FAX: <?php echo $row_shop['fax'];?> - Hotline : <?php echo $row_shop['hotline'];?>
            
            <a class="logo_footer_w" href="" title=""></a>
            
            <?php include("content/".$template."/alexa.php");?>
            
            <div class="lienhe">
			<?php echo $row_shop['detail'];?>
            </div>
            
        </div><!-- End .info_fw -->
    
    </div><!-- End .main_fw -->
</div><!-- End #footer_w -->