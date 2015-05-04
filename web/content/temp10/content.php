
<?php // tạo thư viện từ khóa
if(get_field("tbl_module","idshop",$idshop,"id")!="") {
	$mang1=get_field("tbl_module","idshop",$idshop,"list_title_module");
	$mang2=get_field("tbl_module","idshop",$idshop,"title_module1");
	if($mang1==""){
		$mang1=get_field("tbl_template","id",$row_shop['idtemplate'],"list_title_module");
		$mang2=get_field("tbl_template","id",$row_shop['idtemplate'],"title_module1");
	}
}else{
	$mang1=get_field("tbl_template","id",$row_shop['idtemplate'],"list_title_module");
	$mang2=get_field("tbl_template","id",$row_shop['idtemplate'],"title_module1");
}

$mang11=explode(",", $mang1);
$mang22=explode(",", $mang2);



function module_keyword($a,$b,$x){
	foreach($a as $key => $var){
		if($var==$x) return $b[$key];
	}
}
?>
<div id="wrapper_main">

    <div id="top_wrap">
        
        <div class="main_tw">
        
            <a class="logo" href="<?php echo $linkroot ;?>/<?php echo $shop;?>" title=""> 
            	<img src="<?php echo $linkroot ;?>/<?php echo $row_shop['logo'];?>" />
            </a>
            
            <?php include("content/".$template."/menu_main.php");?>
            
            <div class="hotline">
               <?php echo module_keyword($mang11,$mang22,"hotline");?>: <span><?php echo $row_shop['hotline'];?> </span>
            </div><!-- End .hotline -->
            
            
             <div class="box_shop_2">
               <a href="xem-gio-hang">  Có  (<?php if(isset($_SESSION['tongso'])) echo $_SESSION['tongso'];else echo "0";?>) sản phẩm trong giỏ hàng </a> 
            </div><!-- End .hotline -->
            
            <?php include("content/".$template."/box_search.php");?>
            
        </div><!-- End .main_tw -->
        
    </div><!-- End #top_wrap -->
    
    <div id="main_warp">
    
        <?php include("content/".$template."/slider.php");?>
        
        <div class="container">
        
            <div class="left_ct">
                
             	<?php //include("content/".$template."/menu_left.php");?> 
                
                <?php 
                if(get_field("tbl_module","idshop",$idshop,"id")!="") {
                    $b=get_field("tbl_module","idshop",$idshop,"boxarray");
                    $left=get_field("tbl_module","idshop",$idshop,"countleft");
                    $b=unserialize($b);
                    //print_r($b);
                    $i=0;
                    foreach($b as $key => $var){
                        if($i==$left || $left==0) break;
                        else $i++;
                        include("content/".$template."/".$key.".php");
                    }
                }else{
                    $listmodule=get_field("tbl_template","id",$row_shop['idtemplate'],"listname");
                    $listmodule=explode(",", $listmodule);
					$tmm=1;
                    foreach($listmodule as $key => $var){
                        include("content/".$template."/".$var.".php");
						if($tmm==3) break;
						else $tmm++;
                    }
                }
                ?>  
                                                        
            </div><!-- End .left_ct -->
            
                
            <?php include("content/".$template."/processFrame.php");?> 
                
            
            <div class="right_ct">                
                
               <?php //include("content/".$template."/box_ad.php");?>  
               <?php //include("content/".$template."/box_news.php");?>
               
               <?php 
				if(get_field("tbl_module","idshop",$idshop,"id")!="") { 
					$j=1;
					foreach($b as $key => $var){
						if($j>$i) include("content/".$template."/".$key.".php");
						else $j++;
					}
				}else{
					foreach($listmodule as $key => $var){
						include("content/".$template."/".$var.".php");
					}
				}
				?>   
                                    
            </div><!-- End .right_ct -->
            
            <div class="clear"></div>
        
        </div><!-- End .container -->
    
    </div><!-- End #main_warp -->
    
    <?php include("content/".$template."/footer.php");?> 

</div>
<?php if($seo['button']==1)include("content/".$template."/box_social.php");?> 

<?php include("content/".$template."/ad_scroll.php");?> 