<?php
	require("../config.php");
	require("../common_start.php");
	include("../lib/func.lib.php");
	
	$linkroot = $root; $_POST['keyword'];
	
	if($_POST['keyword'] == true){
		$tukhoa = $_POST['keyword'];
		$loai = $_POST['loai'];
		$_SESSION['kt_tukhoa'] = $_POST['keyword'];
		$back = $linkrootshop.'/tim-kiem/'.$loai.'/'.$tukhoa.'.html';
		header("location: $back");
	}else{
		header("location: $linkrootshop");
	}
?>