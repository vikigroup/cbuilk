<?php
//kiểm tra quyền truy cập
if(isset($frame) == true){
    check_permiss($_SESSION['kt_login_id'], 30, 'admin.php');
    $myPermission = getRecord('tbl_crud', "id_users='".$_SESSION['kt_login_id']."' AND id_permiss=30");
    $permissionList = get_field('tbl_users','id', $_SESSION['kt_login_id'], 'list');
}else{
    header("location: ../admin.php");
}

//tìm kiếm
if(isset($_POST['tim']) == true){ //isset kiem tra submit
    if($_POST['tukhoa'] != ""){$tukhoa = $_POST['tukhoa'];} else{$tukhoa = -1;}
    if($tukhoa == "Từ khóa...") $tukhoa = "";
    $_SESSION['kt_tukhoa_bignew'] = $tukhoa;
    $tukhoa = trim(strip_tags($tukhoa));
    if(get_magic_quotes_gpc() == false){
        $tukhoa = mysql_real_escape_string($tukhoa);
    }

    if($_POST['ddCat'] != NULL){$parent = $_POST['ddCat'];} else{$parent = -1;}
    $_SESSION['kt_parent_bignew'] = $parent;

    if($_POST['ddCatch'] != NULL){$parent1 = $_POST['ddCatch'];} else{$parent1 = -1;}
    $_SESSION['kt_ddCatch_bignew'] = $parent1;
}

//hiển thị tất cả
if(isset($_POST['reset']) == true){
    $_POST['ddCatch'] = -1;
    $_SESSION['kt_tukhoa_bignew'] = -1;
    $_SESSION['kt_parent_bignew'] = -1;
    $_SESSION['kt_ddCatch_bignew'] = -1;

}

//cài đặt tự chọn hiển thị dữ liệu
if($_SESSION['kt_tukhoa_bignew'] == NULL){$tukhoa = -1;}
if($_SESSION['kt_tukhoa_bignew'] != NULL){$tukhoa = $_SESSION['kt_tukhoa_bignew'];}
if($_SESSION['kt_parent_bignew'] == NULL){$parent = -1;}
if($_SESSION['kt_parent_bignew'] != NULL){$parent = $_SESSION['kt_parent_bignew'];}

if($_SESSION['kt_ddCatch_bignew'] == NULL){$parent1 = -1;}
if($_SESSION['kt_ddCatch_bignew'] != NULL){$parent1 = $_SESSION['kt_ddCatch_bignew'];}

if($_GET['anhien'] == NULL){$anhien = -1; $_SESSION['kt_anhien'] = $anhien;}
if($_GET['anhien'] != NULL){$anhien = $_GET['anhien']; $_SESSION['kt_anhien'] = $anhien;}
settype($anhien, "int");

if($_GET['tang'] == NULL){$tang = -1; $_SESSION['kt_tang'] = $tang;}
if($_GET['tang'] != NULL){$tang = $_GET['tang']; $_SESSION['kt_tang'] = $tang;}
settype($tang,"int");

if($_GET['noibat'] == NULL){$noibat = -1; $_SESSION['kt_noibat'] = $noibat;}
if($_GET['noibat'] != NULL){$noibat = $_GET['noibat']; $_SESSION['kt_noibat'] = $noibat;}
settype($noibat, "int");

if($tang == 0){$ks = 'DESC';}
else if($tang == 1){$ks = 'ASC';}
else $ks = 'DESC';

//đường dẫn tập tin hình ảnh mặc định
$noimgs = "imgs/no_images.png";

//cài đặt hiển thị dữ liệu
$pageSize = 10;
$pageNum = 1;
$totalRows = 0;

if (isset($_GET['pageNum']) == true) $pageNum = $_GET['pageNum'];

if ($pageNum <= 0) $pageNum = 1;

$startRow = ($pageNum - 1) * $pageSize;

if($parent != -1 || $parent1 != -1) {
    if($parent1 != '-1') $parenstrt = "$parent1";
    else $parenstrt = optimizeString(getParent("tbl_shop_category",$parent));
    $where = "1 = 1 and (id = '{$tukhoa}' or name LIKE '%$tukhoa%' or '{$tukhoa}' = -1) and  (parent1 in ({$parenstrt}) or parent in ({$parenstrt}) or id = $parent or id = $parent1)";
}
else $where = "1 = 1 and (id = '{$tukhoa}' or name LIKE '%$tukhoa%' or '{$tukhoa}' = -1)";

$where .= " AND ( status = '{$anhien}' or '{$anhien}' = -1)  AND ( hot = '{$noibat}' or '{$noibat}' = -1)";
$MAXPAGE = 1;
$totalRows = countRecord("tbl_item",$where);

if ($_REQUEST['cat'] != '') $where = "parent = ".$_REQUEST['cat'];

