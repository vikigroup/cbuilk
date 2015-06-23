<? $errMsg =''?>
<?

$path = "../images/gianhang/item";
$pathdb = "images/gianhang/item";
if (isset($_POST['btnSave'])){
	$code          = isset($_POST['txtCode']) ? trim($_POST['txtCode']) : '';
	$name          = isset($_POST['name']) ? trim($_POST['name']) : '';
    $link          = isset($_POST['link']) ? trim($_POST['link']) : '';
	$parent        = $_POST['ddCat'];
	
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
	$cate          = $_POST['cate'];
	
	$catInfo       = getRecord('tbl_ad', 'id='.$parent);
	if(!$multiLanguage){
		$lang      = $catInfo['lang'];
	}else{
		$lang      = $catInfo['lang'] != '' ? $catInfo['lang'] : $_POST['cmbLang'];
	}

	if ($name=="") $errMsg .= "Hãy nhập tên quảng cáo!<br>";
	$errMsg .= checkUpload($_FILES["txtImage"],".jpg;.gif;.bmp",500*1024,0);
	$errMsg .= checkUpload($_FILES["txtImageLarge"],".jpg;.gif;.bmp",500*1024,0);

	if ($errMsg==''){
		if (!empty($_POST['id'])){
			$oldid = $_POST['id'];
			$sql = "update tbl_ad set idshop='".$idshop."',cate='".$cate."',name='".$name."', link='".$link."', status=0 ,last_modified=now() where id='".$oldid."'";
		}else{
			$sql = "insert into tbl_ad ( idshop , name , cate , link, status , date_added, last_modified ) values ('".$idshop."','".$name."','".$cate."','".$link."','1',now(),now()  )";
		}
		if (mysql_query($sql,$conn)){
			if(empty($_POST['id'])) $oldid = mysql_insert_id();
			$r = getRecord("tbl_ad","id=".$oldid);
		
			$hinh=luu_hinh_flash('hinh','../','images/gianhang/ad/',$loi);// root chua hinh upload	

			if($loi=='' && $hinh!="")	{
				$sqlUpdate = "update tbl_ad set image='".$hinh."' where id='".$oldid."'";
				if(mysql_query($sqlUpdate,$conn))
					if(file_exists('../'.$r['hinh'])) @unlink('../'.$r['hinh']);

				//them thong tin ad flash
				$k=$hinh;
				$GT = explode(".",$k);
				$ten=$GT[0];
				$kieu=$GT[1];
				if($kieu=='swf' || $kieu=='SWF'){
					$linkgetimagesize="../".$k;//get width va height file
					list($width, $height, $type, $attr)=getimagesize($linkgetimagesize); //get kich thuoc file
				}

				$sqlUpdate = "update tbl_ad set ad_info='".$width."-".$height."' where id='".$oldid."'";
				mysql_query($sqlUpdate,$conn);
			}
			
		}else{
			$errMsg = "Không thể cập nhật !";
		}
	}

	if ($errMsg == '')
		echo '<script>window.location="'.$$host_link_full.'/quantri/index.php?act=adv&cat='.$_REQUEST['cat'].'&page='.$_REQUEST['page'].'&code=1"</script>';
}else{
	if (isset($_GET['id'])){
		$oldid=$_GET['id'];
		$page = $_GET['page'];
		$sql = "select * from tbl_ad where id='".$oldid."'";
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
    
    <h1 class="title_menu_admin">Quảng cáo</h1><!-- End .title_menu_admin -->
    
    <div class="frame_cont_body">    
    
        <div class="note">Lưu ý: Những ô có dấu * là bắt buộc</div>                
    
    
        <div class="frm_tbl">
        <form method="post" name="frmForm" enctype="multipart/form-data" action="index.php?act=adv_m">   
          <input type="hidden" name="act" value="adv_m">
            <input type="hidden" name="id" value="<?=$_REQUEST['id']?>">
            <input type="hidden" name="page" value="<?=$_REQUEST['page']?>">
          <div> <? if($errMsg!=''){echo '<p align=center class="err">'.$errMsg.'<br></p>';}?>  </div>
            <table>
            
                <tr>
                    <th>Tên danh mục<span class="star_color">*</span></th>
                    <td>
                        <div class="pdd1">
                            <input name="name" type="text" class="ipt_txt1" id="name" value="<?=$name?>"/>
                        </div>
                    </td>
                </tr>                                
                <tr>
                  <th height="31">Loại</th>
                  <td>
                  <label for="cate"></label>
                  <select name="cate" id="cate">
                   	<option value="0"  <?php if($cate==0) echo 'selected="selected"'?>> Quảng cáo </option> 
                    <option value="1" <?php if($cate==1) echo 'selected="selected"'?>> Quảng chạy bên trái </option> 
                    <option value="2" <?php if($cate==2) echo 'selected="selected"'?>> Quảng chạy bên phải </option> 
                    <option value="3" <?php if($cate==3) echo 'selected="selected"'?>> Đối tác </option>
                  </select>
                  </td>
                </tr>
                <tr>
                  <th height="31">Link</th>
                  <td><span class="pdd1">
                    <input name="link" type="text" class="ipt_txt1" id="link" value="<?=$link?>"/>
                  </span></td>
                </tr>
                <tr>
                  <th height="64">Hình</th>
                  <td> <input name="hinh" type="file" class="" id="hinh"/>&nbsp;&nbsp;<br />
                 
                  </td>
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
                <tr>
                    <th>&nbsp;</th>
                    <td>
                         <img src="../../<?=$row['image']?>" width="80" height="80" border="0" class="hinh" />
                    </td>
                </tr>
                                             
            </table>
         </form>   
        </div><!-- End .frm_tbl -->
    
    </div><!-- End .frame_cont_body -->
    
</div>