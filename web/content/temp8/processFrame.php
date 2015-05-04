<?php   
switch ($frame){
	case "chuyenmuc"               : include("content/".$template."/chuyenmuc.php");break;
	case "chuyenmuc_detail"        : include("content/".$template."/chuyenmuc_detail.php");break;
	
	case "danhmuc"                 : include("content/".$template."/danhmuc.php");break;
	case "product_detail"          : include("content/".$template."/product_detail.php");;break;
	
	case "search"                  : include("content/".$template."/search.php");break;
	case "products"                : include("content/".$template."/products.php");break;
	case "home"                    : include("content/".$template."/home.php");break;
	case "order"                   : include("content/".$template."/order.php");break;
	case "page404"                 : include("content/".$template."/page404.php");break;
	case "viewcart"                : include("content/".$template."/viewcart.php");break;
	
	case "tag"                     : include("content/".$template."/tag.php");break;
	
	case "contact"                 : include("content/".$template."/contact.php");break;
	
	
	case "add_item"                : include("content/".$template."/adcart.php");break;
	
	default                        : include("content/".$template."/home.php");break;
	
}
?>