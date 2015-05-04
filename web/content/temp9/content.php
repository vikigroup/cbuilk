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
<div id="wrapper_mau_gh"> 
	 <div id="header_mau_gh">
    	<?php include("content/".$template."/banner.php");?>
        <?php include("content/".$template."/menu_main.php");?>
    </div><!-- End #header_mau_gh -->
    
    <div id="content_mau_gh"> 
        <div class="left_c_mau_gh">
        
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
            
                                 
        </div><!-- End .left_c_mau_gh -->
         
        <div class="center_c_mau_gh">
        
        	<?php include("content/".$template."/processFrame.php");?>              
                        
        </div><!-- End .center_c_mau_gh -->
    
    </div>
    
    <div class="clear"> </div>
    
    <div id="footer_mau_gh">
        <?php 
            include("content/".$template."/menu_footer.php");
        ?>
        <?php include("content/".$template."/footer.php");?> 
    </div><!-- End #footer_mau_gh -->
    
</div>

<?php if($seo['button']==1)include("content/".$template."/box_social.php");?> 

<?php include("content/".$template."/ad_scroll.php");?> 