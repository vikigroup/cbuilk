<? $errMsg =''?>
<?
$path = "../images/gianhang/item";
$pathdb = "images/gianhang/item";
if (isset($_POST['btnSave'])){
	$code          = isset($_POST['txtCode']) ? trim($_POST['txtCode']) : '';
	$name          = isset($_POST['name']) ? trim($_POST['name']) : '';
	$parent        = $_POST['ddCat'];
	$parent1       = $_POST['ddCat1'];
	$listimage     = $_POST['chk'];
	
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
	$pricekm        = isset($_POST['price2']) ? trim($_POST['price2']) : '';
	$loaihinh       = isset($_POST['loaihinh']) ? trim($_POST['loaihinh']) : '';
	
 
	
	$catInfo       = getRecord('tbl_item', 'id='.$parent);
	if(!$multiLanguage){
		$lang      = $catInfo['lang'];
	}else{
		$lang      = $catInfo['lang'] != '' ? $catInfo['lang'] : $_POST['cmbLang'];
	}

	if ($name=="") $errMsg .= "Hãy nhập tên danh mục !<br>";
	$errMsg .= checkUpload($_FILES["txtImage"],".jpg;.gif;.bmp;.png;.jpeg;",1000*1024,0);
	$errMsg .= checkUpload($_FILES["txtImageLarge"],".jpg;.gif;.bmp;.png;.jpeg",1000*1024,0);

	if ($errMsg==''){
		if (!empty($_POST['id'])){
			$oldid = $_POST['id'];
			$sql = "update tbl_item set code='".$code."',idshop='".$idshop."',idcity='".$idcity."',type='".$loaihinh."',name='".$name."', parent='".$parent."', parent1='".$parent1."',subject='".$subject."',detail_short='".$detail_short."',detail='".$detail."', sort='".$sort."', title='".$title."', description='".$description."', keyword='".$keyword."', status='".$status."', price='".$price."', pricekm='".$pricekm."',last_modified=now(), lang='".$lang."' where id='".$oldid."'";
		}else{
			$sql = "insert into tbl_item (code, idshop , idcity , type , name, parent, parent1, subject, detail_short, detail, sort, price, pricekm , title, description , keyword, status , date_added, last_modified, lang) values ('".$code."','".$idshop."','".$idcity."','".$loaihinh."','".$name."','".$parent."','".$parent1."','".$subject."','".$detail_short."','".$detail."','".$sort."','".$price."','".$pricekm."','".$title."','".$description."','".$keyword."','0',now(),now(),'".$lang."')";
		}
		if (mysql_query($sql,$conn)){
			if(empty($_POST['id'])) $oldid = mysql_insert_id();
			$r = getRecord("tbl_item","id=".$oldid);
			
			$kiemtra=getRecord("tbl_item_category","id='".$name."'");
			$kiemtra1=getRecord("tbl_item","id='".$name."'");
			if($kiemtra['id']>0 || $kiemtra1['id']>0 )  {
		
				$arrField = array(
				"subject"          => "'".vietdecode($name)."-".$oldid."'"
				); 
			}else{
				$arrField = array(
				"subject"          => "'".vietdecode($name)."'"
				);// ko them id vao cuoi cho dep
			}
			
			$result = update("tbl_item",$arrField,"id=".$oldid);
			
			echo $dem=count($listimage);
			if($dem>0){
				
				foreach ($listimage as $k=>$v){
					$arrField = array(
						"iditem"          => "'".$oldid."'",
					);
					$result = update("tbl_ad",$arrField,"id='".$v."'");
				}
				
				
			}
			
			$sqlUpdateField = "";
			
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
				$sqlUpdate = "update tbl_item set $sqlUpdateField where id='".$oldid."'";
				mysql_query($sqlUpdate,$conn);
			}
		}else{
			$errMsg = "Không thể cập nhật !";
		}
	}

	if ($errMsg == '');
		echo '<script>window.location="index.php?act=item&cat='.$_REQUEST['cat'].'&page='.$_REQUEST['page'].'&code=1"</script>';
}else{
	if (isset($_GET['id'])){
		$oldid=$_GET['id'];
		$page = $_GET['page'];
		$sql = "select * from tbl_item where id='".$oldid."'";
		if ($result = mysql_query($sql,$conn)) {
			$row=mysql_fetch_array($result);
			$code          = $row['code'];
			$name          = $row['name'];
			$parent        = $row['parent'];
			$parent1       = $row['parent1'];
			$subject       = $row['subject'];
			$detail_short  = $row['detail_short'];
			$detail        = $row['detail'];
			$image         = $row['image'];
			$image_large   = $row['image_large'];
			$sort          = $row['sort'];
			$status        = $row['status'];
			$loaihinh      = $row['type'];
			
			$price        = $row['price'];
			$pricekm      = $row['pricekm'];
			
			$title        = $row['title'];
			$description  = $row['description'];
			$keyword      = $row['keyword'];

			$date_added    = $row['date_added'];
			$last_modified = $row['last_modified'];
		}
	}
}

