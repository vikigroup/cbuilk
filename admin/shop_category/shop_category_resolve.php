<?php
//kiểm tra quyền truy cập
if(isset($frame) == true){
    check_permiss($_SESSION['kt_login_id'], 1, 'admin.php');
    $myPermission = getRecord('tbl_crud', "id_users='".$_SESSION['kt_login_id']."' AND id_permiss=1");
}else{
    header("location: ../admin.php");
}

//tìm kiếm
if(isset($_POST['tim']) == true){
    if($_POST['tukhoa'] != NULL && $_POST['tukhoa'] != 'Từ khóa...'){$tukhoa = $_POST['tukhoa'];} else{$tukhoa = -1;}
    $_SESSION['kt_tukhoa_bignew'] = $tukhoa;
    $tukhoa = trim(strip_tags($tukhoa));
    if (get_magic_quotes_gpc() == false){
        $tukhoa = mysql_real_escape_string($tukhoa);
    }
    if($_POST['ddCat'] != NULL){$parent = $_POST['ddCat'];} else{$parent = -1;}
    $_SESSION['kt_parent_bignew']=$parent;

    if($_POST['ddCatch'] != NULL){$parent1 = $_POST['ddCatch'];} else{$parent1 = -1;}
    $_SESSION['kt_ddCatch_bignew'] = $parent1;
}

