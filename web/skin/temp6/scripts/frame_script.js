$(document).ready(function(){
	$(".menu_w ul li:last-child").css("padding-right","0");
	$(".psp_ul3 li:nth-child(3n)").css("padding-right","0");
	$('.support_online_w').mouseover(function(){
		$('.frame_hotline_sow').css({'display':'block'});
	});
	$('.support_online_w').mouseout(function(){
		$('.frame_hotline_sow').css({'display':'none'});
	});
});
$(document).ready(function(){
	jQuery(document).ready(function($) {
		$(".frame_slider").slideshow({
		width      : 939,
		height     : 336,
		transition : 'squareRandom'
		});
	});	
});
$(function(){
	$('#psp_ul').bxSlider({
		auto: false,
		controls: true,
		autoHover: false,	
		pager: false,
		displaySlideQty: 3,
		moveSlideQty: 3
	});
	$('#psp_ul2').bxSlider({
		auto: false,
		controls: true,
		autoHover: false,	
		pager: false,
		displaySlideQty: 3,
		moveSlideQty: 3
	});
});

// these are (ruh-roh) globals. You could wrap in an
// immediately-Invoked Function Expression (IIFE) if you wanted to...
var currentTallest = 0,
	currentRowStart = 0,
	rowDivs = new Array();

function setConformingHeight(el, newHeight) {
	// set the height to something new, but remember the original height in case things change
	el.data("originalHeight", (el.data("originalHeight") == undefined) ? (el.height()) : (el.data("originalHeight")));
	el.height(newHeight);
}

function getOriginalHeight(el) {
	// if the height has changed, send the originalHeight
	return (el.data("originalHeight") == undefined) ? (el.height()) : (el.data("originalHeight"));
}

function columnConform() {

	// find the tallest DIV in the row, and set the heights of all of the DIVs to match it.
	$('.psp_ul li > div').each(function() {
	
		// "caching"
		var $el = $(this);
		
		var topPosition = $el.position().top;

		if (currentRowStart != topPosition) {

			// we just came to a new row.  Set all the heights on the completed row
			for(currentDiv = 0 ; currentDiv < rowDivs.length ; currentDiv++) setConformingHeight(rowDivs[currentDiv], currentTallest);

			// set the variables for the new row
			rowDivs.length = 0; // empty the array
			currentRowStart = topPosition;
			currentTallest = getOriginalHeight($el);
			rowDivs.push($el);

		} else {

			// another div on the current row.  Add it to the list and check if it's taller
			rowDivs.push($el);
			currentTallest = (currentTallest < getOriginalHeight($el)) ? (getOriginalHeight($el)) : (currentTallest);

		}
		// do the last row
		for (currentDiv = 0 ; currentDiv < rowDivs.length ; currentDiv++) setConformingHeight(rowDivs[currentDiv], currentTallest);

	});

}


$(window).resize(function() {
	columnConform();
});

// Dom Ready
// You might also want to wait until window.onload if images are the things that
// are unequalizing the blocks
$(function() {
	columnConform();
});