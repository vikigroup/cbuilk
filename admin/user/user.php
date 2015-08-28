<?php
if(isset($frame) == true){
    check_permiss($_SESSION['kt_login_id'],17,'admin.php');
}else{
    header("location: ../admin.php");
}

if(isset($_POST['tim']) == true){//isset kiem tra submit
    if($_POST['tukhoa'] != ""){$tukhoa = $_POST['tukhoa'];}else {$tukhoa = -1;}
    if($tukhoa == "Từ khóa...") $tukhoa = "";
    $_SESSION['kt_tukhoa_bignew'] = $tukhoa;
    $tukhoa = trim(strip_tags($tukhoa));
    if (get_magic_quotes_gpc() == false){
        $tukhoa = mysql_real_escape_string($tukhoa);
    }

    if($_POST['ddCat'] != NULL){$parent = $_POST['ddCat'];}else {$parent = -1;}
    $_SESSION['kt_parent_bignew'] = $parent;

    if($_POST['ddCatch'] != NULL){$parent1 = $_POST['ddCatch'];}else {$parent1 = -1;}
    $_SESSION['kt_ddCatch_bignew'] = $parent1;
}

if(isset($_POST['reset']) == true){
    $_POST['ddCatch'] = -1;
    $_SESSION['kt_tukhoa_bignew'] = -1;
    $_SESSION['kt_parent_bignew'] = -1;
    $_SESSION['kt_ddCatch_bignew'] = -1;

}
if($_SESSION['kt_tukhoa_bignew'] == NULL){$tukhoa = -1;}
if($_SESSION['kt_tukhoa_bignew'] != NULL){$tukhoa = $_SESSION['kt_tukhoa_bignew'];}
if($_SESSION['kt_parent_bignew'] == NULL){$parent = -1;}
if($_SESSION['kt_parent_bignew'] != NULL){$parent = $_SESSION['kt_parent_bignew'];}

if($_SESSION['kt_ddCatch_bignew'] == NULL){$parent1 = -1;}
if($_SESSION['kt_ddCatch_bignew'] != NULL){$parent1 = $_SESSION['kt_ddCatch_bignew'];}

if($_GET['anhien'] == NULL){$anhien = -1; $_SESSION['kt_anhien'] = $anhien;}
if($_GET['anhien'] != NULL){$anhien = $_GET['anhien']; $_SESSION['kt_anhien'] = $anhien;}
settype($anhien, "int");

if($_GET['tang'] == NULL){$tang = -1;$_SESSION['kt_tang'] = $tang;}
if($_GET['tang'] != NULL){$tang = $_GET['tang']; $_SESSION['kt_tang'] = $tang;}
settype($tang, "int");

if($_GET['noibat'] == NULL){$noibat = -1; $_SESSION['kt_noibat'] = $noibat;}
if($_GET['noibat'] != NULL){$noibat = $_GET['noibat']; $_SESSION['kt_noibat'] = $noibat;}
settype($noibat, "int");

if($tang == 0){$ks = 'DESC';}//0 tang
else if($tang == 1){$ks = 'ASC';}//1 giam
else $ks = 'DESC';
?>

<script>
$(document).ready(function() {
    $("img.anhien").click(function(){
	    id = $(this).attr("value");
	    obj = this;
		$.ajax({
            url:'status.php',
		    data: 'id='+ id +'&table=tbl_users',
		    cache: false,
		    success: function(data){
			    if(data == "images/anhien_1.png"){
                    obj.src = "images/mo.png";
                    obj.title = "Nhấn vào để khóa";
                }
			    else{
                    obj.src = "images/dong.png";
                    obj.title = "Nhắp vào để mở";
                }
            }
		});
	});
	
	$("#chkall").click(function(){
		var status = this.checked;
		$("input[class='tai_c']").each(function(){this.checked = status;})
	});

    $("#btnDel").click(function(){
        var num = $('input[name="chk[]"]:checked').length;
        if(num == 0){
            alert("Bạn chưa chọn thành viên cần xóa! \nXin vui lòng chọn ít nhất một thành viên.");
            return false;
        }
        else{
            return confirm("Bạn chắc chắn muốn xóa?");
        }
    });
});
</script>

