<?php
	require("../config.php");
	require("../common_start.php");
	include("../lib/func.lib.php");
	
	$linkroot=$root; echo $_POST['keyword'];
	
	if($_POST['keyword']==true){
		//$tukhoa=xuly_kytu_db_timkiem($_POST['keyword'],1);
		$tukhoa=$_POST['keyword'];
		$loai=$_POST['loai'];
		$_SESSION['kt_tukhoa']=$_POST['keyword'];
		$back=$linkrootshop.'/tu-khoa-tim/'.$loai.'/'.str_replace(" ", "-", $tukhoa).'.html';
		header("location: $back");
	}else{
		header("location: $linkrootshop");
	}
	
?>