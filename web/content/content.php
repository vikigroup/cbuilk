<div id="wrapper_main">

    <div id="f_wrapper">
    
        <div id="header_w">
        
            <div class="main_header_w">
            
                <div class="top_mhw">
                    
                    <?php include("content/".$template."/box_hotline.php");?>
                    
                    <?php include("content/".$template."/box_support.php");?>
                    
                    <div class="clear"></div>
                
                </div><!-- End .top_mhw -->
                
                <div class="banner_w">
                
                    <?php include("content/".$template."/banner.php");?>
                    
                    <?php include("content/".$template."/menu_main.php");?>
                    
                    <?php include("content/".$template."/box_search.php");?>
                
                </div><!-- End .banner_w -->
                
            </div><!-- End .main_header_w -->
            
        </div><!-- End #header_w -->
        
        <div id="container_w">
        	<?php if($frame=="" || $frame=="home") include("content/".$template."/slider.php");?>
        	
            <div class="slidebar_w">
            
                <?php include("content/".$template."/menu_left.php");?>
                
                <?php include("content/".$template."/box_cart.php");?>
                
                <?php include("content/".$template."/box_ad.php");?>
                
            </div><!-- End .slidebar_w -->
            
            <?php include("content/".$template."/processFrame.php");?>
            
            <div class="clear"></div>
            
        
        </div><!-- End #container_w -->            
        
        <?php include("content/".$template."/footer.php");?>
        
    </div><!-- End #f_wrapper -->

</div>