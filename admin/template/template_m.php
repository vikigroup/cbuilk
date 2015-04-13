<?php
if(isset($frame)==true){
	check_permiss($_SESSION['kt_login_id'],3,'admin.php');
}else{
	header("location: ../admin.php");
}
?>
<? $errMsg =''?>
<?

$path = "../web/images/gianhang/template";
$pathdb = "web/images/gianhang/template";
if (isset($_POST['btnSave'])){
	$code          = isset($_POST['txtCode']) ? trim($_POST['txtCode']) : '';
	$name          = isset($_POST['txtName']) ? trim($_POST['txtName']) : '';
	$parent        = $_POST['ddCat'];
	$subject       = vietdecode($name);
	$detail_short  = isset($_POST['txtDetailShort']) ? trim($_POST['txtDetailShort']) : '';
	$detail        = isset($_POST['txtDetail']) ? trim($_POST['txtDetail']) : '';
	$sort          = isset($_POST['txtSort']) ? trim($_POST['txtSort']) : 0;
	$status        = $_POST['chkStatus']!='' ? 1 : 0;
	
	$catInfo       = getRecord('tbl_template', 'id='.$parent);
	if(!$multiLanguage){
		$lang      = $catInfo['lang'];
	}else{
		$lang      = $catInfo['lang'] != '' ? $catInfo['lang'] : $_POST['cmbLang'];
	}

	if ($name=="") $errMsg .= "Hãy nhập tên danh mục !<br>";
	$errMsg .= checkUpload($_FILES["txtImage"],".jpg;.gif;.bmp",500*1024,0);
	$errMsg .= checkUpload($_FILES["txtImageLarge"],".jpg;.gif;.bmp",500*1024,0);

	if ($errMsg==''){
		if (!empty($_POST['id'])){
			$oldid = $_POST['id'];
			$sql = "update tbl_template set name='".$name."', status='".$status."',last_modified=now() where id='".$oldid."'";
		}else{
			echo $sql = "insert into tbl_template (name, status,  date_added, last_modified) values ('".$name."','1',now(),now())";
		}
		if (mysql_query($sql,$conn)){
			if(empty($_POST['id'])) $oldid = mysql_insert_id();
			$r = getRecord("tbl_template","id=".$oldid);
		
			$sqlUpdateField = "";
			
			if ($_POST['chkClearImg']==''){
				$extsmall=getFileExtention($_FILES['txtImage']['name']);
				if (makeUpload($_FILES['txtImage'],"$path/template_s$oldid$extsmall")){
					@chmod("$path/template_s$oldid$extsmall", 0777);
					$sqlUpdateField = " image='$pathdb/template_s$oldid$extsmall' ";
				}
			}else{
				if(file_exists('../'.$r['image'])) @unlink('../'.$r['image']);
				$sqlUpdateField = " image='' ";
			}
			
			if($sqlUpdateField!='')	{
				$sqlUpdate = "update tbl_template set $sqlUpdateField where id='".$oldid."'";
				mysql_query($sqlUpdate,$conn);
			}
		}else{
			$errMsg = "Không thể cập nhật !";
		}
	}

	if ($errMsg == '')
		echo '<script>window.location="admin.php?act=template&cat='.$_REQUEST['cat'].'&page='.$_REQUEST['page'].'&code=1"</script>';
}else{
	if (isset($_GET['id'])){
		$oldid=$_GET['id'];
		$page = $_GET['page'];
		$sql = "select * from tbl_template where id='".$oldid."'";
		if ($result = mysql_query($sql,$conn)) {
			$row=mysql_fetch_array($result);
			$code          = $row['code'];
			$name          = $row['name'];
			$parent        = $row['parent'];
			$subject       = $row['subject'];
			$detail_short  = $row['detail_short'];
			$detail        = $row['detail'];
			$image         = $row['image'];
			$image_large   = $row['image_large'];
			$sort          = $row['sort'];
			$status        = $row['status'];
			$date_added    = $row['date_added'];
			$last_modified = $row['last_modified'];
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
<div class="row-fluid">
    <div class="span12">
        <div class="box-widget">
          <div class="widget-container">
              <div class="widget-block">
                    
                   <form method="post" name="frmForm" enctype="multipart/form-data" action="admin.php?act=template_m">
                        <input type="hidden" name="txtSubject" id="txtSubject">
                        <input type="hidden" name="txtDetailShort" id="txtDetailShort">
                        <input type="hidden" name="txtDetail" id="txtDetail">
                        
                        <input type="hidden" name="act" value="template_m">
                        <input type="hidden" name="id" value="<?=$_REQUEST['id']?>">
                        <input type="hidden" name="page" value="<?=$_REQUEST['page']?>">
                        <div> <? if($errMsg!=''){echo '<p align=center class="err">'.$errMsg.'<br></p>';}?>  </div>
                            <table  class="table_chinh">
                                <tr>
                                  <td class="table_chu_tieude_them" colspan="2" align="center" valign="middle"  >TIN TỨC</td>
                              </tr>
                                <tr>
                                  <td valign="middle">&nbsp;</td>
                                  <td valign="middle">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td valign="middle" width="30%">
                                        Tên  <span class="sao_bb">*</span>
                                    </td>
                                    <td valign="middle" width="70%">
                                        <input name="txtName" type="text" class="table_khungnho" id="txtName" value="<?=$name?>"/>
                                    </td>
                                </tr>
                                <tr>
                                    <td valign="middle" width="30%">
                                    Hình đại diện</td>
                                    <td valign="middle" width="70%">
                                        <input name="txtImage" type="file" class="textbox" id="txtImage" size="34">
                                        <input type="checkbox" name="chkClearImg" value="on"> Xóa bỏ hình ảnh	 <br>
                                        <? if ($image!=''){ echo '<img width="200" border="0" src="../'.$image.'"><br><br>Hình (kích thước nhỏ)';}?>&nbsp;&nbsp;
                                        <?  if ($image_large!=''){ echo '<img border="0" src="../'.$image_large.'"><br><br>Hình (kích thước lớn)';}?>
                                 
                                        
                                    </td>
                                </tr>
                                <tr>
                                    <td valign="top" width="30%">
                                        Không hiển thị</td>
                                    <td valign="middle" width="70%">
                                        <input type="checkbox" name="chkStatus" value="on" <? if ($status>0) echo 'checked' ?>>
                                    </td>
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