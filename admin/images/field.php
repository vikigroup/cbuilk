<?php
	require("../config.php");
	require("../common_start.php");
	include("../lib/func.lib.php");
	//require("check_login.php");
	
	$id=$_GET['id']; 
	settype($id,"int");
	
	$table=$_GET['table']; 
	
	$type=$_GET['type']; 
	settype($type,"int");
	
	if ($id<=0) die ("-1");
	if ($table=="") die ("-1");
	if ($type=="") die ("-1");
	
	if($type==1){
		//an hien
	}elseif($type==2){
		//hot
	}
	elseif($type==3){
		//up tin 
		mysql_query($sql) or die(mysql_error());
		echo "images/anhien_1.png";	
		
	}
 
?>