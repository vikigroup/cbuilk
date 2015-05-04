<?php 
	include "content/".$template."/mail_gmail/class.phpmailer.php"; 
	include "content/".$template."/mail_gmail/class.smtp.php"; 
	
	//function ten($table,$where,$name) {  if($where!=' '){$where="WHERE $where";}else $where=' ';  $sql = "SELECT * FROM $table $where"; $gt = mysql_query($sql) or die (mysql_error()); $row=mysql_fetch_assoc($gt); $kq=$row["$name"]; return $kq; }
	
	
	//$guimail=get_records('sadasd','id=5',' ',' ',' ');
	//$row_guimail=mysql_fetch_assoc($guimail);
	
	//$mail=get_records('tbl_shop',"id='".$idshop."'",' ',' ',' ');
	//$row_mail=mysql_fetch_assoc($mail);
	
	$noidung_AltBody='
	Chào bạn! <br>
	Email này là do khách hàng của bạn gửi liên hệ thông qua website <a href="http://'.$domain.'"> http://'.$domain.'</a>  <br />';

?>
 <?php 
if (isset($_POST['them'])==true)//isset kiem tra submit
	{
			
		$tennguoigui_name 	= $_POST['tennguoigui_name'];
		$nguoigui_from 		= $_POST['nguoigui_from'];
		$tieude_Subject 	= $_POST['tieude_Subject'];
		$noidung_Body 		= $_POST['noidung_Body'];
		$dienthoai 			= $_POST['dienthoai'];
		$cap 				= $_POST['cap'];

		$tennguoigui_name 	= trim(strip_tags($tennguoigui_name));
		$nguoigui_from 		= trim(strip_tags($nguoigui_from));
		$tieude_Subject 	= trim(strip_tags($tieude_Subject));
		$noidung_Body 		= trim(strip_tags($noidung_Body));
		$dienthoai 			= trim(strip_tags($dienthoai));
		
		if (get_magic_quotes_gpc()==false) 
			{
				$tennguoigui_name 	= mysql_real_escape_string($tennguoigui_name);
				$nguoigui_from 		= mysql_real_escape_string($nguoigui_from);
				$tieude_Subject 	= mysql_real_escape_string($tieude_Subject);
				$noidung_Body 		= mysql_real_escape_string($noidung_Body);
				$dienthoai 			= mysql_real_escape_string($dienthoai);
			}
		
		$coloi=false;	
		if ($tennguoigui_name == NULL){$coloi=true; $coloi_hien_tennguoigui_name = "<br />Bạn chưa nhập tên của bạn";}
		if ($nguoigui_from == NULL){$coloi=true; $coloi_hien_nguoigui_from = "<br />Bạn chưa nhập địa chỉ email của bạn";}
		if ($tieude_Subject == NULL){$coloi=true; $coloi_hien_tieude_Subject = "<br />Bạn chưa nhập tiêu đề thư";}
		if ($dienthoai == NULL){$coloi=true; $coloi_hien_dienthoai= "<br />Bạn chưa nhập số điện thoại";}
		if ($noidung_Body == NULL){$coloi=true; $coloi_hien_noidung_Body = "<br />Bạn chưa nhập nội dung";}
		if ($cap == NULL){$coloi=true; $coloi_hien_cap= "<br />Bạn chưa nhập ký tự giống trong hình ";}
		
		if($tennguoigui_name!=NULL){
			if (strlen($tennguoigui_name)<3 ){$coloi=true; $coloi_hien_tennguoigui_name = "<br />Tên phải nhiều hơn 3 ký tự";}
		}
		
		if($tennguoigui_name!=NULL){
			if (strlen($tennguoigui_name)>50 ){$coloi=true; $coloi_hien_tennguoigui_name = "<br />Tên phải ít hơn 50 ký tự";}
		}
		
		if($dienthoai!=NULL){
			if (strlen($dienthoai)<5 ){$coloi=true; $coloi_hien_dienthoai = "<br />Điện thoại phải nhiều hơn 5 ký tự";}
		}
		
		if($dienthoai!=NULL){
			if (strlen($dienthoai)>20 ){$coloi=true; $coloi_hien_dienthoai = "<br />Điện thoại phải ít hơn 20 ký tự";}
		}
		
		if($tieude_Subject!=NULL){
			if (strlen($tieude_Subject)<5 ){$coloi=true; $coloi_hien_tieude_Subject= "<br />Tiêu đề thư phải nhiều hơn 5 ký tự";}
		}
		
		if($tieude_Subject!=NULL){
			if (strlen($tieude_Subject)>200 ){$coloi=true; $coloi_hien_tieude_Subject= "<br />Tiêu đề thư phải ít hơn 200 ký tự";}
		}
		
		if($noidung_Body!=NULL){
			if (strlen($noidung_Body)<5 ){$coloi=true; $coloi_hien_noidung_Body= "<br />Nội dung thư phải nhiều hơn 5 ký tự";}
		}
		
		if($noidung_Body!=NULL){
			if (strlen($noidung_Body)>1000 ){$coloi=true; $coloi_hien_noidung_Body= "<br />Nội dung thư  phải ít hơn 1000 ký tự";}
		}		
		
		if($nguoigui_from!=NULL){
			if (filter_var($nguoigui_from,FILTER_VALIDATE_EMAIL)==FALSE){$coloi=true; $coloi_hien_nguoigui_from= "<br />Bạn nhập email không đúng kiểu ( ten@yahoo.com )";	
			}
		}
		
		if ($cap!=NULL){
		if ($_SESSION['captcha_code'] != $cap) {$coloi=true; $coloi_hien_cap="<i>Bạn nhập sai mã số trong hình rồi</i>";}
		}		
		
		if($coloi==FALSE)
		{
			
			$noidung_Body_full=$noidung_AltBody
			.'<strong>Thông tin khách hàng như sau:  </strong> <br />'
			.'<strong>Người gửi : </strong>'.$tennguoigui_name.'<br />'
			.'<strong>Email : </strong>'.$nguoigui_from.'<br />'
			.'<strong>Điện thoại : </strong>'.$dienthoai.'<br /><br />'
			.'<strong>Tiêu đề : </strong> <br>  '.$tieude_Subject.'<br />'
			.'<strong>Nội dung : </strong> <br>  '.$noidung_Body.'<br />'
			.'<br> <br><hr>
			Numbala mong bạn thực hiện giao dịch thành công, chúc công việc kinh doanh của bạn ngày càng thuận lợi." vào trong Email. <br>';
		
			
			$ng_ten=$tennguoigui_name;
			$ng_email=$nguoigui_from;
			
			/*$ch_email=ten('versdfsdsion',"id=1",'cauhinh_mail_ten');
			$ch_pass=ten('versdfdsfsion',"id=1",'cauhinh_mail_mk');
			
			$nn_ten=$row_mail['tengh'];
			$nn_email=$row_mail['email'];
			
			$noidung=$noidung_Body_full;			
						
			$tieude=$tieude_Subject;

			$kq=@guimail($ng_ten,$ng_email,$ch_email,$ch_pass,$nn_ten,$nn_email,$tieude,$noidung);
		
			if($kq==0)
				{
					$coloi_hien_tonquat="<h1>Gửi mail không thành công..!: " . $mail->ErrorInfo;
				}
				else
					{
						location("http://".$domain);
					};
				*/
		 	}
	}
