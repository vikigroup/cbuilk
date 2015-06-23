$(document).ready(function(){

	$(".menu_main ul li ul.menu_child li:first-child a").css({'border-top-width':'0'});
	$(".menu_main ul li ul.menu_child li:last-child a").css({'border-bottom-width':'0'});
	$(".frame_slidebar:last-child").css({'padding-bottom':'0'});
	$(".dmsp ul li:first-child").css({'padding-top':'0'});
	$(".dmsp ul li:last-child").css({'padding-bottom':'0', 'border-bottom-width':'0'});
	$(".support_online ul li:first-child").css({'padding-top':'0'});
	$(".contact ul li:first-child").css({'padding-top':'0'});
	$(".contact ul li:last-child").css({'padding-bottom':'0', 'border-bottom-width':'0'});
	$(".adv ul li:last-child").css({'padding-bottom':'0'});
	$(".frame_content:last-child").css({'padding-bottom':'0'});
	//$(".main_rfct2 ul li:nth-child(8)").css({'padding-bottom':'0px'});
	
});

$(function(){
	$('#sliderbx').bxSlider({
		auto: true,
		controls: false,
		autoHover: false,	
		displaySlideQty: 1,
		moveSlideQty: 1
	});
	$('#prodbc').bxSlider({
		ticker: true,
		mode:'vertical',
		displaySlideQty: 4,
		tickerHover: true,
		tickerSpeed: 1500
	});
	$('#prodf').bxSlider({
		ticker: true,
		displaySlideQty: 8,
		tickerHover: true,
		tickerSpeed: 1500
	});
});

$(document).ready(function() {
	setHeight('.product_new ul li h3');
});

var maxHeight = 0;
function setHeight(column) {
	//Get all the element with class = col
	column = $(column);
	//Loop all the column
	column.each(function() {       
		//Store the highest value
		if($(this).height() > maxHeight) {
			maxHeight = $(this).height();;
		}
	});
	//Set the height
	column.height(maxHeight);
}