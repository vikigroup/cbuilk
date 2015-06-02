<?php
if(isset($frame)==true){
	check_permiss($_SESSION['kt_login_id'],10,'index.php');
}else{
	header("location: ../index.php");
}
?>
<? $errMsg =''?>
<?

$path = "../web/images/item";
$pathdb = "images/item";
if (isset($_POST['btnSave'])){
	$code          = isset($_POST['txtCode']) ? trim($_POST['txtCode']) : '';
	$name          = isset($_POST['txtName']) ? trim($_POST['txtName']) : '';
	$nickyahoo     = isset($_POST['nickyahoo']) ? trim($_POST['nickyahoo']) : '';
	$parent        = $_POST['ddCat'];
	$subject       = vietdecode($name);
	$detail_short  = isset($_POST['txtDetailShort']) ? trim($_POST['txtDetailShort']) : '';
	$detail        = isset($_POST['txtDetail']) ? trim($_POST['txtDetail']) : '';
	$sort          = isset($_POST['txtSort']) ? trim($_POST['txtSort']) : 0;
	$status        = $_POST['chkStatus'];
	
	$catInfo       = getRecord('tbl_support', 'id='.$parent);
	if(!$multiLanguage){
		$lang      = $catInfo['lang'];
	}else{
		$lang      = $catInfo['lang'] != '' ? $catInfo['lang'] : $_POST['cmbLang'];
	}

	if ($name=="") $errMsg .= "Hãy nhập tên   !<br>";
	$errMsg .= checkUpload($_FILES["txtImage"],".jpg;.gif;.bmp",500*1024,0);
	$errMsg .= checkUpload($_FILES["txtImageLarge"],".jpg;.gif;.bmp",500*1024,0);

	if ($errMsg==''){
		if (!empty($_POST['id'])){
			$oldid = $_POST['id'];
			$sql = "update tbl_support set name='".$name."' , nickyahoo='".$nickyahoo."' , sort='".$sort."', status='".$status."',last_modified=now() where id='".$oldid."'";
		}else{
			$sql = "insert into tbl_support (name, nickyahoo , sort, status,  date_added, last_modified) values ('".$name."','".$nickyahoo."','".$sort."','".$status."',now(),now())";
		}
		if (mysql_query($sql,$conn)){
			if(empty($_POST['id'])) $oldid = mysql_insert_id();
			$r = getRecord("tbl_support","id=".$oldid);
		
			$arrField = array(
			"subject"          => "'".vietdecode($name)
			);// ko them id vao cuoi cho dep
			$result = update("tbl_support",$arrField,"id=".$oldid);
			
			$sqlUpdateField = "";
			
			if ($_POST['chkClearImg']==''){
				$extsmall=getFileExtention($_FILES['txtImage']['name']);
				if (makeUpload($_FILES['txtImage'],"$path/item_category_s$oldid$extsmall")){
					@chmod("$path/item_category_s$oldid$extsmall", 0777);
					$sqlUpdateField = " image='$pathdb/item_category_s$oldid$extsmall' ";
				}
			}else{
				if(file_exists('../web/'.$r['image'])) @unlink('../web/'.$r['image']);
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
				if(file_exists('../web/'.$r['image_large'])) @unlink('../web/'.$r['image_large']);
				if($sqlUpdateField != "") $sqlUpdateField .= ",";
				$sqlUpdateField .= " image_large='' ";
			}
			
			if($sqlUpdateField!='')	{
				$sqlUpdate = "update tbl_support set $sqlUpdateField where id='".$oldid."'";
				mysql_query($sqlUpdate,$conn);
			}
		}else{
			$errMsg = "Không thể cập nhật !";
		}
	}

	if ($errMsg == '')
		echo '<script>window.location="admin.php?act=hotro&cat='.$_REQUEST['cat'].'&page='.$_REQUEST['page'].'&code=1"</script>';
}else{
	if (isset($_GET['id'])){
		$oldid=$_GET['id'];
		$page = $_GET['page'];
		$sql = "select * from tbl_support where id='".$oldid."'";
		if ($result = mysql_query($sql,$conn)) {
			$row=mysql_fetch_array($result);
			$code          = $row['code'];
			$name          = $row['name'];
			$parent        = $row['parent'];
			$subject       = $row['subject'];
			$nickyahoo     = $row['nickyahoo'];
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
     <?=$errMsg;?>
</div>
<?php }?>
<div class="row-fluid">
    <div class="span12">
        <div class="box-widget">
          <div class="widget-container">
              <div class="widget-block">
                    
                   <form method="post" name="frmForm" enctype="multipart/form-data" action="#">
                        <input type="hidden" name="act" value="hotro_m">
                        <input type="hidden" name="id" value="<?=$_REQUEST['id']?>">
                        <input type="hidden" name="page" value="<?=$_REQUEST['page']?>">
                   
                        <table  class="table_chinh">
                             <tr>
                              <td class="table_chu_tieude_them" colspan="2" align="center" valign="middle"  >HỖ TRỢ</td>
                            </tr>
                            <tr>
                              <td valign="middle"  class="table_chu">&nbsp;</td>
                              <td valign="middle">&nbsp;</td>
                            </tr>
                            <tr>
                                <td valign="middle" width="30%">Tên người dùng<span class="sao_bb">*</span>
                                </td>
                                <td valign="middle" width="70%">
                                    <input name="txtName" type="text" class="table_khungnho" id="txtName" value="<?=$name?>"/>
                                </td>
                            </tr>
                            <tr>
                              <td valign="middle"> Nick yahoo<span class="sao_bb"></span></td>
                              <td valign="middle"><input name="nickyahoo" type="text" class="table_khungnho" id="nickyahoo" value="<?=$nickyahoo?>"/></td>
                            </tr>
                             
                             <tr>
                                <td valign="middle" width="30%">
                                   Thứ tự sắp xếp
                                </td>
                                <td valign="middle" width="70%">
                                    <input class="table_khungnho" value="<?=$sort?>" type="text" name="txtSort"  />
                                </td>
                            </tr>
                            <tr>
                                <td valign="top" width="30%">
                                    Không hiển thị</td>
                                <td valign="middle" width="70%">
                                    <input type="checkbox" name="chkStatus" value="<?php if($status>0){echo $status;}else{echo 0;} ?>" <? if ($status>0) echo 'checked' ?> onchange="if($(this).is(':checked')){this.value = 1;}else{this.value = 0;}">
                                </td>
                            </tr>
                             
                           
                            <tr>
                                <td valign="top" width="30%">&nbsp;
                                        
                                </td>
                                <td valign="middle" width="70%">
                                    <input name="btnSave" type="submit" id="btnSave" value=" Lưu thông tin"/>
                                    <input type="reset" value="Xóa trắng"/>
                                </td>
                            </tr>
                        </table>
                            
                     </form> 

                </div>
            </div>
        </div>
    </div>
</div>