<? $errMsg =''?>
<?

$path = "../images/gianhang/download";
$pathdb = "images/gianhang/download";
if (isset($_POST['btnSave'])){
	$code          = isset($_POST['txtCode']) ? trim($_POST['txtCode']) : '';
	$name          = isset($_POST['name']) ? trim($_POST['name']) : '';
    $link          = isset($_POST['link']) ? trim($_POST['link']) : '';
	$parent        = $_POST['ddCat'];
	$loai          = $_POST['loai'];
	
	if($parent=="") $parent=2;
	
	$subject       = vietdecode($name);
	$detail_short  = isset($_POST['txtDetailShort']) ? trim($_POST['txtDetailShort']) : '';
	$detail        = isset($_POST['content']) ? trim($_POST['content']) : '';
	$sort          = isset($_POST['txtSort']) ? trim($_POST['txtSort']) : 0;
	$status        = 0;
	$title          = isset($_POST['title']) ? trim($_POST['title']) : '';
	$description    = isset($_POST['description']) ? trim($_POST['description']) : '';
	$keyword        = isset($_POST['keyword']) ? trim($_POST['keyword']) : '';
	$price          = isset($_POST['price']) ? trim($_POST['price']) : '';
	
	$catInfo       = getRecord('tbl_other', 'id='.$parent);
	if(!$multiLanguage){
		$lang      = $catInfo['lang'];
	}else{
		$lang      = $catInfo['lang'] != '' ? $catInfo['lang'] : $_POST['cmbLang'];
	}

	if ($name=="") $errMsg .= "Hãy nhập tên tài liệu!<br>";
	$errMsg .= checkUpload($_FILES["txtImage"],".jpg;.gif;.bmp;.png",1000*1024,0);
	$errMsg .= checkUpload($_FILES["txtImageLarge"],".jpg;.gif;.bmp;.png;.zip;.rar;;.pdf;.doc;.docx;.xls",1000*1024,0);

	if ($errMsg==''){
		if (!empty($_POST['id'])){
			$oldid = $_POST['id'];
			$sql = "update tbl_other set idshop='".$idshop."',name='".$name."',detail_short='".$detail_short."', last_modified=now() where id='".$oldid."'";
		}else{
			$sql = "insert into tbl_other ( idshop , cate , name ,  detail_short ,status , date_added, last_modified ) values ('".$idshop."','2','".$name."','".$detail_short."','1',now(),now() )";
		}
		if (mysql_query($sql,$conn)){
			if(empty($_POST['id'])) $oldid = mysql_insert_id();
			$r = getRecord("tbl_other","id=".$oldid);
		
			if ($_POST['chkClearImg']==''){
				$extsmall=getFileExtention($_FILES['txtImage']['name']);
				if (makeUpload($_FILES['txtImage'],"$path/item_s$oldid$extsmall")){
					@chmod("$path/item_s$oldid$extsmall", 0777);
					$sqlUpdateField = " image='$pathdb/item_s$oldid$extsmall' ";
				}
			}else{
				if(file_exists('../'.$r['image'])) @unlink('../'.$r['image']);
				$sqlUpdateField = " image='' ";
			}
			
			if ($_POST['chkClearImgLarge']==''){
				$extlarge=getFileExtention($_FILES['txtImageLarge']['name']);
				if (makeUpload($_FILES['txtImageLarge'],"$path/item_l$oldid$extlarge")){
					@chmod("$path/item_l$oldid$extlarge", 0777);
					if($sqlUpdateField != "") $sqlUpdateField .= ",";
					$sqlUpdateField .= " image_large='$pathdb/item_l$oldid$extlarge' ";
				}
			}else{
				if(file_exists('../'.$r['image_large'])) @unlink('../'.$r['image_large']);
				if($sqlUpdateField != "") $sqlUpdateField .= ",";
				$sqlUpdateField .= " image_large='' ";
			}
			
			if($sqlUpdateField!='')	{
				$sqlUpdate = "update tbl_other set $sqlUpdateField where id='".$oldid."'";
				mysql_query($sqlUpdate,$conn);
			}
			
		}else{
			$errMsg = "Không thể cập nhật !";
		}
	}

	if ($errMsg == '')
		echo '<script>window.location="'.$host_link_full.'/quantri/index.php?act=download&cat='.$_REQUEST['cat'].'&page='.$_REQUEST['page'].'&code=1"</script>';
}else{
	if (isset($_GET['id'])){
		$oldid=$_GET['id'];
		$page = $_GET['page'];
		$sql = "select * from tbl_other where id='".$oldid."'";
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
			$loai          = $row['cate'];
			
			$price        = $row['price'];
			$link        = $row['link'];
			
			$title        = $row['title'];
			$description  = $row['description'];
			$keyword      = $row['keyword'];

			$date_added    = $row['date_added'];
			$last_modified = $row['last_modified'];
		}
	}
}

?>
<div class="main_cont_body">
    
    <h1 class="title_menu_admin">Tài liệu</h1><!-- End .title_menu_admin -->
    
    <div class="frame_cont_body">    
    
        <div class="note">Lưu ý: Những ô có dấu * là bắt buộc</div>                
    
    
        <div class="frm_tbl">
        <form method="post" name="frmForm" enctype="multipart/form-data" action="index.php?act=config_shop">   
          <input type="hidden" name="act" value="download_m">
            <input type="hidden" name="id" value="<?=$_REQUEST['id']?>">
            <input type="hidden" name="page" value="<?=$_REQUEST['page']?>">
          <div> <? if($errMsg!=''){echo '<p align=center class="err">'.$errMsg.'<br></p>';}?>  </div>
            <table>
            
                <tr>
                    <th>Tên tài liệu<span class="star_color">*</span></th>
                    <td>
                        <div class="pdd1">
                            <input name="name" type="text" class="ipt_txt1" id="name" value="<?=$name?>"/>
                        </div>
                    </td>
                </tr>                                
                <tr>
                  <th height="31">Mô tả</th>
                  <td><label for="detail"></label>
                  <textarea name="txtDetailShort"  id="txtDetailShort" style="width:360px;" ><?=$detail_short;?>
                    </textarea></td>
                </tr>
                <tr>
                  <th height="64">Hình</th>
                  <td> <input name="txtImage" type="file" class="" id="txtImage"/>&nbsp;&nbsp;<input type="checkbox" name="chkClearImg" value="on"> Xóa bỏ hình ảnh &nbsp;&nbsp;<br /></td>
              </tr>
                <tr>
                  <th>File đính kèm</th>
                  <td><input type="file" name="txtImageLarge" class="textbox" size="34">
						<input type="checkbox" name="chkClearImgLarge" value="on">					   
						 Xóa bỏ file</td>
                </tr>
                <tr>
                    <th>&nbsp;</th>
                    <td>
                        <div class="pdd1">
                            <input id="btnSave"  name="btnSave" class="sub_txt1" type="submit" value="Chấp nhận"/>
                            &nbsp;
                            <input class="sub_txt1" type="submit" value="Quay lại"/>
                        </div>
                    </td>
                </tr>
                                             
            </table>
         </form>   
        </div><!-- End .frm_tbl -->
    
    </div><!-- End .frame_cont_body -->
    
</div>