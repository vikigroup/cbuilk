<?php
	ob_start();
	session_start(); 
	
	require_once("../../../config.php");
	require_once("../../../common_start.php");
	require_once("../../../lib/func.lib.php");
	require_once("../../domain.php");
	
	$id=$_GET['idtin'];
	settype($id,"int");
	$pri=1;
	
	$tm=$url;  
	$template="temp".$tm;


	//settype($idSP,"int");
	
	$a="select * from tbl_item where id=".$id;
	$a1=mysql_query($a);
	$a2=mysql_fetch_array($a1);
	$idSP=$id;
	
    $price=$a2['price'];;
     
	 //echo print_r($_SESSION['dayidsp']);
	 if($id>0){
	    $_SESSION['tongso']-=$_SESSION['daySoluong'][$idSP];
		unset($_SESSION['dayidsp'][$idSP]);
		unset($_SESSION['daySoluong'][$idSP]);
		unset($_SESSION['dayMaSP'][$idSP]);
		unset($_SESSION['dayDongia'][$idSP]);
		unset($_SESSION['dayurlsp'][$idSP]);	 
		unset($_SESSION['dayloaisp'][$idSP]);	
		session_unregister($_SESSION['dayidsp'][$idSP]); 
		session_unregister($_SESSION['daySoluong'][$idSP]); 
		session_unregister($_SESSION['dayMaSP'][$idSP]); 
		session_unregister($_SESSION['dayDongia'][$idSP]); 
		session_unregister($_SESSION['dayurlsp'][$idSP]); 
		session_unregister($_SESSION['dayloaisp'][$idSP]); 
	 }

	if($_SESSION['tongso'][$idSP]<1){
		unset($_SESSION['dayid'][$idSP]);
		unset($_SESSION['daySoluong'][$idSP]);
		unset($_SESSION['dayMaSP'][$idSP]);
		unset($_SESSION['dayDongia'][$idSP]);
		unset($_SESSION['dayurl'][$idSP]);
		unset($_SESSION['tongso'][$idSP]);
	}
	
	if($_SESSION['tongso']<1){
		unset($_SESSION['dayid']);
		unset($_SESSION['daySoluong']);
		unset($_SESSION['dayMaSP']);
		unset($_SESSION['dayDongia']);
		unset($_SESSION['dayurl']);
		unset($_SESSION['tongso']);
	}

	echo ' 
			<p>
			<img src="skin/temp'.$url.'/imgs/layout/icon_card.png" alt=""/>
			</p>
			<p><a href="xem-gio-hang" title="">Hiện tại có ['.$_SESSION['tongso'].'] sản phẩm</a></p>
        	';
?>