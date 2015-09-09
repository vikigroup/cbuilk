<?php
if(isset($frame) == true){
	check_permiss($_SESSION['kt_login_id'], 1, 'admin.php');
    $myPermission = getRecord('tbl_crud', "id_users='".$_SESSION['kt_login_id']."' AND id_permiss=1");
}else{
	header("location: ../admin.php");
}
?>

<script language="javascript">
function btnSave_onclick(){
    if($('#ddCat').val() == '-1'){
        alert('Bạn chưa chọn "Danh mục"!');
        $('#ddCat').focus();
        return false;
    }

    if($('#txtName').val() == ''){
        alert('Bạn chưa nhập "Tên danh mục"!');
        $('#txtName').focus();
        return false;
    }

    if($('#titlePage').val() == ''){
        alert('Bạn chưa nhập "Chủ đề của trang"!');
        $('#titlePage').focus();
        return false;
    }

    if($('#descriptionPage').val() == ''){
        alert('Bạn chưa nhập "Mô tả chủ đề trang"!');
        $('#descriptionPage').focus();
        return false;
    }

    if($('#subject').val() == ''){
        alert('Bạn chưa nhập "Link danh mục VN"! \nBạn có thể nhấn vào nút tạo SEO để hệ thống tự động thực hiện.');
        $('#subject').focus();
        return false;
    }

    if($('#title').val() == ''){
        alert('Bạn chưa nhập "Tiêu đề trang"! \nBạn có thể nhấn vào nút tạo SEO để hệ thống tự động thực hiện.');
        $('#title').focus();
        return false;
    }

    if($('#description').val() == ''){
        alert('Bạn chưa nhập "Mô tả trang"! \nBạn có thể nhấn vào nút tạo SEO để hệ thống tự động thực hiện.');
        $('#description').focus();
        return false;
    }

    if($('#keyword').val() == ''){
        alert('Bạn chưa nhập "Từ khóa VN"! \nBạn có thể nhấn vào nút tạo SEO để hệ thống tự động thực hiện.');
        $('#keyword').focus();
        return false;
    }
	
	document.forms.frmForm.elements.txtDetailShort.value = oEdit1.getHTMLBody();
	document.forms.frmForm.elements.txtDetail.value = oEdit2.getHTMLBody();
	
	return true;
}

$(function(){
    $("#btn-SEO").click(function(){
        var catName = $('#txtName').val().trim();
        if(catName == ''){
            alert('Bạn chưa nhập "Tên danh mục"!');
            $('#txtName').focus();
        }else{
            var id = "<?php echo $_GET['id'] ?>";
            var catNameAfter = catName.toLowerCase().replace(/ /g, "-");
            var dataString = "string="+catNameAfter+"&id="+id+"&isPost=0"+"&functionName="+"removeUnicode";
            $.ajax({
                type: "POST",
                url: "../lib/functions.php",
                data: dataString,
                success: function(x){
                    $("#subject, #txtSubjectSEO").val(x);
                    $('#title').val(catName);
                    $('#description').val(catName);
                    $("#keyword").val(catName.toLowerCase()+", "+ removeUnicode(catName));
                    $("#charlimitinfo").val(156 - catName.length);
                }
            });
        }
    });

    $("#charlimitinfo").val(156 - $('#description').val().length);
    $("#charlimitinfo").attr('value', 156 - $('#description').val().length);
});
</script>

