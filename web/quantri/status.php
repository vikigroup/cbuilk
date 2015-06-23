<?php
	require("../../config.php");
	require("../../common_start.php");
	include("../../lib/func.lib.php");
	//require("check_login.php");
	
	$id=$_GET['id']; 
	settype($id,"int");
	
	$table=$_GET['table']; 
	
	if ($id<=0) die ("-1");
	if ($table=="") die ("-1");
	
	$sql="SELECT status FROM $table WHERE id='{$id}'";
	$rs = mysql_query($sql) or die(mysql_error());
	$row_rs=mysql_fetch_row($rs);
	$anhien=$row_rs[0]; 

	if ($anhien==1) $anhien=0; 	else $anhien=1; 

	$sql="UPDATE $table SET status='{$anhien}' WHERE id='{$id}'";
	mysql_query($sql) or die(mysql_error());
	echo "imgs/layout/anhien_{$anhien}.png";	
?>