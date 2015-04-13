<?php
define("AREA", "module");
error_reporting(E_ALL ^ E_NOTICE);
require("../config.php");
require("../common_start.php");
require("../lib/func.lib.php"); 


$idtem=$_GET['idtem'];
settype($idtem,"int");

if($idtem>0){
	$tem=getRecord('tbl_template', "id='".$idtem."'");
	echo '
	<center>
		<img  width="346" src="'.$root.'/'.$tem['image'].'" alt=""/>
	</center>
	';
}else echo '
	<center>
		<img  width="346" src="'.$linkrootshop.'imgs/layout/RegistrationOnline.jpg" alt=""/>
	</center>';
	


require("../common_end.php");
?>