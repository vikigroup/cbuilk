<?php
error_reporting(E_ALL ^ E_NOTICE);
require("../config.php");
require("../common_start.php");
require("../lib/func.lib.php"); 

$idtem = $_GET['idtem'];
settype($idtem,"int");

if($idtem > 0){
	$tem = getRecord('tbl_template', "id='".$idtem."'");
	echo '<img src="'.$root.'/'.$tem['image'].'" alt="'.$tem['name'].'"/>';
}else{
    echo '<img src="'.$linkrootshop.'/imgs/layout/add-shop.png" alt="Đăng ký gian hàng"/>';
}

require("../common_end.php");
?>