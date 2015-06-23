$(document).ready(function(){
	$(".block_ct:last-child").css({'padding-bottom':'0'});
	$(".main_pm ul li:last-child").css({'border-bottom-width':'0'});
	$(".main_adv ul li:last-child").css({'padding-bottom':'0'});
	$(".main_news ul li:first-child").css({'border-top-width':'0'});
	$(".main_news ul li:last-child").css({'border-bottom-width':'0'});
	$(".block_pd:last-child").css({'padding-bottom':'0'});
	$(".main_pdm li:nth-child(4n)").css({'margin-right':'0'});
});

$(document).ready(function(){
	jQuery(document).ready(function($) {
		$(".frame_slider").slideshow({
			width      : 980,
			height     : 343,
			transition : 'squareRandom'
		});
	});	
});