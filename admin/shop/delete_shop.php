<?php
	//xoa shop
	require("../../config.php");

	require("../../common_start.php");

	include("../../lib/func.lib.php");

	check_permiss($_SESSION['kt_login_id'],2,'index.php');

	

	$id=$_GET['id']; 

	settype($id,"int");

	if ($id<=0) die ("-1");
	
	$idshop=$id;
	
	$row_shop=getRecord("tbl_shop","id='".$idshop."'");
	
	
	//xoa quang cao
    $gt=get_records("tbl_ad","idshop='{$idshop}'"," "," "," ");
	
	while($row_ad=mysql_fetch_assoc($gt)){
		@$result = mysql_query("delete from tbl_ad where id='".$row_ad['id']."'",$conn);
		if ($result){
			if(file_exists('../../web/'.$row_ad['hinh'])) @unlink('../../web/'.$row_ad['hinh']);
			$errMsg = "Đã xóa thành công.";
		}else $errMsg = "Không thể xóa dữ liệu !";

	}
	
	
	//xoa don hang
	
	$gt=get_records("tbl_donhang","idshop='{$idshop}'"," "," "," ");
	
	while($row_ad=mysql_fetch_assoc($gt)){
		@$result = mysql_query("delete from tbl_donhangchitiet` where idDH='".$row_ad['id']."'",$conn);
	}
	
	@$result = mysql_query("delete from tbl_donhang where idshop='".$idshop."'",$conn);
	
	
	//xoa tin tuc
    $gt=get_records("tbl_news_category","idshop='{$idshop}'"," "," "," ");
	
	while($row_ad=mysql_fetch_assoc($gt)){
		$gt1=get_records("tbl_news","parent='".$row_ad['id']."'"," "," "," ");
		while($row_ad1=mysql_fetch_assoc($gt1)){
			@$result = mysql_query("delete from tbl_news where id='".$row_ad1['id']."'",$conn);
			if ($result){
				if(file_exists('../../web/'.$row_ad1['image'])) @unlink('../../web/'.$row_ad1['image']);
				if(file_exists('../../web/'.$row_ad1['image_large'])) @unlink('../../web/'.$row_ad1['image_large']);
				$errMsg = "Đã xóa thành công.";
			}else $errMsg = "Không thể xóa dữ liệu !";
		}
	}
	
	@$result = mysql_query("delete from tbl_news_category where idshop='".$idshop."'",$conn);
	
	@$result = mysql_query("delete from tbl_info_category where idshop='".$idshop."'",$conn);
	
	
	//xoa san pham
    $gt=get_records("tbl_item_category","idshop='{$idshop}'"," "," "," ");
	
	while($row_ad=mysql_fetch_assoc($gt)){
		$gt1=get_records("tbl_item","parent='".$row_ad['id']."'"," "," "," ");
		while($row_ad1=mysql_fetch_assoc($gt1)){
			@$result = mysql_query("delete from tbl_item where id='".$row_ad1['id']."'",$conn);
			if ($result){
				if(file_exists('../../web/'.$row_ad1['image'])) @unlink('../../web/'.$row_ad1['image']);
				if(file_exists('../../web/'.$row_ad1['image_large'])) @unlink('../../web/'.$row_ad1['image_large']);
				$errMsg = "Đã xóa thành công.";
			}else $errMsg = "Không thể xóa dữ liệu !";
		}
	}
	
	@$result = mysql_query("delete from tbl_item_category where idshop='".$idshop."'",$conn);
	
	
	
	
	
	
	//xoa du lieu pass
	@$result = mysql_query("delete from tbl_pass_randomkey where idshop='".$idshop."'",$conn);
	
	//xoa seo
	@$result = mysql_query("delete from tbl_seo where idshop='".$idshop."'",$conn);
	
	//xoa module
	@$result = mysql_query("delete from  tbl_module where idshop='".$idshop."'",$conn);
	
 
	//xoa ho tro cua shop
	@$result = mysql_query("delete from  tbl_support where idshop='".$idshop."'",$conn);
	
	
	//xoa slider
    $gt=get_records("tbl_slider","idshop='{$idshop}'"," "," "," ");
	
	while($row_ad=mysql_fetch_assoc($gt)){
		@$result = mysql_query("delete from tbl_slider where id='".$row_ad['id']."'",$conn);
		if ($result){
			if(file_exists('../../web/'.$row_ad['image'])) @unlink('../../web/'.$row_ad['image']);
			$errMsg = "Đã xóa thành công.";
		}else $errMsg = "Không thể xóa dữ liệu !";

	}
	
	//xoa video
    $gt=get_records("tbl_video","idshop='{$idshop}'"," "," "," ");
	
	while($row_ad=mysql_fetch_assoc($gt)){
		@$result = mysql_query("delete from tbl_video where id='".$row_ad['id']."'",$conn);
		if ($result){
			if(file_exists('../../web/'.$row_ad['image'])) @unlink('../../web/'.$row_ad['image']);
			$errMsg = "Đã xóa thành công.";
		}else $errMsg = "Không thể xóa dữ liệu !";
	
	}
	
	//xoa shop
	
	$r = getRecord("tbl_shop","id=".$idshop);
	
	if(file_exists('../../web/'.$r['logo'])) @unlink('../../web/'.$r['logo']);
	
	if(file_exists('../../web/'.$r['banner'])) @unlink('../../web/'.$r['banner']);
	
	if(file_exists('../../web/'.$r['icon'])) @unlink('../../web/'.$r['icon']);
	
	@$result = mysql_query("delete from tbl_shop where id='".$idshop."'",$conn);
	
	//@$result = mysql_query("delete from tbl_customer where id='".$row_shop['iduser']."'",$conn);
	

	echo  thongbao($root."/admin/admin.php?act=shop",$thongbao='Bạn đã thực hiện thành công..!');
	


	
		

?>