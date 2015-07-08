<?php
$activeLink = $_SERVER['REQUEST_URI'];
$myActiveLink = explode("?", $activeLink);
$myLinkData = explode("=", $myActiveLink[1]);
$myActiveKey = $myLinkData[1];
?>

<script>
    $(document).ready(function () {
        $('#divConfirm').html('<img src="../imgs/load.gif"><p>Đang xử lý, xin vui lòng chờ...</p>');
        lightbox_open('lightConfirm', 'fadeConfirm');
        window.setTimeout(function () {
            var activeKey = "<?php echo $myActiveKey; ?>";
            var dataString = "activeKey="+activeKey+"&functionName="+"updateCustomerActive";
            $.ajax({
                type: "POST",
                url: "lib/functions.php",
                data: dataString,
                success: function(x){
                    if(x == 1){
                        $('#divConfirm').html('<menu><li class="success">Nhập thông tin</li><li class="success">Hệ thống kiểm tra</li><li class="success">Xác thực</li></menu>');
                        $('#divConfirm').append('<p>Xin chúc mừng bạn đã kích hoạt tài khoản thành công!</p>');
                        $('#divConfirm').append('<p>Hệ thống đang chuyển về trang chủ. Nếu hệ thống không tự chuyển, xin vui lòng bấm vào liên kết bên dưới.</p>');
                        $('.pCloseConfirm').html("Trở về trang chủ");
                        $('.pCloseConfirm').attr('onclick','window.location.href="<?php echo $root; ?>"');
                        $('.pCloseConfirm').show();
                        window.setTimeout(function () {
                            location.href = "<?php echo $root; ?>";
                        }, 10000)
                    }
                    else{
                        window.setTimeout(function () {
                            location.href = "<?php echo $root; ?>/dang-nhap.html";
                        }, 2000)
                    }
                }
            });
        }, 2000)
    });
</script>