<?php if($errMsg != ""){ ?>
    <div class="alert alert-block no-radius fade in">
        <button type="button" class="close" data-dismiss="alert"><span class="mini-icon cross_c"></span></button>
        <p class="pAlert pWarning"><strong class="strongAlert strongWarning"><?php if($_REQUEST['code'] != 1 ){echo 'Cảnh báo!';} ?></strong> <?php echo $errMsg; ?> <span class="xClose" title="Đóng" onclick="$(this).parent().hide();">x</span></p>
    </div>
<?php } ?>

<div class="row-fluid">
    <div class="span12">
        <div class="box-widget">
            <div class="widget-container">
                <div class="widget-block">
                    <?
                    switch ($_GET['action']){ // luu y lai viec xoa user: hinh anh, cac du lieu ve shop
                        case 'del' :
                            $id = $_GET['id'];
                            $r = getRecord("tbl_users","id=".$id);
                            @$result = mysql_query("delete from tbl_users where id='".$id."'",$conn);
                            if ($result){
                                if(file_exists('../'.$r['image'])) @unlink('../'.$r['image']);
                                if(file_exists('../'.$r['image_large'])) @unlink('../'.$r['image_large']);
                                $errMsg = "Đã xóa thành công.";
                            }else $errMsg = "Không thể xóa dữ liệu !";
                            break;
                    }

                    if (isset($_POST['btnDel'])){
                        $cntDel = 0;
                        $cntNotDel = 0;
                        $cntParentExist = 0;
                        if($_POST['chk'] != ''){
                            foreach ($_POST['chk'] as $id){
                                $r = getRecord("tbl_users","id=".$id);
                                @$result = mysql_query("delete from tbl_users where id='".$id."'",$conn);
                                if ($result){
                                    if(file_exists('../'.$r['image'])) @unlink('../'.$r['image']);
                                    if(file_exists('../'.$r['image_large'])) @unlink('../'.$r['image_large']);
                                    $cntDel++;
                                }else $cntNotDel++;
                            }
                            $errMsg = "Đã xóa ".$cntDel." phần tử.<br><br>";
                            $errMsg .= $cntNotDel > 0 ? "Không thể xóa ".$cntNotDel." phần tử.<br>" : '';
                            $errMsg .= $cntParentExist > 0 ? "Đang có danh mục con sử dụng ".$cntParentExist." phần tử." : '';
                        }else{
                            $errMsg = "Hãy chọn trước khi xóa !";
                        }
                    }

                    $pageSize = 50;
                    $pageNum = 1;
                    $totalRows = 0;

                    if (isset($_GET['pageNum']) == true) $pageNum = $_GET['pageNum'];
                    if ($pageNum <= 0) $pageNum = 1;
                    $startRow = ($pageNum-1) * $pageSize;

                    $where = "1=1 and (id='{$tukhoa}' or mobile LIKE '%$tukhoa%' or username LIKE '%$tukhoa%' or name LIKE '%$tukhoa%' or '{$tukhoa}'=-1) and idgroup <> -1";
                    $where .= " AND ( status='{$anhien}' or '{$anhien}'=-1) ";

                    $MAXPAGE = 1;
                    $totalRows = countRecord("tbl_users",$where);

                    if ($_REQUEST['cat'] != '') $where = "parent=".$_REQUEST['cat']; ?>

                    <form method="POST" action="#" name="frmForm" enctype="multipart/form-data">
                        <input type="hidden" name="page" value="<?=$page?>">
                        <input type="hidden" name="act" value="user">

                        <? if ($_REQUEST['code'] == 1) $errMsg = '<p class="pAlert pSuccess"><strong class="strongAlert strongSuccess">Chúc mừng!</strong> Bạn đã cập nhật thành công. <span class="xClose" title="Đóng" onclick="$(this).parent().hide();">x</span></p>'; ?>

                        <table width="100%" class="admin_table">
                            <thead>
                                <tr align="center">
                                    <td valign="middle" colspan="11" align="center">
                                        <div class="table_chu_tieude"><strong>THÀNH VIÊN</strong></div>
                                    </td>
                                </tr>
                                <tr align="center">
                                    <td valign="middle" style="background-color:#F0F0F0; height:40px; padding-left:20px" colspan="11"><input class="table_khungnho" name="tukhoa" id="tukhoa" type="text" value="Từ khóa..." placeholder="Từ khóa" onfocus="if(this.value=='Từ khóa...') this.value = '';" onblur="if(this.value == '') this.value = 'Từ khóa...';"/>
                                        <input name="tim" type="submit" class="nut_table" id="tim" value="Tìm kiếm"/>
                                        <input type="submit" name="reset" class="nut_table" value="Tất cả" title=" Reset "/>
                                    </td>
                                </tr>
                                <tr>
                                    <td valign="middle" align="left" style="background-color:#F0F0F0; height:40px; padding-left:20px" colspan="11">
                                        <div class="link_loc" style="width:80px; text-align:center; padding:3px; border:solid 1px #999; float:left; margin-right:5px; <?php if($noibat == 0 && $anhien == 0) echo 'background-color:#FF0; color:#000;'; else echo 'background-color:#FFF; color:#FFF;"'; ?>">
                                            <a href="admin.php?act=user&tang=1&anhien=-1">Tất cả</a>
                                        </div>
                                        <div class="link_loc" style="width:80px; text-align:center; padding:3px; border:solid 1px #999; float:left; margin-right:5px; <?php if($tang == 1) echo 'background-color:#FF0; color:#000;'; else echo 'background-color:#FFF; color:#FFF;"'; ?>">
                                            <a href="admin.php?act=user&tang=1&anhien=<?php echo $_SESSION['kt_anhien']; ?>">Tăng dần</a>
                                        </div>
                                        <div class="link_loc" style="width:80px; text-align:center; padding:3px; border:solid 1px #999; float:left; margin-right:5px; <?php if($tang == 0) echo 'background-color:#FF0; color:#000;'; else echo 'background-color:#FFF; color:#FFF;"'; ?>">
                                            <a href="admin.php?act=user&tang=0&anhien=<?php echo $_SESSION['kt_anhien']; ?>">Giảm dần</a>
                                        </div>
                                        <div class="link_loc" style="width:80px; text-align:center; padding:3px; border:solid 1px #999; float:left; margin-right:5px; <?php if($anhien == 1) echo 'background-color:#FF0; color:#000;'; else echo 'background-color:#FFF; color:#FFF;"'; ?>">
                                            <a href="admin.php?act=user&tang=<?php echo $_SESSION['kt_tang']; ?>&anhien=1">Mở</a>
                                        </div>
                                         <div class="link_loc" style="width:80px; text-align:center; padding:3px; border:solid 1px #999; float:left; margin-right:5px; <?php if($anhien == 0) echo 'background-color:#FF0; color:#000;'; else echo 'background-color:#FFF; color:#FFF;"'; ?>">
                                            <a href="admin.php?act=user&tang=<?php echo $_SESSION['kt_tang']; ?>&anhien=0">Khóa</a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center" colspan="2">
                                        <input type="submit" value="Xóa chọn" name="btnDel" id="btnDel" class="button">
                                    </td>
                                    <td align="center" class="PageNum" colspan="8">
                                        <?php echo pagesListLimit($totalRows,$pageSize); ?>
                                    </td>
                                    <td width="102" align="center" colspan="1">
                                        <div>
                                            <a href="admin.php?act=user_m">
                                                <img width="48" height="48" border="0" src="images/them.png">
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="admin_tieude_table">
                                    <td width="3%" align="center">
                                        <input type="checkbox" name="chkall" id="chkall" onClick="chkallClick(this);"/>
                                    </td>
                                    <td width="5%" align="center">STT</td>
                                    <td width="10%" align="center"><span class="title"><a class="title" href="<?=getLinkSortAdmin(3)?>">Tên thành viên</a></span></td>
                                    <td width="10%" align="center"><a class="title" href="<?=getLinkSortAdmin(4)?>">Tên đăng nhập</a></td>
                                    <td width="9%" align="center"><a class="title" href="<?=getLinkSortAdmin(10)?>">Hình ảnh</a></td>
                                    <td width="16%" align="center">Thông tin</td>
                                    <td width="9%" align="center">Quyền hạn</td>
                                    <td width="11%" align="center"><span class="title"><a class="title" href="<?=getLinkSortAdmin(11)?>">Ngày khởi tạo</a></span></td>
                                    <td width="12%" align="center"><a class="title" href="<?=getLinkSortAdmin(12)?>">Lần chỉnh sửa cuối</a></td>
                                    <td width="8%" align="center"><a class="title" href="<?=getLinkSortAdmin(12)?>">Trạng thái</a></td>
                                    <td width="7%" align="center">Công cụ</td>
                                </tr>
                            </thead>
                            <tbody>
                            <?
                            $sortby = "order by id $ks";
                            if ($_REQUEST['sortby'] != '') $sortby = "order by ".(int)$_REQUEST['sortby'];
                            $direction = ($_REQUEST['direction'] == '' || $_REQUEST['direction'] == '0' ? "desc" : "");
                            $sql = "select *,DATE_FORMAT(date_added,'%d/%m/%Y %h:%i') as dateAdd,DATE_FORMAT(last_modified,'%d/%m/%Y %h:%i') as dateModify from tbl_users where $where $sortby limit ".($startRow).",".$pageSize;
                            $result = mysql_query($sql,$conn);
                            $i = 0;
                            while($row = mysql_fetch_array($result)){
                            $parent = getRecord('tbl_users','id = '.$row['parent']);
                            $color = $i++ % 2 ? "#d5d5d5" : "#e5e5e5";
                            ?>
                                <tr>
                                    <td align="center">
                                        <input type="checkbox" name="chk[]" value="<?=$row['id']?>" class="tai_c"/>
                                    </td>
                                    <td align="center"><?=$row['id']?></td>
                                    <td align="center"><?=$row['name']?></td>
                                    <td align="center"><?=$row['username']?></td>
                                    <td align="center">
                                        <?php if($row['image'] == true){ ?>
                                            <a onclick="positionedPopup(this.href,'myWindow','500','400','100','400','yes'); return false;" href="../web/<?=$row['image']?>" title="Click vào xem ảnh">
                                                <img src="../web/<?=$row['image']?>" width="80" height="80" border="0" class="hinh"/>
                                            </a>
                                        <?php }else{?>
                                        <img src="../<?php echo $noimgs; ?>" width="80" height="80" border="0" class="hinh"/>
                                        <?php }?>
                                    </td>
                                    <td align="left" style="padding-left: 5px;">
                                        Điện thoại: <b><?=$row['mobile']?></b><br/>
                                        Địa chỉ: <b><?=$row['mobile']?></b><br/>
                                        Email: <b><?=$row['mobile']?></b><br/>
                                    </td>
                                    <td align="center">
                                        <a href="?act=user_permiss&id=<?php echo $row['id']; ?>" title="Nhấn để chỉnh sửa phân quyền cho tài khoản này">
                                            <?php
                                                if($row['idgroup'] == 1){echo 'Member';}
                                                else if($row['idgroup'] == 2){echo 'Moderator';}
                                                else if($row['idgroup'] == 3){echo 'Administrator';}
                                            ?>
                                        </a>
                                    </td>
                                    <td align="center"><?=$row['dateAdd']?></td>
                                    <td align="center"><?=$row['dateAdd']?></td>
                                    <td align="center">
                                        <span class="smallfont">
                                            <img src="images/<?php if($row['status'] == 1){echo 'mo';} else{echo 'dong';} ?>.png" width="25" height="25" class="anhien" title="<?php if($row['status'] == 1){echo 'Nhấn vào để khóa';} else{echo 'Nhấn vào để mở';} ?>" value="<?=$row['id']?>"/>
                                        </span>
                                    </td>
                                    <td align="center">
                                        <a title="Cập nhật" href="admin.php?act=user_m&cat=<?=$_REQUEST['cat']?>&page=<?=$_REQUEST['page']?>&id=<?=$row['id']?>"><img src="images/icon3.png"/></a>
                                        <a title="Xóa" href="?act=user&action=del&page=<?=$_REQUEST['page']?>&id=<?=$row['id']?>" onclick="return confirm('Bạn chắc chắn muốn xoá?');"><img src="images/icon4.png" width="20" border="0"/></a>
                                    </td>
                                </tr>
                            <?php } ?>
                                <tr>
                                    <td class="PageNext" colspan="9" align="center" valign="middle">
                                        <div style="padding:5px;">
                                            <?php echo pagesLinks($totalRows,$pageSize); ?>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
