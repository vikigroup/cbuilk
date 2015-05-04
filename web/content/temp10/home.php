<div class="center_ct">
	<?php //include("content/".$template."/product_best.php");?>
    
    <?php //include("content/".$template."/product_new.php");?>
    
    <?php //include("content/".$template."/good_product.php");?>
    
    <?php 
	if(get_field("tbl_module","idshop",$idshop,"id")!="") {
		$m=get_field("tbl_module","idshop",$idshop,"modulearray");
		$m=unserialize($m);
		//print_r($b);
		foreach($m as $key => $var){
			include("content/".$template."/".$key.".php");
		}
	}else{
		$listmodule=get_field("tbl_template","id",$row_shop['idtemplate'],"listmodule");
		$listmodule=explode(",", $listmodule);
		foreach($listmodule as $key => $var){
			include("content/".$template."/".$var.".php");
		}
	}
	?>
    
    
    <div class="clear2"></div>

</div><!-- End .center_ct -->