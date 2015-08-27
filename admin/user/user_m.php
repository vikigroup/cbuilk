<?php
if(isset($frame) == true){
	check_permiss($_SESSION['kt_login_id'],5,'admin.php');
}else{
	header("location: ../admin.php");
}
?>

<script language="javascript">
function btnSave_onclick(){
    if($('#name').val() == ''){
        alert('Bạn chưa nhập "Tên thành viên"!');
        $('#name').focus();
        return false;
    }

    if($('#accessName').val() == ''){
        alert('Bạn chưa nhập "Tên truy cập"!');
        $('#accessName').focus();
        return false;
    }

    var id = "<?php echo $_GET['id']; ?>";
    if(id == ''){
        if($('#accessPassWord').val() == ''){
            alert('Bạn chưa nhập "Mật khẩu"!');
            $('#accessPassWord').focus();
            return false;
        }
    }

    var isChanged = $('#hiddenIsChanged').val();
    if(isChanged == 1){
        if($('#reAccessPassWord').val() == ''){
            alert('Bạn chưa "Nhập lại mật khẩu"!');
            $('#reAccessPassWord').focus();
            return false;
        }
        else if($('#reAccessPassWord').val() != $('#accessPassWord').val()){
            alert('Mật khẩu nhập lại không khớp!');
            $('#reAccessPassWord').focus();
            return false;
        }
    }

    if($('#email').val() == ''){
        alert('Bạn chưa nhập "Email"!');
        $('#email').focus();
        return false;
    }

	return true;
}
</script>

<? $errMsg =''?>
<?
$path = "../web/images/nhanvien";
$pathdb = "images/nhanvien";
if(isset($_POST['btnSave'])){
	$name               = isset($_POST['name']) ? trim($_POST['name']) : '';
	$accessName         = isset($_POST['accessName']) ? trim($_POST['accessName']) : '';
	$accessPassWord     = isset($_POST['accessPassWord']) ? trim($_POST['accessPassWord']) : '';
	$mobile             = isset($_POST['mobile']) ? trim($_POST['mobile']) : '';
	$email              = isset($_POST['email']) ? trim($_POST['email']) : '';
	$cmnd               = isset($_POST['cmnd']) ? trim($_POST['cmnd']) : '';
	$ghichu             = isset($_POST['ghichu']) ? trim($_POST['ghichu']) : '';
	$idgroup            = isset($_POST['idgroup']) ? $_POST['idgroup'] : 1;
	$gioitinh           = $_POST['hiddenStatus'];
    $idgroup            = isset($_POST['idgroup']) ? $_POST['idgroup'] : 1;
    $accessStatus       = isset($_POST['accessStatus']) ? $_POST['accessStatus'] : 1;

    $accessPassWord     = md5(md5(md5($accessPassWord)));

	if(!$multiLanguage){
		$lang      = $catInfo['lang'];
	}else{
		$lang      = $catInfo['lang'] != '' ? $catInfo['lang'] : $_POST['cmbLang'];
	}

	if ($name == "") $errMsg .= "Xin vui lòng nhập tên thành viên!<br>";
	$errMsg .= checkUpload($_FILES["txtImage"],".jpeg;.jpg;.png;.bmp",250*250,0);

	if ($errMsg == ''){
		if (!empty($_POST['id'])){
			$oldid = $_POST['id'];
			if($_POST['hiddenIsChanged'] == 0) $sql = "update tbl_users set name='".$name."', username='".$accessName."', mobile='".$mobile."', email='".$email."', cmnd='".$cmnd."', ghichu='".$ghichu."', sex='".$gioitinh."', idgroup='".$idgroup."', status='".$accessStatus."', last_modified=now() where id='".$oldid."'";
			else $sql = "update tbl_users set name='".$name."', username='".$accessName."', password='".$accessPassWord."', mobile='".$mobile."', email='".$email."', cmnd='".$cmnd."', ghichu='".$ghichu."', sex='".$gioitinh."', status='".$accessStatus."', last_modified=now() where id='".$oldid."'";
		}else{
			$sql = "insert into tbl_users (name, username, password, mobile, email, cmnd, ghichu, sex, idgroup, status, date_added, last_modified) values ('".$name."', '".$accessName."', '".$accessPassWord."', '".$mobile."', '".$email."', '".$cmnd."', '".$ghichu."', '".$gioitinh."', '".$idgroup."', '".$accessStatus."', now(), now())";
		} 
		if(mysql_query($sql,$conn)){
			if(empty($_POST['id'])) $oldid = mysql_insert_id();
			$r = getRecord("tbl_users","id=".$oldid);
			$sqlUpdateField = "";
			
			if($_POST['chkClearImg'] == ''){
				$extsmall = getFileExtention($_FILES['txtImage']['name']);
				if (makeUpload($_FILES['txtImage'],"$path/user_s$oldid$extsmall")){
					@chmod("$path/user_s$oldid$extsmall", 0777);
					$sqlUpdateField = " image='$pathdb/user_s$oldid$extsmall' ";
				}
			}else{
				if(file_exists('../'.$r['image'])) @unlink('../'.$r['image']);
				$sqlUpdateField = " image='' ";
			}
					
			if($sqlUpdateField != '')	{
				$sqlUpdate = "update tbl_users set $sqlUpdateField where id='".$oldid."'";
				mysql_query($sqlUpdate,$conn);
			}
		}else{
			$errMsg = "Hệ thống không thể cập nhật dữ liệu!";
		}
	}

	if ($errMsg == '')
		echo '<script>window.location="admin.php?act=user&cat='.$_REQUEST['cat'].'&page='.$_REQUEST['page'].'&code=1"</script>';
}else{
	if (isset($_GET['id'])){
		$oldid = $_GET['id'];
		$page = $_GET['page'];
		$sql = "select * from tbl_users where id='".$oldid."'";
		if($result = mysql_query($sql,$conn)){
			$row = mysql_fetch_array($result);
			$name                = $row['name'];
			$accessName          = $row['username'];
			$mobile              = $row['mobile'];
			$email               = $row['email'];
			$idgroup             = $row['idgroup'];
			$cmnd                = $row['cmnd'];
			$image               = $row['image'];
			$accessStatus        = $row['status'];
			$date_added          = $row['date_added'];
			$last_modified       = $row['last_modified'];
            $gioitinh            = $row['sex'];
            $ghichu              = $row['ghichu'];
        }
	}
}
?>

