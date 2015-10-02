<?php
if(isset($frame)==true){
	check_permiss($_SESSION['kt_login_id'], 6, 'admin.php');
}else{
	header("location: ../admin.php");
}
?>

<script language="javascript">
function btnSave_onclick(){
	if(test_empty(document.frmForm.emailkh.value)){
		alert('Bạn chưa nhập "Mail nhận thư"!');
		document.frmForm.emailkh.focus();
		return false;
	}

    if(test_empty(document.frmForm.cauhinh_mail_ten.value)){
		alert('Bạn chưa nhập "Tài khoản mail"!');
		document.frmForm.cauhinh_mail_ten.focus();
		return false;
	}

    if(test_empty(document.frmForm.cauhinh_mail_mk.value)){
		alert('Bạn chưa nhập "Mật khẩu mail"!');
		document.frmForm.cauhinh_mail_mk.focus();
		return false;
	}
	
	return true;
}
</script>

<? $errMsg =''?>
<?
$path = "../images/item";
$pathdb = "images/item";
if (isset($_POST['btnSave'])){
	$code                   = isset($_POST['txtCode']) ? trim($_POST['txtCode']) : '';
	$name                   = isset($_POST['txtName']) ? trim($_POST['txtName']) : '';
	$parent                 = $_POST['ddCat'];
	$subject                = vietdecode($name);
	$detail_short           = isset($_POST['txtDetailShort']) ? trim($_POST['txtDetailShort']) : '';
	$detail                 = isset($_POST['txtDetail']) ? trim($_POST['txtDetail']) : '';
	$sort                   = isset($_POST['txtSort']) ? trim($_POST['txtSort']) : 0;
	$status                 = $_POST['chkStatus']!='' ? 1 : 0;
	
	$copyright              = isset($_POST['copyright']) ? trim($_POST['copyright']) : '';
	$tenkh                  = isset($_POST['tenkh']) ? trim($_POST['tenkh']) : '';
	$dckh                   = isset($_POST['dckh']) ? trim($_POST['dckh']) : '';
	$dtkh                   = isset($_POST['dtkh']) ? trim($_POST['dtkh']) : '';
	$hotlinekh              = isset($_POST['hotlinekh']) ? trim($_POST['hotlinekh']) : '';
	$emailkh                = isset($_POST['emailkh']) ? trim($_POST['emailkh']) : '';
	$faxkh                  = isset($_POST['faxkh']) ? trim($_POST['faxkh']) : '';
    $contentkh              = isset($_POST['contentkh']) ? trim($_POST['contentkh']) : '';

    $title                  = isset($_POST['title']) ? trim($_POST['title']) : '';
	$description            = isset($_POST['description']) ? trim($_POST['description']) : '';
	$keywords               = isset($_POST['keywords']) ? trim($_POST['keywords']) : '';
    $cache                  = $_POST['onoffswitch'];

    $email_bcc              = isset($_POST['emailbcc']) ? trim($_POST['emailbcc']) : '';
    $email_title            = isset($_POST['emailtitle']) ? trim($_POST['emailtitle']) : '';
    $email_footer           = isset($_POST['txtMailFooter']) ? trim($_POST['txtMailFooter']) : '';

    $cauhinh_mail_ten       = isset($_POST['cauhinh_mail_ten']) ? trim($_POST['cauhinh_mail_ten']) : '';
	$cauhinh_mail_mk        = isset($_POST['cauhinh_mail_mk']) ? trim($_POST['cauhinh_mail_mk']) : '';

	$google_analytics       = isset($_POST['txtGoogleAnalytics']) ? trim($_POST['txtGoogleAnalytics']) : '';
	$other_code             = isset($_POST['txtOtherCode']) ? trim($_POST['txtOtherCode']) : '';

	$catInfo                = getRecord('tbl_config', 'id='.$parent);
	if(!$multiLanguage){
		$lang               = $catInfo['lang'];
	}else{
		$lang               = $catInfo['lang'] != '' ? $catInfo['lang'] : $_POST['cmbLang'];
	}

	//if ($name=="") $errMsg .= "Hãy nhập tên danh mục !<br>";
	$errMsg .= checkUpload($_FILES["txtImage"],".jpg;.gif;.bmp",500*1024,0);
	$errMsg .= checkUpload($_FILES["txtImageLarge"],".jpg;.gif;.bmp",500*1024,0);

	if ($errMsg==''){
		if (!empty($_POST['id'])){
			$oldid = $_POST['id'];
			$sql = "update tbl_config set copyright='".$copyright."',title='".$title."', description='".$description."',keywords='".$keywords."'
			,tenkh='".$tenkh."',dckh='".$dckh."', dtkh='".$dtkh."', hotlinekh='".$hotlinekh."', emailkh='".$emailkh."', faxkh='".$faxkh."'
			, contentkh='".$contentkh."', note='".$detail."', cauhinh_mail_ten='".$cauhinh_mail_ten."', cauhinh_mail_mk='".encryptIt($cauhinh_mail_mk)."'
			, cache='".$cache."', email_bcc='".$email_bcc."', email_title='".$email_title."', email_footer='".$email_footer."', google_analytics='".$google_analytics."'
			, other_code='".$other_code."' where id='".$oldid."'";
		}
		
		if (mysql_query($sql,$conn)){
			$errMsg = "";
		}else{
			$errMsg = "Không thể cập nhật!";
		}
	}

	if ($errMsg == '')
		echo '<script>window.location="admin.php?act=config&id='.$oldid.'&cat='.$_REQUEST['cat'].'&page='.$_REQUEST['page'].'&code=1"</script>';
}else{
	if (isset($_GET['id'])){
		$oldid = $_GET['id'];
		$page = $_GET['page'];
		$sql = "select * from tbl_config where id = '".$oldid."'";
		if ($result = mysql_query($sql,$conn)) {
			$row = mysql_fetch_array($result);
			$copyright           = $row['copyright'];
			$title               = $row['title'];
			$description         = $row['description'];
			$keywords            = $row['keywords'];
			$tenkh               = $row['tenkh'];
			$dckh                = $row['dckh'];
			$dtkh                = $row['dtkh'];
			$detail              = $row['note'];
			$hotlinekh           = $row['hotlinekh'];
			$emailkh             = $row['emailkh'];
			$faxkh               = $row['faxkh'];
            $contentkh           = $row['contentkh'];
			$cauhinh_mail_ten    = $row['cauhinh_mail_ten'];
			$cauhinh_mail_mk     = decryptIt($row['cauhinh_mail_mk']);
			$title               = $row['title'];
			$description         = $row['description'];
			$keywords            = $row['keywords'];
            $cache               = $row['cache'];
            $email_bcc           = $row['email_bcc'];
            $email_title         = $row['email_title'];
            $email_footer        = $row['email_footer'];
            $google_analytics    = $row['google_analytics'];
            $other_code          = $row['other_code'];
        }
	}
}
?>

