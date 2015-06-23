<?php 	
	$id=$idshop;
	
	if(get_field("tbl_seo","idshop",$idshop,"id")!="") {
		$b=getRecord("tbl_seo", "idshop=".$idshop);
		$magoogle=$b['googleverify'];
		$uagoogle=$b['uagoogle'];
		$maalexa=$b['alexaVerifyID'];
		$codealexa=$b['alexacode'];
		$button    = $b['button'];
		$buttonpo  = $b['buttonpo'];

	}	
?>
<?php 
if (isset($_POST['them'])==true)//isset kiem tra submit
	{
		$magoogle=trim($_POST['magoogle']);
		$uagoogle=trim($_POST['uagoogle']);
		$maalexa=trim($_POST['maalexa']);
		$codealexa=trim($_POST['codealexa']);
		
		$button         =  $_POST['button'] ;
		$buttonpo       =  $_POST['buttonpo'] ;
		
		
		$coloi=false;
		if($coloi==FALSE) 
		{	
			
			if(get_field("tbl_seo","idshop",$idshop,"id")==""){
				$arrField = array(
				"idshop"                    => "'".$idshop."'",
				"googleverify"              => "'".$magoogle."'",
				"uagoogle"                  => "'".$uagoogle."'",
				"alexaVerifyID"             => "'".$maalexa."'",
				"alexacode"                 => "'".$codealexa."'", 
				"button"                    => "'".$button."'",
				"buttonpo"                  => "'".$buttonpo."'"
				); 
				insert("tbl_seo",$arrField);
			}
			else {
				$arrField = array(
				"googleverify"              => "'".$magoogle."'",
				"uagoogle"                  => "'".$uagoogle."'",
				"alexaVerifyID"             => "'".$maalexa."'",
				"alexacode"                 => "'".$codealexa."'",
				"button"                    => "'".$button."'",
				"buttonpo"                  => "'".$buttonpo."'"
				);  
				update("tbl_seo",$arrField,"idshop=".$idshop);
			}
			
			echo thongbao($linkroot."/quantri/index.php?act=seoweb",$thongbao='Bạn vừa cấu hình thành phần của web thành công..!');
			
		}
	}
?>

<form action="index.php?act=seoweb" method="post" enctype="multipart/form-data" name=formdk id=formdk>
<table width="800" border="0" class="table_chinh">
          <tr>
            <td colspan="7" align="center" valign="top" class="table_chu_tieude_them"><b>CẤU HÌNH CÁC THÔNG SỐ SEO</b><br /> <hr /></td>
          </tr>
          <tr class="table_admin_tr">
           	  <td colspan="3" align="center" valign="middle" class="table_chu">Mã chứng thực google<br /></td>
           	  <td width="15" align="left" valign="middle" class="table_khung">&nbsp;</td>
           	  <td width="175" align="left" valign="middle" class="table_khung">
   	      			<input type="text" name="magoogle" id="magoogle"  value="<?php if($magoogle!="") echo $magoogle;?>"  />
            </td>
           	  <td width="55" align="center" valign="middle" class="table_khung">&nbsp;</td>
              <td width="126" align="left" valign="middle" class="table_khung"><br />                &nbsp;
            </td>
          </tr>
          <tr class="table_admin_tr">
           	  <td colspan="3" align="center" valign="middle" class="table_chu">UA Google<br /></td>
           	  <td align="left" valign="middle" class="table_khung">&nbsp;</td>
           	  <td align="left" valign="middle" class="table_khung">
   	      			<input type="text" name="uagoogle" id="uagoogle"  value="<?php if($uagoogle!="") echo $uagoogle;?>"  />
            </td>
           	  <td align="center" valign="middle" class="table_khung">&nbsp;</td>
              <td align="left" valign="middle" class="table_khung"><br />                &nbsp;
            </td>
          </tr>
          <tr class="table_admin_tr">
           	  <td colspan="3" align="center" valign="middle" class="table_chu">Mã chứng thực alexa<br /></td>
           	  <td align="left" valign="middle" class="table_khung">&nbsp;</td>
           	  <td align="left" valign="middle" class="table_khung">
   	      			<input type="text" name="maalexa" id="maalexa"  value="<?php if($maalexa!="") echo $maalexa;?>"  />
            </td>
           	  <td align="center" valign="middle" class="table_khung">&nbsp;</td>
              <td align="left" valign="middle" class="table_khung"><br />                &nbsp;
            </td>
          </tr>
          <tr class="table_admin_tr">
            <td colspan="3" align="center" valign="middle" class="table_chu">Tool google+, facebook like <br />
(Hiện bên góc trái web)</td>
            <td align="left" valign="middle" class="table_khung">&nbsp;</td>
            <td align="left" valign="middle" class="table_khung">
      
                  <input name="button" id="button" type="radio" value="0" <?php if($button==0) echo 'checked="checked"';?>  /> Ẩn
                  <input name="button" id="button" type="radio" value="1" <?php if($button==1) echo 'checked="checked"';?>  /> Hiện
       
            </td>
            <td align="center" valign="middle" class="table_khung">&nbsp;</td>
            <td align="left" valign="middle" class="table_khung">&nbsp;</td>
          </tr>
          <tr class="table_admin_tr">
            <td colspan="3" align="center" valign="middle" class="table_chu">&nbsp;</td>
            <td align="left" valign="middle" class="table_khung">&nbsp;</td>
            <td align="left" valign="middle" class="table_khung">
            <input name="buttonpo" id="buttonpo" type="radio" value="0" <?php if($buttonpo==0) echo 'checked="checked"';?>  /> Bên trái trang
                  <input name="buttonpo" id="buttonpo" type="radio" value="1" <?php if($buttonpo==1) echo 'checked="checked"';?>  /> Dưới footer
            </td>
            <td align="center" valign="middle" class="table_khung">&nbsp;</td>
            <td align="left" valign="middle" class="table_khung">&nbsp;</td>
          </tr>
          <tr class="table_admin_tr">
           	  <td colspan="3" align="center" valign="middle" class="table_chu">Code alexa<br /></td>
           	  <td align="left" valign="middle" class="table_khung">&nbsp;</td>
           	  <td align="left" valign="middle" class="table_khung">
   	      			
                    <textarea name="codealexa" id="codealexa" cols="" rows="" style="width:250px; height:200px;"><?php if($codealexa!="") echo $codealexa;?> </textarea>
            </td>
           	  <td align="center" valign="middle" class="table_khung">&nbsp;</td>
              <td align="left" valign="middle" class="table_khung"><br />                &nbsp;
            </td>
          </tr>
          <tr>
            <td colspan="7" align="center" valign="top">&nbsp;</td>
      </tr>
           <tr>
             <td colspan="7" align="center" valign="top">
             <input type="submit" name="them" class="nut_table" value="Chấp nhận" title="Chấp nhận hoàn thành " />&nbsp;&nbsp;
             <input type="submit" name="quayra" class="nut_table" value="Quay ra" title="Quay ra ngoài " />
             </td>
           </tr>
           <tr>
             <td colspan="7" align="center" valign="top">&nbsp;</td>
           </tr>
  </table>
</form>
 
