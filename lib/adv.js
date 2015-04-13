var slideTime = 2000;
var floatAtBottom = false;

function pepsi_floating_init(){
	xMoveTo('rightBanner', 887 - (800-screen.width), 0);

	winOnResize(); // set initial position
	xAddEventListener(window, 'resize', winOnResize, false);
	xAddEventListener(window, 'scroll', winOnScroll, false);
}
function winOnResize(){
	checkScreenWidth();
	winOnScroll(); // initial slide
}
function winOnScroll(){
	var y = xScrollTop();
	if (floatAtBottom){y += xClientHeight() - xHeight('leftBanner');}
	if( screen.width <= 800 ){
		xSlideTo('leftBanner', (screen.width - (800-777) - 772)/2, y+6, slideTime);
		xSlideTo('rightBanner', (screen.width - (800-777) + 772)/2-114, y+6, slideTime);
	}else{
		xSlideTo('leftBanner', (screen.width - (800-777) - 772)/2-108, y+6, slideTime);
		xSlideTo('rightBanner', (screen.width - (800-777) + 772)/2+10, y+6, slideTime);
	}
}
function checkScreenWidth(){
	if( screen.width <= 800){
		document.getElementById('leftBanner').style.display = 'none';
	}
	if(screen.width < 800){
		document.getElementById('rightBanner').style.display = 'none';
	}
}
