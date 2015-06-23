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
	$content=$ttt['content'];
	$title=$ttt['title'];
	$content1=$ttt['content_module'];
	$title1=$ttt['title_module'];
?>
<?php 
if (isset($_POST['them'])==true)//isset kiem tra submit
	{
		$content=trim($_POST['content']);
		$title=trim($_POST['tieude']);
		
		
		$content1=trim($_POST['content1']);
		$title1=trim($_POST['tieude1']);
		
		$coloi=false;
		if($coloi==FALSE) 
		{	
			
			if(get_field("tbl_module","idshop",$idshop,"id")==""){
				$arrField = array(
				"content"          => "'".$content."'",
				"title"            => "'".$title."'",
				"content_module"   => "'".$content1."'",
				"title_module"     => "'".$title1."'"
				); 
				insert("tbl_module",$arrField);
			}
			else {
				$arrField = array(
				"content"          => "'".$content."'",
				"title"            => "'".$title."'",
				"content_module"   => "'".$content1."'",
				"title_module"     => "'".$title1."'"
				);  
				update("tbl_module",$arrField,"idshop=".$idshop);
			}
			
			echo thongbao($linkroot."/quantri/",$thongbao='Bạn vừa cấu hình thành phần của web thành công..!');
			
		}
	}
?>

<form action="index.php?act=conauto" method="post" enctype="multipart/form-data" name=formdk id=formdk>
<table width="850" border="0" class="table_chinh">
          <tr class="table_admin_tr">
           	  <td align="center" valign="middle" class="table_chu">Nội dung module tự do (Cột trái phải)<br /></td>
           	  <td width="446" colspan="-1" align="left" valign="middle" class="table_khung">&nbsp;</td>
       	  </tr>
          <tr class="table_admin_tr">
            <td align="center" valign="middle" class="table_chu">Tiêu đề</td>
            <td align="left" valign="middle" class="table_chu"><label for="tieude"></label>
            <input type="text" name="tieude" id="tieude" value="<?=$title?>" /></td>
          </tr>
          <tr class="table_admin_tr">
           	  <td colspan="2" align="center" valign="middle" class="table_chu">
               <textarea name="content" class="teare_editor" id="content" style="height:200px;"><?=$content?>
                    </textarea>
                    <script type="text/javascript" src="scripts/tiny_mce/tiny_mce.js"></script>
                    <script type="text/javascript">
                                tinyMCE.init({
                                    // General options
                                    mode : "exact",
                                    elements : "content",
                                    convert_urls : false,
                                    theme : "advanced",
                                    plugins : "pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave",
                            
                                    // Theme options
                                    theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
                                    theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
                                    theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
                                    theme_advanced_toolbar_location : "top",
                                    theme_advanced_toolbar_align : "left",
                                    theme_advanced_statusbar_location : "bottom",
                                    theme_advanced_resizing : true,
                            
                                    // Example content CSS (should be your site CSS)
                                    // using false to ensure that the default browser settings are used for best Accessibility
                                    // ACCESSIBILITY SETTINGS
                                    content_css : false,
                                    // Use browser preferred colors for dialogs.
                                    browser_preferred_colors : true,
                                    detect_highcontrast : true,
                            
                                    // Drop lists for link/image/media/template dialogs
                                    template_external_list_url : "lists/template_list.js",
                                    external_link_list_url : "lists/link_list.js",
                                    external_image_list_url : "lists/image_list.js",
                                    media_external_list_url : "lists/media_list.js",
                            
                                    // Style formats
                                    style_formats : [
                                        {title : 'Bold text', inline : 'b'},
                                        {title : 'Red text', inline : 'span', styles : {color : '#ff0000'}},
                                        {title : 'Red header', block : 'h1', styles : {color : '#ff0000'}},
                                        {title : 'Example 1', inline : 'span', classes : 'example1'},
                                        {title : 'Example 2', inline : 'span', classes : 'example2'},
                                        {title : 'Table styles'},
                                        {title : 'Table row 1', selector : 'tr', classes : 'tablerow1'}
                                    ],
                            
                                    // Replace values for the template plugin
                                    template_replace_values : {
                                        username : "Some User",
                                        staffid : "991234"
                                    }
                                });
                            </script>
              
              </td>
       	  </tr>
          <tr class="table_admin_tr">
           	  <td align="center" valign="middle" class="table_chu">Nội dung module tự do (Home)<br /></td>
           	  <td width="446" colspan="-1" align="left" valign="middle" class="table_khung">&nbsp;</td>
       	  </tr>
          <tr class="table_admin_tr">
            <td align="center" valign="middle" class="table_chu">Tiêu đề</td>
            <td align="left" valign="middle" class="table_chu"><label for="tieude"></label>
            <input type="text" name="tieude1" id="tieude1" value="<?=$title1?>" /></td>
          </tr>
          <tr class="table_admin_tr">
           	  <td colspan="2" align="center" valign="middle" class="table_chu">
               <textarea name="content1" class="teare_editor" id="content1" style="height:200px;"><?=$content1?>
                    </textarea>
                    <script type="text/javascript">
                                tinyMCE.init({
                                    // General options
                                    mode : "exact",
                                    elements : "content1",
                                    convert_urls : false,
                                    theme : "advanced",
                                    plugins : "pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave",
                            
                                    // Theme options
                                    theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
                                    theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
                                    theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",

                                    theme_advanced_toolbar_location : "top",
                                    theme_advanced_toolbar_align : "left",
                                    theme_advanced_statusbar_location : "bottom",
                                    theme_advanced_resizing : true,
                            
                                    // Example content CSS (should be your site CSS)
                                    // using false to ensure that the default browser settings are used for best Accessibility
                                    // ACCESSIBILITY SETTINGS
                                    content_css : false,
                                    // Use browser preferred colors for dialogs.
                                    browser_preferred_colors : true,
                                    detect_highcontrast : true,
                            
                                    // Drop lists for link/image/media/template dialogs
                                    template_external_list_url : "lists/template_list.js",
                                    external_link_list_url : "lists/link_list.js",
                                    external_image_list_url : "lists/image_list.js",
                                    media_external_list_url : "lists/media_list.js",
                            
                                    // Style formats
                                    style_formats : [
                                        {title : 'Bold text', inline : 'b'},
                                        {title : 'Red text', inline : 'span', styles : {color : '#ff0000'}},
                                        {title : 'Red header', block : 'h1', styles : {color : '#ff0000'}},
                                        {title : 'Example 1', inline : 'span', classes : 'example1'},
                                        {title : 'Example 2', inline : 'span', classes : 'example2'},
                                        {title : 'Table styles'},
                                        {title : 'Table row 1', selector : 'tr', classes : 'tablerow1'}
                                    ],
                            
                                    // Replace values for the template plugin
                                    template_replace_values : {
                                        username : "Some User",
                                        staffid : "991234"
                                    }
                                });
                            </script>
              
              </td>
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
 
