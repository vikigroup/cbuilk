<?php include("shop_post_m_resolve.php"); ?>

<?php if($errMsg != ""){ ?>
    <div class="alert alert-block no-radius fade in">
        <button type="button" class="close" data-dismiss="alert"><span class="mini-icon cross_c"></span></button>
        <p class="pAlert pWarning"><strong class="strongAlert strongWarning">Cảnh báo!</strong> <?php echo $errMsg; ?> <span class="xClose" title="Đóng" onclick="$(this).parent().hide();">x</span></p>
    </div>
<?php } ?>

<div class="row-fluid">
    <div class="span12">
        <div class="box-widget">
            <div class="widget-container">
                <div class="widget-block">
                    <form method="post" name="frmForm" enctype="multipart/form-data" action="admin.php?act=shop_post_m">
                        <input type="hidden" name="act" value="shop_post_m">
                        <input type="hidden" name="id" value="<?=$_REQUEST['id']?>">
                        <input type="hidden" name="page" value="<?=$_REQUEST['page']?>">
                        <table class="table_chinh">
                            <tr>
                                <td class="table_chu_tieude_them" colspan="2" align="center" valign="middle">BÀI VIẾT WEBSITE</td>
                            </tr>
                            <tr class="tr_title">
                                <td valign="middle"> &nbsp;Nội dung bài viết </td>
                                <td valign="middle"> &nbsp;- Phần nhập dữ liệu </td>
                            </tr>
                            <tr>
                                <td valign="middle" class="table_chu">Danh mục<span class="sao_bb">*</span></td>
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
                                        while($row=mysql_fetch_assoc($gt)){ ?>
                                            <option value="<?php echo $row['id']; ?>" <?php if($parent == $row['id']) echo 'selected="selected"';?> >&cir; <?php echo $row['name']; ?></option>
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
                                                <option value="<?php echo $row['id']; ?>" <?php if($parent1 == $row['id']) echo 'selected="selected"'; ?> ><?php echo $row['name']; ?></option>
                                            <?php } ?>
                                        <?php }?>
                                        <option value="-1"> Chọn danh mục con </option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td valign="middle" width="30%" class="table_chu">Tên bài viết VN<span class="sao_bb">*</span></td>
                                <td valign="middle" width="70%">
                                    <input name="txtName" type="text" class="table_khungnho" id="txtName" value="<?=$name?>" onchange="removeStartWith(this.id, this.value);"/>
                                    <p class="pGuideline"><i>Nhập tên bài viết. Tốt nhất là 60 ký tự.</i></p>
                                </td>
                            </tr>
                            <tr>
                                <td height="31" valign="middle" class="table_chu">Chọn thể loại</td>
                                <td valign="middle">
                                    <select name="ddCategory" id="ddCategory" class="table_list table_selector" onchange="checkPostStyle(this.value);">
                                        <?php
                                        $gt = get_records("tbl_shop_category","parent=2","name COLLATE utf8_unicode_ci"," "," ");
                                        while($row = mysql_fetch_assoc($gt)){ ?>
                                            <option value="<?php echo $row['cate']; ?>" <?php if($style == $row['cate']) echo 'selected="selected"';?> ><?php echo $row['name']; ?></option>
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
                                        <input type="checkbox" name="chkClearImg" value="on"> Xóa bỏ hình ảnh <br/><br/>
                                    <?php } ?>
                                    <?php if($image != ''){echo '<img width="80" height="80" border="0" src="../web/'.$image.'">';} ?><br/><br/>
                                    <i> Kích thước chuẩn 883x577(px), ảnh đuôi JPEG, GIF, JPG, PNG, BMP. </i>
                                </td>
                            </tr>
                            <tr class="trPrice">
                                <td valign="middle" width="30%" class="table_chu">Giá bán</td>
                                <td valign="middle" width="70%">
                                    <input name="txtPrice" id="txtPrice" type="text" class="table_khungnho" value="<?=$price?>" onkeyup="moneyString(this.id, 'spanPrice');" onkeypress="validate(event);"/>
                                    <span id="spanPrice" class="strongInfo"></span>
                                    <p class="pGuideline"><i>Giá bán sản phẩm phải là số thực. Giá trị nhỏ nhất là 0 (Giá liên hệ).</i></p>
                                </td>
                            </tr>
                            <tr class="trPrice">
                                <td valign="middle" width="30%" class="table_chu">Giá khuyến mãi</td>
                                <td valign="middle" width="70%">
                                    <input name="txtPricekm" id="txtPricekm" type="text" class="table_khungnho" value="<?=$pricekm?>" onkeyup="moneyString(this.id, 'spanPriceKM');" onkeypress="validate(event);"/>
                                    <span id="spanPriceKM" class="strongInfo"></span>
                                    <p class="pGuideline"><i>Giá khuyến mãi phải nhỏ hơn hoặc bằng giá bán sản phẩm. Giá trị nhỏ nhất là 0 (Giá liên hệ).</i></p>
                                </td>
                            </tr>
                            <tr class="trPrice">
                                <td valign="middle" width="30%" class="table_chu">Loại tiền tệ</td>
                                <td valign="middle" width="70%">
                                    <select name="slCurrency" id="slCurrency" class="slCurrency" onchange="$('#txtPrice, #txtPricekm').keyup();">
                                        <option value="0" <?php if($currency == 0) echo 'selected="selected"';?> >đ</option>
                                        <option value="1" <?php if($currency == 1) echo 'selected="selected"';?> >$</option>
                                    </select>
                                    <p class="pGuideline"><i>đ cho loại tiền tệ VND và $ cho loại tiền tệ USD.</i></p>
                                </td>
                            </tr>
                            <tr class="trPrice">
                                <td valign="middle" width="30%" class="table_chu">Đơn vị tính</td>
                                <td valign="middle" width="70%">
                                    <input name="txtUnit" type="text" id="txtUnit" class="txtUnit" value="<?php if($unit != ''){echo $unit;}else{echo 'máy';}; ?>">
                                    <p class="pGuideline"><i>Mỗi sản phẩm có thể có một đơn vị tính khác nhau. Ví dụ: máy, mét, bình,...</i></p>
                                </td>
                            </tr>
                            <tr>
                                <td valign="middle" class="table_chu">Mô tả ngắn VN<span class="sao_bb">*</span></td>
                                <td valign="middle">&nbsp;</td>
                            </tr>
                            <tr>
                                <td colspan="2" valign="middle">
                                    <textarea name="txtDetailShort" style="width:780px; height:150px; padding: 5px;" id="txtDetailShort"><?php echo $detail_short;?></textarea>
                                    <p class="pGuideline"><i>Đoạn mô tả ngắn bài viết sẽ hiển thị ở trang tiếng Việt.</i></p>
                                </td>
                            </tr>
                            <tr>
                                <td valign="middle" class="table_chu">Nội dung chính VN</td>
                                <td valign="middle">&nbsp;</td>
                            </tr>
                            <tr>
                                <td colspan="2" valign="middle"><textarea name="txtDetail" class="txt" id="txtDetail"><?php echo $detail?></textarea>
                                    <script type="text/javascript">
                                        var editor = CKEDITOR.replace( 'txtDetail',
                                            {
                                                height: 500,
                                                width: 780,
                                                filebrowserImageBrowseUrl : '../lib/ckfinder/ckfinder.html?Type=Images',
                                                filebrowserFlashBrowseUrl : '../lib/ckfinder/ckfinder.html?Type=Flash',
                                                filebrowserImageUploadUrl : '../lib/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
                                                filebrowserFlashUploadUrl : '../lib/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',
                                                fullPage : true
                                            });
                                    </script>
                                </td>
                            </tr>
                            <tr class="tr_title">
                                <td valign="middle"> &nbsp;Nội dung SEO </td>
                                <td valign="middle"> &nbsp;- Phần dành cho google đọc</td>
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
                                    <input name="title" type="text" class="table_khungnho" id="title" value="<?=$title?>" onchange="removeStartWith(this.id, this.value);"/>
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
                                <td valign="middle"> &nbsp;Cài đặt bài viết </td>
                                <td valign="middle"> &nbsp;- Phần mở rộng </td>
                            </tr>
                            <tr>
                                <td valign="middle" width="30%" class="table_chu">Liên kết ngoài</td>
                                <td valign="middle" width="70%">
                                    <input class="table_khungnho" value="<?php if($otherLink != ''){echo $otherLink;}else{echo '';} ?>" type="text" name="txtOtherLink" id="txtOtherLink" onchange="if(this.value != ''){addhttp(this.id, this.value);}"/>
                                    <p class="pGuideline"><i>Khi bấm vào bài viết sẽ chuyển đến trang liên kết này, mặc định bỏ trống.<br/> Link phải có http:// hoặc https://, ví dụ: http://www.cbuilk.com</i></p>
                                </td>
                            </tr>
                            <tr>
                                <td valign="top" width="30%" class="table_chu">Tùy chọn</td>
                                <td valign="middle" width="70%">
                                    <input type="checkbox" name="chkNoIndexNoFollow" value="<?php if($noIndexNoFollow > 0){echo $noIndexNoFollow;}else{echo 0;} ?>" <? if ($noIndexNoFollow > 0) echo 'checked'; ?> onchange="if($(this).is(':checked')){this.value = 1;}else{this.value = 0;}"> Noindex, nofollow &nbsp; &nbsp;
                                    <input type="checkbox" name="chkBlock" value="<?php if($block > 0){echo $block;}else{echo 0;} ?>" <? if ($block > 0) echo 'checked'; ?> onchange="if($(this).is(':checked')){this.value = 1;}else{this.value = 0;}" title="Khi bạn chọn chức năng này. Bài viết này sẽ bị khóa và chỉ quản trị viên mới có thể mở và chỉnh sửa."> Khóa bài viết &nbsp; &nbsp;
                                    <input type="checkbox" name="chkStatus" id="chkStatus" value="<?php if($status > 0){echo $status;}else{echo 0;} ?>" <? if ($status > 0) echo 'checked'; ?> onchange="if($(this).is(':checked')){this.value = 1; $('#hiddenDisplayStatus').val('1');}else{this.value = 0; $('#hiddenDisplayStatus').val('0');}"> Ẩn &nbsp; &nbsp;
                                    <input type="checkbox" name="chkSetTime" id="chkSetTime" value="<?php if($time > date("Y-m-d H:i:s")){echo 1;}else{echo 0;} ?>" <?php if ($time > date("Y-m-d H:i:s")){echo 'checked';} ?> onclick="setTimePost(this.id, 'chkStatus', 'trSetTime', 'hiddenDisplayStatus');"> Hẹn giờ post tin &nbsp; &nbsp;
                                    <input type="checkbox" name="chkHot" value="<?php if($hot > 0){echo $hot;}else{echo 0;} ?>" <? if ($hot > 0) echo 'checked'; ?> onchange="if($(this).is(':checked')){this.value = 1;}else{this.value = 0;}"> Tin hot &nbsp; &nbsp;<br/>
                                    <input type="checkbox" name="chkTop" value="<?php if($top > 0){echo $top;}else{echo 0;} ?>" <? if ($top > 0) echo 'checked'; ?> onchange="if($(this).is(':checked')){this.value = 1;}else{this.value = 0;}"> Nằm trên top &nbsp; &nbsp;
                                    <input type="checkbox" name="chkTarget" value="<?php if($target > 0){echo $target;}else{echo 0;} ?>" <? if ($target > 0) echo 'checked'; ?> onchange="if($(this).is(':checked')){this.value = 1;}else{this.value = 0;}"> Mở link ngoài ra tab mới
                                    <input type="hidden" id="hiddenDisplayStatus" value="<?php if($status > 0){echo $status;}else{echo 0;} ?>">
                                </td>
                            </tr>
                            <tr id="trSetTime" <?php if($time < date("Y-m-d H:i:s")){echo 'style="display: none"';} ?>>
                                <td valign="middle" width="30%" class="table_chu">Thời gian post</td>
                                <td valign="middle" width="70%">
                                    <input class="table_khungnho" value="<?php if($time > date("Y-m-d H:i")){echo strftime('%Y-%m-%dT%H:%M:%S', strtotime($time));}else{echo date('Y-m-d').'T'.date('H:i');} ?>" required="required" type="datetime-local" name="txtSetTime" id="txtSetTime"/>
                                    <p class="pGuideline"><i>Chọn ngày giờ post tin.</i></p>
                                </td>
                            </tr>
                            <tr>
                                <td valign="middle" width="30%" class="table_chu">Số thứ tự</td>
                                <td valign="middle" width="70%">
                                    <input class="table_khungnho" value="<?php if($sort != ''){echo $sort;}else{echo 0;} ?>" type="text" name="txtSort" id="txtSort" onkeypress="validate(event);"/>
                                    <p class="pGuideline"><i>Số thứ tự hiển thị của bài viết, ưu tiên từ nhỏ đến lớn.</i></p>
                                </td>
                            </tr>
                            <tr>
                                <td valign="top" width="30%">&nbsp;</td>
                                <td valign="middle" width="70%">
                                    <input type="submit" name="btnSave" value="Cập nhật" class="nut_table" onclick="return btnSave_onclick();">
                                    <input type="reset" id="reset" class="nut_table" value="Nhập lại">
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