// xóa cụ thể
switch ($_GET['action']){
    case 'del' :
        $id = $_GET['id'];
        $r = getRecord("tbl_item","id=".$id);
        if(number_in_list($permissionList, 30)){
            if($myPermission == '' || ($myPermission != '' && $myPermission['isDelete'] == 1)){
                if($r['block'] == 0 || ($r['block'] == 1 && $_SESSION['kt_login_level'] == 3)){
                    $_SESSION['error'] = ''; //xóa session thông báo lỗi từ chối quyền truy cập
                    $resultParent = 0;
                    @$result = mysql_query("delete from tbl_item where id='".$id."'",$conn);

                    if ($result){
                        if(file_exists('../web/'.$r['image'])) @unlink('../web/'.$r['image']);
                        if(file_exists('../web/'.$r['image_large'])) @unlink('../web/'.$r['image_large']);
                        $status = 1;
                        $errMsg = 'Chúc mừng! Bạn đã xóa thành công.';
                    }else{
                        $status = 3;
                        $errMsg = 'Cảnh báo! Hệ thống không thể xóa dữ liệu! Xin vui lòng tải lại trang và thử lại.';
                    }
                    break;
                }
                else{
                    header("Location: ".$root.'/admin/admin.php?act=shop_post&deny=1');
                }
            }
            else{
                header("Location: ".$root.'/admin/admin.php?act=shop_post&deny=1');
            }
        }else{
            header("Location: ".$root.'/admin/admin.php?act=shop_post&deny=1');
        }
}

// xóa chọn
if (isset($_POST['btnDel'])){
    $cntDel = 0;
    $cntNotDel = 0;
    $myDeletedArr = array();
    $myUnDeletedArr = array();
    if($_POST['chk'] != ''){
        foreach ($_POST['chk'] as $id){
            $r = getRecord("tbl_item","id=".$id);
            if(number_in_list($permissionList, 30)){
                if($myPermission == '' || ($myPermission != '' && $myPermission['isDelete'] == 1)){
                    if($r['block'] == 0 || ($r['block'] == 1 && $_SESSION['kt_login_level'] == 3)){
                        $resultParent = 0;
                        @$result = mysql_query("delete from tbl_item where id='".$id."'",$conn);
                        if ($result){
                            if(file_exists('../web/'.$r['image'])) @unlink('../web/'.$r['image']);
                            if(file_exists('../web/'.$r['image_large'])) @unlink('../web/'.$r['image_large']);
                            $cntDel++;
                            array_push($myDeletedArr, $r['name']);
                        }else{
                            $cntNotDel++;
                            array_push($myUnDeletedArr, $r['name']);
                        }
                    }else{
                        $cntNotDel++;
                        array_push($myUnDeletedArr, $r['name']);
                        $deny = 1;
                    }
                }else{
                    $deny = 1;
                }
            }else{
                $deny = 1;
            }
        }

        $status = 2;
        $errMsg = "Hệ thống đã xóa ".$cntDel." bài viết: ".implode(', ', $myDeletedArr)."<br/>";
        $errMsg .= $cntNotDel > 0 ? "Không thể xóa ".$cntNotDel." bài viết: ".implode(', ', $myUnDeletedArr).".<br/>" : '';
        if($deny == 1){
            $errMsg .= "<b>(Tài khoản của bạn đã bị giới hạn quyền để xóa bài viết. Xin vui lòng liên hệ quản trị viên để biết thêm chi tiết.)</b>";
        }
    }else{
        $status = 0;
        $errMsg = 'Bạn chưa chọn bài viết cần xóa! Xin vui lòng chọn ít nhất một bài viết.';
    }
}
?>

<script>
$(document).ready(function() {
    $("img.anhien").click(function(){
        id = $(this).attr("value");
        obj = this;
        $.ajax({
            url:'status.php',
            data: 'id='+ id +'&table=tbl_item',
            cache: false,
            success: function(data){
                obj.src = data;
                if (data == "images/anhien_1.png") obj.title = "Nhắp vào để hiện";
                else obj.title = "Nhắp vào để ẩn";
            }
        });
    });

    $("img.hot").click(function(){
        id = $(this).attr("value");
        obj = this;
        $.ajax({
            url:'hot.php',
            data: 'id='+ id +'&table=tbl_item',
            cache: false,
            success: function(data){
                obj.src = data;
                if (data == "images/noibat_1.png") obj.title = "Nhấn vào để cài đặt về mặc định";
                else obj.title = "Nhấn vào để cài đặt là tin hot";
            }
        });
    });

    $("#chkall").click(function(){
        var status = this.checked;
        $("input[class='tai_c']").each(function(){this.checked = status;})
    });

    $("#btnDel").click(function(){
        var num = $('input[name="chk[]"]:checked').length;
        if(num == 0){
            alert("Bạn chưa chọn bài viết cần xóa! \nXin vui lòng chọn ít nhất một bài viết.");
            return false;
        }
        else{
            return confirm("Bạn chắc chắn muốn xóa?");
        }
    });

    var isDeny = "<?php echo $_GET['deny']; ?>";
    if(isDeny == 1){
        alert("Bài viết này hiện đang bị khóa. \nHoặc bạn không được cấp quyền để xóa hay chỉnh sửa. Xin vui lòng liên hệ quản trị viên để biết thêm chi tiết.");
    }

    $("#ddCat").change(function(){
        var id = $(this).val();
        var table = "tbl_shop_category";
        $("#ddCatch").load("getChild.php?table="+ table + "&id=" +id);
    });
});
</script>

<?php
if ($_REQUEST['code'] == 1) {
    $status = 1;
    $errMsg = 'Chúc mừng! Bạn đã thực hiện thành công.';
}
?>