
$(document).ready(function(){
	$("ul.menu_child li:last-child a").css("border-bottom","0");
	
	$(function(){
		$('#slider1').bxSlider({
			auto: true,
			mode: 'fade',	
			pager: true,
			controls: false
		});
		
		function tick3(){
			$('#ticker_03 li:first').animate({'opacity':0}, 200, function () { $(this).appendTo($('#ticker_03')).css('opacity', 1); });
		}
		setInterval(function(){ tick3 () }, 2000);
		
	});
	
});

