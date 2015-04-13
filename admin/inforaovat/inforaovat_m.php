<?php
if(isset($frame)==true){
	check_permiss($_SESSION['kt_login_id'],9,'index.php');
}else{
	header("location: ../index.php");
}
?>



<? $errMsg =''?>
<?

$path = "../web/images/info";
$pathdb = "images/info";
if (isset($_POST['btnSave'])){
	$code          = isset($_POST['txtCode']) ? trim($_POST['txtCode']) : '';
	$name          = isset($_POST['txtName']) ? trim($_POST['txtName']) : '';
	$parent        = $_POST['ddCat'];
	$subject       = vietdecode($name);
	$detail_short  = isset($_POST['txtDetailShort']) ? trim($_POST['txtDetailShort']) : '';
	$detail        = isset($_POST['txtDetail']) ? trim($_POST['txtDetail']) : '';
	$link          = isset($_POST['link']) ? trim($_POST['link']) : '';
	$sort          = isset($_POST['txtSort']) ? trim($_POST['txtSort']) : 0;
	$status        = $_POST['chkStatus']!='' ? 1 : 0;
	
	$title         = isset($_POST['title']) ? trim($_POST['title']) : "";
	$description   = isset($_POST['description']) ? trim($_POST['description']) : "";
	$keyword       = isset($_POST['keyword']) ? trim($_POST['keyword']) : "";
	
	$catInfo       = getRecord('tbl_raovat', 'id='.$parent);
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
			echo $sql = "update tbl_raovat set name='".$name."',parent='".$parent."',detail='".$detail."',sort='".$sort."', status='".$status."', title='".$title."', description='".$description."', keyword='".$keyword."',last_modified=now() where id='".$oldid."'";
		}else{
			$sql = "insert into tbl_raovat (name, cate , parent , detail, sort, status , title , description , keyword ,  date_added, last_modified  ) values ('".$name."','1','".$parent."','".$detail."','".$sort."','".$title."','".$description."','".$keyword."','1',now(),now())";
		}
		if (mysql_query($sql,$conn)){
			if(empty($_POST['id'])) $oldid = mysql_insert_id();
			$r = getRecord("tbl_raovat","id=".$oldid);
		
			$arrField = array(
			"subject"          => "'".vietdecode($name)."'"
			);// ko them id vao cuoi cho dep
			$result = update("tbl_raovat",$arrField,"id=".$oldid);
			
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
				$sqlUpdate = "update tbl_raovat set $sqlUpdateField where id='".$oldid."'";
				mysql_query($sqlUpdate,$conn);
			}
		}else{
			$errMsg = "Không thể cập nhật !";
		}
	}

	if ($errMsg == '')
		echo '<script>window.location="index.php?act=inforaovat&cat='.$_REQUEST['cat'].'&page='.$_REQUEST['page'].'&code=1"</script>';
}else{
	if (isset($_GET['id'])){
		$oldid=$_GET['id'];
		$page = $_GET['page'];
		$sql = "select * from tbl_raovat where id='".$oldid."'";
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
            <div class="widget-head overview-chart clearfix">
                <span class="h-icon"><i class="gray-icons graph"></i></span>
                <h4 class="pull-left">Tin tức&nbsp;></h4><h4 class="pull-left">Sửa tin </h4>
                <div id="reportrange" class="pull-right tai_form">
                    
                     
                </div>
            </div>
            <div class="widget-container">
                <div class="widget-block">
                    
                   <form method="post" name="frmForm" enctype="multipart/form-data" action="index.php?act=inforaovat_m">



            

            <input type="hidden" name="act" value="inforaovat_m">

            <input type="hidden" name="id" value="<?=$_REQUEST['id']?>">

            <input type="hidden" name="page" value="<?=$_REQUEST['page']?>">

            <div> <? if($errMsg!=''){echo '<p align=center class="err">'.$errMsg.'<br></p>';}?>  </div>

                <table width="100%">

                    <tr>

                        <td valign="middle" width="30%">

                            Tên  <span class="sao_bb">*</span>

                        </td>

                        <td valign="middle" width="70%">

                            <input name="txtName" type="text" class="btn_search" id="txtName" value="<?=$name?>"/>

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

								height:200,

								width:780,

								filebrowserImageBrowseUrl : '../lib/ckfinder/ckfinder.html?Type=Images',

								filebrowserFlashBrowseUrl : '../lib/ckfinder/ckfinder.html?Type=Flash',

								filebrowserImageUploadUrl : '../scripts/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',

								filebrowserFlashUploadUrl : '../scripts/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',									

								fullPage : true

                            }); 

                            </script></td>

                    </tr>

                    <tr>

                        <td valign="middle" width="30%">

                           Thứ tự sắp xếp<span class="sao_bb">*</span>

                        </td>

                        <td valign="middle" width="70%">

                            <input class="btn_search" value="<?=$sort?>" type="text" name="txtSort"  />

                        </td>

                    </tr>

                    <tr>

                        <td valign="middle" width="30%">

                        Hình đại diện</td>

                        <td valign="middle" width="70%">

                            <input type="file" name="txtImage" class="textbox" size="34">

							<input type="checkbox" name="chkClearImg" value="on"> Xóa bỏ hình ảnh	 <br>

							<? if ($image!=''){ echo '<img border="0" width="80" height="80" src="../web/'.$image.'"><br><br>Hình (kích thước nhỏ)';}?>&nbsp;&nbsp;

                            <?  if ($image_large!=''){ echo '<img border="0" src="../web/'.$image_large.'"><br><br>Hình (kích thước lớn)';}?>

                     

                            

                        </td>

                    </tr>

                    <tr>

                        <td valign="middle" width="30%">

                            title  <span class="sao_bb">*</span>

                        </td>

                        <td valign="middle" width="70%">

                            <input name="title" type="text" class="btn_search" id="title" value="<?=$title?>"/>

                        </td>

                    </tr>

                     <tr>

                        <td valign="middle" width="30%">

                            description  <span class="sao_bb">*</span>

                        </td>

                        <td valign="middle" width="70%">

                            <input name="description" type="text" class="btn_search" id="description" value="<?=$description?>"/>

                        </td>

                    </tr>

                    <tr>

                        <td valign="middle" width="30%">

                            keyword  <span class="sao_bb">*</span>

                        </td>

                        <td valign="middle" width="70%">

                            <input name="keyword" type="text" class="btn_search" id="keyword" value="<?=$keyword?>"/>

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