<?php
if(isset($frame)==true){
	check_permiss($_SESSION['kt_login_id'],11,'admin.php');
}else{
	header("location: ../admin.php");
}
?>

<script language="javascript">
function btnSave_onclick(){
    if($('#txtName').val() == ''){
        alert('Bạn chưa nhập "tên" !');
        $('#txtName').focus();
        return false;
    }

    if($('#ddCat').val() == -1){
        alert('Bạn chưa chọn "danh mục"');
        $('#ddCat').focus();
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

	//document.forms.frmForm.elements.txtSubject.value = oEdit0.getHTMLBody();
	document.frmForm.txtDetailShort.focus();
	document.forms.frmForm.elements.txtDetail.value = oEdit2.getHTMLBody();

    return true;
}
</script>



<? $errMsg =''?>
<?

$path = "../web/images/gianhang/item";
$pathdb = "images/gianhang/item";
if (isset($_POST['btnSave'])){
	$code          = isset($_POST['txtCode']) ? trim($_POST['txtCode']) : '';
	$name          = isset($_POST['txtName']) ? trim($_POST['txtName']) : '';
	$price         = isset($_POST['txtPrice']) ? trim($_POST['txtPrice']) : '';
	$pricekm       = isset($_POST['txtPricekm']) ? trim($_POST['txtPricekm']) : '';
    $loaihinh      = isset($_POST['loaihinh']) ? trim($_POST['loaihinh']) : '';
    $description   = isset($_POST['description']) ? trim($_POST['description']) : '';

	$parent        = $_POST['ddCat'];
	$parent1       = $_POST['ddCatch'];
	
	if($parent1==-1) $parent1=211;
	
	$subject       = vietdecode($name);
	$detail_short  = isset($_POST['txtDetailShort']) ? trim($_POST['txtDetailShort']) : '';
	$detail        = isset($_POST['txtDetail']) ? trim($_POST['txtDetail']) : '';
	$link          = isset($_POST['link']) ? trim($_POST['link']) : '';
	$sort          = isset($_POST['txtSort']) ? trim($_POST['txtSort']) : 0;
	$status        = $_POST['chkStatus']!='' ? 1 : 0;
    $title         = isset($_POST['title']) ? trim($_POST['title']) : '';
    $keyword       = isset($_POST['keyword']) ? trim($_POST['keyword']) : '';

    $catInfo       = getRecord('tbl_item', 'id='.$parent);
	if(!$multiLanguage){
		$lang      = $catInfo['lang'];
	}else{
		$lang      = $catInfo['lang'] != '' ? $catInfo['lang'] : $_POST['cmbLang'];
	}

	if ($name=="") echo $errMsg .= "Hãy nhập tên danh mục !<br>";
	$errMsg .= checkUpload($_FILES["txtImage"],".jpg;.gif;.bmp;.png",500*1024,0);
	$errMsg .= checkUpload($_FILES["txtImageLarge"],".jpg;.gif;.bmp;.png",500*1024,0);

	if ($errMsg==''){
		if (!empty($_POST['id'])){
			$oldid = $_POST['id'];
			$sql = "update tbl_item set name='".$name."',parent='".$parent."',parent1='".$parent1."',detail='".$detail."',type='".$loaihinh."',price='".$price."',pricekm='".$pricekm."',sort='".$sort."', status='".$status."', title='".$title."', description='".$description."', keyword='".$keyword."',last_modified=now() where id='".$oldid."'";
		}else{
			$sql = "insert into tbl_item (name, parent, parent1 , detail, type , price , pricekm , sort, status,  date_added, last_modified, style, title, description, keyword  ) values ('".$name."','".$parent."','".$parent1."','".$detail."','".$loaihinh."','".$price."','".$pricekm."','".$sort."','1',now(),now(),'1','".$title."','".$description."','".$keyword."')";
		} 
		if (mysql_query($sql,$conn)){
			if(empty($_POST['id'])) $oldid = mysql_insert_id();
			$r = getRecord("tbl_item","id=".$oldid);
		
			$arrField = array(
			"subject"          => "'".vietdecode($name).$oldid."'"
			);// ko them id vao cuoi cho dep
			$result = update("tbl_item",$arrField,"id=".$oldid);
			
			$sqlUpdateField = "";
			
			if ($_POST['chkClearImg']==''){
				$extsmall=getFileExtention($_FILES['txtImage']['name']);
				if (makeUpload($_FILES['txtImage'],"$path/items$oldid$extsmall")){
					@chmod("$path/items$oldid$extsmall", 0777);
					$sqlUpdateField = " image='$pathdb/items$oldid$extsmall' ";
				}
			}else{
				if(file_exists('../web/'.$r['image'])) @unlink('../web/'.$r['image']);
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
				if(file_exists('../web/'.$r['image_large'])) @unlink('../web/'.$r['image_large']);
				if($sqlUpdateField != "") $sqlUpdateField .= ",";
				$sqlUpdateField .= " image_large='' ";

			}
			
			if($sqlUpdateField!='')	{
				$sqlUpdate = "update tbl_item set $sqlUpdateField where id='".$oldid."'";
				mysql_query($sqlUpdate,$conn);
			}
		}else{
			$errMsg = "Không thể cập nhật !";
		}
	}

	if ($errMsg == ''){
		if($r['type']=="0") echo '<script>window.location="admin.php?act=newuser&cat='.$_REQUEST['cat'].'&page='.$_REQUEST['page'].'&code=1"</script>';
		else  echo '<script>window.location="admin.php?act=newuser&cat='.$_REQUEST['cat'].'&page='.$_REQUEST['page'].'&code=1"</script>'; 
	}
}else{
	if (isset($_GET['id'])){
		$oldid=$_GET['id'];
		$page = $_GET['page'];
		$sql = "select * from tbl_item where id='".$oldid."'";
		if ($result = mysql_query($sql,$conn)) {
			$row=mysql_fetch_array($result);
			$code          = $row['code'];
			$name          = $row['name'];
			
			$parent1        = $row['parent1'];
			$parent         = $row['parent'];
			
			if($parent==2) {
				$parent=$parent1;
				$parent1=-1;
			}
			$idshop        = $row['idshop']; 
			$subject       = $row['subject'];
			$price         = $row['price'];
			$pricekm       = $row['pricekm'];
			$subject       = $row['subject'];
			$detail_short  = $row['detail_short'];
			$link          = $row['link'];
			$loaihinh      = $row['type'];
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
     <? $errMsg =''?>
</div>
<?php }?>
<script>
$(document).ready(function() {
	$("#ddCat").change(function(){ 
		var id=$(this).val();//val(1) gan vao gia tri 1 dung trong form
		var table="tbl_shop_category";
		$("#ddCatch").load("getChild.php?table="+ table + "&id=" +id); //alert(idthanhpho)
	});
});
</script>
<script type="text/javascript" src="../lib/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="../lib/ckfinder/ckfinder.js"></script>
<div class="row-fluid">
    <div class="span12">
        <div class="box-widget">
             
            <div class="widget-container">
                <div class="widget-block">
                    
                   <form method="post" name="frmForm" enctype="multipart/form-data" action="admin.php?act=newuser_m">



            

            <input type="hidden" name="act" value="newuser_m">

            <input type="hidden" name="id" value="<?=$_REQUEST['id']?>">

            <input type="hidden" name="page" value="<?=$_REQUEST['page']?>">

            <div> <? if($errMsg!=''){echo '<p align=center class="err">'.$errMsg.'<br></p>';}?>  </div>

                 <table  class="table_chinh">

                    <tr>
                      <td class="table_chu_tieude_them" colspan="2" align="center" valign="middle"  >TIN TỨC</td>
                  </tr>
                    <tr>
                      <td valign="middle"  class="table_chu">&nbsp;</td>
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
			
                      <td valign="middle"  class="table_chu">Danh mục<span class="sao_bb">*</span></td>

                      <td valign="middle"><select name="ddCat" id="ddCat" class="table_list">
                        <?php if($_POST['ddCat']!=NULL){ ?>
                        <option value="<?php echo $idtheloaic=$_POST['ddCat'] ; ?>"><?php echo get_field('tbl_shop_category','id',$parent,'name'); ?></option>
                        <?php }?>
                        <?php if($parent!=-1 && $parent!=""){?>
                         <option value="<?php echo $parent ?>"><?php echo get_field('tbl_shop_category','id',$parent,'name'); ?></option>
                         <?php }?>
                        <option value="-1" <?php if($parent==-1) echo 'selected="selected"';?> > Chọn danh mục </option>
						<?php   
                        $gt=get_records("tbl_shop_category","parent=211 and status=0 ","id DESC"," "," "); //and (idshop='{$idshop}' or '{$idshop}'=-1)
                        while($row=mysql_fetch_assoc($gt)){?>
                        <option value="<?php echo $row['id']; ?>" <?php if($parent==$row['id']) echo 'selected="selected"';?> ><?php echo $row['name']; ?></option>
                        <?php } ?>
                      </select></td>

                    </tr>

                    <tr>
                      <td height="31" valign="middle" class="table_chu">Danh mục con</td>
                      <td valign="middle"> 
                        <select name="ddCatch" id="ddCatch" class="table_list">
                          <?php if($_POST['ddCatch']!=NULL && $_POST['ddCatch']!=-1 ){ ?>
                          <option value="<?php echo $parent1=$_POST['ddCatch'] ; ?>"><?php echo get_field('tbl_shop_category','id',$parent1,'name'); ?></option>
                          <?php }?>
                           <?php if($parent1!=-1 && $parent1!=""){?>
                          <option value="<?php echo $parent1 ?>"><?php echo get_field('tbl_shop_category','id',$parent1,'name'); ?></option>
                          <?php }?>
                          <option value="-1"> Chọn danh mục con </option>
                        </select>
                       </td>
                    </tr>

                    <tr>

                      <td valign="middle">Tóm tắt</td>

                      <td valign="middle">&nbsp;</td>

                    </tr>

                    <tr>

                      <td colspan="2" valign="middle"><textarea name="txtDetailShort"  style="width:780px; height:150px;" id="txtDetailShort"><?php echo $detail_short;?></textarea></td>

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

                        <td valign="middle" width="30%">

                           Thứ tự sắp xếp

                        </td>

                        <td valign="middle" width="70%">

                            <input class="table_khungnho" value="<?=$sort?>" type="text" name="txtSort" id="txtSort"  />

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

                            Tiêu đề  <span class="sao_bb">*</span>

                        </td>

                        <td valign="middle" width="70%">

                            <input name="title" type="text" class="table_khungnho" id="title" value="<?=$title?>"/>

                        </td>

                    </tr>

                     <tr>

                        <td valign="middle" width="30%">

                            Mô tả  <span class="sao_bb">*</span>

                        </td>

                        <td valign="middle" width="70%">

                            <input name="description" type="text" class="table_khungnho" id="description" value="<?=$description?>"/>

                        </td>

                    </tr>

                    <tr>

                        <td valign="middle" width="30%">

                            Từ khóa tìm kiếm  <span class="sao_bb">*</span>

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