<?php if( $errMsg != ""){ ?>
    <div class="alert alert-block no-radius fade in">
        <button type="button" class="close" data-dismiss="alert"><span class="mini-icon cross_c"></span></button>
        <p class="pAlert pInfo"><strong class="strongAlert strongInfo">Thông báo</strong><br/> <?php echo $errMsg; ?> <span class="xClose" title="Đóng" onclick="$(this).parent().hide();">x</span></p>
    </div>
<?php } ?>

<div class="row-fluid">
    <div class="span12">
        <div class="box-widget">
            <div class="widget-container">
                <div class="widget-block">
                    <form method="post" name="frmForm" enctype="multipart/form-data" action="admin.php?act=user_m&id=<?php echo $_REQUEST['id']; ?>">
                        <input type="hidden" name="act" value="user_m">
                        <input type="hidden" name="id" value="<?=$_REQUEST['id']?>">
                        <input type="hidden" name="page" value="<?=$_REQUEST['page']?>">
                        <table  class="table_chinh">
                            <tr>
                                <td class="table_chu_tieude_them" colspan="2" align="center" valign="middle">THÀNH VIÊN</td>
                            </tr>
                            <tr>
                                <td valign="middle" class="table_chu">&nbsp;</td>
                                <td valign="middle">&nbsp;</td>
                            </tr>
                            <tr>
                                <td valign="middle">Nhóm quản trị</td>
                                <td valign="middle">
                                    <?php if($quyen == "") $quyen = 1; ?>
                                    <input type="radio" name="idgroup" id="idgroup" value="1" <?php if($idgroup == 1 || $idgroup == '') echo 'checked="checked"'; ?>>Member
                                    <input type="radio" name="idgroup" id="idgroup" value="2" <?php if($idgroup == 2) echo 'checked="checked"'; ?>>Moderator
                                    <input type="radio" name="idgroup" id="idgroup" value="3" <?php if($idgroup == 3) echo 'checked="checked"'; ?>>Administrator
                                    <p class="pGuideline"><i>Quản trị viên thuộc nhóm quản trị nào sẽ chỉ dùng được những chức năng mà nhóm đó được phân quyền.</i></p>
                                </td>
                            </tr>
                            <tr>
                                <td valign="middle" width="30%">Tên thành viên<span class="sao_bb">*</span></td>
                                <td valign="middle" width="70%">
                                    <input name="name" type="text" class="table_khungnho" id="name" value="<?=$name?>"/>
                                </td>
                            </tr>
                            <tr>
                                <td valign="middle" width="30%">Tên truy nhập<span class="sao_bb">*</span></td>
                                <td valign="middle" width="70%">
                                    <input name="accessName" type="text" class="table_khungnho" id="accessName" value="<?=$accessName?>">
                                    <p class="pGuideline"><i>Tên truy cập để đăng nhập vào CMS.</i></p>
                                </td>
                            </tr>
                            <tr>
                                <td valign="middle" width="30%">Mật khẩu<span class="sao_bb">*</span></td>
                                <td valign="middle" width="70%">
                                    <input type="hidden" name="hiddenIsChanged" id="hiddenIsChanged" value="0">
                                    <input name="accessPassWord" type="password" class="table_khungnho" id="accessPassWord" onchange="if(this.value != ''){$('#hiddenIsChanged').val('1');} else{$('#hiddenIsChanged').val('0');}">
                                    <p class="pGuideline"><i>Mật khẩu để đăng nhập vào CMS.</i></p>
                                </td>
                            </tr>
                            <tr>
                                <td valign="middle">Nhập lại mật khẩu</td>
                                <td valign="middle"><input name="reAccessPassWord" type="password" class="table_khungnho" id="reAccessPassWord"></td>
                            </tr>
                            <tr>
                                <td valign="middle" width="30%">Điện thoại</td>
                                <td valign="middle" width="70%">
                                    <input name="mobile" type="text" class="table_khungnho" id="mobile" value="<?=$mobile?>">
                                </td>
                            </tr>
                            <tr>
                                <td valign="middle" width="30%">Email<span class="sao_bb">*</span></td>
                                <td valign="middle" width="70%">
                                    <input name="email" type="text" class="table_khungnho" id="email" value="<?=$email?>">
                                    <p class="pGuideline"><i>Email dùng để nhận lại mật khẩu.</i></p>
                                </td>
                            </tr>
                            <tr>
                                <td valign="middle" width="30%">Số CMND</td>
                                <td valign="middle" width="70%">
                                    <input name="cmnd" type="text" class="table_khungnho" id="cmnd" value="<?=$cmnd?>">
                                </td>
                            </tr>
                            <tr>
                                <td valign="middle" width="30%">Giới tính</td>
                                <td valign="middle" width="70%">
                                    <input type="hidden" name="hiddenStatus" id="hiddenStatus" value="<?php echo $gioitinh; ?>">
                                    <input type="checkbox" id="gioiTinhNam" value="1" <?php if($gioitinh == 1) echo 'checked="checked"'; ?> onclick="$('#gioiTinhNu').prop('checked', false); $('#hiddenStatus').val('1');"> Nam
                                    <input type="checkbox" id="gioiTinhNu" value="0" <?php if($gioitinh == 0) echo 'checked="checked"'; ?> onclick="$('#gioiTinhNam').prop('checked', false); $('#hiddenStatus').val('0');"> Nữ
                                </td>
                            </tr>
                            <tr>
                                <td valign="middle" width="30%">Hình đại diện</td>
                                <td valign="middle" width="70%">
                                    <input name="txtImage" type="file" id="txtImage"/>
                                    <?php if($image != ''){ ?>
                                        <input type="checkbox" name="chkClearImg" value="on"> Xóa bỏ hình ảnh <br/>
                                    <?php } ?>
                                    <?php if($image != ''){echo '<img width="100" height="100" border="0" src="../web/'.$image.'">';} ?><br/><br/>
                                    Hình (kích thước nhỏ)<i> (kích thước chuẩn 250x250(px), ảnh đuôi JPEG, JPG, PNG, BMP). </i><br/><br/>
                                </td>
                            </tr>
                            <tr>
                                <td valign="top" width="30%">Ghi chú</td>
                                <td valign="middle" width="70%">
                                    <textarea name="ghichu" class="table_khungnho" id="ghichu" style="height:150px;"><?=$ghichu?></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td valign="top" width="30%">Trạng thái</td>
                                <td valign="middle" width="70%">
                                    <input type="checkbox" name="accessStatus" id="accessStatus" value="<?php if($accessStatus > 0){echo $accessStatus;}else{echo 0;} ?>" <? if ($accessStatus < 1) echo 'checked'; ?> onchange="if($(this).is(':checked')){this.value = 0;}else{this.value = 1;}"> Khóa &nbsp; &nbsp;
                                </td>
                            </tr>
                            <tr>
                                <td valign="top" width="30%">&nbsp;</td>
                                <td valign="middle" width="70%">
                                    <input name="btnSave" type="submit" id="btnSave" value="Cập nhật" onclick="return btnSave_onclick();"/>
                                    <input type="reset" class="button" value="Nhập lại"/>
                                    <input type="button" id="close" class="button" value="Đóng" onclick="window.location.href = '<?php echo $root.'/admin/admin.php?act='.substr($frame, 0, strlen($frame) - 2); ?>';">
                                </td>
                            </tr>
                        </table>
            		</form>
                </div>
            </div>
        </div>
    </div>
</div>