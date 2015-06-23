$(document).ready(function(){
									
	$(".btn_multicols").click(function () {
		$(".content_pd_cell").css({'display':'block'});
		$(".content_pd_grid").css({'display':'none'});
		$(".btn_multicols").addClass('active');
		$(".btn_lists").removeClass('active');										
		$.cookie("luu_mn", "1", { path: '/' });
		//alert( $.cookie("luu_mn") );
	});
	$(".btn_lists").click(function () {
		$(".content_pd_grid").css({'display':'block'});
		$(".content_pd_cell").css({'display':'none'});
		$(".btn_lists").addClass('active');
		$(".btn_multicols").removeClass('active');										
		$.cookie("luu_mn", "2", { path: '/' });
		//alert( $.cookie("luu_mn") );
	});
	
	var bien=$.cookie("luu_mn"); //alert( bien );
	
	
	
	if(bien==null || bien==1) {bien=1;}
	else if(bien==2) bien=2;
	
	$.cookie("luu_mn", bien, { path: '/' });
	
	
	//alert( bien );
	
	if(bien==1){		
		$(".content_pd_cell").css({'display':'block'});
		$(".content_pd_grid").css({'display':'none'});
		$(".btn_multicols").addClass('active');
		$(".btn_lists").removeClass('active');										
	}else{										
		$(".content_pd_grid").css({'display':'block'});
		$(".content_pd_cell").css({'display':'none'});
		$(".btn_lists").addClass('active');
		$(".btn_multicols").removeClass('active');										
	}
	
	//alert(bien);
});