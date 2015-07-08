<div class="container">
<div class="row" style="margin-top: 20%; margin-bottom: 20%;">
    <div class="col-lg-3 col-xs-12"></div>
    <div class="col-lg-6 col-xs-12" style="border: 1px solid #F36F00">
        <div class="row" style="background-color: orange; font-weight: bolder; font-size: 20px; padding: 10px; color: white; text-align: center"><span style="padding: 20px">XÁC NHẬN</span></div>
        <div class="row">
            <p style="text-align: center; color: darkgreen; font-weight: bold">Xin chúc mừng bạn đã kích hoạt tài khoản thành công!</p>
        </div>
        <div class="row">
            <p style="text-align: center; color: darkgreen; font-style: italic">Hệ thống đang chuyển về trang chủ. Nếu hệ thống không tự chuyển, xin vui lòng bấm vào liên kết bên dưới.</p>
        </div>
        <div class="row" style="text-align: center">
            <span style="padding: 10px; width: 500px; background-color: darkorange; color: white; font-size: 18px; cursor: pointer; margin: 20px" onclick="window.location.href = '<?php echo base_url() ?>'">Trở về trang chủ</span>
        </div>
    </div>
    <div class="col-lg-3 col-xs-12"></div>
</div>
</div>

<script>
    $(document).ready(function () {
        window.setTimeout(function () {
            location.href = "<?php echo base_url() ?>";
        }, 10000)
    });
</script>