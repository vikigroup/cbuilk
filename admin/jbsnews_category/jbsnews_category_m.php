<?php
if(isset($frame)==true){
	check_permiss($_SESSION['kt_login_id'],12,'index.php');
}else{
	header("location: ../index.php");
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

$path = "../web/images/item";
$pathdb = "images/item";
if (isset($_POST['btnSave'])){
	$code          = isset($_POST['txtCode']) ? trim($_POST['txtCode']) : '';
	$name          = isset($_POST['txtName']) ? trim($_POST['txtName']) : '';
	$type          = isset($_POST['type']) ? trim($_POST['type']) : '';
	$parent        = $_POST['ddCat'];
	$subject       = vietdecode($name);
	$detail_short  = isset($_POST['txtDetailShort']) ? trim($_POST['txtDetailShort']) : '';
	$detail        = isset($_POST['txtDetail']) ? trim($_POST['txtDetail']) : '';
	$sort          = isset($_POST['txtSort']) ? trim($_POST['txtSort']) : 0;
	$status        = $_POST['chkStatus']!='' ? 1 : 0;
	
	$title         = isset($_POST['title']) ? trim($_POST['title']) : "";
	$description   = isset($_POST['description']) ? trim($_POST['description']) : "";
	$keyword       = isset($_POST['keyword']) ? trim($_POST['keyword']) : "";
	
	$catInfo       = getRecord('jbs_news_category', 'id='.$parent);
	if(!$multiLanguage){
		$lang      = $catInfo['lang'];
	}else{
		$lang      = $catInfo['lang'] != '' ? $catInfo['lang'] : $_POST['cmbLang'];
	}

	if ($name=="") $errMsg .= "Hãy nhập tên danh mục !<br>";
	//if($parent=="" || $parent < 2) $errMsg .="Bạn chưa chọn danh mục!";
	if($parent=="" || $parent < 2) $parent=2;
	$errMsg .= checkUpload($_FILES["txtImage"],".jpg;.gif;.bmp",500*1024,0);
	$errMsg .= checkUpload($_FILES["txtImageLarge"],".jpg;.gif;.bmp",500*1024,0);

	if ($errMsg==''){
		if (!empty($_POST['id'])){
			$oldid = $_POST['id'];
			$sql = "update jbs_news_category set code='".$code."',type='".$type."',name='".$name."', parent='".$parent."',subject='".$subject."',detail_short='".$detail_short."',detail='".$detail."', sort='".$sort."', title='".$title."', description='".$description."', keyword='".$keyword."', status='".$status."',last_modified=now(), lang='".$lang."' where id='".$oldid."'";
		}else{
			$sql = "insert into jbs_news_category (code, name, type , parent, subject, detail_short, detail, sort, status, title , description , keyword ,  date_added, last_modified, lang) values ('".$code."','".$name."','".$type."','".$parent."','".$subject."','".$detail_short."','".$detail."','".$sort."','".$title."','".$description."','".$keyword."','1',now(),now(),'".$lang."')";
		}
		if (mysql_query($sql,$conn)){
			if(empty($_POST['id'])) $oldid = mysql_insert_id();
			$r = getRecord("jbs_news_category","id=".$oldid);
		
			$arrField = array(
			"subject"          => "'".vietdecode($name)
			);// ko them id vao cuoi cho dep
			$result = update("jbs_news_category",$arrField,"id=".$oldid);
			
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
				$sqlUpdate = "update jbs_news_category set $sqlUpdateField where id='".$oldid."'";
				mysql_query($sqlUpdate,$conn);
			}
		}else{
			$errMsg = "Không thể cập nhật !";
		}
	}

	if ($errMsg == '')
	  echo '<script>window.location="admin.php?act=jbsnews_category&cat='.$_REQUEST['cat'].'&page='.$_REQUEST['page'].'&code=1"</script>';
}else{
	if (isset($_GET['id'])){
		$oldid=$_GET['id'];
		$page = $_GET['page'];
		$sql = "select * from jbs_news_category where id='".$oldid."'";
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
			$type          = $row['type'];
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
<div class="row-fluid">
    <div class="span12">
        <div class="box-widget">
             
            <div class="widget-container">
                <div class="widget-block">
                    
                   <form method="post" name="frmForm" enctype="multipart/form-data" action="admin.php?act=jbsnews_category_m">
                        <input type="hidden" name="txtSubject" id="txtSubject">
                        <input type="hidden" name="txtDetailShort" id="txtDetailShort">
                        <input type="hidden" name="txtDetail" id="txtDetail">
                        
                        <input type="hidden" name="act" value="jbsnews_category_m">
                        <input type="hidden" name="id" value="<?=$_REQUEST['id']?>">
                        <input type="hidden" name="page" value="<?=$_REQUEST['page']?>">
                       
                            <table  class="table_chinh">
                            	<tr>
                                  <td class="table_chu_tieude_them" colspan="2" align="center" valign="middle"  >DANH MỤC TIN TỨC</td>
                              </tr>
                                <tr>
                                  <td valign="middle"  class="table_chu">&nbsp;</td>
                                  <td valign="middle">&nbsp;</td>
                                </tr>
                                <tr>
                                  <td valign="middle">Thuộc danh mục<span class="sao_bb">*</span></td>
                                  <td valign="middle">
                                    <? //comboCategory('ddCat',getArrayCategory('jbs_news_category'),'sle_search',$parent,0)?>
                                    <select name="ddCat" id="ddCat" class="table_list"> 
                                        <?php if($_POST['ddCat']!=NULL){ ?>
                                        <option value="<?php echo $idtheloaic=$_POST['ddCat'] ; ?>"><?php echo get_field('jbs_news_category','id',$parent,'name'); ?> </option> 
                                        <?php }?>
                                        
                                        <option value="-1" <?php if($parent==-1) echo 'selected="selected"';?> > Chọn danh mục </option> 
                                        <?php   
                                        $gt=get_records("jbs_news_category","parent=2 and status=0 ","id DESC"," "," ");
                                        while($row=mysql_fetch_assoc($gt)){?>
                                        <option value="<?php echo $row['id']; ?>" <?php if($parent==$row['id']) echo 'selected="selected"';?> ><?php echo $row['name']; ?></option> 
                                        <?php } ?>
                                    
                                    </select>
                                  </td>
                                </tr>
                                <tr>
                                  <td valign="middle">Loại</td>
                                  <td valign="middle"><label for="loai"></label>
                                    <select name="type" id="type" class="table_list">
                                    <option value="0" <?php if($type==0) echo 'selected="selected"';?> > Dịch vụ </option>
                                    <option value="1" <?php if($type==1) echo 'selected="selected"';?>  > Tin tức </option>
                                  </select></td>
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
                                       Thứ tự sắp xếp<span class="sao_bb">*</span>
                                    </td>
                                    <td valign="middle" width="70%">
                                        <input class="table_khungnho" value="<?=$sort?>" type="text" name="txtSort"  />
                                    </td>
                                </tr>
                                <tr>
                                    <td valign="middle" width="30%">
                                        title  <span class="sao_bb">*</span>
                                    </td>
                                    <td valign="middle" width="70%">
                                        <input name="title" type="text" class="table_khungnho" id="title" value="<?=$title?>"/>
                                    </td>
                                </tr>
                                 <tr>
                                    <td valign="middle" width="30%">
                                        description  <span class="sao_bb">*</span>
                                    </td>
                                    <td valign="middle" width="70%">
                                        <input name="description" type="text" class="table_khungnho" id="description" value="<?=$description?>"/>
                                    </td>
                                </tr>
                                <tr>
                                    <td valign="middle" width="30%">
                                        keyword  <span class="sao_bb">*</span>
                                    </td>
                                    <td valign="middle" width="70%">
                                        <input name="keyword" type="text" class="table_khungnho" id="keyword" value="<?=$keyword?>"/>
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