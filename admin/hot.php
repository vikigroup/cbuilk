<?php
	require("../config.php");
	require("../common_start.php");
	include("../lib/func.lib.php");
	//require("check_login.php");
	
	$id=$_GET['id']; 
	settype($id,"int");
	
	$table=$_GET['table']; 
	
	if ($id<=0) die ("-1");
	if ($table=="") die ("-1");
	
	$sql="SELECT hot FROM $table WHERE id='{$id}'";
	$rs = mysql_query($sql) or die(mysql_error());
	$row_rs=mysql_fetch_row($rs);
	$hot=$row_rs[0]; 

	if ($hot==1) $hot=0;else $hot=1; 

	$sql="UPDATE $table SET hot='{$hot}' WHERE id='{$id}'";
	mysql_query($sql) or die(mysql_error());
	echo "images/noibat_{$hot}.png";	
?>