<div class="content">
    <div class="frame_nd">
    
        <h1 class="title_fnd">
           Liên hệ
        </h1><!-- End .title_fnd -->
        
        <div class="main_fnd">
        
            <div style="padding:10px;">
            
                <div>
                    <br><?php echo  $row_shop['name'] ?> <br />
                    Địa chỉ: <?php echo  $row_shop['address'] ?> <br />
                    Điện thoại: <?php echo  $row_shop['telephone'] ?> - Hotline: <?php echo  $row_shop['hotline'] ?><br />
                    Email: <?php echo  $row_shop['email'] ?> <br /> 
                </div>
                <?php include("content/".$template."/mail_gmail/mail.php");?>
             

        	</div>
        
            <div class="clear2"></div>
        
        </div><!-- End .main_fnd -->
        
        
        <!-- End .main_frame_text -->
    
    </div>
</div>