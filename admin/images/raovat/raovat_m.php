<?php
if(isset($frame)==true){
	check_permiss($_SESSION['kt_login_id'],13,'index.php');
}else{
	header("location: ../index.php");
}
?>

<? $errMsg =''?>


<? $errMsg =''?>
<?

$path = "../web/images/rv";
$pathdb = "images/rv";
if (isset($_POST['btnSave'])){
	$code          = isset($_POST['txtCode']) ? trim($_POST['txtCode']) : '';
	$name          = $_POST['txtName'];

	$parent        = $_POST['ddCat'];
	$parent1       = $_POST['ddCatch'];
	
	if($parent1==-1) $parent1=$parent;
	
	$listimage     = $_POST['chk'];
	$cap 		= $_POST['cap'];
	
	$iduser= $_SESSION['kh_login_id'];
	
	if($iduser=="") $iduser="161";
	
	if($parent=="") $parent=2;
	
	$subject       = vietdecode($name);
	$detail_short  = isset($_POST['detail_short']) ? trim($_POST['detail_short']) : '';
	$detail        =  $_POST['txtDetail'];
	$khuyenmai     = isset($_POST['khuyenmai']) ? trim($_POST['khuyenmai']) : '';
	$baohanh        = isset($_POST['baohanh']) ? trim($_POST['baohanh']) : '';
	$mausac        = isset($_POST['mausac']) ? trim($_POST['mausac']) : '';
	$sort          = isset($_POST['txtSort']) ? trim($_POST['txtSort']) : 0;
	$status        = 0;
	$maluc          = isset($_POST['maluc']) ? trim($_POST['maluc']) : '';
	$sit            = isset($_POST['sit']) ? trim($_POST['sit']) : '';
	$title          = isset($_POST['title']) ? trim($_POST['title']) : '';
	$description    = isset($_POST['description']) ? trim($_POST['description']) : '';
	$keyword        = isset($_POST['keyword']) ? trim($_POST['keyword']) : '';
	$price          = isset($_POST['price']) ? trim($_POST['price']) : '';
	$pricekm        = isset($_POST['price2']) ? trim($_POST['price2']) : '';
	$loaihinh       = isset($_POST['loaihinh']) ? trim($_POST['loaihinh']) : '';
	$nhucau         = isset($_POST['nhucau']) ? trim($_POST['nhucau']) : '';
	$tinh           = isset($_POST['tinh']) ? trim($_POST['tinh']) : '';
	
	$user_fullname  = isset($_POST['user_fullname']) ? trim($_POST['user_fullname']) : '';
	$user_email     = isset($_POST['user_email']) ? trim($_POST['user_email']) : '';
	$user_mobile    = isset($_POST['user_mobile']) ? trim($_POST['user_mobile']) : '';
	$user_ym        = isset($_POST['user_ym']) ? trim($_POST['user_ym']) : '';
	
	$name          = mysql_real_escape_string($name);;
	

	if ($name=="") $errMsg .= "Hãy nhập tiêu đề rao vặt !<br>";
	if ($detail=="") $errMsg .= "Hãy nhập nội dung rao vặt !<br>";
	if ($parent=="") $errMsg .= "Hãy chọn ít nhất một chuyên mục!<br>";
	if ($tinh=="") $errMsg .= "Hãy chọn tỉnh thành cần rao!<br>";
	
	$aa=0;
	if(isset($_POST['id']))if(get_field("tbl_raovat","name",$name,"id")!="" && $_POST['id']!=get_field("tbl_raovat","name",$name,"id")) $aa=1;

	if ($errMsg==''){
		if (!empty($_POST['id'])){
			$oldid = $_POST['id'];
			 $sql = "update tbl_raovat set   name='".$name."',parent='".$parent1."',idcity='".$tinh."',detail='".$detail."',type='".$loaihinh."',nhucau='".$nhucau."',price='".$price."',user_fullname='".$user_fullname."',user_mobile='".$user_mobile."',user_email='".$user_email."',user_ym='".$user_ym."',sort='".$sort."', last_modified=now() where id='".$oldid."'";
		}else{
			$sql = "insert into tbl_raovat (code, iduser ,cate , idcity , type , name, parent, nhucau , subject, detail_short, detail , sort, price , user_fullname , user_email , user_mobile , user_ym , title, description , keyword, status , date_added, last_modified, lang) values ('".$code."','".$iduser."',0,'".$tinh."','".$loaihinh."','".$name."','".$parent1."','".$nhucau."','','".$detail_short."','".$detail."','".$sort."','".$price."','".$user_fullname."','".$user_email."','".$user_mobile."','".$user_ym."','".$title."','".$description."','".$keyword."','1',now(),now(),'".$lang."')";
		}
		if (mysql_query($sql,$conn)){
			if(empty($_POST['id'])) $oldid = mysql_insert_id();
			$r = getRecord("tbl_raovat","id=".$oldid);
					
			if($aa==1){
				$arrField = array(
				"subject"          => "'".cat_kytu_dacbiet(str_replace("sym", "SYM",$name),1,1,0,1,1)."-".$oldid."'"
				);// ko them id vao cuoi cho dep	
			}else{
				$arrField = array(
				"subject"          => "'".cat_kytu_dacbiet(str_replace("sym", "Sym",$name),1,1,0,1,1)."'"
				);// ko them id vao cuoi cho dep
			}
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
		echo '<script>window.location="index.php?act=raovat&cat='.$_REQUEST['cat'].'&page='.$_REQUEST['page'].'&code=1"</script>';
}else{
	if (isset($_GET['id'])){
		$oldid=$_GET['id'];
		$page = $_GET['page'];
		$sql = "select * from tbl_raovat where id='".$oldid."'";
		if ($result = mysql_query($sql,$conn)) {
			$row=mysql_fetch_array($result);
			$code          = $row['code'];
			$name          = mysql_real_escape_string($row['name']);;
			
			$parent1        = $row['parent'];
			$parent         = get_field('tbl_raovat_category','id',$parent1,'parent');
			
			if($parent==2) {
				$parent=$parent1;
				$parent1=-1;
			}
			
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
			

			$tinh          =$row['idcity'];
			$parent        =$row['parent'];
			$loaihinh      =$row['type'];
			$nhucau        =$row['nhucau'];
			$price         =$row['price'];
			
			$user_fullname =$row['user_fullname'];
			$user_email    =$row['user_email'];
			$user_ym       =$row['user_ym']; 
			$user_mobile   =$row['user_mobile'];
			
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
     <? echo $errMsg ;?>
</div>
<?php }?>
<script>
$(document).ready(function() {
	$("#ddCat").change(function(){ 
		var id=$(this).val();//val(1) gan vao gia tri 1 dung trong form
		var table="tbl_raovat_category";
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
                    
                   <form method="post" name="frmForm" enctype="multipart/form-data" action="index.php?act=raovat_m">



            

            <input type="hidden" name="act" value="raovat_m">

            <input type="hidden" name="id" value="<?=$_REQUEST['id']?>">

            <input type="hidden" name="page" value="<?=$_REQUEST['page']?>">

            <div> <? if($errMsg!=''){echo '<p align=center class="err">'.$errMsg.'<br></p>';}?>  </div>

                <table  class="table_chinh">

                    <tr>
                      <td class="table_chu_tieude_them" colspan="2" align="center" valign="middle"  >TIN TAO VẶT</td>
                  	</tr>
                    <tr>
                      <td valign="middle"  class="table_chu">&nbsp;</td>
                      <td valign="middle">&nbsp;</td>
                    </tr>
                    <tr>

                      <td valign="middle"  class="table_chu">Danh mục<span class="sao_bb">*</span></td>

                      <td valign="middle"><select name="ddCat" id="ddCat" class="table_list">
                        <?php if($_POST['ddCat']!=NULL){ ?>
                        <option value="<?php echo $idtheloaic=$_POST['ddCat'] ; ?>"><?php echo get_field('tbl_raovat_category','id',$parent,'name'); ?></option>
                        <?php }?>
                        <?php if($parent!=-1 && $parent!=""){?>
                         <option value="<?php echo $parent ?>"><?php echo get_field('tbl_raovat_category','id',$parent,'name'); ?></option>
                         <?php }?>
                        <option value="-1" <?php if($parent==-1) echo 'selected="selected"';?> > Chọn danh mục </option>
						<?php   
                        $gt=get_records("tbl_raovat_category","parent=2 and status=0 ","id DESC"," "," ");
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
                          <option value="<?php echo $parent1=$_POST['ddCatch'] ; ?>"><?php echo get_field('tbl_raovat_category','id',$parent1,'name'); ?></option>
                          <?php }?>
                           <?php if($parent1!=-1 && $parent1!=""){?>
                          <option value="<?php echo $parent1 ?>"><?php echo get_field('tbl_raovat_category','id',$parent1,'name'); ?></option>
                          <?php }?>
                          <option value="-1"> Chọn danh mục con </option>
                        </select>
                       </td>
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
                      <td valign="middle">Giá</td>
                      <td valign="middle">
                      <select id="price" name="price" class="table_list"  >  
                         <option value="0" <?php if($price==0) echo 'selected="selected"';?> >Không có giá</option>  
                         <option value="1" <?php if($price==1) echo 'selected="selected"';?>>Dưới 500k</option>  
                         <option value="2" <?php if($price==2) echo 'selected="selected"';?>>500k - 1,5 triệu</option>  
                         <option value="3" <?php if($price==3) echo 'selected="selected"';?>>1,5 - 3 triệu</option>  
                         <option value="4" <?php if($price==4) echo 'selected="selected"';?> >3 - 6 triệu</option>  
                         <option value="5" <?php if($price==5) echo 'selected="selected"';?>>6 - 10 triệu</option>  
                         <option value="6" <?php if($price==6) echo 'selected="selected"';?>>Trên 10 triệu</option>  
                     </select>
                      </td>
                    </tr>
                  <tr>
                      <td valign="middle">Loại tin</td>
                      <td valign="middle"><span class="mb_tdrow2">
                        <select name="nhucau" id="nhucau" class="table_list"  >
                          <option value="1" <?php if($nhucau==1) echo 'selected="selected"';?>>Mua</option>
                          <option value="2" <?php if($nhucau==2) echo 'selected="selected"';?>>Bán</option>
                          <option value="3" <?php if($nhucau==3) echo 'selected="selected"';?>>Rao vặt</option>
                          <option value="4" <?php if($nhucau==4) echo 'selected="selected"';?>>Quảng cáo</option>
                          <option value="5" <?php if($nhucau==5) echo 'selected="selected"';?>>Sự kiện</option>
                        </select>
                      </span></td>
                    </tr>
                    <tr>
                      <td valign="middle">Tỉnh/Thành</td>
                      <td valign="middle"><span class="mb_tdrow2">
                        <select  id="tinh" name="tinh" class="table_list">
                          <option value="0">- Chọn Tỉnh/Thành -</option>
                          <option value="100" <?php if($tinh==100) echo 'selected="selected"';?>> Toàn quốc</option>
                          <?php
                        $cate=get_records("tbl_quanhuyen_category","status=1"," "," "," ");
                        while($row_cate=mysql_fetch_assoc($cate)){
                        ?>
                          <option value="<?php echo $row_cate['id']?>" <?php if($tinh==$row_cate['id']) echo 'selected="selected"';?>> <?php echo $row_cate['name']?></option>
                          <?php }?>
                        </select>
                      </span></td>
                    </tr>
                    <tr>

                      <td valign="middle">Nội dung</td>

                      <td valign="middle">&nbsp;</td>

                    </tr>

                    <tr>

                      <td colspan="2" valign="middle"><textarea name="txtDetail"   id="txtDetail" style=" width:100%;"><?php echo $detail?></textarea>

                      <script type="text/javascript">

                            var editor = CKEDITOR.replace( 'txtDetail',

                            {

								height:200,

								filebrowserImageBrowseUrl : '../lib/ckfinder/ckfinder.html?Type=Images',

								filebrowserFlashBrowseUrl : '../lib/ckfinder/ckfinder.html?Type=Flash',

								filebrowserImageUploadUrl : '../lib/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',

								filebrowserFlashUploadUrl : '../lib/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',									

								fullPage : true

                            }); 

                            </script></td>

                    </tr>

                    <tr>
                      <td valign="middle">Tên liên hệ</td>
                      <td valign="middle"><span class="mb_tdrow2">
                        <input type="text" value="<?php echo $user_fullname;?>"  size="47" id="user_fullname" name="user_fullname" style="width: 300px;" class="table_khungnho" />
                      </span></td>
                    </tr>
                    <tr>
                      <td valign="middle">Email</td>
                      <td valign="middle"><span class="mb_tdrow2">
                        <input type="text" size="45" id="user_email" name="user_email" style="width: 300px;" class="table_khungnho" value="<?php echo $user_email;?>" />
                      </span></td>
                    </tr>
                    <tr>
                      <td valign="middle">Di động</td>
                      <td valign="middle"><span class="mb_tdrow2">
                        <input type="text" value="<?php echo $user_mobile;?>" size="20" name="user_mobile" style="width: 300px;" class="table_khungnho" />
                      </span></td>
                    </tr>
                    <tr>
                      <td valign="middle">Nick Yahoo</td>
                      <td valign="middle"><span class="mb_tdrow2">
                        <input type="text" size="25" name="user_ym" style="width: 300px;" class="table_khungnho" value="<?php echo $user_ym;?>" />
                      </span></td>
                    </tr>
                    <tr>

                        <td valign="middle" width="30%">

                        Hình đại diện</td>

                        <td valign="middle" width="70%">

                            <input type="file" name="txtImage" class="textbox" size="34">

							<input type="checkbox" name="chkClearImg" value="on"> Xóa bỏ hình ảnh	 <br>

							<? if ($image!=''){ echo '<img border="0" width="80" height="80" src="../raovat/'.$image.'"><br><br>Hình (kích thước nhỏ)';}?>&nbsp;&nbsp;

                            <?  if ($image_large!=''){ echo '<img border="0" src="../raovat/'.$image_large.'"><br><br>Hình (kích thước lớn)';}?>

                     

                            

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