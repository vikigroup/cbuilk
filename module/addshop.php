<?php  
if(isset($_SESSION['kh_login_id'])){
    $id=get_field('tbl_shop','iduser',$_SESSION['kh_login_id'],'id');
    if($id!="") {
        echo '<script> alert("Bạn đã thực hiện việc đăng ký gian hàng cho tài khoản này...") </script>';
        echo  '<script>window.location="'.$linkrootshop.'" </script>';
    }

    if (isset($_POST['btn_dangky'])==true){
            $tenshop = $_POST['tenshop'];
            $tenmien = $_POST['tenmien'];
            $intro   = $_POST['intro'];
            $ddCat   = $_POST['ddCat'];
            $idtemplate   = $_POST['idtemplate'];
            $status  = $_POST['thoathuan'];
            $cap = $_POST['cap'];

            $tenshop = trim(strip_tags($tenshop));
            $tenmien = trim(strip_tags($tenmien));
            $intro   = trim(strip_tags($intro));
            $ddCat   = trim(strip_tags($ddCat));

            if (get_magic_quotes_gpc()==false)
                {
                    $tenshop = mysql_real_escape_string($tenshop);
                    $tenmien = mysql_real_escape_string($tenmien);
                    $intro = mysql_real_escape_string($intro);
                    $ddCat = mysql_real_escape_string($ddCat);
                    $idtemplate = mysql_real_escape_string($idtemplate);
                }

            $coloi=false;

            if ($_SESSION['captcha_code'] != $cap) {$coloi=true; $loi="Mã bảo mật chưa đúng!";}

            if ($loi!="") {$coloi=true; $error_login = $loi;}

            if ($coloi==FALSE)
            {
                $iduser=$_SESSION['kh_login_id'];
                $password=md5(md5(md5($matkhau)));
                $randomkey=chuoingaunhien(50);
                $khoa=1;
                $vale1='iduser,intro,parent,idtemplate,name,subject,date_added,last_modified,status';
                $vale2="'".$iduser."','".$intro."','".$ddCat."','".$idtemplate."','".$tenshop."','".$tenmien."','".$ngay."','".$ngay."',0";
                insert_table('tbl_shop',$vale1,$vale2,$hinh);

                $sql = sprintf("SELECT * FROM tbl_customer WHERE id='%s'", $iduser);
                $user = mysql_query($sql);
                $row_user=mysql_fetch_assoc($user);

                $_SESSION['kh_login_id'] = $row_user['id'];
                $_SESSION['kh_login_username'] = $row_user['username'];

                echo("<script>if(confirm('Xin chúc mừng bạn đã mở gian hàng thành công! Vào trang quản trị ngay')){
                    window.location='http://".$tenmien.".".$sub."/quantri.html';
                 } else {
                    window.location='".$linkrootshop."';
                 };</script>");
            }
    }
    $username = $_SESSION['kh_login_username'];
?>
<script>
$(document).ready(function() {
	$("#idtemplate").change(function(){ 
			var idtheloai=$(this).val();//val(1) gan vao gia tri 1 dung trong form
			$("#gif_slide_frame").load("<?php echo $linkrootshop;?>module/template.php?idtem="+ idtheloai,function() {
					/*tb_init('a.thickbox, area.thickbox, input.thickbox');*/
			}); //alert(idtheloai)
			
		});

	
	$("#tenmien").keyup(function(){  
	   var val=this.value;
	   var strlen=val.length;
	   if(strlen>=2) $("#baoloi").load("<?php echo $linkrootshop;?>/module/tenmien.php?tenmien="+val);
	});

    $('#btn_dangky').click(function(){
        var tenshop = $("#tenshop").val();
        var tenmien = $("#tenmien").val();
        var cap = $("#cap").val();
        var check = 0;
        if(tenshop.length < 2) {
            check = 1;
            alert("Tên gian hàng phải >= 2 ký tự!");
            $('#tenshop').focus();
        }
        else if(tenmien.length < 2) {
            check = 1;
            alert("Ten miền phải >= 2 ký tự!");
            $('#tenmien').focus();
        }
        else if(cap=="") {
            check = 1;
            alert("Bạn chưa nhập mã bảo mật!");
            $('#cap').focus();
        }
        else if(!$('#thoathuan').is(":checked")){
            check = 1;
            alert("Bạn chưa đồng ý với thõa thuận sử dụng của chúng tôi!");
            $('#thoathuan').focus();
        }
        if(check == 0){
            $('#form1').submit();
        }
        else{
            return false;
        }
    });
});
</script>
<div class="form_dn">
    <ul>
        <li id="gif_slide_frame" style="text-align: center;">
            <img src="<?php echo $linkrootshop;?>/imgs/layout/LoginRed.png" alt=""/>
        </li>
        <li>
            <div class="main_f_dn">
                <h1 class="title_f_tt">Đăng ký mở gian hàng </h1>
                <form id="form1" name="form1" method="post">
                <div class="main_f_tt">
                    <div class="module_ftt">
                        <div class="l_f_tt">Tên gian hàng</div>
                        <div class="r_f_tt">
                            <input class="ipt_f_tt" required type="text" name="tenshop" id="tenshop" value="<?php echo $tenshop; ?>" />
                            <span class="star_style">*</span>
                        </div>
                        <div class="clear"></div>
                    </div><!-- End .module_ftt -->
                    <div class="module_ftt">
                        <div class="l_f_tt">Tên miền</div>
                        <div class="r_f_tt" style="position:relative;">
                            <input class="ipt_f_tt" name="tenmien" id="tenmien" required type="text" placeholder="tenmiengianhang" style="width:142px; text-align:left;" value="<?php echo $tenmien; ?>"/>
                            <input name="asdadasd" class="ipt_f_tt" type="text" value=".<?php echo $sub;?>" disabled="disabled"  style="width:70px;" />
                            <span class="star_style">*</span>
                            <div id="baoloi" style="font-style:italic; width:30px; position:absolute;top:0px; right:41px;"> </div>
                        </div>
                        <div class="clear"></div>
                    </div><!-- End .module_ftt -->
                    <div class="module_ftt">
                        <div class="l_f_tt">Loại gian hàng</div>
                        <div class="r_f_tt">
                             <select name="intro" id="intro" class="ipt_f_tt">
                                <option value="0" <?php if($intro==0) echo 'selected="selected"';?>  >Sản phẩm  </option>
                                <option value="1" <?php if($intro==1) echo 'selected="selected"';?>> Giới thiệu công ty </option>
                            </select>
                        </div>
                        <div class="clear"></div>
                    </div><!-- End .module_ftt -->
                     <div class="module_ftt">
                        <div class="l_f_tt">Lĩnh vực kinh doanh</div>
                        <div class="r_f_tt">
                            <select name="ddCat" id="ddCat" class="ipt_f_tt">
                            <?php
                            $sql="SELECT * FROM tbl_shop_category WHERE status=0 and parent=457";
                            $gt=mysql_query($sql) or die(mysql_error());
                            while ($row=mysql_fetch_assoc($gt)){?>
                            <option value="<?php echo $row['id']; ?>"  <?php if($parent==$row['id']) echo 'selected="selected"';?> ><?php echo $row['name']; ?></option>
                            <?php } ?>
                            </select>
                            <span class="star_style">*</span>
                        </div>
                        <div class="clear"></div>
                    </div><!-- End .module_ftt -->
                    <div class="module_ftt">
                        <div class="l_f_tt">Giao diện gian hàng</div>
                        <div class="r_f_tt">
                            <select name="idtemplate" id="idtemplate" class="ipt_f_tt">
                            <?php
                            $sql="SELECT * FROM tbl_template WHERE status=1";
                            $gt=mysql_query($sql) or die(mysql_error());
                            while ($row=mysql_fetch_assoc($gt)){?>
                            <option value="<?php echo $row['id']; ?>"  <?php if($idtemplate==$row['id']) echo 'selected="selected"';?> ><?php echo $row['name']; ?></option>
                            <?php } ?>
                            </select>
                            <span class="star_style">*</span>
                        </div>
                        <div class="clear"></div>
                    </div><!-- End .module_ftt -->
                    <div class="module_ftt">
                        <div class="l_f_tt">Nhập mã xác nhận</div>
                        <div class="r_f_tt">
                            <input style="width:200px;" name="cap" id="cap" required value="<?php echo $cap; ?>" class="ipt_f_tt" type="text"/>
                            <div class="img_capcha" style="width:80px; padding-left:0px;">
                                <img class="img_cap" align="absmiddle" src="<?php echo $linkrootshop;?>/scripts/capcha/dongian.php" alt="">
                                <span class="star_style">*</span>
                            </div>
                        </div>
                        <div class="clear"></div>
                    </div><!-- End .module_ftt -->
                    <div class="module_ftt">
                        <div class="r_f_tt">
                            <input id="thoathuan" name="thoathuan" type="checkbox" value="<?php if($status>0){echo $status;}else{echo 0;} ?>" <? if ($status>0) echo 'checked' ?> onchange="if($(this).is(':checked')){this.value = 1;}else{this.value = 0;}"/>
                                <a target="_blank" href="http://<?php echo $sub; ?>/thong-tin/qui-che-hoat-dong.html" title="" style="padding-left:5px;">Tôi đồng ý với thỏa thuận sử dụng của <?php echo $sub; ?></a>
                            <span class="star_style">*</span>
                        </div>
                        <div class="clear"></div>
                    </div><!-- End .module_ftt -->
                    <div class="module_ftt"style="text-align:center; color:#F00; padding:5px;">
                        <?php echo $error_login;?>
                    </div>
                    <div class="module_ftt">
                        <div class="l_f_tt">
                           &nbsp;
                        </div>
                        <div class="r_f_tt">
                            <div style="padding-bottom:15px;">
                            <input name="btn_dangky" id="btn_dangky" class="btn_dk" type="submit" value="&nbsp;"/>
                            </div>
                        </div>
                        <div class="clear"></div>
                    </div><!-- End .module_ftt -->
                </div><!-- End .main_f_tt -->
                </form>
            </div><!-- End .main_f_dn -->
        </li>
    </ul>
    <div class="clear"></div>
</div>
<?php }else {
	header("Location: ".$linkrootshop."/dang-nhap.html");
}
?>
<script type="text/javascript">
    function goodbye(e) {
        if(!e) e = window.event;
        //e.cancelBubble is supported by IE - this will kill the bubbling process.
        e.cancelBubble = true;
        e.returnValue = 'Bạn chắc chắn muốn rời khỏi?'; //This is displayed on the dialog

        //e.stopPropagation works in Firefox.
        if (e.stopPropagation) {
            e.stopPropagation();
            e.preventDefault();
        }
    }
    window.onbeforeunload=goodbye;
</script>