<?php
$noimgs = "imgs/no_image.gif";
switch ($frame){
	case "shop_category"                : include("shop_category/shop_category.php");break;
	case "shop_category_m"              : include("shop_category/shop_category_m.php");break;

    case "product_category"             : include("product_category/product_category.php");break;
    case "product_category_m"           : include("product_category/product_category_m.php");break;

    case "video_category"               : include("video_category/video_category.php");break;
    case "video_category_m"             : include("video_category/video_category_m.php");break;

    case "advertisement_category"       : include("advertisement_category/advertisement_category.php");break;
    case "advertisement_category_m"     : include("advertisement_category/advertisement_category_m.php");break;

    case "machine_category"             : include("machine_category/machine_category.php");break;
    case "machine_category_m"           : include("machine_category/machine_category_m.php");break;

	case "shop"                         : include("shop/shop.php");break;
	case "shop_m"                       : include("shop/shop_m.php");break;
	
	case "template"                     : include("template/template.php");break;
	case "template_m"                   : include("template/template_m.php");break;
	
	case "user"                         : include("user/user.php");break;
	case "user_m"                       : include("user/user_m.php");break;
	case "user_permiss"                 : include("user/user_permiss.php");break;

	case "customer"                     : include("customer/customer.php");break;
	case "customer_m"                   : include("customer/customer_m.php");break;
	
	case "hotro"         	            : include("hotro/hotro.php");break;
	case "hotro_m"       	            : include("hotro/hotro_m.php");break;
	
	case "slider"                       : include("slider/slider.php");break;
	case "slider_m"                     : include("slider/slider_m.php");break;
 
	case "item"                         : include("item/item.php");break;
	case "item_m"                       : include("item/item_m.php");break;
    case "itemsaleoff"                  : include("item/itemsaleoff.php");break;
	
	case "hotro"                        : include("hotro/hotro.php");break;
	case "hotro_m"                      : include("hotro/hotro_m.php");break;
	
	case "config"                       : include("config/config.php");break;
	 
	case "viki_infomation"              : include("viki_infomation/viki_infomation.php");break;
	case "viki_infomation_m"            : include("viki_infomation/viki_infomation_m.php");break;

    case "jbsnews"                      : include("jbsnews/jbsnews.php");break;
    case "jbsnews_m"                    : include("jbsnews/jbsnews_m.php");break;

	case "adv"                          : include("adv/adv.php");break;
	case "adv_m"                        : include("adv/adv_m.php");break;
	
	case "comment"                      : include("comment/comment.php");break;
	case "comment_m"                    : include("comment/comment_m.php");break;
	
	case "quanhuyen_category"           : include("quanhuyen_category/quanhuyen_category.php");break;
	case "quanhuyen_category_m"         : include("quanhuyen_category/quanhuyen_category_m.php");break;
	
	case "quanhuyen"                    : include("quanhuyen/quanhuyen.php");break;
	case "quanhuyen_m"                  : include("quanhuyen/quanhuyen_m.php");break;
	
	case "item_category"                : include("item_category/item_category.php");break;
	case "item_category_m"              : include("item_category/item_category_m.php");break;

    case "news_category"                : include("news_category/news_category.php");break;
    case "news_category_m"              : include("news_category/news_category_m.php");break;

    case "service"                      : include("service/service.php");break;
    case "service_m"                    : include("service/service_m.php");break;

    case "service_category"             : include("service_category/service_category.php");break;
    case "service_category_m"           : include("service_category/service_category_m.php");break;

    case "advuser"                      : include("advuser/advuser.php");break;
	case "advuser_m"                    : include("advuser/advuser_m.php");break;
 
 	case "slideruser"                   : include("slideruser/slideruser.php");break;
	case "slideruser_m"                 : include("slideruser/slideruser_m.php");break;
		
	case "hotrouser"                    : include("hotrouser/hotrouser.php");break;
	case "hotrouser_m"                  : include("hotrouser/hotrouser_m.php");break;
	
	case "news"                         : include("news/news.php");break;
	case "news_m"                       : include("news/news_m.php");break;
	
	case "product"                      : include("product/product.php");break;
	case "product_m"                    : include("product/product_m.php");break;

	case "video"                        : include("video/video.php");break;
	case "video_m"                      : include("video/video_m.php");break;

    case "advertisement"                : include("advertisement/advertisement.php");break;
    case "advertisement_m"              : include("advertisement/advertisement_m.php");break;

    case "machine"                      : include("machine/machine.php");break;
    case "machine_m"                    : include("machine/machine_m.php");break;

	case "login"                        : include("login.php");break;
	case "logout"                       : unset($_SESSION['kt_login_id']);
                                          unset($_SESSION['kt_login_username']);
                                          unset($_SESSION['kt_login_level']);
                                          echo "<script>window.location='admin.php'</script>";
                                          break;
		
	//----------------------------------------------------------------------------------------------
	
	case "home"                         : include("home.php");break;
	default                             : include("home.php");break;
}
?>