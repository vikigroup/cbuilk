<?php
	if(isset($tvi)==true){
		require_once("librarys/funs/check_login.php");
	}else{
		header("location: ../../../../index.php");
	}
		$id= $_SESSION['kt_login_id'];	
		settype($id,"int");
		
		$quantri=lap_table('users','id='.$id,' ',' ',' ');
		$row_quantri=mysql_fetch_assoc($quantri);
	if (isset($_POST['them'])==true)//isset kiem tra submit
	
		{
			$ten = $_POST['ten'];
			$dienthoai  = $_POST['dienthoai'];
			$emai  = $_POST['email'];
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
	
			if($password!=NULL){
				if (strlen($password)<6 ){$coloi=true; $coloi_hien_password= "<br />Mật khẩu nhiều hơn 6 ký tự";}
			}
			if($password!=NULL){
				if (strlen($password)>100 ){$coloi=true; $coloi_hien_password= "<br />Mật khẩu ít hơn 100 ký tự";}
			}
			if($email!=NULL){
				if (filter_var($email,FILTER_VALIDATE_EMAIL)==FALSE){$coloi=true; $coloi_hien_email= "<br />Bạn nhập email không đúng kiểu ( ten@yahoo.com )";	
				}
			}
			
			if($email!=NULL){
				if (check_table('users','email='."'".$email."' AND id!=".$id,'id')==false) {$coloi=true; $coloi_hien_email = "<br>Địa chỉ mail này đã có người dùng";}
			}
			if($dienthoai!=NULL){
				if (check_table('users','dienthoai='."'".$dienthoai."' AND id!=".$id,'id')==false) {$coloi=true; $coloi_hien_dienthoai = "<br>Điện thoại này đã có người dùng";}
			}
			
			if ($coloi==FALSE) $hinh=luu_hinh('../','uploads/users/',$loi);// root chua hinh upload	
			//if ($hinh == NULL){$coloi=true; $error_hien_filechon = "<br />Bạn chưa chọn file";}
			if ($loi!="") {$coloi=true; $error_hien_filechon = $loi;}
			
			if($coloi==FALSE)
			{
				$up="ten='".$ten."',dienthoai='".$dienthoai."',email='".$email."',nickyahoo='".$nickyahoo."',nickskype='".$nickskype."'";
				chinh_table('users',$id,$up,$hinh,'../');
				echo "<script language='javascript'>alert('Chúc mừng bạn đã thay đổi thông tin tài khoản thành công..!');</script>";
				location('admin.php');
				//header("location: admin.php");
			}
		}
	if (isset($_POST['quayra'])==true) {
		header("location: admin.php");
	}
	ob_start();		
