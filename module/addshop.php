<?php  
if(isset($_SESSION['kh_login_id'])){
	
// check dang nhap thanh vien	
$id=get_field('tbl_shop','iduser',$_SESSION['kh_login_id'],'id');
if($id!="") {
	echo '<script> alert("Bạn đã thực hiện việc đăng ký gian hàng cho tài khoản này...") </script>';
	echo  '<script>window.location="'.$linkrootshop.'" </script>';
}

if(isset($_SESSION['kh_login_username'])){  
	$row_user  = getRecord('tbl_customer', "username='".$_SESSION['kh_login_username']."'");
 
	if($row_user['mobile']=="" || $row_user['address']=="") {
	   /* $_SESSION['back_shop']="http://shop.jbs.vn".$_SERVER['REQUEST_URI'];
		unset($_SESSION['back_raovat']);
		header("location: http://shop.jbs.vn/quan-ly.html");*/
	}
}

if (isset($_POST['btn_dangky'])==true)//isset kiem tra submit
	{
		
		$tenshop = $_POST['tenshop'];
		$tenmien = $_POST['tenmien'];
		$intro   = $_POST['intro'];
		$ddCat   = $_POST['ddCat'];
		$idtemplate   = $_POST['idtemplate'];
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
		if ($tenshop == NULL){$coloi=true; $coloi_hien_tenshop = "Bạn chưa nhập tên shop (>=4 ký tự)";} 
		if ($tenmien == NULL){$coloi=true; $coloi_hien_tenmien = "Bạn chưa nhập tên miền(>=6 ký tự)";}
		if ($intro == NULL){$coloi=true; $coloi_hien_intro = "Bạn chưa chọn loại shop";}
		if ($ddCat == NULL){$coloi=true; $coloi_hien_ddCat = "Bạn chưa chọn lĩnh vực kinh doanh";}
		if ($idtemplate == NULL){$coloi=true; $coloi_hien_idtemplate = "Bạn chưa chọn giao diện";}
		if ($cap == NULL){$coloi=true; $coloi_hien_cap= "Bạn chưa nhập ký tự giống trong hình ";} 
		

		
		if($tenshop!=NULL){
			if (strlen($tenshop)<4){$coloi=true; $coloi_hien_tenshop = "Tên shop (>=4 ký tự)";}
		}

		if($tenmien!=NULL){
			if (strlen($tenmien)<6){$coloi=true; $coloi_hien_tenmien = "Tên miền (>=6 ký tự)";}
		}

	
		if ($cap!=NULL){
		if ($_SESSION['captcha_code'] != $cap) {$coloi=true; $coloi_hien_cap="Bạn nhập sai mã số trong hình rồi";}
		}

		if ($loi!="") {$coloi=true; $error_hien_filechon = $loi;}

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

			
			echo thongbao("http://".$tenmien.".".$sub."/quantri.html",$thongbao='Chúc mừng bạn đã đăng ký shop thành công...')	;
			
		}
}

	$username = $_SESSION['kh_login_username'];
	if (isset($_POST['quayra'])==true) {

		header("location: $linkrootshop");
	}

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
	   if(strlen>=4) $("#baoloi").load("<?php echo $linkrootshop;?>/module/tenmien.php?tenmien="+val); 
	});
});
	
	

</script>
<div class="form_dn">
    
    <ul>
        <li id="gif_slide_frame"  >
            <center>
                <img src="<?php echo $linkrootshop;?>/imgs/layout/LoginRed.jpg" alt=""/>
            </center>
        </li>
        <li>
            <div class="main_f_dn">
                <h1 class="title_f_tt">Đăng ký mở website </h1>
                <form id="form1" name="form1" method="post" action="#">
                <div class="main_f_tt">
                
                    <div class="module_ftt">
                        <div class="l_f_tt">
                            Tên shop
                        </div>
                        <div class="r_f_tt">
                            <input class="ipt_f_tt" type="text" name="tenshop" value="<?php echo $name; ?>" />
                            <span class="star_style">*</span>
                        </div>
                        <div class="clear"></div>
                    </div><!-- End .module_ftt -->
                    
                    <div class="module_ftt">
                        <div class="l_f_tt">
                            Tên miền vào shop 
                        </div>
                        <div class="r_f_tt" style="position:relative;">
                            <input class="ipt_f_tt" name="tenmien" id="tenmien" type="text" value="tenmiengianhang" onblur="if(this.value=='') this.value='tenmiengianhang';" onfocus="if(this.value=='tenmiengianhang') this.value='';" style="width:142px; text-align:left; color:#CCC;" />
                            <input name="asdadasd" class="ipt_f_tt" type="text" value="<?php echo $sub;?>" disabled="disabled"  style="width:50px; text-transform:uppercase;" />
                            <span class="star_style">*</span>
                            <div id="baoloi" style="font-style:italic; width:30px; position:absolute;top:0px; right:41px;"> </div>
                        </div>
                        <div class="clear"></div>
                    </div><!-- End .module_ftt -->
                    
                    <div class="module_ftt">
                        <div class="l_f_tt">
                          Loại web
                        </div>
                        <div class="r_f_tt">
                             <select name="intro" id="intro" class="ipt_f_tt">
                                    <option value="0" <?php if($intro==0) echo 'selected="selected"';?>  >Sản phẩm  </option>
                                    <option value="1" <?php if($intro==1) echo 'selected="selected"';?>>Giới thiệu công ty</option>
                                </select>
                             
                        </div>
                        <div class="clear"></div>
                    </div><!-- End .module_ftt -->
                    
                     <div class="module_ftt">
                        <div class="l_f_tt">
                           Lĩnh vực kinh doanh
                        </div>
                        <div class="r_f_tt">
                            <select name="ddCat" id="ddCat" class="ipt_f_tt">
                            <option value="-1"  > Chọn lĩnh vực kinh doanh</option>
                            <?php  
                            $sql="SELECT * FROM tbl_shop_category WHERE status=0 and parent=2";
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
                        <div class="l_f_tt">
                          Giao diện web
                        </div>
                        <div class="r_f_tt">
                            <select name="idtemplate" id="idtemplate" class="ipt_f_tt">
                            <option value="-1"  > Chọn giao diện</option>
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
                        <div class="l_f_tt">
                          Nhập mã xác nhận
                        </div>
                        <div class="r_f_tt">
                            <input name="cap" value="<?php echo $cap; ?>" class="ipt_f_tt" type="text"/>
                            <div class="img_capcha">
                            <img  class="img_cap" align="absmiddle" src="<?php echo $linkrootshop;?>/scripts/capcha/dongian.php" alt="">
                            </div>
                            <span class="star_style">*</span>
                        </div>
                        <div class="clear"></div>
                    </div><!-- End .module_ftt -->
                    
                    <div class="module_ftt">
                        <div class="l_f_tt">
                          &nbsp;
                        </div>
                        <div class="r_f_tt">
                            <input type="checkbox"/>
                                <a href="#" title="" style="padding-left:5px;">Tôi đồng ý với thỏa thuận sử dụng</a>
                            <span class="star_style">*</span>
                        </div>
                        <div class="clear"></div>
                    </div><!-- End .module_ftt -->
                    
                    <div class="module_ftt">
                        <div class="l_f_tt">
                           &nbsp;
                        </div>
                        <div class="r_f_tt">
                            <div style="padding-bottom:15px;">
                            <input name="btn_dangky" class="btn_dn" type="submit" value="&nbsp;"/>
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