<?php if($frame=="item_m" || $frame=="news_m"){?>
<?php 
 if(isset($_SESSION['id_tmp']));
 else $_SESSION['id_tmp']=chuoingaunhien(9);
?>
<div style="position:absolute;right:-220px; width:200px; top:<?php if($frame=="item_m") echo "800";else echo "400"?>px;">
<!-- <script type="text/javascript" src="scripts/up/jquery.min.js"></script>-->
<script type="text/javascript" src="scripts/up/jquery.form.js"></script>


<script type="text/javascript" >
 $(document).ready(function() { 
        
		$('#photoimg').live('change', function()			{ 
			$("#preview").html('');
			$("#current").hide();
			$("#preview").html('<img src="scripts/up/ajax-loader.gif" alt="Uploading...."/>');
			$("#imageform").ajaxForm({
					target: '#preview'
			}).submit();
			$(".hinhthem").load("listimage.php?idshop="+<?php echo $_SESSION['idshop'];?>);;
			$(".hinhthem").load("listimage.php?idshop="+<?php echo $_SESSION['idshop'];?>);;
			$(".hinhthem").load("listimage.php?idshop="+<?php echo $_SESSION['idshop'];?>);;
			$(".hinhthem").load("listimage.php?idshop="+<?php echo $_SESSION['idshop'];?>);;
			$(".hinhthem").load("listimage.php?idshop="+<?php echo $_SESSION['idshop'];?>);;
		
		});
		
		$("#addimage").click(function(){
		var domain="<?php echo $host_link_full?>";
		var src=""; alert("sfdsfs sdfs");
		src=src.replace(/../g, "");
		src=$(".preview").attr("src");
		$('#content').append("<img src="+domain+src+">");
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


<form id="imageform" method="post" enctype="multipart/form-data" action='ajax_file.php'>
<b>Upload image from your computer:</b> <input type="file" name="photoimg" id="photoimg" /><br><br/>
<div class="color_small">
Maximum size of 1024k. JPG, GIF, PNG. <br />
<b> <i> Để chèn hình vào văn bản, bạn hãy chọn tấm ảnh vừa úp và kéo thả vào khung nhập văn bản </i> </b> <br />
<!--<input name="chonlua" type="checkbox" value="<?php $_S  ?>" checked="checked" /> Chọn những ảnh vừa up là ảnh đại diện phụ-->
</div><!--<input name="addimage" id="addimage" type="button" />-->

</form>
<div id='preview'></div>
</div>
<?php }?>