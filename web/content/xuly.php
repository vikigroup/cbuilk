<?php
	require("../../config.php");
	require("../../common_start.php");
	include("../../lib/func.lib.php");
	require("../domain.php");
	

	if($_POST['keyword']==true){
		if($_POST['keyword']=="Nhập từ khóa tìm kiếm!") $tukhoa="tat-ca";else $tukhoa=$_POST['keyword'];
		$back=$linkroot.'/tu-khoa-tim/'.$tukhoa.".html";
		header("location: $back"); 
	}else{
		header("location: $host_link_full");
	}

?>