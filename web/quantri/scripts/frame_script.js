$(document).ready(function(){	
	$(".teare_editor").css({'width':'100%'});
	$(".menu_admin li ul.menu_child li:first-child").css({'border-left-width':'0'});
	$(".menu_admin li ul.menu_child li:last-child a").css({'border-bottom-width':'0'});
});

$(document).ready(function() {
		
	$(".info_user").click(function(){
		var tks=$(".frame_info_user").attr("tks"); //alert(tk);
		if( tks==0 ){
			$(this).addClass("active_info_user");
			$(".frame_info_user").attr("style","display:block;").attr("tks","1");
		}else if( tks==1 ){
			$(this).removeClass("active_info_user");
			$(".frame_info_user").attr("style","display:none;").attr("tks","0"); 
		}
	});
});

$(document).click(function(event){
	if ( !$(event.target).hasClass('info_user') && !$(event.target).hasClass('frame_info_user')) {
		 $(".info_user").removeClass("active_info_user");
		 $(".frame_info_user").attr("style","display:none;").attr("tks","0");;
	}
});

$(document).ready(function(){
	$(".click_show_hide").click(function(){
		var tk=$(".frm01").attr("tk");
		if(tk==0){$(".frm01").attr("tk","1").css({"display":"none"});}
		else{$(".frm01").attr("tk","0").css({"display":"block"});}
	});	
	$(".click_show_hide1").click(function(){
		var tk=$(".frm011").attr("tk");
		if(tk==0){$(".frm011").attr("tk","1").css({"display":"none"});}
		else{$(".frm011").attr("tk","0").css({"display":"block"});}
	});
});

$(document).ready(function(){
	
	$(".clickSHmenu").click(function(){
		
		$("#mask_num_ad_menu").css({'display':'none'});
		$("#num_ad_menu").css({'display':'none'});
		$("#num_ad_content").css({'margin-left':'20px'});
		$("#num_ad_footer").css({'margin-left':'20px'});
		$(".clickSHmenu").css({'display':'none'});
		$(".clickSHmenu2").css({'display':'block'});
	
		$.cookie("luu_mn", "1", { path: '/' });
		//alert( $.cookie("luu_mn") );
		
	});		
	$(".clickSHmenu2").click(function(){
		
		$("#mask_num_ad_menu").css({'display':'block'});
		$("#num_ad_menu").css({'display':'block'});
		$("#num_ad_content").css({'margin-left':'165px'});
		$("#num_ad_footer").css({'margin-left':'165px'});
		$(".clickSHmenu").css({'display':'block'});
		$(".clickSHmenu2").css({'display':'none'});
		
		$.cookie("luu_mn", "2", { path: '/' });
		//alert( $.cookie("luu_mn") );
		
	});		
	
	var bien=$.cookie("luu_mn"); //alert( bien );
	
	if(bien==1){
		
		$("#mask_num_ad_menu").css({'display':'none'});
		$("#num_ad_menu").css({'display':'none'});
		$("#num_ad_content").css({'margin-left':'20px'});
		$("#num_ad_footer").css({'margin-left':'20px'});
		$(".clickSHmenu").css({'display':'none'});
		$(".clickSHmenu2").css({'display':'block'});
		
	}else{		
		
		$("#mask_num_ad_menu").css({'display':'block'});
		$("#num_ad_menu").css({'display':'block'});
		$("#num_ad_content").css({'margin-left':'165px'});
		$("#num_ad_footer").css({'margin-left':'165px'});
		$(".clickSHmenu").css({'display':'block'});
		$(".clickSHmenu2").css({'display':'none'});
		
	}
			
});