<?php
if(isset($frame)==true){
	check_permiss($_SESSION['kt_login_id'],7,'admin.php');
}else{
	header("location: ../admin.php");
}
?>
<? $errMsg =''?>
<?

$path = "../web/images/adv";
$pathdb = "images/adv";
if (isset($_POST['btnSave'])){
	$code          = isset($_POST['txtCode']) ? trim($_POST['txtCode']) : '';
	$name          = isset($_POST['txtName']) ? trim($_POST['txtName']) : '';
	$type          = isset($_POST['loai']) ? trim($_POST['loai']) : '';
	$parent        = $_POST['ddCat'];
	$subject       = vietdecode($name);
	$detail_short  = isset($_POST['txtDetailShort']) ? trim($_POST['txtDetailShort']) : '';
	$detail        = isset($_POST['txtDetail']) ? trim($_POST['txtDetail']) : '';
	$link          = isset($_POST['link']) ? trim($_POST['link']) : '';
	$sort          = isset($_POST['txtSort']) ? trim($_POST['txtSort']) : 0;
	$status        = $_POST['chkStatus']!='' ? 1 : 0;
    $mainPosition = $_POST['slAlignCreateAdminBanner'];
    $subPosition   = $_POST['slPageCreateAdminBanner'];
    $startDateTime = $_POST['txtCreateBannerCreateDatetime'] ? trim($_POST['txtCreateBannerCreateDatetime']) : '';
    $endDateTime   = $_POST['txtCreateBannerEndDatetime'] ? trim($_POST['txtCreateBannerEndDatetime']) : '';

    $catInfo       = getRecord('tbl_adv', 'id='.$parent);
	if(!$multiLanguage){
		$lang      = $catInfo['lang'];
	}else{
		$lang      = $catInfo['lang'] != '' ? $catInfo['lang'] : $_POST['cmbLang'];
	}

	if ($name=="") $errMsg .= "Hãy nhập tên banner !<br>";
    if ($link=="") $errMsg .= "Hãy nhập liên kết cho banner !<br>";
    if ($startDateTime=="") $errMsg .= "Hãy nhập thời gian đặt banner !<br>";
    if ($endDateTime=="") $errMsg .= "Hãy nhập thời gian kết thúc banner !<br>";
    if ($endDateTime < $startDateTime) $errMsg .= "Thời gian kết thúc phải bằng hoặc lớn hơn thời gian đặt banner !<br>";

    $errMsg .= checkUpload($_FILES["txtImage"],".jpg;.gif;.bmp;.png",500*1024,0);
	$errMsg .= checkUpload($_FILES["txtImageLarge"],".jpg;.gif;.bmp;.png",500*1024,0);

	if ($errMsg==''){
		if (!empty($_POST['id'])){
			$oldid = $_POST['id'];
			 $sql = "update tbl_adv set name='".$name."',type='".$type."',link='".$link."',sort='".$sort."', status='".$status."'
			 ,main_position='".$mainPosition."',sub_position='".$subPosition."',start_banner='".$startDateTime."',finish_banner='".$endDateTime."',last_modified=now() where id='".$oldid."'";
		}else{
			 $sql = "insert into tbl_adv (name, type, link, sort, status,  date_added, last_modified, main_position, sub_position, start_banner, finish_banner) values ('".$name."'
			 ,'".$type."','".$link."','".$sort."','1',now(),now(),'".$mainPosition."','".$subPosition."','".$startDateTime."','".$endDateTime."')";
		}
		if (mysql_query($sql,$conn)){
			if(empty($_POST['id'])) $oldid = mysql_insert_id();
			$r = getRecord("tbl_adv","id=".$oldid);
		
			/*$arrField = array(
			"subject"          => "'".vietdecode($name)
			);// ko them id vao cuoi cho dep
			$result = update("tbl_adv",$arrField,"id=".$oldid);*/
			
			$sqlUpdateField = "";
			
			if ($_POST['chkClearImg']==''){
				$extsmall=getFileExtention($_FILES['txtImage']['name']);
				if (makeUpload($_FILES['txtImage'],"$path/advs$oldid$extsmall")){
					@chmod("$path/advs$oldid$extsmall", 0777);
					$sqlUpdateField = " image='$pathdb/advs$oldid$extsmall' ";
				}
			}else{
				if(file_exists('../'.$r['image'])) @unlink('../'.$r['image']);
				$sqlUpdateField = " image='' ";
			}
			
			if ($_POST['chkClearImgLarge']==''){
				$extlarge=getFileExtention($_FILES['txtImageLarge']['name']);
				if (makeUpload($_FILES['txtImageLarge'],"$path/adv_l$oldid$extlarge")){
					@chmod("$path/adv_l$oldid$extlarge", 0777);
					if($sqlUpdateField != "") $sqlUpdateField .= ",";
					$sqlUpdateField .= " image_large='$pathdb/adv_l$oldid$extlarge' ";
				}
			}else{
				if(file_exists('../'.$r['image_large'])) @unlink('../'.$r['image_large']);
				if($sqlUpdateField != "") $sqlUpdateField .= ",";
				$sqlUpdateField .= " image_large='' ";
			}
			
			if($sqlUpdateField!='')	{
				$sqlUpdate = "update tbl_adv set $sqlUpdateField where id='".$oldid."'";
				mysql_query($sqlUpdate,$conn);
			}
		}else{
			$errMsg = "Không thể cập nhật !";
		}
	}

	if ($errMsg == '')
		echo '<script>window.location="admin.php?act=adv&cat='.$_REQUEST['cat'].'&page='.$_REQUEST['page'].'&code=1"</script>';
}else{
	if (isset($_GET['id'])){
		$oldid=$_GET['id'];
		$page = $_GET['page'];
		$sql = "select * from tbl_adv where id='".$oldid."'";
		if ($result = mysql_query($sql,$conn)) {
			$row=mysql_fetch_array($result);
			$code          = $row['code'];
			$name          = $row['name'];
			$type          = $row['type'];
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
            $mainPosition  = $row['main_position'];
            $subPosition   = $row['sub_position'];
            $startDateTime = $row['start_banner'];
            $endDateTime   = $row['finish_banner'];
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
     <?=$errMsg;?>
</div>
<?php }?>
<div class="row-fluid">
    <div class="span12">
        <div class="box-widget">
            <div class="widget-container">
                <div class="widget-block">
                   <form method="post" name="frmForm" enctype="multipart/form-data" action="admin.php?act=adv_m">
            <input type="hidden" name="txtSubject" id="txtSubject">
            <input type="hidden" name="txtDetailShort" id="txtDetailShort">
            <input type="hidden" name="txtDetail" id="txtDetail">
            
            <input type="hidden" name="act" value="adv_m">
            <input type="hidden" name="id" value="<?=$_REQUEST['id']?>">
            <input type="hidden" name="page" value="<?=$_REQUEST['page']?>">
            <div> <? if($errMsg!=''){echo '<p align=center class="err">'.$errMsg.'<br></p>';}?>  </div>
                 <table  class="table_chinh">

                    <tr>
                      <td class="table_chu_tieude_them" colspan="2" align="center" valign="middle"  >QUẢNG CÁO</td>
                  </tr>
                    <tr>
                      <td valign="middle"  class="table_chu">&nbsp;</td>
                      <td valign="middle">&nbsp;</td>
                    </tr>
                    <tr>
                        <td valign="middle" width="30%">
                            Tên<span class="sao_bb">*</span>
                        </td>
                        <td valign="middle" width="70%">
                            <input name="txtName" type="text" class="table_khungnho" id="txtName" value="<?=$name?>"/>
                        </td>
                    </tr>
                    <tr>
                      <td valign="middle" width="30%">Link<span class="sao_bb">*</span></td>
                      <td valign="middle"><input name="link" type="text" class="table_khungnho" id="link" value="<?=$link;?>"  /></td>
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
                             Vị trí<span class="sao_bb">*</span>
                         </td>
                         <td valign="middle" width="70%">
                             <select class="table_khungnho" id="slAlignCreateAdminBanner" name="slAlignCreateAdminBanner" value="<?=$mainPosition?>" style="margin-bottom: 5px;" onchange="positionSelector(this.value);">
                                 <option value="0" id="0">BÊN TRÁI</option>
                                 <option value="1" id="1">Ở GIỮA</option>
                                 <option value="2" id="2">BÊN TRÊN</option>
                                 <option value="3" id="3">BÊN PHẢI</option>
                             </select>
                             <select class="table_khungnho" id="slPageCreateAdminBanner" name="slPageCreateAdminBanner" value="<?=$subPosition?>"> </select>
                         </td>
                     </tr>
                     <tr>
                         <td valign="middle" width="30%">
                             Thời gian đặt banner<span class="sao_bb">*</span>
                         </td>
                         <td valign="middle" width="70%">
                             <input style="margin-top: 2px;" type="date" class="table_khungnho" name="txtCreateBannerCreateDatetime" value="<?=$startDateTime?>" id="txtCreateBannerCreateDatetime">
                         </td>
                     </tr>
                     <tr>
                         <td valign="middle" width="30%">
                             Thời gian kết thúc banner<span class="sao_bb">*</span>
                         </td>
                         <td valign="middle" width="70%">
                             <input style="margin-top: 2px;" type="date" class="table_khungnho" name="txtCreateBannerEndDatetime" value="<?=$endDateTime?>" id="txtCreateBannerEndDatetime">
                         </td>
                     </tr>
                    <tr>
                        <td valign="middle" width="30%">
                        Hình đại diện</td>
                        <td valign="middle" width="70%">
                            <input type="file" name="txtImage" class="textbox" size="34">
							<input type="checkbox" name="chkClearImg" value="on"> Xóa bỏ hình ảnh	 <br>
							<? if ($image!=''){ echo '<img border="0" width="80" height="80" src="../web/'.$image.'"><br><br>Hình (kích thước nhỏ)';}?>&nbsp;&nbsp;
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

<script>
    $(document).ready(function(){
        $("select#slAlignCreateAdminBanner").find("option#<?php echo $mainPosition ?>").attr("selected", true);
        positionSelector("<?php echo $mainPosition ?>");
    });

    function positionSelector(selector){
        $("#slPageCreateAdminBanner option").remove();
        if(selector == 0){
            $("#slPageCreateAdminBanner").append("<option value='0'>TOP (190x330)</option>");
            for(var i = 1; i <= 8; i++){
                $("#slPageCreateAdminBanner").append("<option value='"+i+"'>"+i+"C (180x60)</option>");
            }
        }
        if(selector == 1){
            for(var j = 1; j <= 4; j++){
                $("#slPageCreateAdminBanner").append("<option value='"+(j+8)+"'>TOP - HÀNG "+j+" (90x45)</option>");
            }

            for(var i = 1; i <= 8; i++){
                $("#slPageCreateAdminBanner").append("<option value='"+i+"'>"+i+"C (390x420)</option>");
            }
        }
        if(selector == 2){
            for(var i = 1; i <= 8; i++){
                $("#slPageCreateAdminBanner").append("<option value='"+i+"'>"+i+"C (1210x60)</option>");
            }
        }
        if(selector == 3){
            $("#slPageCreateAdminBanner").append("<option value='0'>TOP (190x330)</option>");
        }
    }
</script>