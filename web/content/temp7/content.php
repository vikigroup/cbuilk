
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
<div id="wrapper">

     <?php include("content/".$template."/banner.php");?>
    
    <div id="container">
    
        <?php include("content/".$template."/menu_main.php");?>
        
        <?php if($frame=="" || $frame=="home"){?>
        <div class="frame_top">
        
            <?php include("content/".$template."/slider.php");?>
            
            <?php include("content/".$template."/box_intro.php");?>
            
            <div class="clear"></div>
        </div><!-- End .frame_top -->
        <?php }?>
        
        <div class="frame_cnt">
        
           <?php include("content/".$template."/processFrame.php");?> 
            
            <div class="slidebar">
                
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
					
					$j=1;
                    foreach($b as $key => $var){
						if($j>$i) include("content/".$template."/".$key.".php");
						else $j++;
                    }
                }else{
                    $listmodule=get_field("tbl_template","id",$row_shop['idtemplate'],"listname");
                    $listmodule=explode(",", $listmodule);
					$tmm=1;
                    foreach($listmodule as $key => $var){
                        include("content/".$template."/".$var.".php");
						//if($tmm==3) break;
						//else $tmm++;
						$tmm++;
                    }
                }
                ?>  
                
                
            </div><!-- End .slidebar -->
            
            <div class="clear"></div>
        
        </div><!-- End .frame_cnt -->
        
        <?php include("content/".$template."/box_doitac.php");?>  
        
    </div><!-- End #container -->
    
    <div id="footer">
    
        <div class="main_f">
        
            <?php include("content/".$template."/menu_footer.php");?>  
            
            <div class="clear"></div>
            
        </div><!-- End .main_f -->
        
        <?php include("content/".$template."/footer.php");?> 
        
    </div><!-- End #footer -->
    
</div>

<?php if($seo['button']==1)include("content/".$template."/box_social.php");?> 

<?php include("content/".$template."/ad_scroll.php");?> 