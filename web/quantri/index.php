<?php
	require("../../config.php");
	require("../../common_start.php");
	include("../../lib/func.lib.php");

	$host_link='http://'.$_SERVER['HTTP_HOST'];
	$array = explode(".", str_replace("http://", "", $host_link));
	$demi=count($array);
	$host_link_full=$host_link;

	$shop=$_GET['shop'];
	//if($shop=="") header("location: ".$linkrootshop); // vao theo dang gianhang/gianhang/
	//print_r($array);
	if($array[1]==$subname) {
	$row_shop=getRecord("tbl_shop","subject='".$array[0]."'");

	}elseif($array[1]!=$subname){
	//echo $array[0];
	$row_shop=getRecord("tbl_shop","domain='".$array[0].".".$array[1]."'");
	}
	$idshop=$row_shop['id'];
	$_SESSION['idshop']=$idshop;
	$idsuser_domain=$row_shop['iduser'];
	$loaishop=$row_shop['intro'];
	$idcity=$row_shop['idcity'];
	$url=get_field("tbl_template","id",$row_shop['idtemplate'],"url");

	if($idshop=="") header("location: ".$linkrootshop); // go sai ten gian hang

	//echo $_SERVER['REQUEST_URI'];

	$pos = strpos($_SERVER['REQUEST_URI'],"/web/");// bo chu n cu
	if($pos !== false) {
		//Tìm thấy
		$linkmoi=str_replace("/web/", "/",$_SERVER['REQUEST_URI']);
		header("location:".$linkmoi);
	}
	else {
		// Không tìm thấy
	}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<base href="<?php echo $host_link_full ; ?>/quantri/"  />
<title>Quản lý gian hàng</title>
<link rel="stylesheet" type="text/css" href="templates/css.css"/>
<script type="text/javascript" src="scripts/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="scripts/frame_script.js"></script>
<script type="text/javascript" src="scripts/same_height_columns.js"></script>
<script type="text/javascript" src="scripts/Fancy_File_Inputs.js"></script>
<script type="text/javascript" src="scripts/jquery-cookie.js"></script>
<script type="text/javascript" src="scripts/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="scripts/ckfinder/ckfinder.js"></script>

<!--[if lt IE 9]>
	<link rel="stylesheet" type="text/css" href="templates/FIX_IE.css" />
<![endif]-->
</head>
<body>
<?php if(isset($_SESSION['kh_login_username'])) {?>
	<div id="num_ad_wrap">

    	<div id="mask_num_ad_menu"></div>

    	<div id="num_ad_menu">

        	<?php include("menu_left.php");?>

            <?php include("box_up.php");?>

        </div><!-- End #num_ad_menu -->

        <div id="num_ad_content">

            <?php include("info_user.php");?>

            <div class="cont_body">

            	<?php include("processFrame.php");?>

            </div><!-- End .cont_body -->

        </div><!-- End #num_ad_content -->

        <?php include("footer.php");?>

        <div class="clear"></div>

        <div class="frm_clickSHmenu">
            <span class="clickSHmenu" title="Ẩn menu"></span>
            <span class="clickSHmenu2" title="Hiện menu" style="display:none;"></span>
        </div><!-- End .frm_clickSHmenu -->

    </div><!-- End #num_ad_wrap -->
<?php }else{?>
<?php
	if($frame=="forgetpass") include("forgetpass.php");
	elseif($frame=="getpass") include("getpass.php");
	else include("box_login.php");
?>
<?php }?>
</body>
</html>
<?php require("../../common_end.php");?>