<div id="footer_warp" style="position: relative;">
    Copyright 2012 © <?php echo $row_shop['name'];?> . All rights reserved. Design by <a href="http://jbs.vn" title="">JSS.vn</a><br />
    Địa chỉ : <?php echo $row_shop['address'];?><br />
    Email : <?php echo $row_shop['email'];?><br />
    ĐT :  <?php echo $row_shop['mobile'];?> - Hotline : <?php echo $row_shop['holine'];?> 
    
    <?php include("content/".$template."/alexa.php");?>
    
    <div class="lienhe">
    <?php echo $row_shop['detail'];?>
    </div>
    
</div><!-- End #footer_warp -->