?>
<?php
	if (isset($_POST['quayra'])==true) {
		header("location: index.php");
	}
?>
<style type="text/css">
	.color_red{color:#F03;}
	.input_contact_new{border:1px solid #ccc; width:100%; height:22px; line-height:22px; margin:5px 0; text-indent:5px;}
</style>
<form action="" method="post" enctype="multipart/form-data" name=formdk id=formdk>  
<div style="padding:0 10px;">
    <table width="100%">
    	<tr>
        	<td colspan="2">
            	<div style="padding-bottom:5px;">Những ô có dấu sao <span class="color_red">(*)</span> là bắt buộc phải nhập.</div>
            </td>
        </tr>
        <tr>
        	<td colspan="2"><?php echo $coloi_hien_tonquat ?></td>
        </tr>
    	<tr>
        	<td width="30%">Tên của bạn <span class="color_red">*</span></td>
            <td width="70%">
            	<input class="input_contact_new" name="tennguoigui_name" type="text" id="tennguoigui_name" title="Tên của bạn" value="<?php echo $tennguoigui_name ?>" />
            	<br /><span class="coloi_hien"><?php echo $coloi_hien_tennguoigui_name ?></span>
            </td>
        </tr>
        <tr>
        	<td width="30%">Điện thoại <span class="color_red">*</span></td>
            <td width="70%">            	
            	<input class="input_contact_new" name="dienthoai" type="text" id="dienthoai" title="Nhập điện thoại của bạn" value="<?php echo $dienthoai ?>" />
            	<br /><span class="coloi_hien"><?php echo $coloi_hien_dienthoai ?></span>     
            </td>
        </tr>
        <tr>
        	<td width="30%">Địa chỉ mail <span class="color_red">*</span></td>
            <td width="70%">            	
            	<input class="input_contact_new" name="nguoigui_from" type="text"  id="nguoigui_from" title="Nhập địa chỉ email" value="<?php echo $nguoigui_from ?>" />
            	<br /><span class="coloi_hien"><?php echo $coloi_hien_nguoigui_from ?></span>
            </td>
        </tr>
        <tr>
        	<td width="30%">Tiêu đề thư <span class="color_red">*</span></td>
            <td width="70%">            	
            	<input class="input_contact_new" name="tieude_Subject" type="text" id="tieude_Subject" title="Tiêu đề thư"value="<?php echo $tieude_Subject ?>" />
            <br /><span class="coloi_hien"><?php echo $coloi_hien_tieude_Subject ?></span>
            </td>
        </tr>
        <tr>
        	<td width="30%">Nội dung thư <span class="color_red">*</span></td>
            <td width="70%">            	
            	<textarea style="resize:none; height:100px;" class="input_contact_new" name="noidung_Body"  id="noidung_Body" title="Nhập nội dung thư "><?php echo $noidung_Body ;?></textarea>
            	<br /><span class="coloi_hien"><?php echo $coloi_hien_noidung_Body?> </span>
            </td>
        </tr>
        <tr>
        	<td width="30%">Mã số an toàn <span class="color_red">*</span></td>
            <td width="70%">            	
            	<input class="input_contact_new" name="cap" type="text" id="cap" title="Nhập mã số an toàn" value="<?php echo $cap; ?>" /> 
            	<div class="coloi_hien"> <?php echo $coloi_hien_cap ?></div>
            </td>
        </tr>
        <tr>
        	<td width="30%">&nbsp;</td>
            <td width="70%">
                <img style="padding:5px 0;" src="scripts/capcha/dongian.php" width="80" class="img-cap" />  
            </td>
        </tr>
        
        <tr>
        	<td width="30%">&nbsp;</td>
            <td width="70%">
                <input type="submit" name="them" value="Gửi đi" title="Chấp nhận gửi đi " />&nbsp;&nbsp;
                <input type="submit" name="quayra" value="Quay ra" title="Quay ra trang chủ " />
            </td>
        </tr>
        
    </table>	
</div>
</form> 