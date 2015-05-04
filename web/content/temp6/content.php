
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
					}
				}
				?>  
                
            </div><!-- End .slidebar_w -->
            
            <?php include("content/".$template."/processFrame.php");?>
            
            <div class="clear"></div>
            
        
        </div><!-- End #container_w -->            
        
        <?php include("content/".$template."/footer.php");?>
        
    </div><!-- End #f_wrapper -->

</div>

<?php if($seo['button']==1)include("content/".$template."/box_social.php");?> 

<?php include("content/".$template."/ad_scroll.php");?> 