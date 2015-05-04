<style type="text/css">
<?php 
if($seo['buttonpo']==0){
?>
#box_social {
	position:fixed; top:20%; left:2px;
	background-clip: padding-box;
    background-color: #FFFFFF;
    border: 1px solid #BBBBBB;
    border-radius: 5px 5px 5px 5px;
    box-shadow: 1px 0 15px rgba(0, 0, 0, 0.2);
    font-family: Arial;
    font-size: 10px;
    line-height: 16px;
    min-width: 55px;
    padding: 5px;
    text-align: center;
    width: auto;
}
  #example5{
	float:left;
  }
  .sharrre .button{
  /*  float:left;*/
	width:60px;
	margin-top:5px;
  }
  .sharrre .linkedin {
	width:70px;
  }
<?php }else{?>
#box_social {
	z-index:9999;
	position:fixed; bottom:5px; left:-400px;
	background-clip: padding-box;
	background:url(skin/temp<?php echo $url;?>/imgs/like.jpg) right no-repeat ;
    background-color: #FFFFFF;
    border: 1px solid #BBBBBB;
    border-radius: 5px 5px 5px 5px;
    box-shadow: 1px 0 15px rgba(0, 0, 0, 0.2);
    font-family: Arial;
    font-size: 10px;
    line-height: 16px;
    min-width: 55px;
    padding: 5px;
    text-align: center;
    width: 431px;
}
#box_social:hover   { left:0px;}
  #example5{
/*	float:left; */
  }
   .sharrre  { width:395px; float:left;}
  .sharrre .button{
    float:left;
	width:60px;
	margin-top:5px; margin-left:30px;
  }
  .sharrre .linkedin {
	width:70px;
  }
<?php }?>
</style>
<div id="box_social" >
	
		<script src="skin/temp<?php echo $url;?>/scripts/jquery.sharrre-1.3.4.min.js"></script>
        <div id="example5">
        <div id="shareme" data-url="<?php if($frame=="" || $tvi=="home") echo $linkroot;else echo $_SERVER['REQUEST_URI'];?>" data-text="Make your sharing widget with Sharrre (jQuery Plugin)"></div>
        </div>
		<div style="float: left;">  </div>
        <?php 
		if($seo['buttonpo']==0){
		?>
            <script>
            $('#shareme').sharrre({
              share: {
                googlePlus: true,
                facebook: true,
                twitter: true,
                digg: true,
                delicious: true,
                stumbleupon: false,
                linkedin: false,
                pinterest: false
              },
              buttons: {
                googlePlus: {size: 'tall', annotation:'bubble'},
                facebook: {layout: 'box_count'},
                twitter: {count: 'vertical'},
                digg: {type: 'DiggMedium'},
                delicious: {size: 'tall'},
                stumbleupon: {layout: '5'},
                linkedin: {counter: 'top'},
                pinterest: {media: 'http://sharrre.com/img/example1.png', description: $('#shareme').data('text'), layout: 'vertical'}
              },
              enableHover: false,
              enableCounter: false,
              enableTracking: true
            });
            </script>
      <?php }else{?>
      <script>
            $('#shareme').sharrre({
              share: {
                googlePlus: true,
                facebook: true,
                twitter: true,
                digg: false,
                delicious: true,
                stumbleupon: false,
                linkedin: false,
                pinterest: false
              },
              buttons: {
                googlePlus: {size: 'standard', annotation:'bubble'},
                facebook: {layout: 'button_count'},
                twitter: {count: 'horizontal'},
                digg: {type: 'DiggWide'},
                delicious: {size: 'standard'},
                stumbleupon: {layout: '5'},
                linkedin: {counter: 'top'},
                pinterest: {media: 'http://sharrre.com/img/example1.png', description: $('#shareme').data('text'), layout: 'vertical'}
              },
              enableHover: false,
              enableCounter: false,
              enableTracking: true
            });
            </script>
            
      <?php }?>      
</div>
</div> 