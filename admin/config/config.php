<?php
if(isset($frame)==true){
	check_permiss($_SESSION['kt_login_id'],6,'admin.php');
}else{
	header("location: ../admin.php");
}
?>

<script language="javascript">
function btnSave_onclick(){
	if(test_empty(document.frmForm.txtName.value)){
		alert('Hãy nhập "tên" !');
		document.frmForm.txtName.focus();
		return false;
	}
	if(test_integer(document.frmForm.txtSort.value)){
		alert('"Thứ tự sắp xếp" phải là số !');
		document.frmForm.txtSort.focus();
		return false;
	}
	
	//document.forms.frmForm.elements.txtSubject.value = oEdit0.getHTMLBody();
	document.forms.frmForm.elements.txtDetailShort.value = oEdit1.getHTMLBody();
	document.forms.frmForm.elements.txtDetail.value = oEdit2.getHTMLBody();
	
	return true;
}
</script>



<? $errMsg =''?>
<?

$path = "../images/item";
$pathdb = "images/item";
if (isset($_POST['btnSave'])){
	$code          = isset($_POST['txtCode']) ? trim($_POST['txtCode']) : '';
	$name          = isset($_POST['txtName']) ? trim($_POST['txtName']) : '';
	$parent        = $_POST['ddCat'];
	$subject       = vietdecode($name);
	$detail_short  = isset($_POST['txtDetailShort']) ? trim($_POST['txtDetailShort']) : '';
	$detail        = isset($_POST['txtDetail']) ? trim($_POST['txtDetail']) : '';
	$sort          = isset($_POST['txtSort']) ? trim($_POST['txtSort']) : 0;
	$status        = $_POST['chkStatus']!='' ? 1 : 0;
	
	$copyright     = isset($_POST['copyright']) ? trim($_POST['copyright']) : '';
	$tenkh         = isset($_POST['tenkh']) ? trim($_POST['tenkh']) : '';
	$dckh          = isset($_POST['dckh']) ? trim($_POST['dckh']) : '';
	$dtkh          = isset($_POST['dtkh']) ? trim($_POST['dtkh']) : '';
	$hotlinekh     = isset($_POST['hotlinekh']) ? trim($_POST['hotlinekh']) : '';
	$emailkh       = isset($_POST['emailkh']) ? trim($_POST['emailkh']) : '';
	$faxkh         = isset($_POST['faxkh']) ? trim($_POST['faxkh']) : '';
	
	$title         = isset($_POST['title']) ? trim($_POST['title']) : '';
	$description   = isset($_POST['description']) ? trim($_POST['description']) : '';
	$keywords      = isset($_POST['keywords']) ? trim($_POST['keywords']) : '';
    $cache         = $_POST['onoffswitch'];

    $cauhinh_mail_ten        = isset($_POST['cauhinh_mail_ten']) ? trim($_POST['cauhinh_mail_ten']) : '';
	$cauhinh_mail_mk        = isset($_POST['cauhinh_mail_mk']) ? trim($_POST['cauhinh_mail_mk']) : '';
	
	$catInfo       = getRecord('tbl_config', 'id='.$parent);
	if(!$multiLanguage){
		$lang      = $catInfo['lang'];
	}else{
		$lang      = $catInfo['lang'] != '' ? $catInfo['lang'] : $_POST['cmbLang'];
	}

	//if ($name=="") $errMsg .= "Hãy nhập tên danh mục !<br>";
	$errMsg .= checkUpload($_FILES["txtImage"],".jpg;.gif;.bmp",500*1024,0);
	$errMsg .= checkUpload($_FILES["txtImageLarge"],".jpg;.gif;.bmp",500*1024,0);

	if ($errMsg==''){
		if (!empty($_POST['id'])){
			$oldid = $_POST['id'];
			$sql = "update tbl_config set copyright='".$copyright."',title='".$title."', description='".$description."',keywords='".$keywords."',tenkh='".$tenkh."',dckh='".$dckh."', dtkh='".$dtkh."', hotlinekh='".$hotlinekh."', emailkh='".$emailkh."', faxkh='".$faxkh."', note='".$detail."', cauhinh_mail_ten='".$cauhinh_mail_ten."', cauhinh_mail_mk='".$cauhinh_mail_mk."', cache='".$cache."' where id='".$oldid."'";
		}
		
		if (mysql_query($sql,$conn)){
			// lam mot viec gi do
		}else{
			$errMsg = "Không thể cập nhật !";
		}
	}

	if ($errMsg == '')
		echo '<script>window.location="admin.php?act=config&id='.$oldid.'&cat='.$_REQUEST['cat'].'&page='.$_REQUEST['page'].'&code=1"</script>';
}else{
	if (isset($_GET['id'])){
		$oldid=$_GET['id'];
		$page = $_GET['page'];
		$sql = "select * from tbl_config where id='".$oldid."'";
		if ($result = mysql_query($sql,$conn)) {
			$row=mysql_fetch_array($result);
			$copyright     = $row['copyright'];
			$title         = $row['title'];
			$description   = $row['description'];
			$keywords      = $row['keywords'];
			$tenkh         = $row['tenkh'];
			$dckh          = $row['dckh'];
			$dtkh          = $row['dtkh'];
			$detail        = $row['note'];
			$hotlinekh     = $row['hotlinekh'];
			$emailkh       = $row['emailkh'];
			$faxkh         = $row['faxkh'];
			$cauhinh_mail_ten    = $row['cauhinh_mail_ten'];
			$cauhinh_mail_mk     = $row['cauhinh_mail_mk'];
			$title         = $row['title'];
			$description   = $row['description'];
			$keywords      = $row['keywords'];
            $cache         = $row['cache'];

        }
	}
}

