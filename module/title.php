<?php
	$row_title_lap=getRecord('tbl_config', "id=2");
	if($_GET['act']=="search"){
		$title_t=$_GET['keyword'].' - '.$row_title_lap['title'];
		$description_t=$row_title_lap['description'];
		$keywords_t=$row_title_lap['keywords'];
	}
	elseif($_GET['act']=='products' && $_GET['danhmuc']){
		$danhmuc=$_GET['danhmuc'];
		
		$row_rs_tit=getRecord('tbl_shop_category', "subject='".$danhmuc."'");
		
		$title_t    =$row_rs_tit['title']!='' ? $row_rs_tit['title'] : $row_rs_tit['name'];
	    $description_t=$row_rs_tit['description']!='' ? $row_rs_tit['description'] : $row_rs_tit['name'];
		$keywords_t =$row_rs_tit['keyword']!='' ? $row_rs_tit['keyword'] : $row_rs_tit['keyword'];
	}
	elseif($_GET['act']=='product_detail' && $_GET['tensanpham']){
		$tensanpham=$_GET['tensanpham'];

		$row_rs_tit=$row_rs_tit=getRecord('tbl_item', "subject='".$tensanpham."'");
		
		if($row_rs_tit['id']=="") $row_rs_tit=$row_rs_tit=getRecord('tbl_shop_category', "subject='".$tensanpham."'");
		
		$title_t    =$row_rs_tit['title']!='' ? $row_rs_tit['title'] : $row_rs_tit['name'];
	    $description_t=$row_rs_tit['description']!='' ? $row_rs_tit['description'] : $row_rs_tit['name'];
		$keywords_t =$row_rs_tit['keyword']!='' ? $row_rs_tit['keyword'] : $row_rs_tit['keyword'];
	}
	elseif($_GET['act']=='service_detail' && $_GET['tendichvu']){
		$tendichvu=$_GET['tendichvu'];

		$row_rs_tit=$row_rs_tit=getRecord('tbl_item', "subject='".$tendichvu."'");
		
		$title_t    =$row_rs_tit['title']!='' ? $row_rs_tit['title'] : $row_rs_tit['name'];
	    $description_t=$row_rs_tit['description']!='' ? $row_rs_tit['description'] : $row_rs_tit['name'];
		$keywords_t =$row_rs_tit['keyword']!='' ? $row_rs_tit['keyword'] : $row_rs_tit['keyword'];
	}	
	elseif($_GET['act']=='news'){
		$title_t      ="Thông báo";
	    $description_t=$row_title_lap['description'];
		$keywords_t   =$row_title_lap['keywords'];
	}
	elseif($_GET['act']=='new_detail'){ 
		$tenthongtin=$_GET['tenthongtin'];

		$row_rs_tit=$row_rs_tit=getRecord('tbl_news', "subject='".$tenthongtin."'");
		
		$title_t    =$row_rs_tit['title']!='' ? $row_rs_tit['title'] : $row_rs_tit['name'];
	    $description_t=$row_rs_tit['description']!='' ? $row_rs_tit['description'] : $row_rs_tit['name'];
		$keywords_t =$row_rs_tit['keyword']!='' ? $row_rs_tit['keyword'] : $row_rs_tit['keyword'];
	}
	elseif($_GET['act']=='info_detail'){ 
		$tenthongtin=$_GET['tenthongtin'];

		$row_rs_tit=$row_rs_tit=getRecord('jbs_tin', "subject='".$tenthongtin."'");
		
		$title_t    =$row_rs_tit['title']!='' ? $row_rs_tit['title'] : $row_rs_tit['name'];
	    $description_t=$row_rs_tit['description']!='' ? $row_rs_tit['description'] : $row_rs_tit['name'];
		$keywords_t =$row_rs_tit['keyword']!='' ? $row_rs_tit['keyword'] : $row_rs_tit['keyword'];
	}
	elseif($_GET['act']=='detail'){
		switch($_GET['idtin']){
			case 1 :  $title_t    ="Quy định".' - '.$row_title_lap['title'];;break;
			case 2 :  $title_t    ="Hướng dẫn".' - '.$row_title_lap['title'];;break;
			case 3 :  $title_t    ="Bảng giá".' - '.$row_title_lap['title'];;break;
		}
	    $description_t=$row_title_lap['description'];
		$keywords_t =$row_title_lap['keywords'];	
	}
	elseif($_GET['act']=='contact'){
		$title_t    ="Liên hệ".' - '.$row_title_lap['title'];;
	    $description_t=$row_title_lap['description'];
		$keywords_t =$row_title_lap['keywords'];	
	}
	elseif($_GET['act']=='register'){
		$title_t    ="Đăng kí".' - '.$row_title_lap['title'];;
	    $description_t=$row_title_lap['description'];
		$keywords_t =$row_title_lap['keywords'];	
	}
	elseif($_GET['act']=='login'){
		$title_t    ="Đăng nhập".' - '.$row_title_lap['title'];;
	    $description_t=$row_title_lap['description'];
		$keywords_t =$row_title_lap['keywords'];	
	}
	elseif($_GET['act']=='page404'){
		$title_t    ="Lỗi không tìm thấy".' - '.$row_title_lap['title'];;
	    $description_t=$row_title_lap['description'];
		$keywords_t =$row_title_lap['keywords'];	
	}
	elseif($_GET['act']=='userquantritin'){
		$title_t    ="Quản trị tin đăng".' - '.$row_title_lap['title'];;
	    $description_t=$row_title_lap['description'];
		$keywords_t =$row_title_lap['keywords'];	
	}
	else{
		$title_t=$row_title_lap['title'];
		$description_t=$row_title_lap['description'];
		$keywords_t=$row_title_lap['keywords'];	
	}
?>
<title><?php echo $title_t ;?></title>
    <meta name="description" content="<?php echo $description_t ;?>" />
    <meta name="keywords" content="<?php echo $keywords_t ;?>" />
    <meta name="WT.ti" content="<?php echo $title_t ;?>" />
