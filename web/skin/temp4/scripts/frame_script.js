$(document).ready(function(){
	$(".blk_sld:last-child").css({'padding-bottom':'0'});
	$(".dmsp ul li:first-child a").css({'border-top-width':'0'});
	$(".dmsp ul li:last-child a").css({'border-bottom-width':'0'});
	$(".main_ctn ul li:nth-child(4n)").css({'margin-right':'0'});
});

$(document).ready(function(){
	jQuery(document).ready(function($) {
		$(".frame_slider").slideshow({
		width      : 1000,
		height     : 464,
		transition : 'squareRandom'
		});
	});	
});