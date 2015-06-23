<?php
//include('db.php');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>


<title>Dynamic Image upload form using Php, jQuery, Ajax, MySql</title>

<link rel="stylesheet" type="text/css" href="wtfdiary.css" media="screen" />

<script type="text/javascript" src="jquery.min.js"></script>
<script type="text/javascript" src="jquery.form.js"></script>


<script type="text/javascript" >
 $(document).ready(function() { 
		
            $('#photoimg').live('change', function()			{ 
			           $("#preview").html('');
				$("#current").hide();
			    $("#preview").html('<img src="ajax-loader.gif" alt="Uploading...."/>');
			$("#imageform").ajaxForm({
						target: '#preview'
		}).submit();
		
			});
        }); 
</script>

<style>

body
{
font-family:arial;
}
.preview
{
max-width:200px;
max-height:200px;
border:solid 1px #dedede;
padding:5px;
}
#preview
{
color:#cc0000;
font-size:12px
}

</style>



</head>
<body>


<table>
<tr><td><div><h2>FILE/Image upload and Preview form (without refreshing) using Php, jQuery, Ajax, MySql</h2></div></td></tr>
<tr><td style="padding-bottom:30px;">by <a href="http://www.wtfdiary.com">WTFdiary.com</a></td></tr>

<tr><td>

<fieldset style="height:80px;width:400px;" color="#CCC">
<form id="imageform" method="post" enctype="multipart/form-data" action='ajax_file.php'>
<b>Upload image from your computer:</b> <input type="file" name="photoimg" id="photoimg" /><br><br/>
<div class="color_small">Maximum size of 1024k. JPG, GIF, PNG.</div>

</form>
</td></tr>
</fieldset>
<tr style="height:10px;"><td></td></tr>
<tr><td>
<div id='preview'></div>
</td></tr>
<tr style="height:10px;"><td></td></tr>
<tr>
<td>

</tr>
</table>

<div class="info">This same particular form can be used to upload any kind of file and saving them into your database. You just need to add the types of the file (like <b>.doc</b> for MSWORD file, <b>.ppt</b> for PowerPoint file etc). You can even upload videos, but their previews wont be available.</div><br/>

<div>- You just need to add the list of formats in here, &nbsp;&nbsp;<font color="blue"><i>$valid_formats = array(<font color="red">"jpg", "png", "gif","JPG"</font>);</i></font> in the file <b>ajaximage.php</b></div><br></br>

<div>- You can also change the limit of size, to whatever you need, by editing &nbsp;&nbsp; <font color="blue"><i>if($size<(<font color="red">1024*1024</font>))</i></font></div><br></br>

<div>- Style of the Preview image can be changed, by editing the (<b>.preview</b>) class, defined just before the body tag(<b>&lt;body&gt;</b>) in <b>file_upload.php</b> inside a style tag(<b>&lt;style&gt;</b>). </div><br></br>


</body>
</html>


