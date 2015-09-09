<?php include("shop_post_resolve.php"); ?>

<?php if($errMsg != ""){ ?>
    <div class="alert alert-block no-radius fade in">
        <button type="button" class="close" data-dismiss="alert"><span class="mini-icon cross_c"></span></button>
        <p class="pAlert <?php if($status == 0){echo 'pError';} else if($status == 1){echo 'pSuccess';} else if($status == 2){echo 'pInfo';} else{echo 'pWarning';}; ?>">
            <strong class="strongAlert <?php if($status == 0){echo 'strongError';} else if($status == 1){echo 'strongSuccess';} else if($status == 2){echo 'strongInfo';} else{echo 'strongWarning';}; ?>">Thông báo</strong><br/>
            <?php echo $errMsg; ?>
            <span class="xClose" title="Đóng" onclick="$(this).parent().hide();">x</span>
        </p>
    </div>
<?php } ?>

<div class="row-fluid">
    <div class="span12">
        <div class="box-widget">
            <div class="widget-container">
                <div class="widget-block">
                    <form method="POST" action="admin.php?act=shop_post" name="frmForm" enctype="multipart/form-data">
                        <input type="hidden" name="page" value="<?=$page?>">
                        <input type="hidden" name="act" value="shop_post">
                        <table width="100%"  class="admin_table">
                            <thead>
                                <tr align="center" >
                                    <td valign="middle" align="center" colspan="10">
                                        <div class="table_chu_tieude">
                                            <strong>BÀI VIẾT WEBSITE</strong>
                                        </div>
                                    </td>
                                </tr>
                                <tr align="center" >
                                    <td valign="middle" style="background-color:#F0F0F0; height:40px; padding-left:20px" colspan="10">
                                        <select name="ddCat" id="ddCat" class="list_tim_loc table_list">
                                            <?php if($parent != -1){ ?>
                                                <option value="<?php echo $idtheloaic = $_POST['ddCat'] ; ?>"><?php echo get_field('tbl_shop_category','id',$parent,'name'); ?> </option>
                                            <?php }?>
                                            <option value="-1" <?php if($parent == -1) echo 'selected="selected"';?> > Chọn danh mục </option>
                                            <?php
                                            $gt = get_records("tbl_shop_category","parent=2 and id!='".$parent."'","name COLLATE utf8_unicode_ci"," "," ");
                                            while($row = mysql_fetch_assoc($gt)){?>
                                                <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                                                <?php
                                                $gtSub = get_records("tbl_shop_category","parent=".$row['id'],"name COLLATE utf8_unicode_ci"," "," ");
                                                while($rowSub = mysql_fetch_assoc($gtSub)){ ?>
                                                    <option value="<?php echo $rowSub['id']; ?>">&nbsp;&nbsp;&nbsp;|-> <?php echo $rowSub['name']; ?></option>
                                                <?php } ?>
                                            <?php } ?>
                                        </select>
                                        <select name="ddCatch" id="ddCatch" class="list_tim_loc table_list">
                                            <?php if($parent1 != -1 ){ ?>
                                                <option value="<?php echo $parent1; ?>"><?php echo get_field('tbl_shop_category','id',$parent1,'name'); ?> </option>
                                            <?php }?>
                                            <option value="-1" <?php if($parent1 == -1) echo 'selected="selected"';?> > Chọn danh mục con </option>
                                            <?php
                                            $gt = get_records("tbl_shop_category","parent='".$parent."' and id!='".$parent1."' and id not in ('1','2','3')","name COLLATE utf8_unicode_ci"," "," ");
                                            while($row = mysql_fetch_assoc($gt)){?>
                                                <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                                            <?php } ?>
                                        </select>
                                        <input class="table_khungnho" name="tukhoa" id="tukhoa" type="text" value="Từ khóa..." onfocus="if(this.value == 'Từ khóa...') this.value = '';" onblur="if(this.value == '') this.value = 'Từ khóa...';"/>
                                        <input name="tim" type="submit" class="nut_table" id="tim" value="Tìm kiếm"/>
                                        <input type="submit" name="reset" class="nut_table" value="Tất cả" title=" Reset "/>
                                    </td>
                                </tr>
                                <tr >
                                    <td valign="middle" align="left" style="background-color:#F0F0F0; height:40px; padding-left:20px" colspan="10">
                                        <div class="link_loc" style="width:80px;text-align:center; padding:3px; border:solid 1px #999; float:left; margin-right:5px; <?php if($noibat == 0 && $anhien == 0) echo 'background-color:#FF0; color:#000;'; else echo 'background-color:#FFF; color:#FFF;"'; ?>">
                                            <a href="admin.php?act=shop_post&tang=1&anhien=-1&noibat=-1">Tất cả</a>
                                        </div>
                                        <div class="link_loc" style="width:80px; text-align:center; padding:3px; border:solid 1px #999; float:left; margin-right:5px; <?php if($tang == 1) echo 'background-color:#FF0; color:#000;'; else echo 'background-color:#FFF; color:#FFF;"'; ?>" >
                                            <a href="admin.php?act=shop_post&tang=1&anhien=<?php echo $_SESSION['kt_anhien']; ?>&noibat=<?php echo $_SESSION['kt_noibat']; ?>">Tăng dần</a>
                                        </div>
                                        <div class="link_loc" style="width:80px;text-align:center; padding:3px; border:solid 1px #999; float:left; margin-right:5px; <?php if($tang == 0) echo 'background-color:#FF0; color:#000;'; else echo 'background-color:#FFF; color:#FFF;"'; ?>">
                                            <a href="admin.php?act=shop_post&tang=0&anhien=<?php echo $_SESSION['kt_anhien']; ?>&noibat=<?php echo $_SESSION['kt_noibat']; ?>">Giảm dần</a>
                                        </div>
                                        <div class="link_loc" style="width:80px;text-align:center; padding:3px; border:solid 1px #999; float:left; margin-right:5px; <?php if($anhien == 1) echo 'background-color:#FF0; color:#000;'; else echo 'background-color:#FFF; color:#FFF;"'; ?>">
                                            <a href="admin.php?act=shop_post&tang=<?php echo $_SESSION['kt_tang']; ?>&anhien=1&noibat=<?php echo $_SESSION['kt_noibat']; ?>"> Ẩn </a>
                                        </div>
                                        <div class="link_loc" style="width:80px;text-align:center; padding:3px; border:solid 1px #999; float:left; margin-right:5px; <?php if($anhien == 0) echo 'background-color:#FF0; color:#000;'; else echo 'background-color:#FFF; color:#FFF;"'; ?>">
                                            <a href="admin.php?act=shop_post&tang=<?php echo $_SESSION['kt_tang']; ?>&anhien=0&&noibat=<?php echo $_SESSION['kt_noibat']; ?>">Hiện</a>
                                        </div>
                                        <div class="link_loc" style="width:80px;text-align:center; padding:3px; border:solid 1px #999; float:left; margin-right:5px; <?php if($noibat == 1) echo 'background-color:#FF0; color:#000;'; else echo 'background-color:#FFF; color:#FFF;"'; ?>">
                                            <a href="admin.php?act=shop_post&tang=<?php echo $_SESSION['kt_tang']; ?>&anhien=<?php echo $_SESSION['kt_anhien']; ?>&noibat=1">Nổi bật</a>
                                        </div>
                                        <div class="link_loc" style="width:100px;text-align:center; padding:3px; border:solid 1px #999; float:left; margin-right:5px; <?php if($noibat == 0) echo 'background-color:#FF0; color:#000;'; else echo 'background-color:#FFF; color:#FFF;"'; ?>">
                                            <a href="admin.php?act=shop_post&tang=<?php echo $_SESSION['kt_tang']; ?>&anhien=<?php echo $_SESSION['kt_anhien']; ?>&noibat=0">Không nổi bật</a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center" colspan="2">
                                        <input type="submit" value="Xóa chọn" name="btnDel" id="btnDel" class="nut_table">
                                    </td>
                                    <td align="center" class="PageNum" colspan="7">
                                        <?php echo pagesListLimit($totalRows,$pageSize); ?>
                                    </td>
                                    <td width="81" align="center" colspan="1">
                                        <div>
                                            <a href="admin.php?act=shop_post_m" <?php if($myPermission != '' && $myPermission['isCreate'] == 0){echo 'class="disabled"';} ?>>
                                                <img width="48" height="48" border="0" src="images/them.png" <?php if($myPermission != '' && $myPermission['isCreate'] == 0){echo 'class="grayscale"';} ?>>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="admin_tieude_table">
                                    <td align="center">
                                        <input type="checkbox" name="chkall" id="chkall" onClick="chkallClick(this);"/>
                                    </td>
                                    <td align="center">STT</td>
                                    <td align="center"><span class="title"><a class="title">Hình</a></span></td>
                                    <td align="center"><a class="title" href="<?=getLinkSortAdmin(3)?>">Tên </a></td>
                                    <td align="center"><a class="title" href="<?=getLinkSortAdmin(3)?>">Shop</a></td>
                                    <td align="center"><a class="title" href="<?=getLinkSortAdmin(10)?>">Thành viên</a></td>
                                    <td align="center"><a class="title" href="<?=getLinkSortAdmin(15)?>">Tin hot</a></td>
                                    <td align="center"><span class="title"><a class="title" href="<?=getLinkSortAdmin(11)?>">Ẩn/Hiện</a></span></td>
                                    <td align="center"><a class="title" href="<?=getLinkSortAdmin(12)?>">Ngày tạo lập</a></td>
                                    <td align="center">Công cụ</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?
                                $sortby = "order by id $ks";
                                if ($_REQUEST['sortby'] != '') $sortby = "order by ".(int)$_REQUEST['sortby'];
                                $direction = ($_REQUEST['direction'] == '' || $_REQUEST['direction'] == '0' ? "desc" : "");
                                $sql = "select *,DATE_FORMAT(date_added,'%d/%m/%Y %h:%i') as dateAdd,DATE_FORMAT(last_modified,'%d/%m/%Y %h:%i') as dateModify from tbl_item where $where $sortby limit ".($startRow).",".$pageSize;
                                $result = mysql_query($sql,$conn);
                                $i = 0;
                                while($row = mysql_fetch_array($result)){
                                    $parent = getRecord('tbl_item','id = '.$row['parent']);
                                    $color = $i++ % 2 ? "#d5d5d5" : "#e5e5e5"; ?>
                                    <tr>
                                        <td align="center">
                                            <input type="checkbox" name="chk[]" value="<?=$row['id']?>" class="tai_c"/>
                                        </td>
                                        <td align="center"><?=$row['id']?></td>
                                        <td align="center">
                                            <?php if($row['image'] == true){ ?>
                                                <a onclick="positionedPopup(this.href,'myWindow','500','400','100','400','yes'); return false;" href="../web/<?=$row['image']?>" title="Click vào xem ảnh">
                                                    <img src="../web/<?=$row['image']?>" width="80" height="80" border="0" class="hinh"/>
                                                </a>
                                            <?php }else{?>
                                                <img src="../<?php echo $noimgs; ?>" width="80" height="80" border="0" class="hinh"/>
                                            <?php } ?>
                                        </td>
                                        <td align="left" style="padding-left: 5px;">
                                            <a target="_blank" href="<?php if($row['other_link'] != ''){echo $row['other_link'];}else{echo $root.'/'.$row['subject'].'.html';} ?>"><?=$row['name']?></a><br/>
                                            Thể loại: <b><?php echo get_field('tbl_shop_category','id',get_field('tbl_shop_category','id',$row['parent1'],'id'),'name'); ?></b><br/>
                                            Loại: <b><?php echo get_field('tbl_shop_category','id',$row['parent'],'name'); ?></b>
                                        </td>
                                        <td align="center">
                                            <a href="http://<?php echo get_field('tbl_shop','id',$row['idshop'],'subject'); ?>.<?php echo $sub; ?>" target="_blank"><?php echo get_field('tbl_shop','id',$row['idshop'],'name'); ?></a>
                                        </td>
                                        <td align="center">
                                            <?php echo get_field('tbl_customer','id',get_field('tbl_shop','id',$row['idshop'],'iduser'),'username'); ?>
                                        </td>
                                        <td align="center">
                                            <span class="smallfont">
                                                <img src="images/noibat_<?=$row['hot']?>.png" alt="" width="25" height="25" class="hot<?php if(($row['block'] == 1 && $_SESSION['kt_login_level'] != 3) || ($myPermission != '' && $myPermission['isUpdate'] == 0)){echo ' disabled grayscale';} ?>" title="<?php if($row['hot'] == 1){echo 'Nhấn vào để cài đặt về mặc định';} else{echo 'Nhấn vào để cài đặt là tin hot';} ?>" value="<?=$row['id']?>"/>
                                            </span>
                                        </td>
                                        <td align="center">
                                            <span class="smallfont">
                                                <img src="images/anhien_<?=$row['status']?>.png" width="25" height="25" class="anhien<?php if(($row['block'] == 1 && $_SESSION['kt_login_level'] != 3) || ($myPermission != '' && $myPermission['isUpdate'] == 0)){echo ' disabled grayscale';} ?>" title="<?php if($row['status'] == 1){echo 'Nhấn vào để hiện';} else{echo 'Nhấn vào để ẩn';} ?>" value="<?=$row['id']?>"/>
                                            </span>
                                        </td>
                                        <td align="center"><?=$row['dateAdd']?></td>
                                        <td align="center">
                                            <a target="_blank" class="aShopPost" title="Xem bài viết" href="<?php echo $root.'/'.$row['subject'].'.html'; ?>">
                                                <img class="imgViewIcon" src="images/view_icon.png"/>
                                            </a>
                                            <a class="aShopPost<?php if(($row['block'] == 1 && $_SESSION['kt_login_level'] != 3) || ($myPermission != '' && $myPermission['isUpdate'] == 0)){echo ' disabled';} ?>" title="Cập nhật" href="admin.php?act=shop_post_m&cat=<?=$_REQUEST['cat']?>&page=<?=$_REQUEST['page']?>&id=<?=$row['id']?>">
                                                <img <?php if(($row['block'] == 1 && $_SESSION['kt_login_level'] != 3) || ($myPermission != '' && $myPermission['isUpdate'] == 0)){echo 'class="grayscale"';} ?> src="images/icon3.png"/>
                                            </a>
                                            <a class="aShopPost<?php if(($row['block'] == 1 && $_SESSION['kt_login_level'] != 3) || ($myPermission != '' && $myPermission['isDelete'] == 0)){echo ' disabled';} ?>"  title="Xóa" href="admin.php?act=shop_post&action=del&page=<?=$_REQUEST['page']?>&id=<?=$row['id']?>" onclick="return confirm('Bạn chắc chắn muốn xoá?');">
                                                <img <?php if(($row['block'] == 1 && $_SESSION['kt_login_level'] != 3) || ($myPermission != '' && $myPermission['isDelete'] == 0)){echo 'class="grayscale"';} ?> src="images/icon4.png" width="20" border="0"/>
                                            </a>
                                        </td>
                                    </tr>
                                <?php }?>
                            </tbody>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>