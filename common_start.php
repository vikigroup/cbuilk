<?php
	$conn = @mysql_connect($hostname, $username, $password) or 
	die("Can't connect to database");
	mysql_select_db($databasename);
	
	mysql_query("set names 'utf8'");

//----------------------------------------------------------------------------------------------

//----------------------------------------------------------------------------------------------

if($_POST['set_language'] == 'true'){
	if(!isset($_SESSION['LANGUAGE']) || $_SESSION['LANGUAGE'] == NULL){
		session_register('LANGUAGE');
		$_SESSION['LANGUAGE'] = $_POST['LANGUAGE'];
	}else{
		$_SESSION['LANGUAGE'] = $_POST['LANGUAGE'];
	}
}else{
	if(!isset($_SESSION['LANGUAGE']) || $_SESSION['LANGUAGE'] == NULL){
		session_register('LANGUAGE');
		$_SESSION['LANGUAGE'] = 1;
	}
}
if($_SESSION['LANGUAGE']>0){
	include("lib/lang".$_SESSION['LANGUAGE'].".php");
}

if($_SESSION['LANGUAGE']==1) $_lang="vn";
else $_lang = "en";

$frame=$_REQUEST['act'];

//----------------------------------------------------------------------------------------------

//$_lang="vn";

$activeLink = $_SERVER['REQUEST_URI'];
$myActiveLink = explode("?", $activeLink);
$myLinkData = explode("=", $myActiveLink[1]);
$myActiveKey = $myLinkData[1];
?>