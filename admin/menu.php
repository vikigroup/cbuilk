<script type="text/javascript" charset="utf-8" src="../lib/dropdown/js/dropdown.js"></script>
<link rel="stylesheet" type="text/css" href="../lib/dropdown/style.css" />
<div id="wrapper">
        <ul id="nav">
            <li><a href="../index.php" target="_blank">Trang chủ</a></li>
            <?php if($_SESSION['kt_login_id']!=""){?>
            <li>
                <a href="#"> Gian hàng &darr;</a>
                <ul>
                    <li><a href="admin.php?act=shop">Danh sách gian hàng</a></li>
                    <li><a href="admin.php?act=item_category">Danh mục sản phẩm</a></li>
                    <li><a href="admin.php?act=template">Giao diện</a></li>
                    <li><a href="admin.php?act=advuser">Quảng cáo</a></li>
                    <li><a href="admin.php?act=slideruser">Slider</a></li>
                    <li><a href="admin.php?act=hotrouser">Hỗ trợ</a></li>
 					<li><a href="admin.php?act=videouser">Video</a></li>

                </ul>
            </li>
            <li>
                <a href="#"> Quản lý website &darr;</a>
                <ul>
                    <li><a href="admin.php?act=shop_category">Tất cả danh mục</a> </li>
                    <li><a href="admin.php?act=config&id=2">Cấu hình</a>  </li>
                    <li><a href="admin.php?act=slider">Slide ảnh</a> </li> 
                    <li><a href="admin.php?act=viki_infomation">Thông tin</a> </li>
                    <li><a href="admin.php?act=hotro">Hỗ trợ</a> </li> 
                    <li><a href="admin.php?act=adv">Quảng cáo</a> </li>
                    <li><a href="#"> Người dùng &darr;</a>
                        <ul>
                            <li><a href="admin.php?act=user">Thành viên</a> </li>
                            <li><a href="admin.php?act=customer">Khách hàng</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#"> Sản phẩm &darr;</a>
                <ul>
                    <li><a href="admin.php?act=product_category">Danh mục sản phẩm</a> </li>
                    <li><a href="admin.php?act=product">Tất cả sản phẩm</a></li>
                    <li><a href="admin.php?act=product_m">Tạo sản phẩm mới</a></li>
                </ul>
            </li>
            <li>
                <a href="#"> Máy cũ &darr;</a>
                <ul>
                    <li><a href="admin.php?act=machine_category">Danh mục máy cũ</a> </li>
                    <li><a href="admin.php?act=machine">Tất cả máy cũ</a></li>
                    <li><a href="admin.php?act=machine_m">Tạo máy cũ</a></li>
                </ul>
            </li>
            <li>
                <a href="admin.php?act=service">Dịch vụ &darr;</a>
                <ul>
                    <li><a href="admin.php?act=service_category">Danh mục dịch vụ</a> </li>
                    <li><a href="admin.php?act=service">Tất cả dịch vụ</a></li>
                    <li><a href="admin.php?act=service_m">Tạo dịch vụ mới</a></li>
                </ul>
            </li>
            <li>
                <a href="#"> Tin tức &darr;</a>
                <ul>
                    <li><a href="admin.php?act=news_category">Danh mục tin tức</a> </li>
                    <li><a href="admin.php?act=news">Tất cả tin tức</a></li>
                    <li><a href="admin.php?act=news_m">Tạo tin tức mới</a></li>
                </ul>
            </li>
            <li>
                <a href="#"> Video &darr;</a>
                <ul>
                    <li><a href="admin.php?act=video_category">Danh mục video</a> </li>
                    <li><a href="admin.php?act=video">Tất cả video</a></li>
                    <li><a href="admin.php?act=video_m">Tạo video mới</a></li>
                </ul>
            </li>
            <li>
                <a href="#"> Quảng cáo &darr;</a>
                <ul>
                    <li><a href="admin.php?act=advertisement_category">Danh mục quảng cáo</a> </li>
                    <li><a href="admin.php?act=advertisement">Tất cả quảng cáo</a></li>
                    <li><a href="admin.php?act=advertisement_m">Tạo quảng cáo mới</a></li>
                </ul>
            </li>
            <?php }?>
      </ul>
</div>