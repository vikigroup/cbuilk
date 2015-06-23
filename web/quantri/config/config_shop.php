
<? $errMsg =''?>
<?
$idshop=$row_shop['id'];
$path = "../images/item";
$pathdb = "images/item";
if (isset($_POST['btnSave'])){

	$name          = isset($_POST['name']) ? trim($_POST['name']) : '';
	$parent        = $_POST['ddCat'];
	$iduser        = isset($_POST['iduser']) ? trim($_POST['iduser']) : '';
	$intro         = isset($_POST['intro']) ? trim($_POST['intro']) : '';
	$idtemplate    = isset($_POST['idtemplate']) ? trim($_POST['idtemplate']) : '';
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
	
	$detail        = isset($_POST['content']) ? trim($_POST['content']) : '';
	$detail1        = isset($_POST['content1']) ? trim($_POST['content1']) : '';
	$sort          = isset($_POST['txtSort']) ? trim($_POST['txtSort']) : 0;
	$status        = $_POST['chkStatus']!='' ? 1 : 0;
	
	$catInfo       = getRecord('tbl_shop', 'id='.$parent);
	if(!$multiLanguage){
		$lang      = $catInfo['lang'];
	}else{
		$lang      = $catInfo['lang'] != '' ? $catInfo['lang'] : $_POST['cmbLang'];
	}

	if ($name=="") $errMsg .= "Hãy nhập tên gian hang !<br>";


	if ($errMsg==''){

			$oldid = $idshop;
			$r = getRecord("tbl_shop","id=".$oldid);
			$idtemp=$r['idtemplate'];
			
			$sql = "update tbl_shop set name='".$name."', intro='".$intro."', parent='".$parent."', idcity='".$idcity."',detail='".$detail."',detail1='".$detail1."',idtemplate='".$idtemplate."',bg_position='".$bg_position."',address='".$address."',telephone='".$telephone."',fax='".$fax."',yahoo='".$yahoo."',email='".$email."',hotline='".$hotline."',contact='".$contact."',title='".$title."',description='".$description."', keyword='".$keyword."', status='".$status."',last_modified=now() where id='".$oldid."'";

		
		if (mysql_query($sql,$conn)){
			
			if($idtemp!=$idtemplate){
				$arrField = array(
					"box_array"             => "''",
					"module_array"          => "''",
					"content"               => "''",
					"list_title_module"     => "''",
					"title_module1"         => "''" 
				); 
				$result = update("tbl_module",$arrField,"idshop=".$oldid);
			}
					
			$hinh1=luu_hinh('logo','../','images/gianhang/logo/',$loi);// root chua hinh upload	

			if($loi=='' && $hinh1!="")	{
				$sqlUpdate = "update tbl_shop set logo='".$hinh1."' where id='".$oldid."'";
				if(mysql_query($sqlUpdate,$conn))
					if(file_exists('../'.$r['logo'])) @unlink('../'.$r['logo']);
			}
			
			$hinh2=luu_hinh('background','../','images/gianhang/background/',$loi);// root chua hinh upload	

			if($loi=='' && $hinh2!="")	{
				$sqlUpdate = "update tbl_shop set background='".$hinh2."' where id='".$oldid."'";
				if(mysql_query($sqlUpdate,$conn))
					if(file_exists('../'.$r['background'])) @unlink('../'.$r['background']);
			}
			
			$banner=luu_hinh_flash('banner','../','images/gianhang/banner/',$loi);// root chua hinh upload	

			if($loi=='' && $banner!="")	{
				$sqlUpdate = "update tbl_shop set banner='".$banner."' where id='".$oldid."'";
				if(mysql_query($sqlUpdate,$conn))
					if(file_exists('../'.$r['banner'])) @unlink('../'.$r['banner']);
					
				$bannermoi=$banner;
			
				if($bannermoi!="") {
					//them thong tin banner 
					$k=$bannermoi;
					$GT = explode(".",$k);
					$ten=$GT[0];
					$kieu=$GT[1];
					if($kieu=='swf' || $kieu=='SWF'){
						$linkgetimagesize="../".$bannermoi;//get width va height file
						list($width, $height, $type, $attr)=getimagesize($linkgetimagesize); //get kich thuoc file
					}
	
					$sqlUpdate = "update tbl_shop set banner_info='".$width."-".$height."' where id='".$oldid."'";
					mysql_query($sqlUpdate,$conn);
				}
			}
			
			$icon=luu_hinh('icon','../','images/gianhang/icon/',$loi);// root chua hinh upload	

			if($loi=='' && $icon!="")	{
				$sqlUpdate = "update tbl_shop set icon='".$icon."' where id='".$oldid."'";
				if(mysql_query($sqlUpdate,$conn))
					if(file_exists('../'.$r['icon'])) @unlink('../'.$r['icon']);
			}
			
		}else{
			$errMsg = "Không thể cập nhật !";
		}
	} 

	if ($errMsg == '')
		echo thongbao($host_link_full."/quantri/index.php?act=config_shop",$thongbao='Bạn đã thực hiện thành công..!');
}else{

		$oldid = $idshop;
		$page = $_GET['page'];
		$sql = "select * from tbl_shop where id='".$oldid."'";
		if ($result = mysql_query($sql,$conn)) {
			$row=mysql_fetch_array($result);
			$name          = $row['name'];
			$parent        = $row['parent'];
			$subject       = $row['subject'];
			$iduser        = $row['iduser'];
			$intro         = $row['intro'];
			$idcity        = $row['idcity'];
			$idtemplate    = $row['idtemplate'];
			$content       = $row['detail'];
			$content1       = $row['detail1'];
			
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

?>
<div class="main_cont_body">
    
    <h1 class="title_menu_admin">Cấu hình</h1><!-- End .title_menu_admin -->
    
    <div class="frame_cont_body">    
    
        <div class="note">Lưu ý: Những ô có dấu * là bắt buộc</div>                
    
    
        <div class="frm_tbl">
        <form method="post" name="frmForm" enctype="multipart/form-data" action="index.php?act=config_shop">   
          <input type="hidden" name="act" value="config_shop">
            <input type="hidden" name="id" value="<?=$_REQUEST['id']?>">
            <input type="hidden" name="page" value="<?=$_REQUEST['page']?>">
          <div> <? if($errMsg!=''){echo '<p align=center class="err">'.$errMsg.'<br></p>';}?>  </div>
            <table>
            
                <tr>
                    <th>Lĩnh vực kinh doanh gian hàng<span class="star_color">*</span></th>
                    <td>
                        <div class="pdd1">
                          <?=comboCategory('ddCat',getArrayCategory('tbl_shop_category'),'slt_txt1',$parent,0)?>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>Loại website<span class="star_color"></span></th>
                    <td>
                        <div class="pdd1"><span class="table_khung">
                        <select name="intro" id="intro" class="slt_txt1">
                            <option value="0" <?php if($intro==0) echo 'selected="selected"';?>  >Sản phẩm</option>
                            <option value="1" <?php if($intro==1) echo 'selected="selected"';?>>Giới thiệu công ty</option>
                          </select>
                        </span></div>
                    </td>
                </tr>
                
                <tr>
                    <th>Giao diện<span class="star_color"></span></th>
                    <td>
                        <div class="pdd1"><span class="table_khung">
                        <select name="idtemplate" id="idtemplate" class="slt_txt1">
                            <?php  
                        $sql="SELECT * FROM tbl_template WHERE status=1";
                        $gt=mysql_query($sql) or die(mysql_error());
                        while ($row=mysql_fetch_assoc($gt)){?>
                            <option value="<?php echo $row['id']; ?>"  <?php if($idtemplate==$row['id']) echo 'selected="selected"';?> ><?php echo $row['name']; ?></option>
                            <?php } ?>
                          </select>
                        </span></div>
                    </td>
                </tr>
                <tr>
                  <th>&nbsp;</th>
                  <td>  <div class="pdd1"><span class="table_khung">
                        <select name="idcity" id="idcity" class="slt_txt1">
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
                        </span></div></td>
                </tr>
                <tr>
                    <th>Tên website<span class="star_color">*</span></th>
                    <td>
                        <div class="pdd1">
                            <input name="name" type="text" class="ipt_txt1" id="name" value="<?=$name?>"/>
                        </div>
                    </td>
                </tr>                                
                <tr>
                  <th>Tên miền<span class="star_color">*</span></th>
                  <td><div class="pdd1">
                    <input name="subject" type="text" class="ipt_txt1" id="subject" disabled value="<?=$subject?>"/>
                  </div></td>
                </tr>
                <tr>
                  <th>Liên hệ  footer</th>
                  <td><div class="pdd1">
                    <textarea name="content" class="teare_editor" id="content"><?=$content?>
                    </textarea>
                     <script type="text/javascript">
                         var editor = CKEDITOR.replace( 'content');
                    </script> 
                    <script>	  		  	
                        setTimeout("HienDuLieu1()", 1000);		
                        function HienDuLieu1(){
                            var str= "<?=$content;?>";			
                            var oEditor = CKEDITOR.instances.content;			
                            oEditor.setData( str);				
                        }
                    </script>   
                  </div></td>
                </tr>
                <tr>
                  <th>Giới thiệu<span class="star_color"></span></th>
                  <td><div class="pdd1">
                    <textarea name="content1" class="teare_editor" id="content1"><?=$content1?>
                    </textarea>

                    <script type="text/javascript">
                         var editor = CKEDITOR.replace( 'content1');
                    </script> 
                    <script>	  		  	
                        setTimeout("HienDuLieu2()", 1000);		
                        function HienDuLieu2(){
                            var str= "<?=$content1;?>";			
                            var oEditor = CKEDITOR.instances.content1;			
                            oEditor.setData(str);				
                        }
                    </script>   
                  </div></td>
                </tr>
                <tr>
                  <th>Địa chỉ</th>
                  <td><div class="pdd1">
                    <input name="address" type="text" class="ipt_txt1" id="address" value="<?=$address?>"/>
                  </div></td>
                </tr>
                <tr>
                  <th>Điện thoại</th>
                  <td><div class="pdd1">
                    <input name="telephone" type="text" class="ipt_txt1" id="telephone" value="<?=$telephone?>"/>
                  </div></td>
                </tr>
                <tr>
                  <th>Fax<span class="star_color"></span></th>
                  <td><div class="pdd1">
                    <input name="fax" type="text" class="ipt_txt1" id="fax" value="<?=$fax?>"/>
                  </div></td>
                </tr>
                <tr>
                  <th>Yahoo<span class="star_color"></span></th>
                  <td><div class="pdd1">
                    <input name="yahoo" type="text" class="ipt_txt1" id="yahoo" value="<?=$yahoo?>"/>
                  </div></td>
                </tr>
                <tr>
                  <th>Email<span class="star_color"></span></th>
                  <td><div class="pdd1">
                    <input name="email" type="text" class="ipt_txt1" id="email" value="<?=$email?>"/>
                  </div></td>
                </tr>
                <tr>
                  <th>Hotline<span class="star_color"></span></th>
                  <td><div class="pdd1">
                    <input name="hotline" type="text" class="ipt_txt1" id="hotline" value="<?=$hotline?>"/>
                  </div></td>
                </tr>
                <tr>
                  <th>Liên hệ<span class="star_color"></span></th>
                  <td><div class="pdd1">
                    <input name="contact" type="text" class="ipt_txt1" id="name11" value="<?=$contact?>"/>
                  </div></td>
                </tr>
                <tr>
                  <th>Logo</th>
                  <td>
                    <div class="pdd1">
                        <span class="file-wrapper">
                        	<input type="file" name="logo" class="textbox" size="34" id="logo">
                        <span class="button">Chọn file</span>      
                        </span>
                    </div>
                  
                  </td>
                </tr>
                <tr>
                    <th>Hình nền<span class="star_color">*</span></th>
                    <td>
                        <div class="pdd1">
                            <span class="file-wrapper">
                            <input type="file" name="background" class="textbox" size="34" id="background" />
                            <span class="button">Chọn file</span>      
                            </span>
                        </div>
                    </td>
                </tr> 
                <tr>
                  <th height="35">&nbsp;</th>
                  <td><span class="table_khung">
                    <select name="bg_position" id="bg_position" class="slt_txt1">
                      <option value="0" <?php if($bg_position==0) echo 'selected="selected"'; ?> >Lặp ngang</option>
                      <option value="1" <?php if($bg_position==1) echo 'selected="selected"'; ?>>Lặp dọc</option>
                      <option value="2" <?php if($bg_position==2) echo 'selected="selected"'; ?>>Lặp ngang và lặp dọc</option>
                      <option value="3" <?php if($bg_position==3) echo 'selected="selected"'; ?>>Cố định</option>
                    </select>
                  </span></td>
                </tr>
                <tr>
                    <th>Banner<span class="star_color">*</span></th>
                    <td>
                        <div class="pdd1">
                            <span class="file-wrapper">
                            <input type="file" name="banner" class="textbox" size="34" id="banner" />
                            <span class="button">Chọn file</span>      
                            </span>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>Icon web<span class="star_color">*</span></th>
                    <td>
                        <div class="pdd1">
                            <span class="file-wrapper">
                            <input type="file" name="icon" class="textbox" size="34" id="icon" />
                            <span class="button">Chọn file</span>      
                            </span>
                        </div>
                    </td>
                </tr>
                <tr>
                  <th>Title trang</th>
                  <td><div class="pdd1">
                    <input name="title" type="text" class="ipt_txt1" id="name12" value="<?=$title?>"/>
                  </div></td>
                </tr>
                <tr>
                  <th>Decription</th>
                  <td><div class="pdd1">
                    <input name="description" type="text" class="ipt_txt1" id="name13" value="<?=$description?>"/>
                  </div></td>
                </tr>
                <tr>
                  <th height="44">Keyword</th>
                  <td><div class="pdd1">
                    <input name="keyword" type="text" class="ipt_txt1" id="name14" value="<?=$keyword?>"/>
                  </div></td>
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