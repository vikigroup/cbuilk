<?php 
    if(isset($frame) == true){
        check_permiss($_SESSION['kt_login_id'], 5, 'admin.php');
    }else{
        header("location: ../admin.php");
    }

  	$id = $_GET['id'];
	settype($id, "int");
	$sql = "SELECT * FROM tbl_users WHERE id = '{$id}'";
	$tbl_users = mysql_query($sql);
	$row_tbl_users = mysql_fetch_assoc($tbl_users);
?>

<?php
    if (isset($_POST['them']) == true){ //isset kiem tra submit
        //update tbl_users
        $listQuanLy = $_POST['hiddenChosenPermiss'];
        $sql = "UPDATE tbl_users SET list = '{$listQuanLy}' WHERE id = '{$id}'";
        mysql_query($sql) or die (mysql_error());

        //delete exist permission of user tbl_crud
        $myString = "DELETE FROM tbl_crud WHERE id_users = '{$id}'";
        $result = mysql_query($myString) or die (mysql_error());

        //update tbl_crud
        $listCrud = $_POST['hiddenChosenCrud'];
        if($listCrud != ''){
            $myArrCrud = explode(";", $listCrud);
            foreach($myArrCrud as $objMyArrCrud){
                $myArrContent = explode(",", $objMyArrCrud);
                $query = "INSERT INTO tbl_crud(id_users, id_permiss, isCreate, isUpdate, isDelete) VALUES('".$id."', '".$myArrContent[0]."', '".$myArrContent[1]."', '".$myArrContent[2]."', '".$myArrContent[3]."')";
                mysql_query($query) or die(mysql_error());
            }
        }

        header("Location: ".$root."/admin/admin.php?act=user&permiss=1");
    }
?>

<?php if( $errMsg != ""){ ?>
    <div class="alert alert-block no-radius fade in" xmlns="http://www.w3.org/1999/html">
        <button type="button" class="close" data-dismiss="alert"><span class="mini-icon cross_c"></span></button>
        <p class="pAlert pInfo"><strong class="strongAlert strongInfo">Thông báo</strong><br/> <?php echo $errMsg; ?> <span class="xClose" title="Đóng" onclick="$(this).parent().hide();">x</span></p>
    </div>
<?php } ?>

<div class="row-fluid">
    <div class="span12">
        <div class="box-widget">
            <div class="widget-head overview-chart clearfix">
                <span class="h-icon"><i class="gray-icons graph"></i></span>
                <div class="divPermission"><h4 class="pull-left">PHÂN QUYỀN THÀNH VIÊN</h4></div>
                <div id="reportrange" class="pull-right tai_form"></div>
            </div>
            <div class="widget-container">
                <div class="widget-block">
                    <form action="" method="post" enctype="multipart/form-data" name="formdk" id="formdk">
                        <div style="width:700px; height:auto; margin-left:auto; margin-right:auto; text-align:left;">
                            <div class="divPermissInfo">
                                <span>Chỉnh sửa quyền hạn thành viên: <b><?php echo $row_tbl_users['name']; ?></b></span>
                                <span class="pull-right">Thuộc nhóm quản trị: <b><?php if($row_tbl_users['idgroup'] == 1){echo 'Member';} else if($row_tbl_users['idgroup'] == 2){echo 'Moderator';} else{echo 'Administrator';} ?></b></span>
                            </div>
                            <p>
                                Cho phép truy cập tới toàn bộ các trang quản trị
                                <input type="hidden" id="hiddenAllPermiss" value="0">
                                <input type="checkbox" id="chkAllPermiss" title="Nhấn để cấp tất cả quyền cho thành viên này" onclick="setAllPermission(0);">
                            </p>
                            <table width="100%" class="admin_table tbPermission">
                                <thead>
                                    <tr class="admin_tieude_table">
                                        <td width="2%" align="center">#</td>
                                        <td width="20%" align="center"><span class="title">Tên quyền</span></td>
                                        <td width="3%" align="center">
                                            <input type="hidden" id="hiddenAllCreatePermiss" value="0">
                                            <p>Thêm</p>
                                            <p><input type="checkbox" id="chkAllCreatePermiss" title="Nhấn để cấp quyền thêm mới cho thành viên này ở tất cả các trang quản trị" onclick="setAllPermission(1);"></p>
                                        </td>
                                        <td width="3%" align="center">
                                            <input type="hidden" id="hiddenAllUpdatePermiss" value="0">
                                            <p>Sửa</p>
                                            <p><input type="checkbox" id="chkAllUpdatePermiss" title="Nhấn để cấp quyền chỉnh sửa cho thành viên này ở tất cả các trang quản trị" onclick="setAllPermission(2);"></p>
                                        </td>
                                        <td width="3%" align="center">
                                            <input type="hidden" id="hiddenAllDeletePermiss" value="0">
                                            <p>Xóa</p>
                                            <p><input type="checkbox" id="chkAllDeletePermiss" title="Nhấn để cấp quyền xóa cho thành viên này ở tất cả các trang quản trị" onclick="setAllPermission(3);"></p>
                                        </td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <input type="hidden" id="hiddenChosenPermiss" name="hiddenChosenPermiss">
                                    <input type="hidden" id="hiddenChosenCrud" name="hiddenChosenCrud">
                                    <?php
                                        $lap_quyen = get_records('tbl_permiss','status=1','name COLLATE utf8_unicode_ci, id',' ',' ');
                                        $i = 1;
                                        while($row_lap_quyen = mysql_fetch_assoc($lap_quyen)){
                                            $myPermission = getRecord('tbl_crud', "id_users='".$id."' AND id_permiss='".$row_lap_quyen['id']."'"); ?>
                                        <tr class="trPermission">
                                            <input type="hidden" id="hiddenPermissId<?php echo $i; ?>" value="<?php echo $row_lap_quyen['id']; ?>">
                                            <td align="center"><?php echo $i; ?></td>
                                            <td align="center">
                                                <?php echo $row_lap_quyen['name']; ?>
                                            </td>
                                            <td align="center"><input <?php if(number_in_list($row_tbl_users['list'], $row_lap_quyen['id'])){if($myPermission['isCreate'] == 1 || $myPermission == ''){ ?> checked="checked" <?php }} ?> type="checkbox" id="chkCreate<?php echo $i; ?>"></td>
                                            <td align="center"><input <?php if(number_in_list($row_tbl_users['list'], $row_lap_quyen['id'])){if($myPermission['isUpdate'] == 1 || $myPermission == ''){ ?> checked="checked" <?php }} ?> type="checkbox" id="chkUpdate<?php echo $i; ?>"></td>
                                            <td align="center"><input <?php if(number_in_list($row_tbl_users['list'], $row_lap_quyen['id'])){if($myPermission['isDelete'] == 1 || $myPermission == ''){ ?> checked="checked" <?php }} ?> type="checkbox" id="chkDelete<?php echo $i; ?>"></td>
                                        </tr>
                                    <?php $i++; } ?>
                                </tbody>
                            </table>
                        </div>
                        <br/><br/>
                        <input type="submit" name="them" id="btnPermission" class="nut_table" value="Cập nhật" title="Cập nhật" onclick="return checkPermission();"/>&nbsp;&nbsp;
                        <input type="reset" id="reset" class="nut_table" value="Mặc định">&nbsp;&nbsp;
                        <input type="button" name="quayra" class="nut_table" value="Hủy" title="Hủy" onclick="window.location.href = 'admin.php?act=user'"/><br/>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
