<?php
 
		$id= $_SESSION['kh_login_id'];	
		settype($id,"int");
		
		if($id=="") header("location: $linkrootshop");
		
		$row_quantri=getRecord('tbl_customer','id='.$id);

	if (isset($_POST['them'])==true)//isset kiem tra submit
	
		{
			$ten = $_POST['ten'];
			$mobile  = $_POST['dienthoai'];
			$email  = $_POST['email'];
			$diachi  = $_POST['diachi'];
			$cmnd  = $_POST['cmnd'];
			
	
			$ten = trim(strip_tags($ten));
			$mobile = trim(strip_tags($mobile));
			$emai = trim(strip_tags($emai));
			$diachi = trim(strip_tags($diachi));
			$cmnd = trim(strip_tags($cmnd));
	
			if (get_magic_quotes_gpc()==false) 
	
				{
					$ten = mysql_real_escape_string($ten);
					$mobile = mysql_real_escape_string($mobile);
					$emai = mysql_real_escape_string($emai);
					$diachi  = mysql_real_escape_string($diachi);
					$cmnd  = mysql_real_escape_string($cmnd);
				}
	
			$coloi=false;	
			if ($ten == NULL){$coloi=true; $coloi_hien_ten = "Bạn chưa nhập họ tên";}
			if ($mobile == NULL){$coloi=true; $coloi_hien_mobile = "Bạn chưa nhập số điện thoại";}
			if ($email == NULL){$coloi=true; $coloi_hien_email = "Bạn chưa nhập địa chỉ mail";}
			if ($diachi == NULL){$coloi=true; $coloi_hien_diachi = "Bạn chưa nhập địa chỉ";}
			if ($cmnd == NULL){$coloi=true; $coloi_hien_cmnd = "Bạn chưa nhập cmnd";}

			if($email!=NULL){
				if (filter_var($email,FILTER_VALIDATE_EMAIL)==FALSE){$coloi=true; $coloi_hien_email= "Bạn nhập email không đúng kiểu ( email@yahoo.com )";	
				}
			}
			
			if($email!=NULL){
				if (check_table('tbl_customer','email='."'".$email."' AND id!=".$id,'id')==false) {$coloi=true; $coloi_hien_email = "Địa chỉ mail này đã có người dùng";}
			}
			if($mobile!=NULL){
				if (check_table('tbl_customer','mobile='."'".$mobile."' AND id!=".$id,'id')==false) {$coloi=true; $coloi_hien_mobile = "Điện thoại này đã có người dùng";}
			}
			
			if ($coloi==FALSE) $hinh=luu_hinh('filechon','../','images/gianhang/cus/',$loi);// root chua hinh upload	
			//if ($hinh == NULL){$coloi=true; $error_hien_filechon = "<br />Bạn chưa chọn file";}
			if ($loi!="") {$coloi=true; $error_hien_filechon = $loi;}
			
			if($coloi==FALSE)
			{
				$up="name='".$ten."',mobile='".$mobile."',email='".$email."',address='".$diachi."',cmnd='".$cmnd."'";
				update_table('tbl_customer',$id,$up,$hinh,' ');
				/*echo "<script language='javascript'>alert('Chúc mừng bạn đã thay đổi thông tin tài khoản thành công..!');</script>";*/
				if(isset($_SESSION['back_bds'])) echo '<script>window.location="'.$_SESSION['back_bds'].'"</script>';
				if(isset($_SESSION['back_raovat'])) echo '<script>window.location="'.$_SESSION['back_raovat'].'"</script>';
				if(isset($_SESSION['back_shop'])) echo '<script>window.location="'.$_SESSION['back_shop'].'"</script>';
				
				location($linkrootshop);
				//header("location: admin.php");
			}
		}
	if (isset($_POST['quayra'])==true) {
		header("location: $linkrootshop");
	}
 
	
	$name=$row_quantri['name'];
	$mobile=$row_quantri['mobile'];
	$diachi=$row_quantri['address'];
	$email=$row_quantri['email'];
 	$cmnd=$row_quantri['cmnd'];