<?php if($_GET['code'] == 1){$errMsg = "Cập nhật thành công!";} ?>

<?php if($errMsg != ""){ ?>
    <div class="alert alert-block no-radius fade in">
        <button type="button" class="close" data-dismiss="alert"><span class="mini-icon cross_c"></span></button>
        <p class="pAlert pInfo"><strong class="strongAlert strongInfo">Thông báo:</strong> <?php echo $errMsg; ?> <span class="xClose" title="Đóng" onclick="$(this).parent().hide();">x</span></p>
    </div>
<?php } ?>

<script type="text/javascript" src="../lib/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="../lib/ckfinder/ckfinder.js"></script>
<div class="row-fluid">
    <div class="span12">
        <div class="box-widget">
            <div class="widget-container">
                <div class="widget-block">
                   <form method="post" name="frmForm" enctype="multipart/form-data" action="admin.php?act=config">
                        <input type="hidden" name="act" value="config">
                        <input type="hidden" name="id" value="<?php echo $_GET['id'];?>">
                        <input type="hidden" name="page" value="<?=$_REQUEST['page']?>">
                        <table class="table_chinh">
                            <tr>
                                <td class="table_chu_tieude_them" colspan="2" align="center" valign="middle" style="text-transform:uppercase" >CẤU HÌNH HỆ THỐNG</td>
                            </tr>
                            <tr>
                                <td valign="middle"> &nbsp; </td>
                                <td valign="middle"> &nbsp; </td>
                            </tr>
                            <tr class="tr_title">
                                <td valign="middle"> &nbsp;Cấu hình email </td>
                                <td valign="middle"> &nbsp;- CHÚ Ý: Phần này rất quan trọng, cần phải cấu hình đúng để nhận được email liên hệ, đơn hàng... từ khách hàng.</td>
                            </tr>
                            <tr>
                                <td valign="middle"><b>Mail nhận thư</b><span class="sao_bb">*</span></td>
                                <td valign="middle">
                                    <input name="emailkh" type="text" class="table_khungnho" id="emailkh" value="<?=$emailkh?>"/>
                                    <p class="pGuideline"><i>Khi người dùng liên hệ hoặc mua hàng, sẽ gởi mail vào email này! Chỉ nhập một email duy nhất!</i></p>
                                </td>
                            </tr>
                            <tr>
                                <td valign="middle"><b>Mail được BCC</b></td>
                                <td valign="middle">
                                    <input name="emailbcc" type="text" class="table_khungnho" id="emailbcc" value="<?=$email_bcc?>"/>
                                    <p class="pGuideline"><i>Các email sẽ được BCC (đơn hàng, liên hệ), viết liền không khoảng trắng và ngăn cách nhau bởi dấu chấm phẩy (;).</i></p>
                                </td>
                            </tr>
                            <tr>
                                <td valign="middle"><b>Tên hiển thị</b></td>
                                <td valign="middle">
                                    <input name="emailtitle" type="text" class="table_khungnho" id="emailtitle" value="<?=$email_title?>"/>
                                    <p class="pGuideline"><i>Để cho người dùng biết là mail này từ đâu gởi tới!</i></p>
                                </td>
                            </tr>
                            <tr>
                                <td valign="middle"><b>Tài khoản mail</b><span class="sao_bb">*</span></td>
                                <td valign="middle">
                                    <input name="cauhinh_mail_ten" type="text" class="table_khungnho" id="cauhinh_mail_ten" value="<?=$cauhinh_mail_ten?>"/>
                                    <p class="pGuideline"><i>Tài khoản mail dùng để gởi mail!</i></p>
                                </td>
                            </tr>
                            <tr>
                                <td valign="middle"><b>Mật khẩu mail</b><span class="sao_bb">*</span></td>
                                <td valign="middle">
                                    <input name="cauhinh_mail_mk" type="password" class="table_khungnho" id="cauhinh_mail_mk" value="<?=$cauhinh_mail_mk;?>"/>
                                    <p class="pGuideline"><i>Mật khẩu của tài khoản mail ngay bên trên.</i></p>
                                </td>
                            </tr>
                            <tr><td><b>Thông tin mail footer:</b></td></tr>
                            <tr>
                                <td colspan="2" valign="middle">
                                    <textarea name="txtMailFooter" class="txt" id="txtMailFooter"><?php echo $email_footer; ?></textarea>
                                    <script type="text/javascript">
                                        var editor = CKEDITOR.replace( 'txtMailFooter',
                                            {
                                                height:200,
                                                width:900,
                                                filebrowserImageBrowseUrl : '../lib/ckfinder/ckfinder.html?Type=Images',
                                                filebrowserFlashBrowseUrl : '../lib/ckfinder/ckfinder.html?Type=Flash',
                                                filebrowserImageUploadUrl : '../scripts/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
                                                filebrowserFlashUploadUrl : '../scripts/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',
                                                fullPage : true
                                            });
                                    </script>
                                </td>
                            </tr>
                            <tr class="tr_title">
                                <td valign="middle"> &nbsp;Google Analytics & Webmaster Tools </td>
                                <td valign="middle"> &nbsp;</td>
                            </tr>
                            <tr><td valign="middle"><b>Google Analytics</b></td></tr>
                            <tr>
                                <td colspan="2" valign="middle">
                                    <textarea name="txtGoogleAnalytics" class="table_khungvua" id="txtGoogleAnalytics"><?php echo $google_analytics; ?></textarea>
                                    <p class="pGuideline"><i>Mã Google Analytics dùng thống kê lượt truy cập vào website.</i></p>
                                </td>
                            </tr>
                            <tr><td valign="middle"><b>Các đoạn script khác</b></td></tr>
                            <tr>
                                <td colspan="2" valign="middle">
                                    <textarea name="txtOtherCode" class="table_khungvua" id="txtOtherCode"><?php echo $other_code; ?></textarea>
                                    <p class="pGuideline"><i>Mã zopim, livechat, remarketing ..., tất cả đều thêm ở đây, sẽ xuất hiện trong thẻ body!.</i></p>
                                </td>
                            </tr>
                            <tr class="tr_title">
                                <td valign="middle"> &nbsp;Logo & Favicon </td>
                                <td valign="middle"> &nbsp;</td>
                            </tr>
                            <tr class="tr_title">
                                <td valign="middle"> &nbsp;Mạng xã hội </td>
                                <td valign="middle"> &nbsp;</td>
                            </tr>
                            <tr class="tr_title">
                                <td valign="middle"> &nbsp;Cấu hình phân trang </td>
                                <td valign="middle"> &nbsp;</td>
                            </tr>
                            <tr class="tr_title">
                                <td valign="middle"> &nbsp;Bảo trì website </td>
                                <td valign="middle"> &nbsp;</td>
                            </tr>
                            <tr class="tr_title">
                                <td valign="middle"> &nbsp;Các cấu hình khác </td>
                                <td valign="middle"> &nbsp;</td>
                            </tr>
                            <tr>
                                <td valign="middle" width="30%">
                                    Tên bản quyền<span class="sao_bb">*</span>
                                </td>
                                <td valign="middle" width="70%">
                                    <input name="copyright" type="text" class="table_khungnho" id="copyright" value="<?=$copyright?>"/>
                                </td>
                            </tr>
                            <tr>
                                <td valign="middle" width="30%">Tên công ty<span class="sao_bb">*</span>
                                </td>
                                <td valign="middle" width="70%">
                                    <input name="tenkh" type="text" class="table_khungnho" id="tenkh" value="<?=$tenkh?>"  />
                                </td>
                            </tr>
                            <tr>
                              <td valign="middle">Địa chỉ<span class="sao_bb">*</span></td>
                              <td valign="middle"><input name="dckh" type="text" class="table_khungnho" id="dckh" value="<?=$dckh?>"  /></td>
                            </tr>
                            <tr>
                              <td valign="middle">Điện thoại<span class="sao_bb">*</span></td>
                              <td valign="middle"><input name="dtkh" type="text" class="table_khungnho" id="dtkh" value="<?=$dtkh?>"  /></td>
                            </tr>
                            <tr>
                              <td valign="middle">Hotline<span class="sao_bb">*</span></td>
                              <td valign="middle"><input name="hotlinekh" type="text" class="table_khungnho" id="hotlinekh" value="<?=$hotlinekh?>"  /></td>
                            </tr>
                            <tr>
                              <td valign="middle">Giấy phép ĐKKD<span class="sao_bb">*</span></td>
                              <td valign="middle"><input name="faxkh" type="text" class="table_khungnho" id="faxkh" value="<?=$faxkh?>"  /></td>
                            </tr>
                            <tr>
                                <td valign="middle">Chịu trách nhiệm nội dung<span class="sao_bb">*</span></td>
                                <td valign="middle"><input name="contentkh" type="text" class="table_khungnho" id="contentkh" value="<?=$contentkh?>"  /></td>
                            </tr>
                            <tr>
                                <td valign="middle">Chế độ cache</td>
                                <td valign="middle">
                                    <div class="onoffswitch">
                                        <input type="hidden" id="hiddenCache" value="1">
                                        <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="myonoffswitch" value="<?php if($cache>0){echo $cache;}else{echo 0;} ?>" <? if ($cache>0) echo 'checked' ?> onchange="if($(this).is(':checked')){this.value = 1;}else{this.value = 0;}">
                                        <label class="onoffswitch-label" for="myonoffswitch">
                                            <span class="onoffswitch-inner"></span>
                                            <span class="onoffswitch-switch"></span>
                                        </label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                              <td colspan="2" valign="middle"><textarea name="txtDetail" class="txt" id="txtDetail"><?php echo $detail?></textarea>
                              <script type="text/javascript">
                                    var editor = CKEDITOR.replace( 'txtDetail',
                                    {
                                        height:200,
                                        width:900,
                                        filebrowserImageBrowseUrl : '../lib/ckfinder/ckfinder.html?Type=Images',
                                        filebrowserFlashBrowseUrl : '../lib/ckfinder/ckfinder.html?Type=Flash',
                                        filebrowserImageUploadUrl : '../scripts/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
                                        filebrowserFlashUploadUrl : '../scripts/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',
                                        fullPage : true
                                    });
                                    </script>
                               </td>
                            </tr>
                            <tr>
                              <td valign="middle">Tiêu đề<span class="sao_bb">*</span></td>
                              <td valign="middle"><input name="title" type="text" class="table_khungnho" id="title" value="<?=$title?>"  /></td>
                            </tr>
                            <tr>
                              <td valign="middle">Mô tả<span class="sao_bb">*</span></td>
                              <td valign="middle"><input name="description" type="text" class="table_khungnho" id="description" value="<?=$description?>"  /></td>
                            </tr>
                            <tr>
                              <td valign="middle">Từ khóa tìm kiếm<span class="sao_bb">*</span></td>
                              <td valign="middle"><input name="keywords" type="text" class="table_khungnho" id="keywords" value="<?=$keywords?>"  /></td>
                            </tr>
                            <tr>
                              <td valign="top">&nbsp;</td>
                              <td valign="middle">&nbsp;</td>
                            </tr>
                            <tr>
                                <td valign="top" width="30%">&nbsp;</td>
                                <td valign="middle" width="70%">
                                    <input type="submit" name="btnSave" value="Cập nhật" class="nut_table" onclick="return btnSave_onclick();">
                                    <input type="reset" class="nut_table" value="Nhập lại">
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
