<script type="text/javascript" charset="utf-8" src="../lib/dropdown/js/dropdown.js"></script>
<link rel="stylesheet" type="text/css" href="../lib/dropdown/style.css" />
<div id="wrapper">
        <ul id="nav">
            <li><a href="../index.php" target="_blank">Trang chủ</a></li>
            <?php if($_SESSION['kt_login_id']!=""){?>
            <li>
                <a href="#"> Quản lý gian hàng &darr;</a>
                <ul>
                    <li><a href="#" onclick="emptySessionCategory('shop');">Tất cả gian hàng</a></li>
                    <li><a href="#" onclick="emptySessionCategory('item_category');">Tất cả danh mục</a></li>
                    <li><a href="#" onclick="emptySessionCategory('template');">Giao diện</a></li>
                    <li><a href="#" onclick="emptySessionCategory('advuser');">Quảng cáo</a></li>
                    <li><a href="#" onclick="emptySessionCategory('slideruser');">Slide ảnh</a></li>
                    <li><a href="#" onclick="emptySessionCategory('hotrouser');">Hỗ trợ</a></li>
 					<li><a href="#" onclick="emptySessionCategory('videouser');">Video</a></li>
                </ul>
            </li>
            <li>
                <a href="#"> Quản lý người dùng &darr;</a>
                <ul>
                    <li><a href="#" onclick="emptySessionCategory('user');">Thành viên</a></li>
                    <li><a href="#" onclick="emptySessionCategory('customer');">Khách hàng</a></li>
                </ul>
            </li>
            <li>
                <a href="#"> Quản lý website &darr;</a>
                <ul>
                    <li><a href="#" onclick="emptySessionCategory('shop_category');">Tất cả danh mục</a></li>
                    <li><a href="#" onclick="emptySessionCategory('shop_post');">Tất cả bài viết</a></li>
                    <li><a href="#" onclick="emptySessionCategory('config&id=2');">Cấu hình hệ thống</a></li>
                    <li><a href="#" onclick="emptySessionCategory('slider');">Slide ảnh</a></li>
                    <li><a href="#" onclick="emptySessionCategory('viki_infomation');">Thông tin</a></li>
                    <li><a href="#" onclick="emptySessionCategory('hotro');">Hỗ trợ</a></li>
                    <li><a href="#" onclick="emptySessionCategory('adv');">Quảng cáo</a></li>
                </ul>
            </li>
            <li>
                <a href="#"> Sản phẩm &darr;</a>
                <ul>
                    <li><a href="#" onclick="emptySessionCategory('product_category');">Danh mục sản phẩm</a></li>
                    <li><a href="#" onclick="emptySessionCategory('product');">Tất cả sản phẩm</a></li>
                    <li><a href="#" onclick="emptySessionCategory('product_m');">Tạo sản phẩm mới</a></li>
                </ul>
            </li>
            <li>
                <a href="#"> Máy cũ &darr;</a>
                <ul>
                    <li><a href="#" onclick="emptySessionCategory('machine_category');">Danh mục máy cũ</a></li>
                    <li><a href="#" onclick="emptySessionCategory('machine');">Tất cả máy cũ</a></li>
                    <li><a href="#" onclick="emptySessionCategory('machine_m');">Tạo máy cũ</a></li>
                </ul>
            </li>
            <li>
                <a href="#"> Dịch vụ &darr;</a>
                <ul>
                    <li><a href="#" onclick="emptySessionCategory('service_category');">Danh mục dịch vụ</a></li>
                    <li><a href="#" onclick="emptySessionCategory('service');">Tất cả dịch vụ</a></li>
                    <li><a href="#" onclick="emptySessionCategory('service_m');">Tạo dịch vụ mới</a></li>
                </ul>
            </li>
            <li>
                <a href="#"> Tin tức &darr;</a>
                <ul>
                    <li><a href="#" onclick="emptySessionCategory('news_category');">Danh mục tin tức</a></li>
                    <li><a href="#" onclick="emptySessionCategory('news');">Tất cả tin tức</a></li>
                    <li><a href="#" onclick="emptySessionCategory('news_m');">Tạo tin tức mới</a></li>
                </ul>
            </li>
            <li>
                <a href="#"> Video &darr;</a>
                <ul>
                    <li><a href="#" onclick="emptySessionCategory('video_category');">Danh mục video</a></li>
                    <li><a href="#" onclick="emptySessionCategory('video');">Tất cả video</a></li>
                    <li><a href="#" onclick="emptySessionCategory('video_m');">Tạo video mới</a></li>
                </ul>
            </li>
            <li>
                <a href="#"> Quảng cáo &darr;</a>
                <ul>
                    <li><a href="#" onclick="emptySessionCategory('advertisement_category');">Danh mục quảng cáo</a></li>
                    <li><a href="#" onclick="emptySessionCategory('advertisement');">Tất cả quảng cáo</a></li>
                    <li><a href="#" onclick="emptySessionCategory('advertisement_m');">Tạo quảng cáo mới</a></li>
                </ul>
            </li>
            <li>
                <a href="#"> Phụ tùng &darr;</a>
                <ul>
                    <li><a href="#" onclick="emptySessionCategory('accessory_category');">Danh mục phụ tùng</a></li>
                    <li><a href="#" onclick="emptySessionCategory('accessory');">Tất cả phụ tùng</a></li>
                    <li><a href="#" onclick="emptySessionCategory('accessory_m');">Tạo phụ tùng mới</a></li>
                </ul>
            </li>
            <?php }?>
      </ul>
</div>