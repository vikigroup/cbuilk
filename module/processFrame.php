<?php 
switch ($frame){
	
	case "products"                : include("module/products.php");;break;
	case "xemtatca"                : include("module/xemtatca.php");;break;
	case "search"                  : include("module/search.php");;break;
	
	case "info_detail"             : include("module/info_detail.php");;break;
	case "product_detail"          : include("module/product_detail.php");;break;
	case "service_detail"          : include("module/service_detail.php");;break;
	case "new_detail"              : include("module/new_detail.php");;break;
	
	case "register"                : include("module/register.php");;break;
	case "registersuccess"         : include("module/registersuccess.php");;break;
	case "login"                   : include("module/login.php");;break;
	case "changepass"              : include("module/changepass.php");;break;
	case "changeinfo"              : include("module/changeinfo.php");;break;
	case "forgetpass"              : include("module/forgetpass.php");;break;
	case "getpass"                 : include("module/getpass.php");;break;
	
	case "addshop"                 : include("module/addshop.php");;break;
	case "page404"                 : include("module/page404.php");;break;
	
	case "logout"              	   : 
									{
									unset($_SESSION['kh_login_username']);
									unset($_SESSION['kh_login_id']);
									header("location: $linkrootshop");
									};break;

    case "viewcart"                : include("module/cart.php");;break;
    case "cart"                    : include("module/order.php");;break;

//    case "add_item"                : include("module/addcart.php");break;

    default                        : include("module/home.php");;break;
}
?>