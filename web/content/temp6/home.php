<div class="content_w">
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
</div>