<?php 

	
	$id=$idshop; 	
	$sql="SELECT * FROM tbl_shop WHERE id='{$id}'";
	$gt=mysql_query($sql);
	$row=mysql_fetch_assoc($gt);
	
	if($row['css']=="") $content=get_field("tbl_template","id",$row['idtemplate'],"content");
	else $content=$row['css'];
	
	

?>
<?php 
if (isset($_POST['them'])==true)//isset kiem tra submit
	{
		$css=trim($_POST['css']);
		$coloi=false;
		if($coloi==FALSE)
		{	
			$sql = "UPDATE tbl_shop SET css='{$css}' WHERE id='{$id}'";
			$kq = mysql_query($sql) or die (mysql_error());
			
			echo thongbao($linkroot."/quantri/index.php?act=elementweb&id=".$id,$thongbao='Bạn vừa cấu hình thành phần của web thành công..!');
			
		}
	}
?>

<form action="index.php?act=styleweb" method="post" enctype="multipart/form-data" name=formdk id=formdk>
<table width="1000" border="0" class="table_chinh">
    <tr>
      <td colspan="7" align="center" valign="top">Cấu hình CSS của trang</td>
    </tr>
    <tr>
    <td colspan="7" align="center" valign="top">
        <textarea name="css" class="teare_editor" id="css"  style="height:500px; width:1000px;"><?=$content;?>
        </textarea>
        
    </td>
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
