<?php
if(isset($frame)==true){
	check_permiss($_SESSION['kt_login_id'],18,'index.php');
}else{
	header("location: ../index.php");
}
?>

<script language="javascript">
    function btnSave_onclick(){
        if($('#txtName').val() == ''){
            alert('Bạn chưa nhập "tên" !');
            $('#txtName').focus();
            return false;
        }

        if($('#title').val() == ''){
            alert('Bạn chưa nhập "tiêu đề"');
            $('#title').focus();
            return false;
        }

        if($('#description').val() == ''){
            alert('Bạn chưa nhập "mô tả"');
            $('#description').focus();
            return false;
        }

        if($('#keyword').val() == ''){
            alert('Bạn chưa nhập "từ khóa tìm kiếm"');
            $('#keyword').focus();
            return false;
        }

        document.frmForm.txtDetailShort.focus();
        document.forms.frmForm.elements.txtDetail.value = oEdit2.getHTMLBody();

        return true;
    }
</script>

<? $errMsg =''?>
<?
$path = "../web/images/jbsnews";
$pathdb = "images/jbsnews";
if (isset($_POST['btnSave'])){
	$code          = isset($_POST['txtCode']) ? trim($_POST['txtCode']) : '';
	$name          = isset($_POST['txtName']) ? trim($_POST['txtName']) : '';
	$parent        = $_POST['ddCat'];
	$subject       = vietdecode($name);
	$detail_short  = isset($_POST['txtDetailShort']) ? trim($_POST['txtDetailShort']) : '';
	$detail        = isset($_POST['txtDetail']) ? trim($_POST['txtDetail']) : '';
	$link          = isset($_POST['link']) ? trim($_POST['link']) : '';
	$sort          = isset($_POST['txtSort']) ? trim($_POST['txtSort']) : 0;
	$status        = $_POST['chkStatus'];
	
	$title         = isset($_POST['title']) ? trim($_POST['title']) : "";
	$description   = isset($_POST['description']) ? trim($_POST['description']) : "";
	$keyword       = isset($_POST['keyword']) ? trim($_POST['keyword']) : "";
	
	$catInfo       = getRecord('viki_tin', 'id='.$parent);
	if(!$multiLanguage){
		$lang      = $catInfo['lang'];
	}else{
		$lang      = $catInfo['lang'] != '' ? $catInfo['lang'] : $_POST['cmbLang'];
	}

	if ($name=="") $errMsg .= "Hãy nhập tên danh mục !<br>";
	$errMsg .= checkUpload($_FILES["txtImage"],".jpg;.gif;.bmp;.png",500*1024,0);
	$errMsg .= checkUpload($_FILES["txtImageLarge"],".jpg;.gif;.bmp;.png",500*1024,0);

	if ($errMsg==''){
		if (!empty($_POST['id'])){
			$oldid = $_POST['id'];
			$sql = "update viki_tin set name='".$name."',parent='".$parent."',detail='".$detail."',sort='".$sort."', status='".$status."', title='".$title."', description='".$description."', keyword='".$keyword."',last_modified=now() where id='".$oldid."'";
		}else{
			$sql = "insert into viki_tin (name, parent , detail, title , description , keyword , sort, status,  date_added, last_modified  ) values ('".$name."','".$parent."','".$detail."','".$title."','".$description."','".$keyword."','".$sort."','".$status."',now(),now())";
		}
		if (mysql_query($sql,$conn)){
			if(empty($_POST['id'])) $oldid = mysql_insert_id();
			$r = getRecord("viki_tin","id=".$oldid);
		
			$arrField = array(
			"subject"          => "'".vietdecode($name)."'"
			);
			$result = update("viki_tin",$arrField,"id=".$oldid);
			
			$sqlUpdateField = "";
			
			if ($_POST['chkClearImg']==''){
				$extsmall=getFileExtention($_FILES['txtImage']['name']);
				if (makeUpload($_FILES['txtImage'],"$path/infos$oldid$extsmall")){
					@chmod("$path/infos$oldid$extsmall", 0777);
					$sqlUpdateField = " image='$pathdb/infos$oldid$extsmall' ";
				}
			}else{
				if(file_exists('../web/'.$r['image'])) @unlink('../web/'.$r['image']);
				$sqlUpdateField = " image='' ";
			}
			
			if ($_POST['chkClearImgLarge']==''){
				$extlarge=getFileExtention($_FILES['txtImageLarge']['name']);
				if (makeUpload($_FILES['txtImageLarge'],"$path/info_l$oldid$extlarge")){
					@chmod("$path/info_l$oldid$extlarge", 0777);
					if($sqlUpdateField != "") $sqlUpdateField .= ",";
					$sqlUpdateField .= " image_large='$pathdb/info_l$oldid$extlarge' ";
				}
			}else{
				if(file_exists('../web/'.$r['image_large'])) @unlink('../web/'.$r['image_large']);
				if($sqlUpdateField != "") $sqlUpdateField .= ",";
				$sqlUpdateField .= " image_large='' ";
			}
			
			if($sqlUpdateField!='')	{
				$sqlUpdate = "update viki_tin set $sqlUpdateField where id='".$oldid."'";
				mysql_query($sqlUpdate,$conn);
			}
		}else{
			$errMsg = "Không thể cập nhật !";
		}
	}

	if ($errMsg == '')
		echo '<script>window.location="admin.php?act=viki_infomation&cat='.$_REQUEST['cat'].'&page='.$_REQUEST['page'].'&code=1"</script>';
}else{
	if (isset($_GET['id'])){
		$oldid=$_GET['id'];
		$page = $_GET['page'];
		$sql = "select * from viki_tin where id='".$oldid."'";
		if ($result = mysql_query($sql,$conn)) {
			$row=mysql_fetch_array($result);
			$code          = $row['code'];
			$name          = $row['name'];
			$parent        = $row['parent'];
			$subject       = $row['subject'];
			$detail_short  = $row['detail_short'];
			$link         = $row['link'];
			$detail        = $row['detail'];
			$image         = $row['image'];
			$image_large   = $row['image_large'];
			$sort          = $row['sort'];
			$status        = $row['status'];
			$date_added    = $row['date_added'];
			$last_modified = $row['last_modified'];
			
			$title         = $row['title'];
			$description   = $row['description'];
			$keyword       = $row['keyword'];
		}
	}
}
?>
<?php if( $errMsg !=""){ ?>
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
                   <form method="post" name="frmForm" enctype="multipart/form-data" action="admin.php?act=viki_infomation_m">
                       <input type="hidden" name="act" value="viki_infomation_m">
                       <input type="hidden" name="id" value="<?=$_REQUEST['id']?>">
                       <input type="hidden" name="page" value="<?=$_REQUEST['page']?>">
                       <div> <? if($errMsg!=''){echo '<p align=center class="err">'.$errMsg.'<br></p>';}?></div>
                       <table  class="table_chinh">
                           <tr>
                               <td class="table_chu_tieude_them" colspan="2" align="center" valign="middle"  >THÔNG TIN</td>
                           </tr>
                           <tr>
                               <td valign="middle"  class="table_chu">&nbsp;</td>
                               <td valign="middle">&nbsp;</td>
                           </tr>
                           <tr>
                               <td valign="middle" width="30%">Tên  <span class="sao_bb">*</span></td>
                               <td valign="middle" width="70%">
                                   <input name="txtName" type="text" class="table_khungnho" id="txtName" value="<?=$name?>"/>
                               </td>
                           </tr>
                           <tr>
                               <td valign="middle">Nội dung</td>
                               <td valign="middle">&nbsp;</td>
                           </tr>
                           <tr>
                               <td colspan="2" valign="middle"><textarea name="txtDetail" class="txt" id="txtDetail"><?php echo $detail?></textarea>
                                   <script type="text/javascript">
                                       var editor = CKEDITOR.replace( 'txtDetail',
                                           {
                                               height:500,
                                               width:780,
                                               filebrowserImageBrowseUrl : '../lib/ckfinder/ckfinder.html?Type=Images',
                                               filebrowserFlashBrowseUrl : '../lib/ckfinder/ckfinder.html?Type=Flash',
                                               filebrowserImageUploadUrl : '../lib/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
                                               filebrowserFlashUploadUrl : '../lib/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',
                                               fullPage : true
                                           });
                                   </script>
                               </td>
                           </tr>
                           <tr>
                               <td valign="middle" width="30%">Thứ tự sắp xếp</td>
                               <td valign="middle" width="70%">
                                   <input class="table_khungnho" value="<?=$sort?>" type="text" name="txtSort"/>
                               </td>
                           </tr>
                           <tr>
                               <td valign="middle" width="30%">Hình đại diện</td>
                               <td valign="middle" width="70%">
                                   <input type="file" name="txtImage" class="textbox" size="34">
                                   <input type="checkbox" name="chkClearImg" value="on"> Xóa bỏ hình ảnh <br>
                                   <? if ($image!=''){ echo '<img border="0" width="80" height="80" src="../web/'.$image.'"><br><br>Hình (kích thước nhỏ)';}?>&nbsp;&nbsp;
                                   <?  if ($image_large!=''){ echo '<img border="0" src="../web/'.$image_large.'"><br><br>Hình (kích thước lớn)';}?>
                               </td>
                           </tr>
                           <tr>
                               <td valign="middle" width="30%">Tiêu đề  <span class="sao_bb">*</span></td>
                               <td valign="middle" width="70%">
                                   <input name="title" type="text" class="table_khungnho" id="title" value="<?=$title?>"/>
                               </td>
                           </tr>
                           <tr>
                               <td valign="middle" width="30%">Mô tả  <span class="sao_bb">*</span></td>
                               <td valign="middle" width="70%">
                                   <input name="description" type="text" class="table_khungnho" id="description" value="<?=$description?>"/>
                               </td>
                           </tr>
                           <tr>
                               <td valign="middle" width="30%">Từ khóa tìm kiếm  <span class="sao_bb">*</span></td>
                               <td valign="middle" width="70%">
                                   <input name="keyword" type="text" class="table_khungnho" id="keyword" value="<?=$keyword?>"/>
                               </td>
                           </tr>
                           <tr>
                               <td valign="top" width="30%">Không hiển thị</td>
                               <td valign="middle" width="70%">
                                   <input type="checkbox" name="chkStatus" value="<?php if($status>0){echo $status;}else{echo 0;} ?>" <? if ($status>0) echo 'checked' ?> onchange="if($(this).is(':checked')){this.value = 1;}else{this.value = 0;}">
                               </td>
                           </tr>
                           <tr>
                               <td valign="top" width="30%">&nbsp;</td>
                               <td valign="middle" width="70%">
                                   <input type="submit" name="btnSave" value="Cập nhật" class=button onclick="return btnSave_onclick()">
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