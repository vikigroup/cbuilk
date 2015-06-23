$(document).ready(function(){
	$(".main_cnt ul li:nth-child(2n)").css({'margin-right':'0'});
	$(".main_dmmn ul li:last-child").css({'border-bottom-width':'0'});
	$(".menu_f ul li:last-child").css({'padding-right':'0'});
});

$(document).ready(function(){	
	$('#sld_m').bxSlider({
		displaySlideQty: 1,
		moveSlideQty: 1,
		auto: true,
		autoControls: false,
		controls: false
	});
		$('#slider_dt').bxSlider({
		ticker: true,
		displaySlideQty: 9,
		tickerHover: true,
		tickerSpeed: 2000
	});
});