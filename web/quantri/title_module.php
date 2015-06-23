<?php 
	
	$id=$idshop;
	
	$sql="SELECT * FROM tbl_shop WHERE id='{$id}'";
	$gt=mysql_query($sql);
	$row=mysql_fetch_assoc($gt);
	
	if($row['css']=="") $content=get_field("tbl_template","id",$row['idtemplate'],"content");
	else $content=$row['css'];
	
	$box=get_field("tbl_template","id",$row['idtemplate'],"listname");
	$box=explode(",", $box);
	$demaa=count($box);
	
	$ttt=getRecord("tbl_module","idshop='".$idshop."'");
	//$content=$ttt['list_title_module'];
	$content="";
	$content1=$ttt['title_module1'];
	
	if($content=="" ) $content=get_field("tbl_template","id",$row['idtemplate'],"list_title_module");
	//if($content1=="" ) $content1=get_field("tbl_template","id",$row['idtemplate'],"title_module1");
	
	$mangmd=explode(",",get_field("tbl_template","id",$row['idtemplate'],"title_module1")); 
	
	$mang1=explode(",",get_field("tbl_template","id",$row['idtemplate'],"list_title_module")); 
	$mang2=explode(",",$content1);
?>
<?php 
if (isset($_POST['them'])==true)//isset kiem tra submit
	{
		/*$content=trim($_POST['content']);*/
		$title=trim($_POST['tieude']);
		
		$listquanly = $_POST['tit'];
		$ddk='';
			foreach ($listquanly as $k=>$v){
				$ddk=$ddk.",".$v;
			}
		$ddk=substr($ddk,1);
		$ddk;
		
		$a=explode(",",$ddk);
		foreach($a as $key => $var){ 
			if($var=="") $a[$key]=$mangmd[$key];
		}
		
		foreach ($a as $k=>$v){
			$ddkk=$ddkk.",".$v;
		}
		$ddkk=substr($ddkk,1);
		$ddkk;
		
		
		$content1=$ddkk;
		$title1=trim($_POST['tieude1']);
		
		$coloi=false;
		if($coloi==FALSE) 
		{	
			
			if(get_field("tbl_module","idshop",$idshop,"id")==""){
				$arrField = array(
				"list_title_module"   => "'".$content."'",
				"title_module1"       => "'".$content1."'"
				); 
				insert("tbl_module",$arrField);
			}
			else {
				$arrField = array(
				"list_title_module"   => "'".$content."'",
				"title_module1"       => "'".$content1."'"
				); 
				update("tbl_module",$arrField,"idshop=".$idshop);
			}
			
			 echo thongbao($linkroot."/quantri/",$thongbao='Bạn vừa cấu hình thư viện từ khóa của web thành công..!'); 
			
		}
	}
?>

<form action="index.php?act=title_module" method="post" enctype="multipart/form-data" name=formdk id=formdk>
<table width="850" border="0" class="table_chinh">
          <tr class="table_admin_tr">
           	  <td align="center" valign="middle" class="table_chu"><br /></td>
           	  <td width="446" colspan="-1" align="left" valign="middle" class="table_khung">&nbsp;</td>
       	  </tr>
          <tr class="table_admin_tr">
            <td align="center" valign="middle" class="table_chu">Danh sách từ khóa</td>
            <td align="left" valign="middle" class="table_chu">Khai báo 1</td>
          </tr>
          
          <tr class="table_admin_tr">
           	  <td colspan="2" align="center" valign="middle" class="table_chu">
              	
              </td>
       	  </tr>
          <tr class="table_admin_tr">
            <td height="55" align="center" valign="top" class="table_chu">
            	<table width="400">
                  <?php
				  $dem=count($mang1);
				  $i=1;
				  foreach($mang1 as $key => $var){ 
				  if($i==14) break;
				  else $i++;
				  ?>
                	<tr>
                    	<td width="191" height="32">
                        <?php echo $mangmd[$key];?>
                        </td>
                        <td width="197">
                        <input type="text" name="tit[]" id="tit[]" value="<?php if($mang2[$key]) echo $mang2[$key];else echo  $mangmd[$key];?>" />
                        </td>
                    </tr>
                <?php }?>
                </table>
            </td>
            <td align="left" valign="top" class="table_chu">
             <table width="400">
                  <?php
				  $dem=count($mang1);
				  $i=1;
				  foreach($mang1 as $key => $var){ 
				  if($i>13){
				  ?>
                	<tr>
                    	<td width="191" height="31">
                        <?php echo $mangmd[$key];?>
                        </td>
                        <td width="197">
                        <input type="text" name="tit[]" id="tit[]" value="<?php if($mang2[$key]) echo $mang2[$key];else echo  $mangmd[$key];?>" />
                        </td>
                    </tr>
                  <?php }else $i++;}?>
                </table>
             
             </td>
          </tr>
          <tr class="table_admin_tr">
           	  <td colspan="2" align="center" valign="middle" class="table_chu">&nbsp;</td>
       	  </tr>
          <tr>
            <td colspan="2" align="center" valign="top">
             <input type="submit" name="them" class="nut_table" value="Chấp nhận" title="Chấp nhận hoàn thành " />&nbsp;&nbsp;
             <input type="submit" name="quayra" class="nut_table" value="Quay ra" title="Quay ra ngoài " />
            </td>
           </tr>
           <tr>
             <td colspan="2" align="center" valign="top">&nbsp;</td>
           </tr>
  </table>
  
</form>
 
