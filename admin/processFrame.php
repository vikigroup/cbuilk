<?php
$noimgs = "imgs/no_image.gif";
switch ($frame){
	
	//  shop category
	case "shop_category"    : include("shop_category/shop_category.php");break;
	case "shop_category_m"  : include("shop_category/shop_category_m.php");break;

    // product category
    case "product_category"    : include("product_category/product_category.php");break;
    case "product_category_m"  : include("product_category/product_category_m.php");break;

    // video category
    case "video_category"    : include("video_category/video_category.php");break;
    case "video_category_m"  : include("video_category/video_category_m.php");break;

	//  shop
	case "shop"             : include("shop/shop.php");break;
	case "shop_m"           : include("shop/shop_m.php");break;
	
	//  template
	case "template"         : include("template/template.php");break;
	case "template_m"       : include("template/template_m.php");break;
	
	//  user
	case "user"             : include("user/user.php");break;
	case "user_m"           : include("user/user_m.php");break;
	case "user_permiss"     : include("user/user_permiss.php");break;
	
	
	//  customer
	case "customer"         : include("customer/customer.php");break;
	case "customer_m"       : include("customer/customer_m.php");break;
	
	//  support
	case "hotro"         	: include("hotro/hotro.php");break;
	case "hotro_m"       	: include("hotro/hotro_m.php");break;
	
	//  slider
	case "slider"           : include("slider/slider.php");break;
	case "slider_m"         : include("slider/slider_m.php");break;
 
	// item
	case "item"             : include("item/item.php");break;
	case "item_m"           : include("item/item_m.php");break;
    case "itemsaleoff"      : include("item/itemsaleoff.php");break;
	
	//support
	case "hotro"             : include("hotro/hotro.php");break;
	case "hotro_m"           : include("hotro/hotro_m.php");break;
	
	//config
	case "config"           : include("config/config.php");break;
	
 
	 
	//info page
	case "jbstin"             : include("jbstin/jbstin.php");break;
	case "jbstin_m"           : include("jbstin/jbstin_m.php");break;

    case "jbsnews"             : include("jbsnews/jbsnews.php");break;
    case "jbsnews_m"           : include("jbsnews/jbsnews_m.php");break;

	//adv
	case "adv"             : include("adv/adv.php");break;
	case "adv_m"           : include("adv/adv_m.php");break;
	
	case "comment"              : include("comment/comment.php");break;
	case "comment_m"            : include("comment/comment_m.php");break;
	
	case "quanhuyen_category"   : include("quanhuyen_category/quanhuyen_category.php");break;
	case "quanhuyen_category_m" : include("quanhuyen_category/quanhuyen_category_m.php");break;
	
	case "quanhuyen"            : include("quanhuyen/quanhuyen.php");break;
	case "quanhuyen_m"          : include("quanhuyen/quanhuyen_m.php");break;
	
	// category of user
	case "item_category"        : include("item_category/item_category.php");break;
	case "item_category_m"      : include("item_category/item_category_m.php");break;
    case "news_category"        : include("news_category/news_category.php");break;
    case "news_category_m"      : include("news_category/news_category_m.php");break;

    case "service"              : include("service/service.php");break;
    case "service_m"            : include("service/service_m.php");break;
    case "service_category"     : include("service_category/service_category.php");break;
    case "service_category_m"   : include("service_category/service_category_m.php");break;

    case "advuser"              : include("advuser/advuser.php");break;
	case "advuser_m"            : include("advuser/advuser_m.php");break;
 
 	case "slideruser"           : include("slideruser/slideruser.php");break;
	case "slideruser_m"         : include("slideruser/slideruser_m.php");break;
		
	case "hotrouser"            : include("hotrouser/hotrouser.php");break;
	case "hotrouser_m"          : include("hotrouser/hotrouser_m.php");break;
	
	case "newuser"              : include("newuser/newuser.php");break;
	case "newuser_m"            : include("newuser/newuser_m.php");break;
	
	case "itemuser"             : include("itemuser/itemuser.php");break;
	case "itemuser_m"           : include("itemuser/itemuser_m.php");break;
	
	case "videouser"            : include("videouser/videouser.php");break;
	case "videouser_m"          : include("videouser/videouser_m.php");break;
		
	case "login"          : include("login.php");break;
	case "logout" :
		unset($_SESSION['kt_login_id']);
		unset($_SESSION['kt_login_username']);
		unset($_SESSION['kt_login_level']);
		echo "<script>window.location='admin.php'</script>";
		break;
		
	//----------------------------------------------------------------------------------------------
	
	case "home"          : include("home.php");break;
	default              : include("home.php");break;
}
?>