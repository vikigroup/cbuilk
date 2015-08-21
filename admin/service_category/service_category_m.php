<?php
if(isset($frame) == true){
    check_permiss($_SESSION['kt_login_id'],1,'admin.php');
}else{
    header("location: ../admin.php");
}
?>

<script language="javascript">
    function btnSave_onclick(){
        if($('#txtName').val() == ''){
            alert('Bạn chưa nhập "Tên danh mục"!');
            $('#txtName').focus();
            return false;
        }

        if($('#titlePage').val() == ''){
            alert('Bạn chưa nhập "Chủ đề của trang"!');
            $('#titlePage').focus();
            return false;
        }

        if($('#descriptionPage').val() == ''){
            alert('Bạn chưa nhập "Mô tả chủ đề trang"!');
            $('#descriptionPage').focus();
            return false;
        }

        if($('#subject').val() == ''){
            alert('Bạn chưa nhập "Link danh mục VN"! \nBạn có thể nhấn vào nút tạo SEO để hệ thống tự động thực hiện.');
            $('#subject').focus();
            return false;
        }

        if($('#title').val() == ''){
            alert('Bạn chưa nhập "Tiêu đề trang"! \nBạn có thể nhấn vào nút tạo SEO để hệ thống tự động thực hiện.');
            $('#title').focus();
            return false;
        }

        if($('#description').val() == ''){
            alert('Bạn chưa nhập "Mô tả trang"! \nBạn có thể nhấn vào nút tạo SEO để hệ thống tự động thực hiện.');
            $('#description').focus();
            return false;
        }

        if($('#keyword').val() == ''){
            alert('Bạn chưa nhập "từ khóa VN"! \nBạn có thể nhấn vào nút tạo SEO để hệ thống tự động thực hiện.');
            $('#keyword').focus();
            return false;
        }

        document.forms.frmForm.elements.txtDetailShort.value = oEdit1.getHTMLBody();
        document.forms.frmForm.elements.txtDetail.value = oEdit2.getHTMLBody();

        return true;
    }

    $(function(){
        $("#btn-SEO").click(function(){
            var catName = $('#txtName').val().trim();
            if(catName == ''){
                alert('Bạn chưa nhập "Tên danh mục"!');
                $('#txtName').focus();
            }else{
                var catNameAfter = catName.toLowerCase().replace(/ /g, "-");
                var dataString = "string="+catNameAfter+"&functionName="+"removeUnicode";
                $.ajax({
                    type: "POST",
                    url: "../lib/functions.php",
                    data: dataString,
                    success: function(x){
                        $("#subject, #txtSubjectSEO").val(x);
                        $('#title').val(catName);
                        $('#description').val(catName);
                        $("#keyword").val(catName.toLowerCase()+", "+ x.toLowerCase().replace(/-/g, " ").replace(/[0-9]/g, "").trim());
                        $("#charlimitinfo").val(156 - catName.length);
                    }
                });
            }
        });

        $("#charlimitinfo").val(156 - $('#txtName').val().length);
    });
</script>

