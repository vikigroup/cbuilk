<?php
	require("../../config.php");
	require("../../common_start.php");
	include("../../lib/func.lib.php");
	//require("check_login.php");
	
	ob_flush(); flush();
	
	$idshop=$_GET['idshop'];
	$chuoi="";
	$hinh=get_records("tbl_ad","idshop='{$idshop}' AND name='' AND iditem=''","id DESC","0,19"," ");
	while($row_hinh=mysql_fetch_assoc($hinh)){
	
	$chuoi.='<li>
		<img src="../'.$row_hinh['image'].'" /> <br />
		<input name="chk[]" type="checkbox" value="" />
	</li>';
	}
	echo $chuoi;	
?>