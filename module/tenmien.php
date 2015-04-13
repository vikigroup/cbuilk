<?php
	require("../config.php");
	require("../common_start.php");
	include("../lib/func.lib.php");
?>
<?php
	$tenmien=$_GET['tenmien'];
	
	if(get_field("tbl_shop","subject",$tenmien,"id")!="") echo '<img width="30" height="30" src="'.$linkrootshop.'/imgs/x.png">';
	else echo '<img src="'.$linkrootshop.'/imgs/check.png" width="30" height="30" >';

?>