<?php


		$id= $_SESSION['kh_login_id'];	

		settype($id,"int");

		$quantri=get_records("tbl_customer","id='{$id}' "," "," "," ");;

		$row_quantri=mysql_fetch_assoc($quantri);

	if (isset($_POST['them'])==true)//isset kiem tra submit

	

		{

			$ten = $_POST['ten'];

			$dienthoai  = $_POST['dienthoai'];

			$email  = $_POST['email'];

			$nickyahoo  = $_POST['nickyahoo'];

			$nickskype  = $_POST['nickskype'];

			

	

			$ten = trim(strip_tags($ten));

			$dienthoai = trim(strip_tags($dienthoai));

			$emai = trim(strip_tags($emai));

			$nickyahoo = trim(strip_tags($nickyahoo));

			$nickskype = trim(strip_tags($nickskype));

	

			if (get_magic_quotes_gpc()==false) 

	

				{

					$ten = mysql_real_escape_string($ten);

					$dienthoai = mysql_real_escape_string($dienthoai);

					$emai = mysql_real_escape_string($emai);

					$nickyahoo = mysql_real_escape_string($nickyahoo);

					$nickskype = mysql_real_escape_string($nickskype);

				}

	

			$coloi=false;	

			if ($ten == NULL){$coloi=true; $coloi_hien_ten = "<br />Bạn chưa nhập họ tên";}

			if ($dienthoai == NULL){$coloi=true; $coloi_hien_dienthoai = "<br />Bạn chưa nhập số điện thoại";}

			if ($email == NULL){$coloi=true; $coloi_hien_email = "<br />Bạn chưa nhập địa chỉ mail";}



			if($dienthoai!=NULL){

				if (strlen($dienthoai)<6 ){$coloi=true; $coloi_hien_dienthoai= "<br />Điện thoại phải nhiều hơn 6 ký tự";}

			}

	

		
			if($email!=NULL){

				if (filter_var($email,FILTER_VALIDATE_EMAIL)==FALSE){$coloi=true; $coloi_hien_email= "<br />Bạn nhập email không đúng kiểu ( ten@yahoo.com )";	

				}

			}

			

			if($email!=NULL){

				if (check_table('tbl_customer','email='."'".$email."' AND id!=".$id,'id')==false) {$coloi=true; $coloi_hien_email = "<br>Địa chỉ mail này đã có người dùng";}

			}

			if($dienthoai!=NULL){

				if (check_table('tbl_customer','mobile='."'".$dienthoai."' AND id!=".$id,'id')==false) {$coloi=true; $coloi_hien_dienthoai = "<br>Điện thoại này đã có người dùng";}

			}

		

			if ($loi!="") {$coloi=true; $error_hien_filechon = $loi;}

			

			if($coloi==FALSE)

			{

				$up="name='".$ten."',mobile='".$dienthoai."',email='".$email."'";

				update_table('tbl_customer',$id,$up,$hinh,'../');

				echo "<script language='javascript'>alert('Chúc mừng bạn đã thay đổi thông tin tài khoản thành công..!');</script>";

				echo '<script type="text/javascript"> window.location = "'.$host_link_full.'/quantri/index.php"; </script>';

				//header("location: admin.php");

			}

		}

	if (isset($_POST['quayra'])==true) {

		echo '<script type="text/javascript"> window.location = "'.$host_link_full.'/quantri/index.php"; </script>';

	}

	ob_start();		