<? $errMsg =''?>
<?
$path = "../web/images/shopcate";
$pathdb = "images/shopcate";
if (isset($_POST['btnSave'])){
	$code              = isset($_POST['txtCode']) ? trim($_POST['txtCode']) : '';
	$name              = isset($_POST['txtName']) ? trim($_POST['txtName']) : '';
	$parent            = $_POST['ddCat'];
	$parent1           = $_POST['ddCatch'];
	
	if($parent1 == -1) $parent1 = $parent;
	if($parent1 == -1 && $parent == -1 )$parent1 = 2;

	$subject           = $_POST['txtSubjectSEO'];
	$detail_short      = isset($_POST['txtDetailShort']) ? trim($_POST['txtDetailShort']) : '';
	$detail            = isset($_POST['txtDetail']) ? trim($_POST['txtDetail']) : '';
	$sort              = isset($_POST['txtSort']) ? trim($_POST['txtSort']) : 0;
	$status            = $_POST['chkStatus'];
    $cate              = $_POST['ddCategory'];
    $target            = $_POST['chkTarget'];
    $otherLink         = $_POST['txtOtherLink'];
    $titlePage         = isset($_POST['titlePage']) ? trim($_POST['titlePage']) : "";
    $descriptionPage   = isset($_POST['descriptionPage']) ? trim(htmlspecialchars($_POST['descriptionPage'])) : "";
    $title             = isset($_POST['title']) ? trim($_POST['title']) : "";
	$description       = isset($_POST['description']) ? trim(htmlspecialchars($_POST['description'])) : "";
	$keyword           = isset($_POST['keyword']) ? trim($_POST['keyword']) : "";

	$catInfo       = getRecord('tbl_shop_category', 'id='.$parent);
	if(!$multiLanguage){
		$lang      = $catInfo['lang'];
	}else{
		$lang      = $catInfo['lang'] != '' ? $catInfo['lang'] : $_POST['cmbLang'];
	}

	if ($name=="") $errMsg .= "Xin vui lòng nhập tên danh mục!<br/>";
	$errMsg .= checkUpload($_FILES["txtImage"],".jpeg;.jpg;.gif;.bmp;.png",250*250,0);
	$errMsg .= checkUpload($_FILES["txtImageLarge"],".jpeg;.jpg;.gif;.bmp;.png",482*1020,0);

	if ($errMsg==''){
		if (!empty($_POST['id'])){
			$oldid = $_POST['id'];
            $myArr = array(209, 210, 211, 390, 458, 500);
            if(in_array($oldid, $myArr)){
                $link = $root."/".$subject.".html";
                if($oldid == 210){
                    $idSystem = 2;
                }
                if($oldid == 209){
                    $idSystem = 3;
                }
                if($oldid == 211){
                    $idSystem = 4;
                }
                if($oldid == 390){
                    $idSystem = 5;
                }
                if($oldid == 500){
                    $idSystem = 6;
                }
                if($oldid == 458){
                    $idSystem = 7;
                }
                $query = "update tbl_system set module_name='".$name."',module_link='".$link."', module_display='".!$status."' where id='".$idSystem."'";
                mysql_query($query,$conn);
            }
			$sql = "update tbl_shop_category set code='".$code."',name='".$name."', parent='".$parent1."',subject='".$subject."',detail_short='".$detail_short."',detail='".$detail."', sort='".$sort."', title='".$title."', description='".$description."', keyword='".$keyword."', status='".$status."',last_modified=now(), lang='".$lang."', cate='".$cate."', target='".$target."', other_link='".$otherLink."', title_page='".$titlePage."', description_page='".$descriptionPage."' where id='".$oldid."'";
        }else{
			$sql = "insert into tbl_shop_category (code, name, parent, subject, detail_short, detail, title , description , keyword , sort, status,  date_added, last_modified, lang, cate, target, other_link, title_page , description_page) values ('".$code."','".$name."','".$parent1."','".$subject."','".$detail_short."','".$detail."','".$title."','".$description."','".$keyword."','".$sort."','".$status."',now(),now(),'".$lang."','".$cate."','".$target."','".$otherLink."','".$titlePage."','".$descriptionPage."')";
        }
		if (mysql_query($sql,$conn)){
			if(empty($_POST['id'])) $oldid = mysql_insert_id();
			$r = getRecord("tbl_shop_category","id=".$oldid);
		
			$arrField = array(
			"subject"          => "'".$subject."'"
			);
			$result = update("tbl_shop_category",$arrField,"id=".$oldid);
			
			$sqlUpdateField = "";
			
			if ($_POST['chkClearImg']==''){
				$extsmall=getFileExtention($_FILES['txtImage']['name']);
				if (makeUpload($_FILES['txtImage'],"$path/item_category_s$oldid$extsmall")){
					@chmod("$path/item_category_s$oldid$extsmall", 0777);
					$sqlUpdateField = " image='$pathdb/item_category_s$oldid$extsmall' ";
				}
			}else{
				if(file_exists('../'.$r['image'])) @unlink('../'.$r['image']);
				$sqlUpdateField = " image='' ";
			}
			
			if ($_POST['chkClearImgLarge']==''){
				$extlarge=getFileExtention($_FILES['txtImageLarge']['name']);
				if (makeUpload($_FILES['txtImageLarge'],"$path/item_category_l$oldid$extlarge")){
					@chmod("$path/item_category_l$oldid$extlarge", 0777);
					if($sqlUpdateField != "") $sqlUpdateField .= ",";
					$sqlUpdateField .= " image_large='$pathdb/item_category_l$oldid$extlarge' ";
				}
			}else{
				if(file_exists('../'.$r['image_large'])) @unlink('../'.$r['image_large']);
				if($sqlUpdateField != "") $sqlUpdateField .= ",";
				$sqlUpdateField .= " image_large='' ";
			}
			
			if($sqlUpdateField!='')	{
				$sqlUpdate = "update tbl_shop_category set $sqlUpdateField where id='".$oldid."'";
				mysql_query($sqlUpdate,$conn);
			}
        }else{
			$errMsg = "Hệ thống không thể cập nhật dữ liệu!";
		}
	}

	if ($errMsg == ''){
        echo '<script>window.location="admin.php?act=shop_category&cat='.$_REQUEST['cat'].'&page='.$_REQUEST['page'].'&code=1"</script>';
    }
}else{
	if (isset($_GET['id'])){
		$oldid = $_GET['id'];
		$page = $_GET['page'];
		$sql = "select * from tbl_shop_category where id='".$oldid."'";
		if ($result = mysql_query($sql,$conn)) {
			$row = mysql_fetch_array($result);
			$code            = $row['code'];
			$name            = $row['name'];

			$parent1         = $row['parent'];
			$parent          = get_field('tbl_shop_category','id',$parent1,'parent');
			if($parent == 2){
				$parent = $parent1;
				$parent1 = -1;
			}

			$subject         = $row['subject'];
			$detail_short    = $row['detail_short'];
			$detail          = $row['detail'];
			$image           = $row['image'];
			$image_large     = $row['image_large'];
			$sort            = $row['sort'];
			$status          = $row['status'];
            $cate            = $row['cate'];
            $date_added      = $row['date_added'];
			$last_modified   = $row['last_modified'];
            $titlePage       = $row['title_page'];
            $descriptionPage = $row['description_page'];
			$title           = $row['title'];
			$description     = $row['description'];
			$keyword         = $row['keyword'];
            $target          = $row['target'];
            $otherLink       = $row['other_link'];
		}
	}
}
?>

<?php
if(($myPermission != '' && $myPermission['isUpdate'] == 0) || ($myPermission != '' && $myPermission['isCreate'] == 0)){
    header("Location: ".$root.'/admin/admin.php?act='.substr($frame, 0, strlen($frame) - 2).'&deny=1');
}
?>
