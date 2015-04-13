<?php
if(isset($frame)==true){
	check_permiss($_SESSION['kt_login_id'],13,'admin.php');
}else{
	header("location: ../admin.php");
}
?>

<? $errMsg =''?>


<? $errMsg =''?>
<?

$path = "../batdongsan/images/video";
$pathdb = "images/video";
if (isset($_POST['btnSave'])){
	$code          = isset($_POST['txtCode']) ? trim($_POST['txtCode']) : '';
	$name          = $_POST['txtName'];

	$parent        = $_POST['ddCat'];
	$parent1       = $_POST['ddCat1'];
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
	$link          = isset($_POST['link']) ? trim($_POST['link']) : '';
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
	
	$dienthoai      = isset($_POST['dienthoai']) ? trim($_POST['dienthoai']) : '';
	$email          = isset($_POST['email']) ? trim($_POST['email']) : '';
	$diachi         = isset($_POST['diachi']) ? trim($_POST['diachi']) : '';
	$khachhang      = isset($_POST['khachhang']) ? trim($_POST['khachhang']) : '';
	$donvi          = isset($_POST['donvi']) ? trim($_POST['donvi']) : '';
	$dientich       = isset($_POST['dientich']) ? trim($_POST['dientich']) : '';
	$huong          = isset($_POST['huong']) ? trim($_POST['huong']) : '';
	$phaply         = isset($_POST['phaply']) ? trim($_POST['phaply']) : '';
	$dtkhuonvien    = isset($_POST['dtkhuonvien']) ? trim($_POST['dtkhuonvien']) : '';
	$solau          = isset($_POST['solau']) ? trim($_POST['solau']) : '';
	$sophong        = isset($_POST['sophong']) ? trim($_POST['sophong']) : '';
	$namxaydung     = isset($_POST['namxaydung']) ? trim($_POST['namxaydung']) : '';
	$raoban_thue     = isset($_POST['raoban_thue']) ? trim($_POST['raoban_thue']) : '';
    $loai            = isset($_POST['loai']) ? trim($_POST['loai']) : '';
	
 
	
	$name          = mysql_real_escape_string($name);;
	

	if ($name=="") $errMsg .= "Hãy nhập tiêu đề rao vặt !<br>";
	if ($detail=="") $errMsg .= "Hãy nhập nội dung rao vặt !<br>";
	if ($parent=="") $errMsg .= "Hãy chọn ít nhất một chuyên mục!<br>";
 
	
	$aa=0;
	if(isset($_POST['id']))if(get_field("tbl_rv_video","name",$name,"id")!="" && $_POST['id']!=get_field("tbl_rv_video","name",$name,"id")) $aa=1;

	if ($errMsg==''){
		if (!empty($_POST['id'])){
			$oldid = $_POST['id'];
			  $sql = "update tbl_rv_video set idshop='".$idshop."',detail_short='".$detail_short."',detail='".$detail."',name='".$name."', link='".$link."',  last_modified=now() where id='".$oldid."'";
		}else{
			  $sql = "insert into tbl_rv_video ( idshop , name, detail_short , detail , link, status , date_added, last_modified ) values ('".$idshop."','".$name."','".$detail_short."','".$detail."','".$link."','1',now(),now()  )";
		}
		if (mysql_query($sql,$conn)){
			if(empty($_POST['id'])) $oldid = mysql_insert_id();
			$r = getRecord("tbl_rv_video","id=".$oldid);
		
			$arrField = array(
			"subject"          => "'".vietdecode($name).$oldid."'"
			);// ko them id vao cuoi cho dep
			$result = update("tbl_rv_video",$arrField,"id=".$oldid);
					
			 
			
			if ($_POST['chkClearImg']==''){
				$extsmall=getFileExtention($_FILES['txtImage']['name']);
				if (makeUpload($_FILES['txtImage'],"$path/infos$oldid$extsmall")){
					@chmod("$path/infos$oldid$extsmall", 0777);
					$sqlUpdateField = " image='$pathdb/infos$oldid$extsmall' ";
				}
			}else{
				if(file_exists('../batdongsan/'.$r['image'])) @unlink('../batdongsan/'.$r['image']);
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
				if(file_exists('../batdongsan/'.$r['image_large'])) @unlink('../batdongsan/'.$r['image_large']);
				if($sqlUpdateField != "") $sqlUpdateField .= ",";
				$sqlUpdateField .= " image_large='' ";
			}
			
			if($sqlUpdateField!='')	{
				$sqlUpdate = "update tbl_rv_video set $sqlUpdateField where id='".$oldid."'";
				mysql_query($sqlUpdate,$conn);
			}
		}else{
			$errMsg = "Không thể cập nhật !";
		}
	}

	if ($errMsg == '')
		 echo '<script>window.location="admin.php?act=video&cat='.$_REQUEST['cat'].'&page='.$_REQUEST['page'].'&code=1"</script>' ;
}else{
	if (isset($_GET['id'])){
		$oldid=$_GET['id'];
		$page = $_GET['page'];
		$sql = "select * from tbl_rv_video where id='".$oldid."'";
		if ($result = mysql_query($sql,$conn)) {
			$row=mysql_fetch_array($result);
			$code          = $row['code'];
			$name          = mysql_real_escape_string($row['name']);;
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
			

			$tinh          =$row['idcity'];
			$parent        =$row['parent'];
			$loaihinh      =$row['type'];
			$nhucau        =$row['nhucau'];
			$price         =$row['price'];
			
			$dienthoai     =$row['dienthoai'];
			$email         =$row['email'];
			$diachi        =$row['diachi']; 
			$khachhang     =$row['khachhang'];
			$donvi         =$row['donvi'];
			$dientich      =$row['dientich'];
			$huong         =$row['huong'];
			$phaply        =$row['tinhtrangphaply'];
			$dtkhuonvien   =$row['dtkhuonvien'];
			$solau         =$row['solau'];
			$sophong       =$row['sophong'];
			$namxaydung    =$row['namxaydung'];
			$dacdiemkhac    =$row['dacdiemkhac'];
			$raoban_thue    =$row['raoban_thue'];
			$loai           =$row['catebatdongsan_news'];
			$link           =$row['link'];
		}
	}
}

