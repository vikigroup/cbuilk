<?php  
	//ob_start('ob_gzhandler');
	ob_start();


$hostname     = "localhost";

$databasename = "cpcmart_1811";

$username     = "cpcmart_1811";

$password     = "x8WfTuXwh";



$visitorTimeout = 900; //=15 * 60

$ngay = date("Y-m-d H:i:s");
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
$linkroot=$linkrootshop."/web";


$noimgs="images/noimage.png";

$root     ="http://cpcmart.com";
$sub      ="cpcmart.com";
$subname  ="cpcmart";


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