<?php
	ob_start();
	session_start(); 
	
	require_once("../../../config.php");
	require_once("../../../common_start.php");
	require_once("../../../lib/func.lib.php");
	require_once("../../domain.php");
		
	$id=$_GET['idtin'];
	$sl=$_GET['sl'];

	$a="select * from tbl_item where id=".$id;
	$a1=mysql_query($a);
	$a2=mysql_fetch_array($a1);
	$idSP=$id;
	
    $price=$a2['price'];;

	$idgd=$idshop;


	if (isset($_SESSION['dayidsp'])==false) {$_SESSION['dayidsp']=array();}
	if (isset($_SESSION['daySoluong'])==false) {$_SESSION['daySoluong']=array();}
	if (isset($_SESSION['dayDongia'])==false) {$_SESSION['dayDongia']=array();}
	if (isset($_SESSION['dayMaSP'])==false) {$_SESSION['dayMaSP']=array();}
	if (isset($_SESSION['dayurlsp'])==false) {$_SESSION['dayurlsp']=array();}
	if (isset($_SESSION['dayloaisp'])==false) {$_SESSION['dayloaisp']=array();}
	if (isset($_SESSION['tongso'])==false) {$_SESSION['tongso']=0;}
	
	$soluong=(isset($_GET['sl'])==true)?$sl:1;

	if ($id>0){
		if ($_GET['update']==1) {$_SESSION['tongso']=$_SESSION['tongso']-$_SESSION['daySoluong'][$idSP]+$soluong;$_SESSION['daySoluong'][$idSP]=$soluong;}
		else { 
			if($_SESSION['daySoluong'][$idSP]!="")  {
			$_SESSION['daySoluong'][$idSP]+=$soluong;
			$_SESSION['tongso']+=$soluong;
				$_SESSION['dayidsp'][$idSP]=$id;
				$_SESSION['dayMaSP'][$idSP]=$a2['name'];
				$_SESSION['dayDongia'][$idSP]=$a2['price'];
				$_SESSION['dayurlsp'][$idSP]=$a2['image'];
				$_SESSION['dayloaisp'][$idSP]=$pri;
			} else {
				$_SESSION['daySoluong'][$idSP]+=$soluong;$_SESSION['tongso']+=$soluong;
				$_SESSION['dayidsp'][$idSP]="";
				$_SESSION['dayMaSP'][$idSP]="";
				$_SESSION['dayDongia'][$idSP]="";
				$_SESSION['dayurlsp'][$idSP]="";
				$_SESSION['dayloaisp'][$idSP]="";
				
				$_SESSION['dayidsp'][$idSP]=$id;
				$_SESSION['dayMaSP'][$idSP]=$a2['name'];
				$_SESSION['dayDongia'][$idSP]=$price;
				$_SESSION['dayurlsp'][$idSP]=$a2['image'];
				$_SESSION['dayloaisp'][$idSP]=$pri;
			}
		}
		
		
			if($_SESSION['daySoluong'][$idSP]==0 || $soluong==0){
			    $_SESSION['tongso']-=$_SESSION['daySoluong'][$idSP];
				unset($_SESSION['dayidsp'][$idSP]);
				unset($_SESSION['daySoluong'][$idSP]);
				unset($_SESSION['dayMaSP'][$idSP]);
				unset($_SESSION['dayDongia'][$idSP]);
				unset($_SESSION['dayurlsp'][$idSP]);
				unset($_SESSION['dayloaisp'][$idSP]);
		    }
	}
	
	 echo ' 
            <a href="xem-gio-hang">  Có '.$_SESSION['tongso'].' sản phẩm trong giỏ hàng </a>
        	'
?>