<?php

if(isset($frame)==true){

	check_permiss($_SESSION['kt_login_id'],2,'index.php');

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



$path = "../images/item";

$pathdb = "images/item";

if (isset($_POST['btnSave'])){



	$name          = isset($_POST['name']) ? trim($_POST['name']) : '';

	$parent        = $_POST['ddCat'];
	$parent1       = $_POST['ddCatch'];
	
	if($parent1==-1) $parent1=$parent;

	$iduser        = isset($_POST['iduser']) ? trim($_POST['iduser']) : '';

	$intro         = isset($_POST['intro']) ? trim($_POST['intro']) : '';

	$idtemplate    = isset($_POST['idtemplate']) ? trim($_POST['idtemplate']) : '';

	$domain        = isset($_POST['domain']) ? trim($_POST['domain']) : '';
	
	$domain2        = isset($_POST['domain2']) ? trim($_POST['domain2']) : '';

	$idcity        = isset($_POST['idcity']) ? trim($_POST['idcity']) : '';

	$subject       = isset($_POST['subject']) ? trim($_POST['subject']) : '';

	$address       = isset($_POST['address']) ? trim($_POST['address']) : '';

	$telephone     = isset($_POST['telephone']) ? trim($_POST['telephone']) : '';

	$hotline       = isset($_POST['fax']) ? trim($_POST['fax']) : '';

	$fax           = isset($_POST['hotline']) ? trim($_POST['hotline']) : '';

	$email         = isset($_POST['email']) ? trim($_POST['email']) : '';

	$yahoo         = isset($_POST['yahoo']) ? trim($_POST['yahoo']) : '';

	$contact       = isset($_POST['contact']) ? trim($_POST['contact']) : '';

	

	$bg_position   = isset($_POST['bg_position']) ? trim($_POST['bg_position']) : '';

	

	$title         = isset($_POST['title']) ? trim($_POST['title']) : '';

	$description   = isset($_POST['description']) ? trim($_POST['description']) : '';

	$keyword       = isset($_POST['keyword']) ? trim($_POST['keyword']) : '';

	

	$detail        = isset($_POST['module']) ? trim($_POST['module']) : '';

	$sort          = isset($_POST['txtSort']) ? trim($_POST['txtSort']) : 0;

	$status        = $_POST['chkStatus']!='' ? 1 : 0;
	
	$dateout         = isset($_POST['dateout']) ? trim($_POST['dateout']) : '';
	
	if($_POST['nam']==1) $dateout1=date("Y-m-d", strtotime($dateout." + 1 year"));
	elseif($_POST['nam']==2) $dateout1=date("Y-m-d", strtotime($dateout." + 2 year"));
	elseif($_POST['nam']==3) $dateout1=date("Y-m-d", strtotime($dateout." + 3 year"));
	
	$nam=$_POST['nam'];

	

	$catInfo       = getRecord('tbl_shop', 'id='.$parent);

	if(!$multiLanguage){

		$lang      = $catInfo['lang'];

	}else{

		$lang      = $catInfo['lang'] != '' ? $catInfo['lang'] : $_POST['cmbLang'];

	}


 

	if ($name=="") $errMsg .= "Hãy nhập tên gian hang !<br>";

	if ($subject=="") $errMsg .= "Hãy nhập tên miền !<br>";



	if ($errMsg==''){

		if (!empty($_POST['id'])){

			$oldid = $_POST['id'];
			if($nam!=0) $sql = "update tbl_shop set name='".$name."', intro='".$intro."', parent='".$parent1."', idcity='".$idcity."',subject='".$subject."',domain='".$domain2."',detail='".$detail."',idtemplate='".$idtemplate."',bg_position='".$bg_position."',address='".$address."',telephone='".$telephone."',fax='".$fax."',yahoo='".$yahoo."',email='".$email."',hotline='".$hotline."',contact='".$contact."',title='".$title."',description='".$description."', keyword='".$keyword."', status='".$status."', date_out='".$dateout1."',last_modified=now() where id='".$oldid."'";
			else $sql = "update tbl_shop set name='".$name."', intro='".$intro."', parent='".$parent1."', idcity='".$idcity."',subject='".$subject."',domain='".$domain2."',detail='".$detail."',iduser='".$iduser."',idtemplate='".$idtemplate."',bg_position='".$bg_position."',address='".$address."',telephone='".$telephone."',fax='".$fax."',yahoo='".$yahoo."',email='".$email."',hotline='".$hotline."',contact='".$contact."',title='".$title."',description='".$description."', keyword='".$keyword."', status='".$status."',last_modified=now() where id='".$oldid."'";
		}else{

			$sql = "insert into tbl_shop (name , intro , parent, idcity , subject, domain , detail, iduser , idtemplate ,  bg_position , address , telephone , fax , yahoo , email , hotline , contact , title , description , keyword , status , date_out ,date_added, last_modified) values ('".$name."','".$intro."','".$parent."','".$idcity."','".$subject."','".$domain."','".$detail."','".$iduser."','".$idtemplate."','".$bg_position."','".$address."','".$telephone."','".$fax."','".$yahoo."','".$email."','".$hotline."','".$contact."','".$title."','".$description."','".$keyword."','".$status."','".$dateout1."',now(),now())";

		}

		if (mysql_query($sql,$conn)){

			if(empty($_POST['id'])) $oldid = mysql_insert_id();

			$r = getRecord("tbl_shop","id=".$oldid);

			

			$sqlUpdateField = "";

			

			

			$hinh1=luu_hinh('logo1','../web/','images/gianhang/logo/',$loi);// root chua hinh upload	



			if($loi=='' && $hinh1!="")	{

				$sqlUpdate = "update tbl_shop set logo='".$hinh1."' where id='".$oldid."'";

				if(mysql_query($sqlUpdate,$conn))

					if(file_exists('../web/'.$r['logo'])) @unlink('../web/'.$r['logo']);

			}

			

			$hinh2=luu_hinh('background1','../web/','images/gianhang/background/',$loi);// root chua hinh upload	



			if($loi=='' && $hinh2!="")	{

				$sqlUpdate = "update tbl_shop set background='".$hinh2."' where id='".$oldid."'";

				if(mysql_query($sqlUpdate,$conn))

					if(file_exists('../web/'.$r['background'])) @unlink('../web/'.$r['background']);

			}

			

			$banner=luu_hinh_flash('banner','../web/','images/gianhang/banner/',$loi);// root chua hinh upload	



			if($loi=='' && $banner!="")	{

				$sqlUpdate = "update tbl_shop set banner='".$banner."' where id='".$oldid."'";

				if(mysql_query($sqlUpdate,$conn))

					if(file_exists('../web/'.$r['banner'])) @unlink('../web/'.$r['banner']);

			}

			

		}else{

			$errMsg = "Không thể cập nhật !";

		}

	}



	if ($errMsg == '')

		echo '<script>window.location="admin.php?act=shop&cat='.$_REQUEST['cat'].'&page='.$_REQUEST['page'].'&code=1"</script>';

}else{

	if (isset($_GET['id'])){

		$oldid=$_GET['id'];

		$page = $_GET['page'];

		$sql = "select * from tbl_shop where id='".$oldid."'";

		if ($result = mysql_query($sql,$conn)) {

			$row=mysql_fetch_array($result);

			$name          = $row['name'];

			$parent1        = $row['parent'];
			$parent         = get_field('jbs_news_category','id',$parent1,'parent');
			
			if($parent==2) {
				$parent=$parent1;
				$parent1=-1;
			}

			$subject       = $row['subject'];

			$domain        = $row['domain'];

			$iduser        = $row['iduser'];

			$intro         = $row['intro'];

			$idcity        = $row['idcity'];

			$idtemplate    = $row['idtemplate'];

			$module       = $row['detail'];

			

			$bg_position       = $row['bg_position'];

			

			$address       = $row['address'];

			$telephone     = $row['telephone'];

			$fax           = $row['fax'];

			$yahoo         = $row['yahoo'];

			$email         = $row['email'];

			$hotline       = $row['hotline'];

			$conract       = $row['conract'];

			

			$title         = $row['title'];

			$description    = $row['description'];

			$keyword       = $row['keyword'];



			$status        = $row['status'];

			$date_added    = $row['date_added'];

			$last_modified = $row['last_modified'];

		}

	}

}



?>

<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script type="text/javascript" src="../lib/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="../lib/ckfinder/ckfinder.js"></script>
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
             
            <style>
				table tr td { text-indent:5px;}
			</style>
            <div class="widget-container">
                <div class="widget-block" style="width:800px;">
                    
                   <form method="post" name="frmForm" enctype="multipart/form-data" action="admin.php?act=shop_m">         

                        <input type="hidden" name="act" value="shop_m">
            
                        <input type="hidden" name="id" value="<?=$_REQUEST['id']?>">
            
                        <input type="hidden" name="page" value="<?=$_REQUEST['page']?>">
            
                        <div> <? if($errMsg!=''){echo '<p align=center class="err">'.$errMsg.'<br></p>';}?>  </div>
                        
                     <table style="width:800px;">
                            <tr>
                              <td class="table_chu_tieude_them" colspan="2" align="center" valign="middle"  >THÔNG TIN SHOP</td>
                            </tr>
                        </table>
                        
            			<div style="width:400px; float:left;">
                            <table class="table_chinh" width="400" style="float:left;">
                                  
                                 
                                <tr>
            
                                  <td valign="middle">Thành viên <span class="sao_bb">*</span></td>
            
                                  <td valign="middle"><span class="table_khung">
            
                                    <select name="iduser" id="iduser" class="table_list">
            
                                       <?php  
            
                                    $sql="SELECT * FROM tbl_customer WHERE status=1";
            
                                    $gt=mysql_query($sql) or die(mysql_error());
            
                                    while ($row=mysql_fetch_assoc($gt)){?>
            
                                      <option value="<?php echo $row['id']; ?>"  <?php if($iduser==$row['id']) echo 'selected="selected"';?> ><?php echo $row['username']; ?></option>
            
                                      <?php } ?>
            
                                    </select>
            
                                  </span></td>
            
                                </tr>
            
                                <tr>
            
                                    <td valign="middle" width="30%">
            
                                        Tên shop <span class="sao_bb">*</span>
            
                                    </td>
            
                                    <td valign="middle" width="70%">
            
                                        <input name="name" type="text" class="table_khungnho" id="name" value="<?=$name?>"/>
            
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
                                    $gt=get_records("tbl_shop_category","parent=2 and status=0 ","id DESC"," "," ");
                                    while($row=mysql_fetch_assoc($gt)){?>
                                    <option value="<?php echo $row['id']; ?>" <?php if($parent==$row['id']) echo 'selected="selected"';?> ><?php echo $row['name']; ?></option>
                                    <?php } ?>
                                  </select></td>
            
                                </tr>
            
                                <tr>
                                  <td height="31" valign="middle" class="table_chu">DM con</td>
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
            
                                  <td valign="middle">Loai</td>
            
                                  <td valign="middle"><span class="table_khung">
            
                                    <select name="intro" id="intro" class="table_list">
            
                                      <option value="0" <?php if($intro==0) echo 'selected="selected"';?>  >Sản phẩm - TMDT</option>
            
                                      <option value="1" <?php if($intro==1) echo 'selected="selected"';?>>Giới thiệu doanh nghiệp</option>
            
                                    </select>
            
                                  </span></td>
            
                                </tr>
            
                                <tr>
            
                                  <td valign="middle">Giao dien</td>
            
                                  <td valign="middle"><span class="table_khung">
            
                                    <select name="idtemplate" id="idtemplate" class="table_list">
            
                                      <?php  
            
                                    $sql="SELECT * FROM tbl_template WHERE status=1";
            
                                    $gt=mysql_query($sql) or die(mysql_error());
            
                                    while ($row=mysql_fetch_assoc($gt)){?>
            
                                      <option value="<?php echo $row['id']; ?>"  <?php if($idtemplate==$row['id']) echo 'selected="selected"';?> ><?php echo $row['name']; ?></option>
            
                                      <?php } ?>
            
                                    </select>
            
                                  </span></td>
            
                                </tr>
            
                                <tr>
            
                                  <td valign="middle">Thành phố</td>
            
                                  <td valign="middle"><span class="table_khung">
            
                                    <select name="idcity" id="idcity" class="table_list">
            
                                      <?php if($_POST['idthanhpho']!=NULL){ ?>
            
                                      <option value="<?php echo $idthanhphorvlay=$_POST['idthanhpho'] ; ?>">
            
                                        <?php  echo get_field('tbl_quanhuyen_category','id',$idthanhphorvlay,'name');  ?>
            
                                      </option>
            
                                      <?php }?>
            
                                      <option value=""> Chọn thành phố </option>
            
                                      <?php  
            
                                    $sql="SELECT *
            
                                    FROM tbl_quanhuyen_category
            
                                    WHERE status=1";
            
                                    $gt=mysql_query($sql) or die(mysql_error());
            
                                    while ($row=mysql_fetch_assoc($gt)){?>
            
                                      <option value="<?php echo $row['id']; ?>"  <?php if($idcity==$row['id']) echo 'selected="selected"';?> ><?php echo $row['name']; ?></option>
            
                                      <?php } ?>
            
                                    </select>
            
                                  </span></td>
            
                                </tr>
            
                                <tr>
            
                                  <td valign="middle"> Tên miền <span class="sao_bb">*</span></td>
            
                                  <td valign="middle"><input name="subject" type="text" class="table_khungnho" id="subject" value="<?=$subject?>"/></td>
            
                                </tr>
            
                            </table>
            			</div>
            			<div style="width:400px; float:left;">
                            <table width="400" style="float:left;">
            					 <tr class="table_chinh">
            					   <td height="34" align="right" valign="middle"> Domain</td>
            					   <td valign="middle"><input name="domain2" type="text" class="table_khungnho" id="domain2" value="<?=$domain?>"/></td>
          					   </tr>
            					 <tr>
            
                                  <td width="30%" align="right" valign="middle">Hotline</td>
            
                                  <td width="70%" valign="middle"><input name="hotline" type="text" class="table_khungnho" id="hotline" value="<?=$hotline?>"/></td>
            
                              </tr>
            
                                <tr>
            
                                  <td align="right" valign="middle">Liên hệ</td>
            
                                  <td valign="middle"><input name="contact" type="text" class="table_khungnho" id="contact" value="<?=$contact?>"/></td>
            
                                </tr>
            
                                <tr>
                                  <td align="right" valign="middle">Ngày hết</td>
                                  <td valign="middle">
                                  <input name="dateout" type="text" class="table_khungnho" id="dateout" value="<?=$dateout;?>" style="width:200px;" /><select name="nam" id="nam" class="sle_search">
                                    <option value="0"> Chọn số năm   </option>
                                    <option value="1"> 1 năm  </option>
                                    <option value="2"> 2 năm  </option>
                                    <option value="3"> 3 năm  </option>
                                  </select>
                                   <script>
                                    $(function() {
                                        $( "#dateout" ).datepicker();
                                    });
                                    </script>
                                  </td>
                                </tr>
                                
            
                                
            
                              
            
                                
            
                                
                              <tr class="table_chinh">
                                  <td align="right" valign="middle">Địa chỉ</td>
                                  <td valign="middle"><input name="address" type="text" class="table_khungnho" id="address" value="<?=$address?>"/></td>
                              </tr>
                              <tr class="table_chinh">
                                <td align="right" valign="middle">Điện thoại</td>
                                <td valign="middle"><input name="telephone2" type="text" class="table_khungnho" id="telephone2" value="<?=$telephone?>"/></td>
                              </tr>
                              <tr class="table_chinh">
                                <td align="right" valign="middle">Fax</td>
                                <td valign="middle"><input name="fax2" type="text" class="table_khungnho" id="fax2" value="<?=$fax?>"/></td>
                              </tr>
                              <tr class="table_chinh">
                                <td align="right" valign="middle">Yahoo</td>
                                <td valign="middle"><input name="yahoo2" type="text" class="table_khungnho" id="yahoo2" value="<?=$yahoo?>"/></td>
                              </tr>
                              <tr class="table_chinh">
                                <td align="right" valign="middle">Email</td>
                                <td valign="middle"><input name="email2" type="text" class="table_khungnho" id="email2" value="<?=$email?>"/></td>
                              </tr>
                            </table>    
           			 </div>
                        <br  style="clear:both; float:none;"/>
                        <table>
                        	<tr>
            
                                  <td valign="middle">Giới thiệu</td>
            
                                  <td valign="middle">&nbsp;</td>
            
                          </tr>
            
                            <tr>
            
                                    <td colspan="2" valign="middle">
            
                                    <textarea name="module" class="txt" id="module"><?php echo $module?></textarea>
            
                                      <script type="text/javascript">
            
                                        var editor = CKEDITOR.replace( 'module',
            
                                        {
            
                                            height:200,
            
                                            width:800,
            
                                            filebrowserImageBrowseUrl : '../lib/ckfinder/ckfinder.html?Type=Images',
            
                                            filebrowserFlashBrowseUrl : '../lib/ckfinder/ckfinder.html?Type=Flash',
            
                                            filebrowserImageUploadUrl : '../scripts/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
            
                                            filebrowserFlashUploadUrl : '../scripts/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',									
            
                                            fullPage : true
            
                                        });
            
                                        </script>
            
                                    </td>
            
                          </tr>
                                <tr>
            
                                    <td valign="top" width="30%">
            
                                        Hiển thị</td>
            
                                    <td valign="middle" width="70%">
            
                                        <input type="checkbox" name="chkStatus" value="on" <? if ($status>0) echo 'checked' ?>>
            
                                    </td>
            
                                </tr>
                                <tr>
            
                                    <td valign="middle" width="30%">
            
                                    Logo</td>
            
                                    <td valign="middle" width="70%">
            
                                        <input type="file" name="logo1" class="textbox" size="34" id="logo1">
            
                                         <br>
            
                                        <? if ($image!=''){ echo '<img border="0" src="../'.$image.'"><br><br>Hình (kích thước nhỏ)';}?>&nbsp;&nbsp;
            
                                      
            
                                 
            
                                        
            
                                    </td>
            
                                </tr>
                                <tr>
            
                                  <td valign="middle">Banner</td>
            
                                  <td valign="middle"><input type="file" name="banner" class="textbox" size="34" id="banner" /></td>
            
                          		</tr>
            
                                <tr>
            
                                  <td valign="middle">Hình nền</td>
            
                                  <td valign="middle"><input type="file" name="background1" class="textbox" size="34" id="background1" /></td>
            
                                </tr>
                                <tr>
            
                                  <td valign="middle">&nbsp;</td>
            
                                  <td valign="middle"><span class="table_khung">
            
                                    <select name="bg_position" id="bg_position" class="sle_search">
            
                                      <option value="0" <?php if($bg_position==0) echo 'selected="selected"'; ?> >Lặp ngang</option>
            
                                      <option value="1" <?php if($bg_position==1) echo 'selected="selected"'; ?>>Lặp dọc</option>
            
                                      <option value="2" <?php if($bg_position==2) echo 'selected="selected"'; ?>>Lặp ngang và lặp dọc</option>
            
                                      <option value="3" <?php if($bg_position==3) echo 'selected="selected"'; ?>>Cố định</option>
            
                                    </select>
            
                                  </span></td>
            
                                </tr>
                                <tr>
            
                                  <td valign="middle">Title trang</td>
            
                                  <td valign="middle"><input name="title" type="text" class="table_khungnho" id="title" value="<?=$title?>"/></td>
            
                                </tr>
            
                                <tr>
            
                                  <td valign="middle">Decription</td>
            
                                  <td valign="middle"><input name="description" type="text" class="table_khungnho" id="description" value="<?=$description?>"/></td>
            
                                </tr>
            
                                <tr>
            
                                  <td valign="middle">Keyword</td>
            
                                  <td valign="middle"><input name="keyword" type="text" class="table_khungnho" id="keyword" value="<?=$keyword?>"/></td>
            
                                </tr>
            					<tr>
            
                                    <td width="30%" height="41" valign="top">&nbsp;
            
                                        
            
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