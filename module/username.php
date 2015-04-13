<?php
	require("../config.php");
	require("../common_start.php");
	include("../lib/func.lib.php");
?>
<?php
	$user=$_GET['user'];
	
	if(get_field("tbl_customer","username",$user,"id")!="") echo '<img width="15" height="15" src="'.$linkrootshop.'imgs/notok.png">';
	else echo '<img src="'.$linkrootshop.'imgs/ok.png" width="15" height="15" >';

?>