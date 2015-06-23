<?
switch ($frame){
	
	//  item cater
	case "item_category"    : include("item_category/item_category.php");break;
	case "item_category_m"  : include("item_category/item_category_m.php");break;
	
	//  item
	case "item"             : include("item/item.php");break;
	case "item_m"           : include("item/item_m.php");break;
	
	//  item
	case "news_category"    : include("news_category/news_category.php");break;
	case "news_category_m"  : include("news_category/news_category_m.php");break;
	
	//  shop
	case "news"             : include("news/news.php");break;
	case "news_m"           : include("news/news_m.php");break;
	
	//  shop
	case "adv"              : include("adv/adv.php");break;
	case "adv_m"            : include("adv/adv_m.php");break;
	
	//  shop
	case "slider"           : include("slider/slider.php");break;
	case "slider_m"         : include("slider/slider_m.php");break;
	
	
	//  shop
	case "support"          : include("support/support.php");break;
	case "support_m"        : include("support/support_m.php");break;
	
	//  shop
	case "video"            : include("video/video.php");break;
	case "video_m"          : include("video/video_m.php");break;
	
	//  link
	case "link"            : include("link/link.php");break;
	case "link_m"          : include("link/link_m.php");break;
	
	//  link
	case "download"        : include("download/download.php");break;
	case "download_m"      : include("download/download_m.php");break;
	
	
	//  user
	case "user"             : include("user/user.php");break;
	case "user_m"           : include("user/user_m.php");break;
	case "user_permiss"     : include("user/user_permiss.php");break;
	
	
	//  customer
	case "customer"         : include("customer/customer.php");break;
	case "customer_m"       : include("customer/customer_m.php");break;
	
	case "info"             : include("info.php");break;
	case "info_m"           : include("info_m.php");break;
	
	case "config_shop"      : include("config/config_shop.php");break;
	
	
	case "order"            : include("order/order.php");break;
	case "order_m"          : include("order/order_m.php");break;
	
	case "elementweb"       : include("elementweb.php");break;
	case "styleweb"         : include("styleweb.php");break;
	case "seoweb"           : include("seoweb.php");break;
	
	case "conauto"          : include("conauto.php");break;
	
	case "demo"             : include("demo.php");break;
	
	case "user_m"           : include("user/user_m.php");break;
	case "pass_m"           : include("user/pass_m.php");break;
	
	case "delelte_banner"       : include("delete_banner.php");break;
	case "delete_background"    : include("delete_background.php");break;
	
	case "forgetpass"       : include("forgetpass.php");break;
	case "getpass"          : include("getpass.php");break;
	
	case "title_module"     : include("title_module.php");break;
	
	case "login"            : include("login.php");break;
	case "logout"           :
		unset($_SESSION['kh_login_id']);
		unset($_SESSION['kh_login_username']);
		unset($_SESSION['cu_login_level']);
		echo "<script>window.location='".$host_link_full."'</script>";
		break;
		
	//----------------------------------------------------------------------------------------------
	
	case "home"            : include("home.php");break;
	default                : include("home.php");break;
}
?>