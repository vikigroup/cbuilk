<?php
	$row_title_lap=$row_shop;
	if($_GET['act']=="search"){
		$title_t=$_GET['keyword'].' - '.$row_title_lap['title'];
		$description_t=$row_title_lap['description'];
		$keywords_t=$row_title_lap['keywords'];
	}
	elseif($_GET['act']=='products' && $_GET['danhmuc']){
		$danhmuc=$_GET['danhmuc'];
		
		$row_rs_tit=getRecord('tbl_item_category', "subject='".$danhmuc."'");
		
		$title_t    =$row_rs_tit['title']!='' ? $row_rs_tit['title'] : $row_rs_tit['name'];
	    $description_t=$row_rs_tit['description']!='' ? $row_rs_tit['description'] : $row_rs_tit['name'];
		$keywords_t =$row_rs_tit['keyword']!='' ? $row_rs_tit['keyword'] : cat_kytu_dacbiet( $row_rs_tit['name'],1,1,0,0,1);;
	}
	elseif($_GET['act']=='chuyenmuc' && $_GET['chuyenmuc']){
		$chuyenmuc=$_GET['chuyenmuc'];
		
		$row_rs_tit=getRecord('tbl_news_category', "subject='".$chuyenmuc."'");
		
		$title_t    =$row_rs_tit['title']!='' ? $row_rs_tit['title'] : $row_rs_tit['name'];
	    $description_t=$row_rs_tit['description']!='' ? $row_rs_tit['description'] : $row_rs_tit['name'];
		$keywords_t =$row_rs_tit['keyword']!='' ? $row_rs_tit['keyword'] : cat_kytu_dacbiet( $row_rs_tit['name'],1,1,0,0,1);;
	}
	elseif($_GET['act']=='product_detail' && $_GET['tensanpham']){
		$tensanpham=$_GET['tensanpham'];

		$row_rs_tit=$row_rs_tit=getRecord('tbl_item', "subject='".$tensanpham."'");
		
		if($row_rs_tit['id']=="")  $row_rs_tit=$row_rs_tit=getRecord('tbl_item_category', "subject='".$tensanpham."'");
		
		$title_t    =$row_rs_tit['title']!='' ? $row_rs_tit['title'] : $row_rs_tit['name'];
	    $description_t=$row_rs_tit['description']!='' ? $row_rs_tit['description'] : catchuoi_tuybien(strip_tags($row_rs_tit['detail']),20);
		$keywords_t =$row_rs_tit['keyword']!='' ? $row_rs_tit['keyword'] : cat_kytu_dacbiet( $row_rs_tit['name'],1,1,0,0,1);
	}
	elseif($_GET['act']=='chuyenmuc_detail' && $_GET['tenchuyenmuc']){
		$tenchuyenmuc=$_GET['tenchuyenmuc'];

		$row_rs_tit=$row_rs_tit=getRecord('tbl_news', "subject='".$tenchuyenmuc."'");
		
		$title_t    =$row_rs_tit['title']!='' ? $row_rs_tit['title'] : $row_rs_tit['name'];
	    $description_t=$row_rs_tit['description']!='' ? $row_rs_tit['description'] : $row_rs_tit['detail_short'];
		$keywords_t =$row_rs_tit['keyword']!='' ? $row_rs_tit['keyword'] : cat_kytu_dacbiet( $row_rs_tit['name'],1,1,0,0,1);
	}
	elseif($_GET['act']=='service_detail' && $_GET['tendichvu']){
		$tendichvu=$_GET['tendichvu'];

		$row_rs_tit=$row_rs_tit=getRecord('tbl_item', "subject='".$tendichvu."'");
		
		$title_t    =$row_rs_tit['title']!='' ? $row_rs_tit['title'] : $row_rs_tit['name'];
	    $description_t=$row_rs_tit['description']!='' ? $row_rs_tit['description'] : $row_rs_tit['name'];
		$keywords_t =$row_rs_tit['keywords']!='' ? $row_rs_tit['keywords'] : $row_rs_tit['keyword'];
	}	
	elseif($_GET['act']=='news'){
		$title_t      ="Thông báo";
	    $description_t=$row_title_lap['description'];
		$keywords_t   =$row_title_lap['keywords'];
	}
	elseif($_GET['act']=='news_detail'){
		$tenmien=$_GET['thongbao']; 
		$rs_tit =lap_table('raovat_thongbao',"tenmien='$tenmien'",' ',' ',' ');
		$row_rs_tit=mysql_fetch_assoc($rs_tit);
		
		$title_t    =$row_rs_tit['title']!='' ? $row_rs_tit['title'] : $row_rs_tit['ten'];
	    $description_t=$row_rs_tit['description']!='' ? $row_rs_tit['description'] : $row_rs_tit['ten'];
		$keywords_t =$row_rs_tit['keywords']!='' ? $row_rs_tit['keywords'] : $row_rs_tit['tenkodau'];
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
	elseif($_GET['act']=='viewcart'){
		$title_t    ="Xem giỏ hàng".' - '.$row_title_lap['title'];;
	    $description_t=$row_title_lap['description'];
		$keywords_t =$row_title_lap['keywords'];	
	}
	elseif($_GET['act']=='order'){
		$title_t    ="Đặt hàng".' - '.$row_title_lap['title'];;
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
		$keywords_t=$row_title_lap['keyword'];	
	}
?>
<title><?php echo $title_t ;?></title>
<meta name="description" content="<?php echo $description_t ;?>" />
<meta name="keywords" content="<?php echo $keywords_t ;?>" />