?>
<?php
	if( $errMsg !=""){ 
?>
<style type="text/css">
.table_khungnho2 {	background:#f2f2f2; 
	border:1px solid #ccc; 
	width:290px; height:24px; 
	line-height:22px; 
	padding:0 5px;
}
.table_chu {color: #000; width: 200px; font-size:12px; font-weight:normal;}

</style>

<div class="alert alert-block no-radius fade in">
    <button type="button" class="close" data-dismiss="alert"><span class="mini-icon cross_c"></span></button>
    <h4>Warning!</h4>
     <? echo $errMsg ;?>
</div>
<?php }?>
<style type="text/css">
 
.ddk {
	width:778px;
	color:#2d2d2d;
	background:#ffffff;
	margin-right: auto;
	margin-left: auto;
}
.ddk_box{
	float:left;
	width:154px;
	border-right:1px solid #d3d3d3;
}
.ddk_row1{
	float:left;
	width:147px;
	color:#2d2d2d;
	height:23px;
	padding:5px 2px 0 5px;
	background: #f5f6f5;
}
.ddk_row2{
	float:left;
	width:149px;
	color:#2d2d2d;
	height:23px;
	padding:5px 0 0 5px;
	background: #ffffff;
}
.ddk_column{
	float: left;
	width:133px;
}
.ddk_column1{
	float: left;
	width:10px;
}
.ddk_chexbox{
	margin:2px 0 0 0;
	text-align:right;
}
.warning_type_batdongsan_news {
	clear: both;
	float: none;
	text-align: center;
	color: #F00;
	font-size: 12px;
	font-style: italic;
	font-weight: normal;
}
.dtcln_title1 {
	clear: both;
	float: none;
	text-align: center;
	padding-top: 5px;
	padding-bottom: 5px;
	font-weight: bold;
	color: #000;
	background-color: #EBEBEB;
	font-size: 14px;
}

 
</style>
<script type="text/javascript" src="../lib/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="../lib/ckfinder/ckfinder.js"></script>
<div class="row-fluid">
    <div class="span12">
        <div class="box-widget">
             
            <div class="widget-container">
                <div class="widget-block">
                    
                   <form method="post" name="frmForm" enctype="multipart/form-data" action="admin.php?act=batdongsan_news_m">



            

            <input type="hidden" name="act" value="video_m">

            <input type="hidden" name="id" value="<?=$_REQUEST['id']?>">

            <input type="hidden" name="page" value="<?=$_REQUEST['page']?>">

            <div> <? if($errMsg!=''){echo '<p align=center class="err">'.$errMsg.'<br></p>';}?>  </div>

                <table  class="table_chinh">
                     <tr>
                      <td class="table_chu_tieude_them" colspan="2" align="center" valign="middle"  >RAO VẶT BẤT ĐỘNG SẢN</td>
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
                      <td valign="middle">Link</td>
                      <td valign="middle"><input name="link" type="text" class="table_khungnho" id="link" value="<?=$link?>"/></td>
                  </tr>
                  <tr>

                      <td valign="middle">Tóm tắt</td>

                      <td valign="middle">&nbsp;</td>

                    </tr>

                    <tr>

                      <td colspan="2" valign="middle"><textarea name="detail_short"  style="width:780px; height:150px;" id="detail_short"><?php echo $detail_short;?></textarea>
                       
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
                      <td valign="middle">&nbsp;</td>
                      <td valign="middle">&nbsp;</td>
                    </tr>
                    <tr>

                        <td valign="middle" width="30%">

                        Hình đại diện</td>

                        <td valign="middle" width="70%">

                            <input type="file" name="txtImage" class="textbox" size="34">

							<input type="checkbox" name="chkClearImg" value="on"> Xóa bỏ hình ảnh	 <br>

							<? if ($image!=''){ echo '<img border="0" width="80" height="80" src="../'.$image.'"><br><br>Hình (kích thước nhỏ)';}?>&nbsp;&nbsp;

                            <?  if ($image_large!=''){ echo '<img border="0" src="../'.$image_large.'"><br><br>Hình (kích thước lớn)';}?>

                     

                            

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