?>
<div class="form_dn">
    
    <ul>
        <li>
            <center>
                <img src="<?php echo $linkrootshop;?>/imgs/layout/LoginRed.jpg" alt=""/>
            </center>
        </li>
        <li> 
            <div class="main_f_dn">
                <h1 class="title_f_tt"> Thêm thông tin</h1>
                <form id="form1" name="form1" method="post" action="#">
                <div class="main_f_tt">
                
                	<div class="module_ftt" style="padding:5px; color:#F00; width:60%; margin:0 auto;">
                    	<?php 
						if($_SERVER['HTTP_REFERER']=="http://shop.jbs.vn/dang-nhap.html" || $_SERVER['HTTP_REFERER']=="http://shop.jbs.vn/dang-ky-gian-hang.html" ) echo "Thông tin của bạn thiếu số điện thoại hoặc địa chỉ, vui lòng điền đầy đủ thông tin vào để có thể đăng tin";
						if($_SERVER['HTTP_REFERER']=="http://raovat.jbs.vn/dang-tin.html" ) echo "Thông tin của bạn thiếu số điện thoại hoặc địa chỉ, vui lòng điền đầy đủ thông tin vào để có thể đăng tin";
						?>
                    </div>
                    <div class="module_ftt">
                        <div class="l_f_tt">
                            Họ và tên
                        </div>
                        <div class="r_f_tt">
                            <input class="ipt_f_tt" type="text" name="ten" value="<?php echo $name;?>" />
                            <span class="star_style">*</span>
                        </div>
                        <div class="clear"></div>
                    </div><!-- End .module_ftt -->
                    
                    <div class="module_ftt">
                        <div class="l_f_tt">
                           Email
                        </div>
                        <div class="r_f_tt">
                            <input class="ipt_f_tt" name="email"  type="text" value="<?php echo $email;?>" />
                            <span class="star_style">*</span>
                        </div>
                        <div class="clear"></div>
                    </div><!-- End .module_ftt -->
                    
                     <div class="module_ftt">
                        <div class="l_f_tt">
                           Điện thoại
                        </div>
                        <div class="r_f_tt">
                            <input class="ipt_f_tt" name="dienthoai" type="text" value="<?php echo $mobile;?>" />
                            <span class="star_style">*</span>
                        </div>
                        <div class="clear"></div>
                    </div><!-- End .module_ftt -->
                    
                    <div class="module_ftt">
                        <div class="l_f_tt">
                           Địa chỉ
                        </div>
                        <div class="r_f_tt">
                            <input class="ipt_f_tt" name="diachi" type="text" value="<?php echo $diachi;?>" />
                            <span class="star_style">*</span>
                        </div>
                        <div class="clear"></div>
                    </div><!-- End .module_ftt -->
                    
                    <div class="module_ftt">
                        <div class="l_f_tt">
                           Số CMND
                        </div>
                        <div class="r_f_tt">
                            <input class="ipt_f_tt" name="cmnd" type="text" value="<?php echo $cmnd;?>" />
                            <span class="star_style">*</span>
                        </div>
                        <div class="clear"></div>
                    </div><!-- End .module_ftt -->
                    
                    <div class="module_ftt">
                        <div class="l_f_tt">
                           Hình đại diện
                        </div>
                        <div class="r_f_tt">
                            <input class="file_chon" type="file" size="34" name="filechon"/>
                            <?php if($row_quantri['image']==true){ ?>
                                <img src="<?php echo $linkroot ;?>/web/<?php echo $row_quantri['image'];?>" width="80" height="80" border="0" class="hinh" />
                            <?php }else{?>
                                <!--<img src="<?php echo $linkroot ;?>/<?php echo $noimgs ?>" width="40" height="40" border="0" class="hinh" />-->
                            <?php }?>   
                        </div>
                        <div class="clear"></div>
                    </div><!-- End .module_ftt -->
                    
                    <div class="module_ftt">
                        <div class="l_f_tt">
                           &nbsp;
                        </div>
                        <div class="r_f_tt">
                            <div style="padding-bottom:15px;">
                            <input style="background:url('<?php echo $linkrootshop ;?>/imgs/layout/ok.png') no-repeat scroll 0 0 rgba(0, 0, 0, 0);" name="them" class="btn_dn" type="submit" value="&nbsp;"/>
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