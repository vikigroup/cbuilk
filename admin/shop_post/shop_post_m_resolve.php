<?php
if(isset($frame) == true){
    check_permiss($_SESSION['kt_login_id'], 30, 'admin.php');
    $myPermission = getRecord('tbl_crud', "id_users='".$_SESSION['kt_login_id']."' AND id_permiss=30");
}else{
    header("location: ../admin.php");
}
?>

<script language="javascript">
    function btnSave_onclick(){
        if($('#ddCat').val() == -1){
            alert('Bạn chưa chọn "Danh mục"!');
            $('#ddCat').focus();
            return false;
        }

        if($('#txtName').val() == ''){
            alert('Bạn chưa nhập "Tên bài viết"!');
            $('#txtName').focus();
            return false;
        }

        if(parseFloat($("#txtPrice").val()) < parseFloat($("#txtPricekm").val())){
            alert("Giá khuyến mãi phải <= giá bán sản phẩm!");
            $("#txtPricekm").focus();
            return false;
        }

        if($('#txtDetailShort').val() == ''){
            alert('Bạn chưa nhập "Mô tả ngắn VN"!');
            $('#txtDetailShort').focus();
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

        document.frmForm.txtDetailShort.focus();
        document.forms.frmForm.elements.txtDetail.value = oEdit2.getHTMLBody();

        return true;
    }

    $(function(){
        $("#btn-SEO").click(function(){
            var catName = optimizePostLink($('#txtName').val());
            if(catName == ''){
                alert('Bạn chưa nhập "Tên bài viết"!');
                $('#txtName').focus();
            }else{
                var id = "<?php echo $_GET['id'] ?>";
                var catNameAfter = catName.toLowerCase().replace(/ /g, "-");
                var dataString = "string="+catNameAfter+"&id="+id+"&isPost=1"+"&functionName="+"removeUnicode";
                $.ajax({
                    type: "POST",
                    url: "../lib/functions.php",
                    data: dataString,
                    success: function(x){
                        $("#subject, #txtSubjectSEO").val(x);
                        $('#title').val($('#txtName').val());
                        $('#description').val($('#txtDetailShort').val());
                        $("#keyword").val(catName.toLowerCase()+", "+ removeUnicode(catName));
                        $("#charlimitinfo").val(156 - catName.length);
                    }
                });
            }
        });

        $("#charlimitinfo").val(156 - $('#description').val().length);
        $("#charlimitinfo").attr('value', 156 - $('#description').val().length);

        $("#reset").click(function(){
            $("#subject").change();
        });

        $('#txtPrice, #txtPricekm').keyup();
    });
</script>

<? $errMsg =''?>
<?
$path = "../web/images/gianhang/item";
$pathdb = "images/gianhang/item";
if (isset($_POST['btnSave'])){
    $code               = isset($_POST['txtCode']) ? trim($_POST['txtCode']) : '';
    $name               = isset($_POST['txtName']) ? trim($_POST['txtName']) : '';
    $price              = $_POST['txtPrice'];
    $pricekm            = $_POST['txtPricekm'];
    $currency           = $_POST['slCurrency'];
    $unit               = $_POST['txtUnit'];
    $description        = isset($_POST['description']) ? trim($_POST['description']) : '';

    $parent             = $_POST['ddCat'];
    $parent1            = $_POST['ddCatch'];

    $subject            = $_POST['txtSubjectSEO'];
    $detail_short       = isset($_POST['txtDetailShort']) ? trim($_POST['txtDetailShort']) : '';
    $detail             = isset($_POST['txtDetail']) ? trim($_POST['txtDetail']) : '';
    $otherLink          = $_POST['txtOtherLink'];
    $target             = $_POST['chkTarget'];
    $sort               = isset($_POST['txtSort']) ? trim($_POST['txtSort']) : 0;
    $status             = $_POST['chkStatus'];
    $hot                = $_POST['chkHot'];
    $title              = isset($_POST['title']) ? trim($_POST['title']) : '';
    $keyword            = isset($_POST['keyword']) ? trim($_POST['keyword']) : '';
    $noIndexNoFollow    = $_POST['chkNoIndexNoFollow'];
    $time               = $_POST['txtSetTime'];
    $top                = $_POST['chkTop'];
    $block              = $_POST['chkBlock'];
    $style              = $_POST['ddCategory'];

    $catInfo       = getRecord('tbl_item', 'id='.$parent);
    if(!$multiLanguage){
        $lang      = $catInfo['lang'];
    }else{
        $lang      = $catInfo['lang'] != '' ? $catInfo['lang'] : $_POST['cmbLang'];
    }

    if ($name == "") echo $errMsg .= "Xin vui lòng nhập tên bài viết!<br/>";
    $errMsg .= checkUpload($_FILES["txtImage"],".jpeg;.jpg;.gif;.bmp;.png",277*583,0);

    if ($errMsg == ''){
        if (!empty($_POST['id'])){
            $oldid = $_POST['id'];
            $sql = "update tbl_item set name='".$name."', parent='".$parent."', parent1='".$parent1."', detail='".$detail."', price='".$price."', pricekm='".$pricekm."', sort='".$sort."', status='".$status."', title='".$title."', description='".$description."', keyword='".$keyword."', last_modified=now(), style='".$style."', other_link='".$otherLink."', target='".$target."', detail_short='".$detail_short."', hot='".$hot."', noindex_nofollow='".$noIndexNoFollow."', set_time='".$time."', top='".$top."', block='".$block."', currency='".$currency."', unit='".$unit."' where id='".$oldid."'";
        }else{
            $sql = "insert into tbl_item (name, parent, parent1 , detail, price , pricekm , sort, status,  date_added, last_modified, style, title, description, keyword, other_link, target, detail_short, hot, noindex_nofollow, set_time, top, block, currency, unit) values ('".$name."', '".$parent."', '".$parent1."', '".$detail."', '".$price."', '".$pricekm."', '".$sort."', '".$status."', now(), now(), '".$style."', '".$title."', '".$description."', '".$keyword."', '".$otherLink."', '".$target."', '".$detail_short."', '".$hot."', '".$noIndexNoFollow."', '".$time."', '".$top."', '".$block."', '".$currency."', '".$unit."')";
        }

        if (mysql_query($sql,$conn)){
            if(empty($_POST['id'])) $oldid = mysql_insert_id();
            $r = getRecord("tbl_item","id=".$oldid);

            $arrField = array(
                "subject"          => "'".$subject."'"
            );
            $result = update("tbl_item",$arrField,"id=".$oldid);

            $sqlUpdateField = "";

            if ($_POST['chkClearImg'] == ''){
                $extsmall = getFileExtention($_FILES['txtImage']['name']);
                if (makeUpload($_FILES['txtImage'],"$path/items$oldid$extsmall")){
                    @chmod("$path/items$oldid$extsmall", 0777);
                    $sqlUpdateField = " image='$pathdb/items$oldid$extsmall' ";
                }
            }else{
                if(file_exists('../web/'.$r['image'])) @unlink('../web/'.$r['image']);
                $sqlUpdateField = " image='' ";
            }

            if($sqlUpdateField != ''){
                $sqlUpdate = "update tbl_item set $sqlUpdateField where id = '".$oldid."'";
                mysql_query($sqlUpdate, $conn);
            }
        }else{
            $errMsg = "Hệ thống không thể cập nhật dữ liệu!";
        }
    }

    if ($errMsg == ''){
        echo '<script>window.location="admin.php?act=shop_post&cat='.$_REQUEST['cat'].'&page='.$_REQUEST['page'].'&code=1"</script>';
    }
}else{
    if (isset($_GET['id'])){
        $oldid = $_GET['id'];
        $page = $_GET['page'];
        $sql = "select * from tbl_item where id = '".$oldid."'";
        if ($result = mysql_query($sql,$conn)) {
            $row  = mysql_fetch_array($result);
            $code               = $row['code'];
            $name               = $row['name'];

            $parent1            = $row['parent1'];
            $parent             = $row['parent'];
            if($parent == 2) {
                $parent = $parent1;
                $parent1 = -1;
            }

            $idshop             = $row['idshop'];
            $subject            = $row['subject'];
            $price              = $row['price'];
            $pricekm            = $row['pricekm'];
            $currency           = $row['currency'];
            $unit               = $row['unit'];
            $subject            = $row['subject'];
            $detail_short       = $row['detail_short'];
            $otherLink          = $row['other_link'];
            $target             = $row['target'];
            $detail             = $row['detail'];
            $image              = $row['image'];
            $image_large        = $row['image_large'];
            $sort               = $row['sort'];
            $status             = $row['status'];
            $hot                = $row['hot'];
            $date_added         = $row['date_added'];
            $title              = $row['title'];
            $description        = $row['description'];
            $keyword            = $row['keyword'];
            $last_modified      = $row['last_modified'];
            $noIndexNoFollow    = $row['noindex_nofollow'];
            $time               = $row['set_time'];
            $top                = $row['top'];
            $block              = $row['block'];
            $style              = $row['style'];
        }
    }
}
?>

<?php
if(($block == 1 && $_SESSION['kt_login_level'] != 3) || ($myPermission != '' && $myPermission['isUpdate'] == 0) || ($myPermission != '' && $myPermission['isCreate'] == 0)){
    header("Location: ".$root.'/admin/admin.php?act='.substr($frame, 0, strlen($frame) - 2).'&deny=1');
}
?>

<script>
    $(document).ready(function() {
        $("#ddCat").change(function(){
            var id = $(this).val();
            var table = "tbl_shop_category";
            $("#ddCatch").load("getChild.php?table="+ table + "&id=" +id);
        });

        var style = "<?php echo $style; ?>";
        checkPostStyle(style);
    });
</script>
<script type="text/javascript" src="../lib/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="../lib/ckfinder/ckfinder.js"></script>