<? $errMsg =''?>
<?
$path = "../web/images/shopcate";
$pathdb = "images/shopcate";
if (isset($_POST['btnSave'])){
    $code              = isset($_POST['txtCode']) ? trim($_POST['txtCode']) : '';
    $name              = isset($_POST['txtName']) ? trim($_POST['txtName']) : '';
    $parent            = $_POST['ddCat'];
    $parent1           = $_POST['ddCatch'];

    if($parent1 == -1) $parent1 = $parent;
    if($parent1 == -1 && $parent == -1 )$parent1 = 209;

    $subject           = $_POST['txtSubjectSEO'];
    $detail_short      = isset($_POST['txtDetailShort']) ? trim($_POST['txtDetailShort']) : '';
    $detail            = isset($_POST['txtDetail']) ? trim($_POST['txtDetail']) : '';
    $sort              = isset($_POST['txtSort']) ? trim($_POST['txtSort']) : 0;
    $status            = $_POST['chkStatus'];
    $cate              = 2;
    $target            = $_POST['chkTarget'];
    $otherLink         = $_POST['txtOtherLink'];
    $titlePage         = isset($_POST['titlePage']) ? trim($_POST['titlePage']) : "";
    $descriptionPage   = isset($_POST['descriptionPage']) ? trim(htmlspecialchars($_POST['descriptionPage'])) : "";
    $title             = isset($_POST['title']) ? trim($_POST['title']) : "";
    $description       = isset($_POST['description']) ? trim(htmlspecialchars($_POST['description'])) : "";
    $keyword           = isset($_POST['keyword']) ? trim($_POST['keyword']) : "";

    $catInfo       = getRecord('tbl_shop_category', 'id='.$parent);
    if(!$multiLanguage){
        $lang      = $catInfo['lang'];
    }else{
        $lang      = $catInfo['lang'] != '' ? $catInfo['lang'] : $_POST['cmbLang'];
    }

    if ($name=="") $errMsg .= "Hãy nhập tên danh mục !<br>";
    $errMsg .= checkUpload($_FILES["txtImage"],".jpg;.gif;.bmp;.png",250*250,0);
    $errMsg .= checkUpload($_FILES["txtImageLarge"],".jpg;.gif;.bmp;.png",1020*482,0);

    if ($errMsg == ''){
        if (!empty($_POST['id'])){
            $oldid = $_POST['id'];
            $sql = "update tbl_shop_category set code='".$code."',name='".$name."', parent='".$parent1."',subject='".$subject."',detail_short='".$detail_short."',detail='".$detail."', sort='".$sort."', title='".$title."', description='".$description."', keyword='".$keyword."', status='".$status."',last_modified=now(), lang='".$lang."', cate='".$cate."', target='".$target."', other_link='".$otherLink."', title_page='".$titlePage."', description_page='".$descriptionPage."' where id='".$oldid."'";
        }else{
            $sql = "insert into tbl_shop_category (code, name, parent, subject, detail_short, detail, title , description , keyword , sort, status,  date_added, last_modified, lang, cate, target, other_link, title_page , description_page) values ('".$code."','".$name."','".$parent1."','".$subject."','".$detail_short."','".$detail."','".$title."','".$description."','".$keyword."','".$sort."','".$status."',now(),now(),'".$lang."','".$cate."','".$target."','".$otherLink."','".$titlePage."','".$descriptionPage."')";
        }
        if (mysql_query($sql,$conn)){
            if(empty($_POST['id'])) $oldid = mysql_insert_id();
            $r = getRecord("tbl_shop_category","id=".$oldid);

            $arrField = array(
                "subject"          => "'".vietdecode($name)
            );
            $result = update("tbl_shop_category",$arrField,"id=".$oldid);

            $sqlUpdateField = "";

            if ($_POST['chkClearImg']==''){
                $extsmall=getFileExtention($_FILES['txtImage']['name']);
                if (makeUpload($_FILES['txtImage'],"$path/item_category_s$oldid$extsmall")){
                    @chmod("$path/item_category_s$oldid$extsmall", 0777);
                    $sqlUpdateField = " image='$pathdb/item_category_s$oldid$extsmall' ";
                }
            }else{
                if(file_exists('../'.$r['image'])) @unlink('../'.$r['image']);
                $sqlUpdateField = " image='' ";
            }

            if ($_POST['chkClearImgLarge']==''){
                $extlarge=getFileExtention($_FILES['txtImageLarge']['name']);
                if (makeUpload($_FILES['txtImageLarge'],"$path/item_category_l$oldid$extlarge")){
                    @chmod("$path/item_category_l$oldid$extlarge", 0777);
                    if($sqlUpdateField != "") $sqlUpdateField .= ",";
                    $sqlUpdateField .= " image_large='$pathdb/item_category_l$oldid$extlarge' ";
                }
            }else{
                if(file_exists('../'.$r['image_large'])) @unlink('../'.$r['image_large']);
                if($sqlUpdateField != "") $sqlUpdateField .= ",";
                $sqlUpdateField .= " image_large='' ";
            }

            if($sqlUpdateField!='')	{
                $sqlUpdate = "update tbl_shop_category set $sqlUpdateField where id='".$oldid."'";
                mysql_query($sqlUpdate,$conn);
            }
        }else{
            $errMsg = "Hệ thống không thể cập nhật dữ liệu!";
        }
    }

    if ($errMsg == '')
        echo '<script>window.location="admin.php?act=service_category&cat='.$_REQUEST['cat'].'&page='.$_REQUEST['page'].'&code=1"</script>';
}else{
    if (isset($_GET['id'])){
        $oldid = $_GET['id'];
        $page = $_GET['page'];
        $sql = "select * from tbl_shop_category where id='".$oldid."'";
        if ($result = mysql_query($sql,$conn)) {
            $row = mysql_fetch_array($result);
            $code            = $row['code'];
            $name            = $row['name'];

            $parent1         = $row['parent'];
            $parent          = get_field('tbl_shop_category','id',$parent1,'parent');
            if($parent == 2){
                $parent = $parent1;
                $parent1 = -1;
            }

            $subject         = $row['subject'];
            $detail_short    = $row['detail_short'];
            $detail          = $row['detail'];
            $image           = $row['image'];
            $image_large     = $row['image_large'];
            $sort            = $row['sort'];
            $status          = $row['status'];
            $cate            = $row['cate'];
            $date_added      = $row['date_added'];
            $last_modified   = $row['last_modified'];
            $titlePage       = $row['title_page'];
            $descriptionPage = $row['description_page'];
            $title           = $row['title'];
            $description     = $row['description'];
            $keyword         = $row['keyword'];
            $target          = $row['target'];
            $otherLink       = $row['other_link'];
        }
    }
}
?>
<?php if( $errMsg != ""){ ?>
    <div class="alert alert-block no-radius fade in">
        <button type="button" class="close" data-dismiss="alert"><span class="mini-icon cross_c"></span></button>
        <p class="pAlert pWarning"><strong class="strongAlert strongWarning">Cảnh báo!</strong> <?php echo $errMsg; ?> <span class="xClose" title="Đóng" onclick="$(this).parent().hide();">x</span></p>
    </div>
<?php }?>

