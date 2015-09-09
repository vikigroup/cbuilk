<?php include("shop_category_m_resolve.php"); ?>

<?php if($errMsg != ""){ ?>
<div class="alert alert-block no-radius fade in">
    <button type="button" class="close" data-dismiss="alert"><span class="mini-icon cross_c"></span></button>
    <p class="pAlert pWarning"><strong class="strongAlert strongWarning">Cảnh báo!</strong> <?php echo $errMsg; ?> <span class="xClose" title="Đóng" onclick="$(this).parent().hide();">x</span></p>
</div>
<?php } ?>

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
                   <form method="post" name="frmForm" enctype="multipart/form-data" action="admin.php?act=shop_category_m">
                        <input type="hidden" name="txtSubject" id="txtSubject">
                        <input type="hidden" name="txtDetailShort" id="txtDetailShort">
                        <input type="hidden" name="txtDetail" id="txtDetail">
                        <input type="hidden" name="act" value="shop_category_m">
                        <input type="hidden" id="id" name="id" value="<?=$_REQUEST['id']?>">
                        <input type="hidden" name="page" value="<?=$_REQUEST['page']?>">
                        <table class="table_chinh">
                            <tr>
                              <td class="table_chu_tieude_them" colspan="2" align="center" valign="middle">DANH MỤC WEBSITE</td>
                            </tr>
                            <tr class="tr_title">
                                <td valign="middle"> &nbsp;Nội dung danh mục </td>
                                <td valign="middle"> &nbsp;- Phần nhập dữ liệu </td>
                            </tr>
                            <tr>
                              <td valign="middle" class="table_chu">Danh mục <span class="sao_bb">*</span></td>
                              <td valign="middle">
                                  <select name="ddCat" id="ddCat" class="table_list table_selector">
                                      <?php if($_POST['ddCat'] != NULL){ ?>
                                          <option value="<?php echo $idtheloaic = $_POST['ddCat']; ?>">&cir; <?php echo get_field('tbl_shop_category','id',$parent,'name'); ?></option>
                                      <?php }?>
                                      <?php if($parent != -1 && $parent != ""){ ?>
                                          <option value="<?php echo $parent; ?>">&cir; <?php echo get_field('tbl_shop_category','id',$parent,'name'); ?></option>
                                      <?php }?>
                                      <option value="-1" <?php if($parent == -1) echo 'selected="selected"'; ?> >&cir; Chọn danh mục </option>
                                      <?php
                                      $gt = get_records("tbl_shop_category","parent=2","name COLLATE utf8_unicode_ci"," "," ");
                                      while($row = mysql_fetch_assoc($gt)){ ?>
                                      <option value = "<?php echo $row['id']; ?>" <?php if($parent == $row['id']) echo 'selected="selected"';?>>&cir; <?php echo $row['name']; ?></option>
                                          <?php
                                          $gtSub = get_records("tbl_shop_category","parent=".$row['id'],"name COLLATE utf8_unicode_ci"," "," ");
                                          while($rowSub = mysql_fetch_assoc($gtSub)){ ?>
                                              <option value="<?php echo $rowSub['id']; ?>">&nbsp;&nbsp;&nbsp;|-> <?php echo $rowSub['name']; ?></option>
                                          <?php } ?>
                                      <?php } ?>
                                  </select>
                              </td>
                            </tr>
                            <tr>
                                <td height="31" valign="middle" class="table_chu"></td>
                                <td valign="middle">
                                    <select name="ddCatch" id="ddCatch" class="table_list table_selector">
                                        <?php if($_POST['ddCatch'] != NULL && $_POST['ddCatch'] != -1){ ?>
                                            <option value="<?php echo $parent1 = $_POST['ddCatch']; ?>"><?php echo get_field('tbl_shop_category','id',$parent1,'name'); ?></option>
                                        <?php }?>
                                        <?php if($parent1 != -1 && $parent1 != ""){ ?>
                                            <?php
                                            $gt = get_records("tbl_shop_category","parent=".$parent,"name COLLATE utf8_unicode_ci"," "," ");
                                            while($row = mysql_fetch_assoc($gt)){ ?>
                                                <option value="<?php echo $row['id']; ?>" <?php if($parent1 == $row['id']) echo 'selected="selected"'; ?>><?php echo $row['name']; ?></option>
                                            <?php } ?>
                                        <?php }?>
                                        <option value="-1"> Chọn danh mục con </option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td valign="middle" width="30%" class="table_chu">Tên danh mục<span class="sao_bb">*</span></td>
                                <td valign="middle" width="70%">
                                    <input name="txtName" type="text" class="table_khungnho" id="txtName" value="<?=$name?>"/>
                                    <p class="pGuideline"><i>Nhập tên danh mục sẽ hiển thị ở trang tiếng Việt.</i></p>
                                </td>
                            </tr>
                            <tr>
                                <td height="31" valign="middle" class="table_chu">Chọn thể loại</td>
                                <td valign="middle">
                                    <select name="ddCategory" id="ddCategory" class="table_list table_selector">
                                        <?php
                                        $gt = get_records("tbl_shop_category","parent=2","name COLLATE utf8_unicode_ci"," "," ");
                                        while($row = mysql_fetch_assoc($gt)){ ?>
                                            <option value="<?php echo $row['cate']; ?>" <?php if($cate == $row['cate']) echo 'selected="selected"';?> ><?php echo $row['name']; ?></option>
                                        <?php } ?>
                                    </select>
                                    <p class="pGuideline"><i>Mỗi thể loại có chức năng khác nhau.<br/> Ví dụ: loại Tin tức để chứa tin tức, loại Sản phẩm để chứa sản phẩm.</i></p>
                                </td>
                            </tr>
                            <tr>
                                <td valign="middle" width="30%" class="table_chu">Hình đại diện</td>
                                <td valign="middle" width="70%">
                                    <input type="file" name="txtImage" class="textbox" size="34">
                                    <?php if($image != ''){ ?>
                                        <input type="checkbox" name="chkClearImg" value="on"> Xóa bỏ hình ảnh <br/>
                                    <?php } ?>
                                    <?php if($image != ''){echo '<img width="80" border="0" src="../web/'.$image.'">';} ?><br/><br/>
                                    Hình (kích thước nhỏ)<i> (kích thước chuẩn 250x250(px), ảnh đuôi JPEG, GIF, JPG, PNG, BMP). </i>
                                </td>
                            </tr>
                            <tr>
                               <td valign="middle" class="table_chu">Hình nền</td>
                               <td>
                                   <input name="txtImageLarge" type="file" class="" id="txtImageLarge"/>
                                   <?php if($image_large != ''){ ?>
                                       <input type="checkbox" name="chkClearImgLarge" value="on"> Xóa bỏ hình ảnh <br/>
                                   <?php } ?>
                                   <?php if($image_large != ''){echo '<img width="200" border="0" src="../web/'.$image_large.'">';} ?><br/><br/>
                                   Hình (kích thước lớn)<i> (kích thước chuẩn 1020x482(px), ảnh đuôi JPEG, GIF, JPG, PNG, BMP). </i><br/><br/>
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
                                    <p class="pGuideline"><i>Nội dung thẻ meta Title hiển thị ở trang tiếng Việt.</i></p>
                                </td>
                             </tr>
                            <tr>
                                <td valign="middle" width="30%" class="table_chu">Mô tả trang<span class="sao_bb">*</span></td>
                                <td valign="middle" width="70%">
                                    <textarea name="description" class="table_khungvua" id="description" maxlength="156" onkeypress="limitChars(this.id, 156, 'charlimitinfo');" onkeyup="limitChars(this.id, 156, 'charlimitinfo');" onkeydown="limitChars(this.id, 156, 'charlimitinfo');"><?=$description?></textarea>
                                    <p class="pGuideline"><input type="text" class="txtSEO" id="charlimitinfo" disabled> ký tự còn lại <b>(Tốt nhất là 156 ký tự).</b></p>
                                    <p class="pGuideline"><i>Nội dung thẻ meta Description hiển thị ở trang tiếng Việt.</i></p>
                                </td>
                             </tr>
                            <tr>
                                <td valign="middle" width="30%" class="table_chu">Từ khóa VN<span class="sao_bb">*</span></td>
                                <td valign="middle" width="70%">
                                    <input name="keyword" type="text" class="table_khungnho" id="keyword" value="<?=$keyword?>"/><br/>
                                    <p class="pGuideline"><i>Nội dung từ khóa chính (Thẻ meta Keyword) hiển thị ở trang tiếng Việt.</i></p>
                                </td>
                            </tr>
                            <tr class="tr_title">
                                <td valign="middle"> &nbsp;Cài đặt danh mục </td>
                                <td valign="middle"> &nbsp;- Phần mở rộng </td>
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
                                    <input type="checkbox" name="chkStatus" value="<?php if($status > 0){echo $status;}else{echo 0;} ?>" <? if ($status > 0) echo 'checked'; ?> onchange="if($(this).is(':checked')){this.value = 1;}else{this.value = 0;}"> Ẩn &nbsp; &nbsp;
                                    <input type="checkbox" name="chkTarget" value="<?php if($target > 0){echo $target;}else{echo 0;} ?>" <? if ($target > 0) echo 'checked'; ?> onchange="if($(this).is(':checked')){this.value = 1;}else{this.value = 0;}"> Mở link ngoài ra tab mới
                                </td>
                            </tr>
                            <tr>
                                <td valign="middle" width="30%" class="table_chu">Thứ tự sắp xếp</td>
                                <td valign="middle" width="70%">
                                    <input class="table_khungnho" value="<?php if($sort != ''){echo $sort;}else{echo 0;} ?>" type="text" name="txtSort" onkeypress="validate(event);"/>
                                    <p class="pGuideline"><i>Thứ tự hiển thị của danh mục, sắp xếp tăng dần từ nhỏ đến lớn</i></p>
                                </td>
                            </tr>
                            <tr>
                                <td valign="top" width="30%">&nbsp;</td>
                                <td valign="middle" width="70%">
                                    <input type="submit" name="btnSave" VALUE="Cập nhật" class="nut_table" onclick="return btnSave_onclick();">
                                    <input type="reset" class="nut_table" value="Nhập lại">
                                    <input type="button" id="close" class="nut_table" value="Đóng" onclick="window.location.href = '<?php echo $root.'/admin/admin.php?act='.substr($frame, 0, strlen($frame) - 2); ?>';">
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
