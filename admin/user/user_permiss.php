<?php 
    if(isset($frame) == true){
        check_permiss($_SESSION['kt_login_id'],5,'index.php');
    }else{
        header("location: ../index.php");
    }

  	$id = $_GET['id'];
	settype($id, "int");
	$sql = "SELECT * FROM tbl_users WHERE id = '{$id}'";
	$tbl_users = mysql_query($sql);
	$row_tbl_users = mysql_fetch_assoc($tbl_users);
		
	/*$gt=lap_table('giaovu','idgv='.$_SESSION['kt_login_id'],' ',' ',' ');
	$row_kiemtra=mysql_fetch_assoc($gt);
	if($row_kiemtra['idtruong']!=$row_tbl_users['idtruong']){
		$kiemtra=false;
		//alert thong bao
		echo '<script> alert("Bạn đang truy cập trái phép vào khu vực không được phép, hoặc dữ liệu không tồn tại!") </script>';				
		echo  '<script>window.location="'.$host_link_full.'" </script>';
		//chuyen huong
	}*/
?>

<?php
    if (isset($_POST['them']) == true){ //isset kiem tra submit
        $listquanly = $_POST['cauhinh'];
        settype($idgroup, "int");

        $ddk = '';
        foreach($listquanly as $k => $v){
            $ddk = $ddk.",".$v;
        }
        $ddk = substr($ddk, 1);

        $coloi = false;
        if($coloi == FALSE){
            settype($idgroup, "int");
            settype($id, "int");
            $sql = "UPDATE tbl_users SET list = '{$ddk}' WHERE id = '{$id}'";
            $kq = mysql_query($sql) or die (mysql_error());
            echo thongbao('?act=user', $thongbao = 'Bạn đã thực hiện thành công..!');
        }
    }
?>

<script type="text/javascript">
    $(document).ready(function() {
        $("#chonhet").click(function(){
            var status = this.checked;
            $("input[class='check_md']").each(function(){this.checked = status;})
        });
    });
</script>

<?php if( $errMsg != ""){ ?>
    <div class="alert alert-block no-radius fade in">
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
                            <p>Tên thành viên: <b><?php echo $row_tbl_users['name']; ?></b></p>
                            <p>Nhóm quản trị: <b><?php if($row_tbl_users['idgroup'] == 1){echo 'Member';} else if($row_tbl_users['idgroup'] == 2){echo 'Moderator';} else{echo 'Administrator';} ?></b></p>
                            <table width="100%" class="admin_table tbPermission">
                                <thead>
                                    <tr class="admin_tieude_table">
                                        <td width="3%" align="center">
                                            <input type="checkbox" name="chonhet" id="chonhet" title="Chọn tất cả"/>
                                        </td>
                                        <td width="2%" align="center">#</td>
                                        <td width="20%" align="center"><span class="title">Tên quyền</span></td>
                                        <td width="3%" align="center">Thêm</td>
                                        <td width="3%" align="center">Sửa</td>
                                        <td width="3%" align="center">Xóa</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $lap_quyen = get_records('tbl_permiss','status=1','name COLLATE utf8_unicode_ci, id',' ',' ');
                                        $i = 1;
                                        while($row_lap_quyen = mysql_fetch_assoc($lap_quyen)){
                                            $myPermission = getRecord('tbl_crud', "id_users='".$id."' AND id_permiss='".$row_lap_quyen['id']."'"); ?>
                                        <tr class="trPermission">
                                            <td align="center">
                                                <input <?php if(number_in_list($row_tbl_users['list'], $row_lap_quyen['id'])){ ?> checked="checked" <?php } ?> name="cauhinh[]" class="check_md" type="checkbox" value="<?php echo $row_lap_quyen['id']; ?>"/>
                                            </td>
                                            <td align="center"><?php echo $i; ?></td>
                                            <td align="center">
                                                <?php echo $row_lap_quyen['name']; ?>
                                            </td>
                                            <td align="center"><input <?php if(number_in_list($row_tbl_users['list'], $row_lap_quyen['id'])){if($myPermission['create'] == 1 || $myPermission == ''){ ?> checked="checked" <?php }} ?> type="checkbox" name="chkCreate"></td>
                                            <td align="center"><input <?php if(number_in_list($row_tbl_users['list'], $row_lap_quyen['id'])){if($myPermission['update'] == 1 || $myPermission == ''){ ?> checked="checked" <?php }} ?> type="checkbox" name="chkUpdate"></td>
                                            <td align="center"><input <?php if(number_in_list($row_tbl_users['list'], $row_lap_quyen['id'])){if($myPermission['delete'] == 1 || $myPermission == ''){ ?> checked="checked" <?php }} ?> type="checkbox" name="chkDelete"></td>
                                        </tr>
                                    <?php $i++; } ?>
                                </tbody>
                            </table>
                        </div>
                        <br/><br/>
                        <input type="submit" name="them" class="nut_table" value="Cập nhật" title="Cập nhật"/>&nbsp;&nbsp;
                        <input type="reset" id="reset" class="nut_table" value="Mặc định">&nbsp;&nbsp;
                        <input type="button" name="quayra" class="nut_table" value="Trở về" title="Trở về" onclick="window.history.back();"/><br/>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