<script>
    $(document).ready(function() {
        $("#ddCat").change(function(){
            var id = $(this).val();
            if(id != -1){
                var table = "tbl_shop_category";
                $("#ddCatch").load("getChild.php?table="+table+"&id=" +id);
            }
            else{
                $("#ddCatch").length = 0;
                $("#ddCatch").html("<option value='-1'> Chọn danh mục con </option>");
            }
        });
    });
</script>

<div class="row-fluid">
    <div class="span12">
        <div class="box-widget">
            <div class="widget-container">
                <div class="widget-block">
                    <form method="post" name="frmForm" enctype="multipart/form-data" action="admin.php?act=service_category_m">
                        <input type="hidden" name="txtSubject" id="txtSubject">
                        <input type="hidden" name="txtDetailShort" id="txtDetailShort">
                        <input type="hidden" name="txtDetail" id="txtDetail">
                        <input type="hidden" name="act" value="service_category_m">
                        <input type="hidden" name="id" value="<?=$_REQUEST['id']?>">
                        <input type="hidden" name="page" value="<?=$_REQUEST['page']?>">
                        <table class="table_chinh">
                            <tr>
                                <td class="table_chu_tieude_them" colspan="2" align="center" valign="middle">DANH MỤC DỊCH VỤ</td>
                            </tr>
                            <tr class="tr_title">
                                <td valign="middle"> &nbsp;Nội dung danh mục </td>
                                <td valign="middle"> &nbsp;- Phần nhập dữ liệu </td>
                            </tr>
                            <tr>
                                <td valign="middle" class="table_chu"> Danh mục </td>
                                <td valign="middle">
                                    <select name="ddCat" id="ddCat" class="table_list table_selector">
                                        <?php if($_POST['ddCat'] != NULL){ ?>
                                            <option value="<?php echo $idtheloaic = $_POST['ddCat']; ?>">&cir; <?php echo get_field('tbl_shop_category','id',$parent,'name'); ?></option>
                                        <?php }?>
                                        <?php if($parent != -1 && $parent != ""){?>
                                            <option value="<?php echo $parent; ?>">&cir; <?php echo get_field('tbl_shop_category','id',$parent,'name'); ?></option>
                                        <?php }?>
                                        <option value="-1" <?php if($parent == -1) echo 'selected="selected"'; ?> >&cir; Chọn danh mục </option>
                                        <?php
                                        $gt = get_records("tbl_shop_category","parent=209","name COLLATE utf8_unicode_ci"," "," ");
                                        while($row = mysql_fetch_assoc($gt)){?>
                                            <option value="<?php echo $row['id']; ?>" <?php if($parent == $row['id']) echo 'selected="selected"';?> >&cir; <?php echo $row['name']; ?></option>
                                        <?php } ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td height="31" valign="middle" class="table_chu"></td>
                                <td valign="middle">
                                    <select name="ddCatch" id="ddCatch" class="table_list table_selector">
                                        <?php if($_POST['ddCatch'] != NULL && $_POST['ddCatch'] != -1){ ?>
                                            <option value="<?php echo $parent1=$_POST['ddCatch']; ?>"><?php echo get_field('tbl_shop_category','id',$parent1,'name'); ?></option>
                                        <?php }?>
                                        <?php if($parent1 != -1 && $parent1 != ""){ ?>
                                            <?php
                                            $gt = get_records("tbl_shop_category","parent=".$parent,"name COLLATE utf8_unicode_ci"," "," ");
                                            while($row = mysql_fetch_assoc($gt)){ ?>
                                                <option value="<?php echo $row['id']; ?>" <?php if($parent1 == $row['id']) echo 'selected="selected"'; ?> ><?php echo $row['name']; ?></option>
                                            <?php } ?>
                                        <?php }?>
                                        <option value="-1"> Chọn danh mục con </option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td valign="middle" width="30%" class="table_chu">Tên danh mục <span class="sao_bb">*</span></td>
                                <td valign="middle" width="70%">
                                    <input name="txtName" type="text" class="table_khungnho" id="txtName" value="<?=$name?>"/>
                                    <p class="pGuideline"><i>Nhập tên danh mục sẽ hiển thị ở trang tiếng Việt</i></p>
                                </td>
                            </tr>
                            <tr>
                                <td valign="middle" width="30%" class="table_chu">Hình đại diện</td>
                                <td valign="middle" width="70%">
                                    <input type="file" name="txtImage" class="textbox" size="34">
                                    <?php if($image != ''){ ?>
                                        <input type="checkbox" name="chkClearImg" value="on"> Xóa bỏ hình ảnh <br>
                                    <?php } ?>
                                    <?php if($image != ''){echo '<img width="80" border="0" src="../web/'.$image.'">';} ?><br><br>
                                    Hình (kích thước nhỏ)<i> (kích thước chuẩn 250x250, ảnh đuôi JPEG, GIF , JPG , PNG) </i>
                                </td>
                            </tr>
                            <tr>
                                <td valign="middle" class="table_chu">Hình nền</td>
                                <td>
                                    <input name="txtImageLarge" type="file" class="" id="txtImageLarge"/>
                                    <?php if($image_large != ''){ ?>
                                        <input type="checkbox" name="chkClearImgLarge" value="on"> Xóa bỏ hình ảnh <br />
                                    <?php } ?>
                                    <?php if($image_large != ''){echo '<img width="200" border="0" src="../web/'.$image_large.'">';} ?><br><br>
                                    Hình (kích thước lớn)<i> (kích thước chuẩn 1020x482, ảnh đuôi JPEG, GIF , JPG , PNG) </i><br/><br/>
                                </td>
                            </tr>
                            <tr class="tr_title">
                                <td valign="middle"> &nbsp;Nội dung bài viết SEO </td>
                                <td valign="middle"> &nbsp;- Phần dành cho người dùng đọc (phân bổ từ khoá)</td>
                            </tr>
                            <tr>
                                <td valign="middle" width="30%" class="table_chu">Chủ đề của trang <span class="sao_bb">*</span></td>
                                <td valign="middle" width="70%">
                                    <input name="titlePage" type="text" class="table_khungnho" id="titlePage" value="<?=$titlePage?>"/>
                                    <p class="pGuideline"><i>Nội dung thẻ H1: Chủ đề chính của trang, 1 - 2 từ khóa chính, hiển thị ở trang tiếng Việt.</i></p>
                                </td>
                            </tr>
                            <tr>
                                <td valign="middle" width="30%" class="table_chu">Mô tả chủ đề trang <span class="sao_bb">*</span></td>
                                <td valign="middle" width="70%">
                                    <textarea name="descriptionPage" class="table_khungvua" id="descriptionPage"><?=$descriptionPage?></textarea>
                                    <p class="pGuideline"><i>Nội dung bài viết SEO: Vài dòng mô tả về nội dung trang, gom các từ khóa quan trọng <br/> vào, 2 - 3 từ khóa, độ dài khoảng 2 dòng, hiển thị ở trang tiếng Việt.</i></p>
                                </td>
                            </tr>
                            <tr class="tr_title">
                                <td valign="middle"> &nbsp;Nội dung SEO </td>
                                <td valign="middle">&nbsp;- Phần dành cho Google đọc</td>
                            </tr>
                            <tr>
                                <td valign="middle" width="30%" class="table_chu">Tạo SEO</td>
                                <td valign="middle" width="70%">
                                    <input type="button" class="button btn-SEO" value="TẠO SEO" id="btn-SEO">
                                    <p class="pGuideline"><i>Bấm TẠO SEO để tạo Link, Tiêu đề, Mô tả, Từ khoá mẫu.</i></p>
                                </td>
                            </tr>
                            <tr>
                                <td valign="middle" width="30%" class="table_chu">Link danh mục VN<span class="sao_bb">*</span></td>
                                <td valign="middle" width="70%">
                                    <input type="hidden" name="txtSubjectSEO" id="txtSubjectSEO" value="<?=$subject?>">
                                    <input name="subject" type="text" class="table_khungnho" id="subject" value="<?=$subject?>" onchange="optimizeSubjectLink(this.id, 'txtSubjectSEO');"/>
                                    <p class="pGuideline"><i>Link hiển thị ở trang tiếng Việt. Quy tắc: không dấu, không ký tự đặc biệt,<br/> không khoảng trắng, khoảng trắng được thay thế bằng dấu gạch ngang (-).</i></p>
                                </td>
                            </tr>
                            <tr>
                                <td valign="middle" width="30%" class="table_chu">Tiêu đề trang<span class="sao_bb">*</span></td>
                                <td valign="middle" width="70%">
                                    <input name="title" type="text" class="table_khungnho" id="title" value="<?=$title?>"/>
                                    <p class="pGuideline"><i>Nội dung thẻ meta Title hiển thị ở trang tiếng Việt</i></p>
                                </td>
                            </tr>
                            <tr>
                                <td valign="middle" width="30%" class="table_chu">Mô tả trang<span class="sao_bb">*</span></td>
                                <td valign="middle" width="70%">
                                    <textarea name="description" class="table_khungvua" id="description" maxlength="156" onkeypress="limitChars(this.id, 156, 'charlimitinfo');" onkeyup="limitChars(this.id, 156, 'charlimitinfo');" onkeydown="limitChars(this.id, 156, 'charlimitinfo');"><?=$description?></textarea>
                                    <p class="pGuideline"><input type="text" class="txtSEO" id="charlimitinfo" value="156"> ký tự còn lại <b>(Tốt nhất là 156 ký tự).</b></p>
                                    <p class="pGuideline"><i>Nội dung thẻ meta Description hiển thị ở trang tiếng Việt</i></p>
                                </td>
                            </tr>
                            <tr>
                                <td valign="middle" width="30%" class="table_chu">Từ khóa VN<span class="sao_bb">*</span></td>
                                <td valign="middle" width="70%">
                                    <input name="keyword" type="text" class="table_khungnho" id="keyword" value="<?=$keyword?>"/><br/>
                                    <p class="pGuideline"><i>Nội dung từ khóa chính (Thẻ meta Keyword) hiển thị ở trang tiếng Việt</i></p>
                                </td>
                            </tr>
                            <tr class="tr_title">
                                <td valign="middle"> &nbsp;Cài đặt danh mục </td>
                                <td valign="middle"> &nbsp;Phần mở rộng </td>
                            </tr>
                            <tr>
                                <td valign="middle" width="30%" class="table_chu">Liên kết ngoài</td>
                                <td valign="middle" width="70%">
                                    <input class="table_khungnho" value="<?php if($otherLink != ''){echo $otherLink;}else{echo '';} ?>" type="text" name="txtOtherLink" id="txtOtherLink" onchange="if(this.value != ''){addhttp(this.id, this.value);}"/>
                                    <p class="pGuideline"><i>Khi bấm vào danh mục sẽ chuyển đến trang liên kết này, mặc định bỏ trống.<br/> Link phải có http:// hoặc https://, ví dụ: http://www.cbuilk.com</i></p>
                                </td>
                            </tr>
                            <tr>
                                <td valign="top" width="30%" class="table_chu">Tùy chọn</td>
                                <td valign="middle" width="70%">
                                    <input type="checkbox" name="chkStatus" value="<?php if($status > 0){echo $status;}else{echo 0;} ?>" <? if ($status > 0) echo 'checked' ?> onchange="if($(this).is(':checked')){this.value = 1;}else{this.value = 0;}"> Ẩn &nbsp; &nbsp;
                                    <input type="checkbox" name="chkTarget" value="<?php if($target > 0){echo $target;}else{echo 0;} ?>" <? if ($target > 0) echo 'checked' ?> onchange="if($(this).is(':checked')){this.value = 1;}else{this.value = 0;}"> Mở link ngoài ra tab mới
                                </td>
                            </tr>
                            <tr>
                                <td valign="middle" width="30%" class="table_chu">Thứ tự sắp xếp</td>
                                <td valign="middle" width="70%">
                                    <input class="table_khungnho" value="<?php if($sort != ''){echo $sort;}else{echo 0;} ?>" type="text" name="txtSort"/>
                                    <p class="pGuideline"><i>Thứ tự hiển thị của danh mục, sắp xếp tăng dần từ nhỏ đến lớn</i></p>
                                </td>
                            </tr>
                            <tr>
                                <td valign="top" width="30%">&nbsp;</td>
                                <td valign="middle" width="70%">
                                    <input type="submit" name="btnSave" VALUE="Cập nhật" class="button" onclick="return btnSave_onclick();">
                                    <input type="reset" class="button" value="Nhập lại">
                                    <input type="button" id="close" class="button" value="Đóng" onclick="window.location.href = '<?php echo $root.'/admin/admin.php?act='.substr($frame, 0, strlen($frame) - 2); ?>';">
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