?>
<form action="" method="post" enctype="multipart/form-data" name=formdk id=formdk>  
  <table border="0" class="table_chinh">
          <tr>
            <td colspan="3" align="center" valign="top">&nbsp;</td>
          </tr>
          
          <tr>
            <td colspan="3" align="center" valign="top" class="table_chu_tieude_them">ĐỔI THÔNG TIN CÁ NHÂN</td>
          </tr>
          
          <tr>
            <td align="right" valign="top">&nbsp;</td>
            <td align="left" valign="top">&nbsp;</td>
            <td align="left" valign="top">&nbsp;</td>
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
            <td align="right" valign="top" class="table_chu">Username :</td>
            <td align="left" valign="top" class="table_khung">&nbsp;</td>
            <td align="left" valign="top" class="table_khung">
  				<span style="color:#F00; font-size:16px; font-weight:bold; text-transform:uppercase">{username}</span>       
            </td>
          </tr>
          
          <tr class="table_admin_tr">
            <td align="right" valign="top" class="table_chu">Ngày đăng ký :</td>
            <td align="left" valign="top" class="table_khung">&nbsp;</td>
            <td align="left" valign="top" class="table_khung">{ngaydangky}</td>
          </tr>
          
          <tr class="table_admin_tr">
            <td align="right" valign="top" class="table_chu">Ngày vào cuối :</td>
            <td align="left" valign="top" class="table_khung">&nbsp;</td>
            <td align="left" valign="top" class="table_khung">{ngayvaocuoi}</td>
          </tr>
          
          <tr class="table_admin_tr">
            <td align="right" valign="top" class="table_chu">&nbsp;</td>
            <td align="left" valign="top" class="table_khung">&nbsp;</td>
            <td align="left" valign="top" class="table_khung">&nbsp;</td>
          </tr>

          <tr class="table_admin_tr">
            <td align="right" valign="top" class="table_chu"><span class="sao">*</span>Họ tên :</td>
            <td align="left" valign="top" class="table_khung">&nbsp;</td>
            <td align="left" valign="top" class="table_khung">
 				<input name="ten" type="text" class="table_khungnho" id="ten" title="Nhập họ tên" value="{ten}" />
   				<br /><span class="coloi_hien"><?php echo $coloi_hien_ten ?></span>            
            </td>
          </tr>

          <tr class="table_admin_tr">
            <td align="right" valign="top" class="table_chu" style="color:#00F; font-weight:bold">
           		<span class="sao">*</span>Điện thoại :
            </td>
            <td align="left" valign="top" class="table_khung">&nbsp;</td>
            <td align="left" valign="top" class="table_khung">
   				<input name="dienthoai" type="text" class="table_khungnho" id="dienthoai" title="Nhập số điện thoại" value="{dienthoai}" />
   				<br /><span class="coloi_hien"><?php echo $coloi_hien_dienthoai ?></span>          
            </td>
          </tr>

          <tr class="table_admin_tr">
            <td align="right" valign="top" class="table_chu"><?php echo $thongbao_luu_hinh ?></td>
            <td align="left" valign="top" class="table_khung">&nbsp;</td>
            <td align="left" valign="top" class="table_khung">
     			<input name="filechon" type="file" id="filechon" title="<?php echo $thongbao_luu_hinh ?>"/>
            	<br /><span class="coloi_hien"><?php echo $error_hien_filechon ?></span><br />
            	<?php if($row_quantri['hinh']==true){ ?>
           	 		<img src="../{hinh}" width="80" height="80" border="0" class="hinh" />
            	<?php }else{?>
            		<img src="../<?php echo $noimgs ?>" width="80" height="80" border="0" class="hinh" />
            	<?php }?>
            </td>
          </tr>

          <tr class="table_admin_tr">
            <td align="right" valign="top" class="table_chu" style="color:#00F; font-weight:bold">
            	<span class="sao">*</span>Email :
            </td>
            <td align="left" valign="top" class="table_khung">&nbsp;</td>
            <td align="left" valign="top" class="table_khung">
  				<input name="email" type="text" class="table_khungnho" id="email" title="Nhập địa chỉ mail" value="{email}" />
   				<br /><span class="coloi_hien"><?php echo $coloi_hien_email ?></span>           
            </td>
          </tr>

          <tr class="table_admin_tr">
            <td align="right" valign="top" class="table_chu">Nick Yahoo :</td>
            <td align="left" valign="top" class="table_khung">&nbsp;</td>
            <td align="left" valign="top" class="table_khung">
  				<input name="nickyahoo" type="text" class="table_khungnho" id="nickyahoo" title="Nhập Nickyahoo" value="{nickyahoo}" />
   				<br /><span class="coloi_hien"><?php echo $coloi_hien_nickyahoo ?></span>           
            </td>
          </tr>

          <tr class="table_admin_tr">
            <td align="right" valign="top" class="table_chu">Nick Skype :</td>
            <td align="left" valign="top" class="table_khung">&nbsp;</td>
            <td align="left" valign="top" class="table_khung">
  				<input name="nickskype" type="text" class="table_khungnho" id="nickskype" title="Nhập NickSkype" value="{nickskype}" />
   				<br /><span class="coloi_hien"><?php echo $coloi_hien_nickskype ?></span>           
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
<?php
	$str=ob_get_clean(); 
	$str = str_replace("{id}" , $row_quantri['id'],$str);
	$str = str_replace("{username}" , $row_quantri['username'],$str);
	$str = str_replace("{ten}" , $row_quantri['ten'],$str);
	$str = str_replace("{hinh}" , $row_quantri['hinh'],$str);
	$str = str_replace("{dienthoai}" , $row_quantri['dienthoai'],$str);
	$str = str_replace("{email}" , $row_quantri['email'],$str);
	$str = str_replace("{nickyahoo}" , $row_quantri['nickyahoo'],$str);
	$str = str_replace("{nickskype}" , $row_quantri['nickskype'],$str);
	$str = str_replace("{ngaydangky}" , date('d/m/Y H:i:s',strtotime($row_quantri['ngaydangky'])),$str);
	$str = str_replace("{ngayvaocuoi}" , date('d/m/Y H:i:s',strtotime($row_quantri['ngayvaocuoi'])),$str);
	echo $str;
?>   