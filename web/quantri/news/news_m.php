<? $errMsg =''?>
<?

$path = "../images/gianhang/news";
$pathdb = "images/gianhang/news";
if (isset($_POST['btnSave'])){
	$code          = isset($_POST['txtCode']) ? trim($_POST['txtCode']) : '';
	$name          = isset($_POST['name']) ? trim($_POST['name']) : '';
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
	
	$catInfo       = getRecord('tbl_item', 'id='.$parent);
	if(!$multiLanguage){
		$lang      = $catInfo['lang'];
	}else{
		$lang      = $catInfo['lang'] != '' ? $catInfo['lang'] : $_POST['cmbLang'];
	}

	if ($name=="") $errMsg .= "Hãy nhập tên danh mục !<br>";
	$errMsg .= checkUpload($_FILES["txtImage"],".jpg;.gif;.bmp;.png;.jpeg",500*1024,0);
	$errMsg .= checkUpload($_FILES["txtImageLarge"],".jpg;.gif;.bmp;.png;.jpeg",500*1024,0);

	if ($errMsg==''){
		if (!empty($_POST['id'])){
			$oldid = $_POST['id'];
			$sql = "update tbl_item set code='".$code."',idshop='".$idshop."',name='".$name."', parent='".$parent."',subject='".$subject."',detail_short='".$detail_short."',detail='".$detail."', sort='".$sort."', title='".$title."', description='".$description."', keyword='".$keyword."', status='".$status."', price='".$price."',last_modified=now(), lang='".$lang."' where id='".$oldid."'";
		}else{
			$sql = "insert into tbl_item (code , cate , idshop , name, parent, subject, detail_short, detail, sort, price , title, description , keyword, status, status1 , date_added, last_modified, lang) values ('".$code."','1','".$idshop."','".$name."','".$parent."','".$subject."','".$detail_short."','".$detail."','".$sort."','".$price."','".$title."','".$description."','".$keyword."','1','1',now(),now(),'".$lang."')";
		}
		if (mysql_query($sql,$conn)){
			if(empty($_POST['id'])) $oldid = mysql_insert_id();
			$r = getRecord("tbl_item","id=".$oldid);
		
			$arrField = array(
			"subject"          => "'".vietdecode($name)."-".$oldid."'"
			);// ko them id vao cuoi cho dep
			$result = update("tbl_item",$arrField,"id=".$oldid);
			
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
				if (makeUpload($_FILES['txtImageLarge'],"$path/item_category_l$oldid$extlarge")){
					@chmod("$path/item_l$oldid$extlarge", 0777);
					if($sqlUpdateField != "") $sqlUpdateField .= ",";
					$sqlUpdateField .= " image_large='$pathdb/item_category_l$oldid$extlarge' ";
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

	if ($errMsg == '')
		echo '<script>window.location="index.php?act=news&cat='.$_REQUEST['cat'].'&page='.$_REQUEST['page'].'&code=1"</script>';
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
			$subject       = $row['subject'];
			$detail_short  = $row['detail_short'];
			$detail        = $row['detail'];
			$image         = $row['image'];
			$image_large   = $row['image_large'];
			$sort          = $row['sort'];
			$status        = $row['status'];
			
			$price        = $row['price'];
			
			$title        = $row['title'];
			$description  = $row['description'];
			$keyword      = $row['keyword'];

			$date_added    = $row['date_added'];
			$last_modified = $row['last_modified'];
			if($parent=="") $parent=2;
		}
	}
}

?>
<div class="main_cont_body">
    
    <h1 class="title_menu_admin">Sửa danh mục sản phẩm</h1><!-- End .title_menu_admin -->
    
    <div class="frame_cont_body">    
    
        <div class="note">Lưu ý: Những ô có dấu * là bắt buộc</div>                
    
    
        <div class="frm_tbl">
        <form method="post" name="frmForm" enctype="multipart/form-data" action="index.php?act=news">   
          <input type="hidden" name="act" value="news_m">
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
                  <td><?=comboCategory1('ddCat',"tbl_item_category",getArrayCategory('tbl_item_category'),'slt_txt1',$parent,0,$idshop)?></td>
              </tr>
                <tr>
                  <th height="31">Tóm tắt</th>
                  <td><span class="pdd1">
                    <input name="txtDetailShort" type="text" class="ipt_txt1" id="txtDetail" value="<?=$detail_short?>"/>
                  </span></td>
                </tr>
                <tr>
                  <th height="31">Nội dung</th>
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
                  <th height="64">Hình</th>
                  <td> <input name="txtImage" type="file" class="" id="txtImage"/>&nbsp;&nbsp;<input type="checkbox" name="chkClearImg" value="on"> Xóa bỏ hình ảnh <br /></td>
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