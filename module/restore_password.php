<script>
    $(document).ready(function () {
        $('#divConfirm').html('<img src="../imgs/load.gif"><p>Đang xử lý, xin vui lòng chờ...</p>');
        lightbox_open('lightConfirm', 'fadeConfirm');
        window.setTimeout(function () {
            var restoreKey = "<?php echo $myActiveKey; ?>";
            var dataString = "restoreKey="+restoreKey+"&functionName="+"checkRestorePassWord";
            $.ajax({
                type: "POST",
                url: "lib/functions.php",
                data: dataString,
                success: function(x){
                    if(x == 0){
                        window.setTimeout(function () {
                            location.href = "<?php echo $root; ?>/dang-nhap.html";
                        }, 2000)
                    }
                    else{
                        openChangePassWordPopup();
                        $("#divConfirm").prepend('<input type="hidden" id="hiddenCustomerRestoreEmail" value='+x+'>');
                        $("#divConfirm").prepend('<input type="hidden" id="hiddenRestorePassWord" value="1">');
                    }
                }
            });
        }, 2000)
    });
</script>