?>

<?php
	if( $errMsg !=""){ 
?>
<div class="alert alert-block no-radius fade in">
    <button type="button" class="close" data-dismiss="alert"><span class="mini-icon cross_c"></span></button>
    <h4>Warning!</h4>
     <? $errMsg =''?>
</div>
<?php }?>
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
                        <div> <? if($errMsg!=''){echo '<p align=center class="err">'.$errMsg.'<br></p>';}?>  </div>
                            <table  class="table_chinh">
                    			 <tr>
                                  <td class="table_chu_tieude_them" colspan="2" align="center" valign="middle"  style="text-transform:uppercase" > <?php $id=$_GET['id'];?>
                                  CẤU HÌNH THÔNG TIN <?php if($id==1) echo "Thiết kế website";elseif($id==2) echo "Hệ thống";elseif($id==3) echo "Rao vặt";elseif($id=4) echo "Bất động sản";?>
                                  </td>
                              	</tr>
                                <tr>
                                  <td valign="middle"  class="table_chu">&nbsp;</td>
                                  <td valign="middle">&nbsp;</td>
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
                                  <td valign="middle">Email<span class="sao_bb">*</span></td>
                                  <td valign="middle"><input name="emailkh" type="text" class="table_khungnho" id="emailkh" value="<?=$emailkh?>"  /></td>
                                </tr>
                                <tr>
                                  <td valign="middle">Số ĐKKD<span class="sao_bb">*</span></td>
                                  <td valign="middle"><input name="faxkh" type="text" class="table_khungnho" id="faxkh" value="<?=$faxkh?>"  /></td>
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
                                  <td valign="middle">Mail gửi<span class="sao_bb">*</span></td>
                                  <td valign="middle"><input name="cauhinh_mail_ten" type="text" class="table_khungnho" id="cauhinh_mail_ten" value="<?=$cauhinh_mail_ten?>"  /></td>
                                </tr>
                                <tr>
                                  <td valign="middle">Mật khẩu<span class="sao_bb">*</span></td>
                                  <td valign="middle"><input name="cauhinh_mail_mk" type="password" class="table_khungnho" id="cauhinh_mail_mk" value="<?=$cauhinh_mail_mk;?>"  /></td>
                                </tr>
                                <tr>
                                  <td valign="middle">Title <span class="sao_bb">*</span></td>
                                  <td valign="middle"><input name="title" type="text" class="table_khungnho" id="title" value="<?=$title?>"  /></td>
                                </tr>
                                <tr>
                                  <td valign="middle">Description<span class="sao_bb">*</span></td>
                                  <td valign="middle"><input name="description" type="text" class="table_khungnho" id="description" value="<?=$description?>"  /></td>
                                </tr>
                                <tr>
                                  <td valign="middle">Keywords<span class="sao_bb">*</span></td>
                                  <td valign="middle"><input name="keywords" type="text" class="table_khungnho" id="keywords" value="<?=$keywords?>"  /></td>
                                </tr>
                                <tr>
                                  <td valign="top">&nbsp;</td>
                                  <td valign="middle">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td valign="top" width="30%">&nbsp;
                                        
                                    </td>
                                    <td valign="middle" width="70%">
                                        <input type="submit" name="btnSave" VALUE="Cập nhật" class=button onclick="return btnSave_onclick()">
                                        <input type="reset" class=button value="Nhập lại">	
                                    </td>
                                </tr>
                            </table>
                            </form> 

                </div>
            </div>
        </div>
    </div>
</div>