//hiển thị tất cả
if(isset($_POST['reset']) == true){
    $_POST['ddCatch'] = -1;
    $_SESSION['kt_tukhoa_bignew'] = -1;
    $_SESSION['kt_parent_bignew'] = -1;
    $_SESSION['kt_ddCatch_bignew'] = -1;
    $errMsg = '';
    $_POST['tukhoa'] = NULL;
    header("Location: ".$root."/admin/admin.php?act=".$_GET['act']."&pageNum=1");
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
if($_GET['tang'] != NULL){$tang = $_GET['tang'];$_SESSION['kt_tang'] = $tang;}
settype($tang, "int");

if($_GET['noibat'] == NULL){$noibat = -1; $_SESSION['kt_noibat'] = $noibat;}
if($_GET['noibat'] != NULL){$noibat = $_GET['noibat']; $_SESSION['kt_noibat'] = $noibat;}
settype($noibat, "int");

if($tang == 0){$ks = 'DESC';}
else if($tang == 1){$ks = 'ASC';}
else $ks = 'DESC';

//đường dẫn tập tin hình ảnh mặc định
$noimgs = "imgs/no_image.gif";

//cài đặt hiển thị dữ liệu
$pageSize = 10;
$pageNum = 1;
$totalRows = 0;

if (isset($_GET['pageNum']) == true) $pageNum = $_GET['pageNum'];
if ($pageNum <= 0) $pageNum = 1;
$startRow = ($pageNum-1) * $pageSize;

if($parent != -1 || $parent1 != -1) {
    if($parent1 != '-1') $parentstrt = "$parent1";
    else $parentstrt = getParent("tbl_shop_category",$parent);
    $parentstrtAfter = optimizeString($parentstrt);
    if($parent1 != '-1'){
        $parentstrt = "$parent1";
        $subParentString = parentString($parent1);
    }

    if($subParentString != ''){
        $where = "1=1   and (id='{$tukhoa}' or name LIKE '%$tukhoa%' or '{$tukhoa}'=-1) and  (parent in ({$parentstrtAfter}) or id in ({$subParentString}) or id=$parent1 or id=$parent)";
    }
    else{
        $where = "1=1   and (id='{$tukhoa}' or name LIKE '%$tukhoa%' or '{$tukhoa}'=-1) and  (parent in ({$parentstrtAfter}) or id=$parent1 or id=$parent)";
    }
}
else $where = "1=1   and (id='{$tukhoa}' or name LIKE '%$tukhoa%' or '{$tukhoa}'=-1)";

$where .= " AND ( status='{$anhien}' or '{$anhien}'=-1)  AND ( hot='{$noibat}' or '{$noibat}'=-1) AND id != 1";

$MAXPAGE = 1;
$totalRows = countRecord("tbl_shop_category",$where);

if ($_REQUEST['cat'] != '') $where = "parent=".$_REQUEST['cat'];

// xóa cụ thể
switch($_GET['action']){
    case 'del' :
        $id = $_GET['id'];
        $myArr = array(209, 210, 211, 390, 457, 458, 500);
        if(!in_array($id, $myArr)){
            $r = getRecord("tbl_shop_category","id=".$id);
            $_SESSION['error'] = ''; //xóa session thông báo lỗi từ chối quyền truy cập
            $resultParent = mysql_query("select id from tbl_shop_category where parent='".$id."'",$conn);
            if (mysql_num_rows($resultParent) <= 0){
                @$result = mysql_query("delete from tbl_shop_category where id='".$id."'",$conn);
                if ($result){
                    if(file_exists('../'.$r['image'])) @unlink('../'.$r['image']);
                    if(file_exists('../'.$r['image_large'])) @unlink('../'.$r['image_large']);
                    $status = 1;
                    $errMsg = 'Chúc mừng! Bạn đã xóa thành công.';
                }else{
                    $status = 3;
                    $errMsg = 'Cảnh báo! Hệ thống không thể xóa dữ liệu! Xin vui lòng tải lại trang và thử lại.';
                }
            }else{
                $status = 3;
                $errMsg = 'Cảnh báo! Danh mục này hiện có danh mục con đang sử dụng! Xin vui lòng xóa danh mục con trước khi thực hiện xóa danh mục này.';
            }
            break;
        }
        else{
            $status = 0;
            $errMsg = 'Lỗi! Danh mục bạn đang xóa hiện là danh mục hệ thống nên thao tác này bị hủy!';
        }
}

// xóa chọn
if(isset($_POST['btnDel'])){
    $cntDel = 0;
    $cntNotDel = 0;
    $cntParentExist = 0;
    $myDeletedArr = array();
    $myUnDeletedArr = array();
    $mySubCatArr = array();
    if($_POST['chk'] != ''){
        foreach ($_POST['chk'] as $id){
            $r = getRecord("tbl_shop_category","id=".$id);
            $resultParent = mysql_query("select id from tbl_shop_category where parent='".$id."'",$conn);
            $categoryName = get_field('tbl_shop_category','id',$id,'name');
            if (mysql_num_rows($resultParent) <= 0){
                $result = mysql_query("delete from tbl_shop_category where id='".$id."'",$conn);
                if ($result){
                    if(file_exists('../'.$r['image'])) @unlink('../'.$r['image']);
                    if(file_exists('../'.$r['image_large'])) @unlink('../'.$r['image_large']);
                    $cntDel++;
                    array_push($myDeletedArr, $categoryName);
                }else{
                    $cntNotDel++;
                    array_push($myUnDeletedArr, $categoryName);
                }
            }else{
                $cntParentExist++;
                array_push($mySubCatArr, $categoryName);
            }
        }
        $status = 2;
        $errMsg = "Hệ thống đã xóa ".$cntDel." danh mục: ".implode(', ', $myDeletedArr)."<br/>";
        $errMsg .= $cntNotDel > 0 ? "Không thể xóa ".$cntNotDel." danh mục: ".implode(', ', $myUnDeletedArr).".<br/>" : '';
        $errMsg .= $cntParentExist > 0 ? "Bạn không thể xóa danh mục đang có danh mục con sử dụng. Gồm ".$cntParentExist." danh mục: ".implode(', ', $mySubCatArr) : '';
    }else{
        $status = 0;
        $errMsg = 'Bạn chưa chọn danh mục cần xóa! Xin vui lòng chọn ít nhất một danh mục.';
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
		    data: 'id='+ id +'&table=tbl_shop_category',
		    cache: false,
		    success: function(data){
                obj.src = data;
                if (data == "images/anhien_1.png") obj.title = "Nhấn vào để hiện";
                else obj.title = "Nhấn vào để ẩn";
		    }
		});
	});
	
	$("img.hot").click(function(){
	    id = $(this).attr("value");
	    obj = this;
		$.ajax({
            url:'hot.php',
		    data: 'id='+ id +'&table=tbl_shop_category',
		    cache: false,
		    success: function(data){
                obj.src = data;
                if (data == "images/noibat_1.png") obj.title = "Nhấn vào để cài đặt về mặc định";
                else obj.title = "Nhấn vào để cài đặt là danh mục tiêu biểu";
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
            alert("Bạn chưa chọn danh mục cần xóa! \nXin vui lòng chọn ít nhất một danh mục.");
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

<?php if ($_REQUEST['code'] == 1){
    $status = 1;
    $errMsg = 'Chúc mừng! Bạn đã thực hiện thành công.';
}
?>
