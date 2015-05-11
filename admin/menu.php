<script type="text/javascript" charset="utf-8" src="../lib/dropdown/js/dropdown.js"></script>
<link rel="stylesheet" type="text/css" href="../lib/dropdown/style.css" />
<div id="wrapper">
        <ul id="nav">
            <li><a href="../index.php" target="_blank">Trang chủ</a></li>
            
            <?php if($_SESSION['kt_login_id']!=""){?>
<!--            <li><a href="admin.php">Admin</a></li> -->
 
<!--            <li><a href="#">Shop &darr;</a>-->
<!--                <ul> -->

<!--                    <li>-->
<!--                    	<a href="admin.php?act=jbsnews_category"> Sản phẩm dịch vụ  &raquo;</a>-->
<!--                        <ul>-->
<!--                         -->
<!--                           <li><a href="admin.php?act=item">Sản phẩm</a></li>-->
<!--                        -->
<!--                         -->
<!--                        </ul> -->
<!--                    </li>-->
<!---->
<!--                </ul>-->
<!--            </li>-->
            
            <li><a href="#"> Quản lý Shop &darr;</a>
                <ul>
                    <li><a href="admin.php?act=shop">Danh sách shop</a></li>
                    <li><a href="admin.php?act=template">Giao diện</a></li>
                    <li><a href="admin.php?act=advuser">Quảng cáo</a></li>
                    <li><a href="admin.php?act=slideruser">Slider</a></li>
                    <li><a href="admin.php?act=hotrouser">Hỗ trợ</a></li>
 					<li><a href="admin.php?act=videouser">Video</a></li>

                </ul>
            </li>
         
                
            <li><a href="#"> Người dùng &darr;</a>
                <ul> 
                    <li><a href="admin.php?act=user">Thành viên</a> </li>
                    <li><a href="admin.php?act=customer">Khách hàng</a></li>
                </ul>
            </li>
            
            
                
            <li><a href="#"> Quản lý Trang chủ &darr;</a>
                <ul>
                    <li><a href="admin.php?act=shop_category">Danh mục shop</a> </li>
                    <li><a href="admin.php?act=itemuser">Sản phẩm</a></li>
                    <li><a href="admin.php?act=service">Dịch vụ</a></li>
                    <li><a href="admin.php?act=jbsnews">Tin tức</a></li>
                    <li><a href="admin.php?act=config&id=2">Cấu hình</a>  </li>
                    <li><a href="admin.php?act=slider">Slide ảnh</a> </li> 
                    <li><a href="admin.php?act=jbstin">Thông tin</a> </li> 
                    <li><a href="admin.php?act=hotro">Hỗ trợ</a> </li> 
                    <li><a href="admin.php?act=adv">Quảng cáo</a> </li>
                </ul>
            </li>
             
            
            <?php }?>
  
      </ul>
</div>