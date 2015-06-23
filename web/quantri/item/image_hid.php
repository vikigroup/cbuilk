<?php
	require("../../../config.php");
	require("../../../common_start.php");
	include("../../../lib/func.lib.php");
	//require("check_login.php");
	
	$id=$_GET['idimage']; 
	settype($id,"int");
	
	
	if ($id<=0) die ("-1");
	
	$sql="SELECT * FROM tbl_ad WHERE id='{$id}'";
	$rs = mysql_query($sql) or die(mysql_error());
	$row_rs=mysql_fetch_row($rs);
	$hot=$row_rs[0]; 

	$sql="UPDATE tbl_ad SET iditem='' WHERE id='{$id}'";
	mysql_query($sql) or die(mysql_error());
	
	echo '<script>window.location="'.$_SERVER['HTTP_REFERER'].'"</script>';
?>