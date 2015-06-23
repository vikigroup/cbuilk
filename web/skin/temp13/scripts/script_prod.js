$(document).ready(function(){
									
	$(".btn_dis_col").click(function () {
		$(".ul_k_prod").css({'display':'block'});
		$(".ul_k_prod_row").css({'display':'none'});
		$(".btn_dis_col").addClass('active');
		$(".btn_dis_row").removeClass('active');										
		$.cookie("luu_mn", "1", { path: '/' });
		//alert( $.cookie("luu_mn") );
	});
	$(".btn_dis_row").click(function () {
		$(".ul_k_prod_row").css({'display':'block'});
		$(".ul_k_prod").css({'display':'none'});
		$(".btn_dis_row").addClass('active');
		$(".btn_dis_col").removeClass('active');										
		$.cookie("luu_mn", "2", { path: '/' });
		//alert( $.cookie("luu_mn") );
	});
	
	var bien=$.cookie("luu_mn"); //alert( bien );
	
	
	
	if(bien==null || bien==1) {bien=1;}
	else if(bien==2) bien=2;
	
	$.cookie("luu_mn", bien, { path: '/' });
	
	
	//alert( bien );
	
	if(bien==1){		
		$(".ul_k_prod").css({'display':'block'});
		$(".ul_k_prod_row").css({'display':'none'});
		$(".btn_dis_col").addClass('active');
		$(".btn_dis_row").removeClass('active');										
	}else{										
		$(".ul_k_prod_row").css({'display':'block'});
		$(".ul_k_prod").css({'display':'none'});
		$(".btn_dis_row").addClass('active');
		$(".btn_dis_col").removeClass('active');										
	}
	
	//alert(bien);
});