?>
<script>
$(document).ready(function() {	
		//dao trang thai an hien
	$("#addimage").click(function(){
	id=$(this).attr("value");
	obj = this;
		$.ajax({
		   url:'status.php',
		   data: 'id='+ id +'&table=tbl_item',
		   cache: false,
		   success: function(data){ //alert(idvnexpres);
			obj.src=data;
			if (data=="images/anhien_1.png") obj.title="Nhắp vào để ẩn";
			else obj.title="Nhắp vào để hiện";
		  }
		});
	});

	
});
</script>
<div class="main_cont_body">
    
    <h1 class="title_menu_admin">Sửa thông tin sản phẩm</h1><!-- End .title_menu_admin -->
    
    <div class="frame_cont_body">    
    
        <div class="note">Lưu ý: Những ô có dấu * là bắt buộc</div>                
    
    
        <div class="frm_tbl">
        <form method="post" name="frmForm" enctype="multipart/form-data" action="index.php?act=item_m">   
          <input type="hidden" name="act" value="item_m">
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
                  <th height="38">Danh mục</th>
                  <td>
                  <?=comboCategory1('ddCat',"tbl_item_category",getArrayCategory('tbl_item_category'),'slt_txt1',$parent,0,$idshop)?>
                  </td>
              </tr>
                <tr>
                  <th height="31">Danh mục JBS</th>
                  <td><?=comboCategory('ddCat1',getArrayCategory('tbl_shop_category'),'slt_txt1',$parent1,0)?></td>
                </tr>
                <tr>
                  <th height="31">Loại hình</th>
                  <td> 
                  	 <select id="loaihinh" name="loaihinh"  class="slt_txt1" >
						<?php if(!isset($_GET['id'])){?>
                        <option value="0" <?php if($loaishop==0) echo 'selected="selected"';?> >  Sản phẩm </option>
                        <option value="1" <?php if($loaishop==1) echo 'selected="selected"';?> >  Dịch vụ </option>
                        <?php }else {?>
                        <option value="0" <?php if($loaihinh==0) echo 'selected="selected"';?> >  Sản phẩm </option>
                        <option value="1" <?php if($loaihinh==1) echo 'selected="selected"';?> >  Dịch vụ </option>
                        <?php }?>
                     </select>
                  </td>
                </tr>
                <tr>
                  <th height="31">Giá</th>
                  <td><span class="pdd1">
                    <input name="price" type="text" class="ipt_txt1" id="price" value="<?=$price?>"/>
                  </span></td>
                </tr>
                <tr>
                  <th height="31">Giá Khuyến mãi</th>
                  <td><span class="pdd1">
                    <input name="price2" type="text" class="ipt_txt1" id="price2" value="<?=$pricekm?>"/>
                  </span></td>
                </tr>
                <tr>
                  <th height="31"> Tóm tắt</th>
                  <td>
                  <div class="pdd1">
                  <? if(1>2){?>
                    <textarea name="txtDetailShort" class="teare_editor" id="txtDetailShort"  style="height:350px;"><?=$detail_short;?>
                    </textarea>
                    <script type="text/javascript" src="scripts/tiny_mce/tiny_mce.js"></script>
                    <script type="text/javascript">
                                tinyMCE.init({
                                    // General options
                                    mode : "exact",
                                    elements : "txtDetailShort",
                                    convert_urls : false,
                                    theme : "advanced",
                                    plugins : "pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave",
                            
                                    // Theme options
                                    theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect,cut,copy,paste,pastetext,pasteword,|,replace,|,bullist,numlist,|,outdent,indent,blockquote",
                                    theme_advanced_buttons2 : "undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor,tablecontrols,|,hr,removeformat,emotions,iespell,media",
                                    theme_advanced_toolbar_location : "top",
                                    theme_advanced_toolbar_align : "left",
                                    theme_advanced_statusbar_location : "bottom",
                                    theme_advanced_resizing : true,
                            
                                    // Example content CSS (should be your site CSS)
                                    // using false to ensure that the default browser settings are used for best Accessibility
                                    // ACCESSIBILITY SETTINGS
                                    content_css : false,
                                    // Use browser preferred colors for dialogs.
                                    browser_preferred_colors : true,
                                    detect_highcontrast : true,
                            
                                    // Drop lists for link/image/media/template dialogs
                                    template_external_list_url : "lists/template_list.js",
                                    external_link_list_url : "lists/link_list.js",
                                    external_image_list_url : "lists/image_list.js",
                                    media_external_list_url : "lists/media_list.js",
                            
                                    // Style formats
                                    style_formats : [
                                        {title : 'Bold text', inline : 'b'},
                                        {title : 'Red text', inline : 'span', styles : {color : '#ff0000'}},
                                        {title : 'Red header', block : 'h1', styles : {color : '#ff0000'}},
                                        {title : 'Example 1', inline : 'span', classes : 'example1'},
                                        {title : 'Example 2', inline : 'span', classes : 'example2'},
                                        {title : 'Table styles'},
                                        {title : 'Table row 1', selector : 'tr', classes : 'tablerow1'}
                                    ],
                            
                                    // Replace values for the template plugin
                                    template_replace_values : {
                                        username : "Some User",
                                        staffid : "991234"
                                    }
                                });
                            </script>
                    <?php }?>        
                    <textarea class="teare_editor"  id="txtDetailShort" name="txtDetailShort" ><?=$detail_short;?></textarea>
                    <script type="text/javascript">
                         var editor = CKEDITOR.replace( 'txtDetailShort');
                    </script> 
                    <script>	  		  	
                        setTimeout("HienDuLieu1()", 1000);		
                        function HienDuLieu1(){
                            var str= "<?=$detail_short;?>";			
                            var oEditor = CKEDITOR.instances.noidung;			
                            oEditor.setData( str);				
                        }
                    </script>         
                  </div>
                  </td>
              </tr>
                <tr>
                  <th height="31">
                   
                 
                  Nội dung <br />
                 
                  
                  </th>
                  <td>
                  <div class="pdd1"> 
                   <textarea class="teare_editor"  id="content" name="content" ><?=$detail;?></textarea>
                    <script type="text/javascript">
                         var editor = CKEDITOR.replace( 'content');
                    </script> 
                    <script>	  		  	
                        setTimeout("HienDuLieu2()", 1000);		
                        function HienDuLieu2(){
                            var str= "<?=$detail;?>";			
                            var oEditor = CKEDITOR.instances.noidung;			
                            oEditor.setData( str);				
                        }
                    </script>            
                  </div>
                  </td>
              </tr>
                <tr>
                  <th height="64">Hình Nhỏ</th>
                  <td> <input name="txtImage" type="file" class="" id="txtImage"/>&nbsp;&nbsp;<input type="checkbox" name="chkClearImg" value="on"> Xóa bỏ hình ảnh <br /></td>
              </tr>
                <tr>
                  <th>Hình lớn</th>
                  <td>
                  <input name="txtImageLarge" type="file" class="" id="txtImageLarge"/>&nbsp;&nbsp;<input type="checkbox" name="chkClearImgLarge" value="on"> Xóa bỏ hình ảnh <br />
                  </td>
                </tr>
                <tr>
                  <th>Thêm hình đính kèm hình đại diện </th>
                  <td>
                  <style>
				  .hinhthem li { width:100px; float:left; height:100px; text-align:center;}
				  .hinhthem li img { max-width:80px; max-height:80px;}
				  </style>
                  <ul class="hinhthem">
					<?php
                    $hinh=get_records("tbl_ad","idshop='{$idshop}' AND name='' AND iditem=''","id DESC","0,19"," ");
                    while($row_hinh=mysql_fetch_assoc($hinh)){
                    ?>
                  	<li>
                    	<img src="../<?php echo $row_hinh['image'];?>" /> <br />
                        <input name="chk[]" type="checkbox" value="<?php echo $row_hinh['id'];?>" />
                    </li>
                    <?php }?>
                  </ul>
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