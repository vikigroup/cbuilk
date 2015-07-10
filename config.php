<?php
ob_start();
date_default_timezone_set('Asia/Ho_Chi_Minh');
$ngay = date("Y-m-d H:i:s");
require("database.php");

$visitorTimeout = 900; //=15 * 60
$MAXPAGE = 30;
$multiLanguage = 1;//0 : single  ;  1 : multi
$arrLanguage = array(
	array('vn','Việt Nam'),
	array('en','English')
);

$root_file='';
$linkroot='http://'.$_SERVER['HTTP_HOST'];
$linkroot=$linkroot.$root_file;

$linkrootshop=$linkroot;
$shophomepage = $linkrootshop;
$linkroot=$linkrootshop."/web";


$noimgs="images/noimage.png";

require("website.php");

ini_set('suhosin.session.cryptdocroot', 0);

if(strpos($_SERVER['HTTP_HOST'],$sub) !== false) {
 	 $a=$sub;
}

if($a==$sub){
	ini_set('session.cookie_domain', '.'.$sub);
	session_set_cookie_params (0, '/','.'.$sub);

}else{
	ini_set('session.cookie_domain', '.'.$_SERVER['HTTP_HOST']);
	session_set_cookie_params (0, '/', '.'.$_SERVER['HTTP_HOST']);
}

session_start();
session_name('kh_login_id');
session_name('kh_login_username');
session_name('online');
session_name('dayidsp');
session_name('daySoluong');
session_name('dayDongia');
session_name('dayMaSP');
session_name('dayurlsp');
session_name('dayloaisp');
session_name('tongso');
session_name('captcha_code');
session_name('kt_login_id');
session_name('kt_login_username');
session_name('kt_login_level');
session_name('kt_thanhpho');

?>