?>

  <div class="frm_tbl">
    
        <form action="index.php?act=user_m" method="post" enctype="multipart/form-data" name=formdk id=formdk>  
			 <input type="hidden" name="act" value="user_m">
              <table border="0" class="table_chinh" style="width:600px;">
            
                      <tr>
            
                        <td colspan="3" align="center" valign="top">&nbsp;</td>
            
                      </tr>
            
                      
            
                      <tr>
            
                        <td colspan="3" align="center" valign="top" class="table_chu_tieude_them">ĐỔI THÔNG TIN CÁ NHÂN</td>
            
                      </tr>
            
                      
            
                      <tr>
            
                        <td width="167" align="right" valign="top">&nbsp;</td>
            
                        <td width="6" align="left" valign="top">&nbsp;</td>
            
                        <td width="413" align="left" valign="top">&nbsp;</td>
            
                      </tr>
            
            
            
                      <tr>
            
                        <td colspan="3" align="center" valign="top" class="chuhd">
            
                        Những ô có dấu sao ( <span class="sao">*</span> ) là bắt buộc phải nhập.<br />
            
                        Những chủ có màu <span style="color:#00F; font-weight:bold"> xanh </span>là cực kỳ quan trọng. Vui lòng nhập chính xác.
            
                        </td>
            
                      </tr>
            
            
            
                      <tr>
            
                        <td align="right" valign="top">&nbsp;</td>
            
                        <td align="left" valign="top">&nbsp;</td>
            
                        <td align="left" valign="top">&nbsp;</td>
            
                      </tr>
            
            
            
                      <tr class="table_admin_tr">
            
                        <td height="30" align="right" valign="top" class="table_chu">Username :</td>
            
                        <td align="left" valign="top" class="table_khung">&nbsp;</td>
            
                        <td align="left" valign="top" class="table_khung">
            
                            <span style="color:#F00; font-size:16px; font-weight:bold; text-transform:uppercase"><?php echo $row_quantri['username'];?></span>       
            
                        </td>
            
                      </tr>
            
                      
            
                      <tr class="table_admin_tr">
            
                        <td height="38" align="right" valign="top" class="table_chu">Ngày đăng ký :</td>
            
                        <td align="left" valign="top" class="table_khung">&nbsp;</td>
            
                        <td align="left" valign="top" class="table_khung"><?php echo $row_quantri['date_added'];?></td>
            
                      </tr>
            
                      
            
                      <tr class="table_admin_tr">
            
                        <td height="37" align="right" valign="top" class="table_chu">Ngày vào cuối :</td>
            
                        <td align="left" valign="top" class="table_khung">&nbsp;</td>
            
                        <td align="left" valign="top" class="table_khung"><?php echo $row_quantri['last_modified'];?></td>
            
                      </tr>
            
                      
            
                      <tr class="table_admin_tr">
            
                        <td height="45" align="right" valign="top" class="table_chu"><span class="sao">*</span>Họ tên :</td>
            
                        <td align="left" valign="top" class="table_khung">&nbsp;</td>
            
                        <td align="left" valign="top" class="table_khung">
            
                            <input name="ten" type="text" class="ipt_txt1" id="ten" title="Nhập họ tên" value="<?php echo $row_quantri['name'];?>" />
            
                            <br /><span class="coloi_hien"><?php echo $coloi_hien_ten ?></span>            
            
                        </td>
            
                      </tr>
            
            
            
                      <tr class="table_admin_tr">
            
                        <td height="45" align="right" valign="top" class="table_chu" style="color:#00F; font-weight:bold">
            
                            <span class="sao">*</span>Điện thoại :
            
                        </td>
            
                        <td align="left" valign="top" class="table_khung">&nbsp;</td>
            
                        <td align="left" valign="top" class="table_khung">
            
                            <input name="dienthoai" type="text" class="ipt_txt1" id="dienthoai" title="Nhập số điện thoại" value="<?php echo $row_quantri['mobile'];?>" />
            
                            <br /><span class="coloi_hien"><?php echo $coloi_hien_dienthoai ?></span>          
            
                        </td>
            
                      </tr>
            
            
            
                      <tr class="table_admin_tr">
            
                        <td align="right" valign="top" class="table_chu" style="color:#00F; font-weight:bold">
            
                            <span class="sao">*</span>Email :
            
                        </td>
            
                        <td align="left" valign="top" class="table_khung">&nbsp;</td>
            
                        <td align="left" valign="top" class="table_khung">
            
                            <input name="email" type="text" class="ipt_txt1" id="email" title="Nhập địa chỉ mail" value="<?php echo $row_quantri['email'];?>" />
            
                            <br /><span class="coloi_hien"><?php echo $coloi_hien_email ?></span>           
            
                        </td>
            
                      </tr>
            
            
            
                      <tr>
            
                        <td colspan="3" align="center" valign="top">&nbsp;</td>
            
                      </tr>
            
                       
            
                       <tr>
            
                         <td colspan="3" align="center" valign="top">
            
                            <input type="submit" name="them" class="nut_table" value="Chấp nhận" title="Chấp nhận hoàn thành " />
            
                                &nbsp;&nbsp;
            
                            <input type="submit" name="quayra" class="nut_table" value="Quay ra" title="Quay ra ngoài " />
            
                         </td>
            
                       </tr>
            
            
            
                       <tr>
            
                         <td colspan="3" align="center" valign="top">&nbsp;</td>
            
                       </tr>
            
              </table>
            
            </form>
        
</div>