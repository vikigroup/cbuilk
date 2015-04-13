$(window).ready(function(){
	//References
	var loading = $("#loading");
	var container = $("#container");
	var pageNum;
	
	//show loading bar
	function showLoading(){
		loading.slideDown("slow");
	}
	
	//hide loading bar
	function hideLoading(){
		loading.slideUp("slow");
	};
	
	$("a.magic-links").click(function(e){
		e.preventDefault();
		showLoading();  
		
		//define the target and get content then load it to container
		var url = $(this).attr("href");
		var targetUrl = url + " #content";
		container.load(targetUrl, hideLoading);
		
		//reset all link and highlight the current page link
		$("#pages a").css({'background-color':''});
		$(this).css({'background-color':'yellow'});
	});
});