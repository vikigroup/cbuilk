<?php
if(get_field("tbl_seo","idshop",$idshop,"id")!="") {
	$seo=getRecord("tbl_seo", "idshop=".$idshop);
}
if($seo['googleverify']!=""){
?>
<meta name="google-site-verification" content="<?php echo $seo['googleverify'];?>" />
<?php }?>
<?php
if($seo['alexaVerifyID']!=""){
?>
<meta name="alexaVerifyID" content="<?php echo $seo['alexaVerifyID'];?>" />
<?php }?>
<?php if($css==""){?>
<link rel="stylesheet" type="text/css" href="skin/temp<?php echo $url;?>/templates/css.css"/>
<?php }else {?>
<style>
<?php echo $css;?>
</style>
<?php }?>

<?php if($row_shop['icon']!=""){?>
<link rel="shortcut icon" href="<?php echo $row_shop['icon'];?>" />
<?php }?>

<script type="text/javascript" src="skin/temp<?php echo $url;?>/scripts/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="skin/temp<?php echo $url;?>/scripts/floater_xlib.js"></script>
<script type="text/javascript" src="skin/temp<?php echo $url;?>/scripts/frame_script.js"></script>
<script type="text/javascript" src="skin/temp<?php echo $url;?>/scripts/jquery.bxSlider.js"></script>
<script type="text/javascript" src="skin/temp<?php echo $url;?>/scripts/javascript.lib.js"></script>
<script type="text/javascript" src="skin/temp<?php echo $url;?>/scripts/same_height_columns.js"></script>
<!--[if IE 6]>
    <script type="text/javascript" src="skin/temp<?php echo $url;?>/scripts/DD_belatedPNG_0.0.8a.js"></script>
    <script type="text/javascript">
		DD_belatedPNG.fix('img, div, span, a, h1, h2, h3, h4, h5, h6, p, table, input');
    </script>
    <script type="text/javascript">
        $(document).ready(function(){		
            $('#slider_dt').bxSlider({
            ticker: true,
            displaySlideQty: 8,
            tickerHover: true,
            tickerSpeed: 2000
        });
    });
    </script>
<![endif]-->
<!--[if IE 7]>    
    <script type="text/javascript">
        $(document).ready(function(){		
            $('#slider_dt').bxSlider({
            ticker: true,
            displaySlideQty: 8,
            tickerHover: true,
            tickerSpeed: 2000
        });
    });
    </script>
<![endif]-->
<?php if($css==""){?>
<!--[if lt IE 9]>
	<link rel="stylesheet" type="text/css" href="skin/temp<?php echo $url;?>/templates/FIX_IE.css" />
<![endif]-->
<?php }?>

<?php
if($seo['uagoogle']!=""){
?>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', '<?php echo $seo['uagoogle'];?>']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
<?php }?>
<SCRIPT type=text/javascript>

var slideTime = 500;
var floatAtBottom = false;

function pepsi_floating_init()
{
	xMoveTo('floating_banner_right', 887 - (1024-screen.width), 0);

	winOnResize(); // set initial position
	xAddEventListener(window, 'resize', winOnResize, false);
	xAddEventListener(window, 'scroll', winOnScroll, false);
}
function winOnResize() {
	checkScreenWidth();
	winOnScroll(); // initial slide
}
function winOnScroll() {
  var y = xScrollTop();
  if (floatAtBottom) {
    y += xClientHeight() - xHeight('floating_banner_left');
  }
  
  xSlideTo('floating_banner_left', (screen.width - (1100-775) - 770)/2-115 , y, slideTime);  // Chỉnh khoảng cách bên trái
  xSlideTo('floating_banner_right', (screen.width - (570-795) + 770)/2, y, slideTime); // // Chỉnh khoảng cách bên Phải
}
	
function checkScreenWidth()
{
	if( document.body.clientWidth < 926 )
	{	
		document.getElementById('floating_banner_left').style.display = 'none';
		document.getElementById('floating_banner_right').style.display = 'none';
	}
	else
	{
		document.getElementById('floating_banner_left').style.display = '';
		document.getElementById('floating_banner_right').style.display = '';	
	}
}

</SCRIPT>