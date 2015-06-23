$(document).ready(function(){
	$(".ul_lti li:last-child").css({'padding-right':'0'});
	$(".ul_lti li ul.lti_ul_child li div:last-child").css({'border-bottom-width':'0'});
	$(".ul_rti li:first-child").css({'padding-left':'0'});
	$(".m_upsp:nth-child(5n)").css({'margin-right':'0'});
	$(".li_f_dv:nth-child(3n)").css({'margin-right':'0'});
	$(".li_main_ghmn:nth-child(3n)").css({'margin-right':'0'});
	$(".main_ti_foot ul li:last-child a").css({'padding-bottom':'0'});
	$(".main_ti_foot ol li:last-child").css({'padding-right':'0'});
	$(".ul_mnsp li:hover:first-child a").css({'border-top-width':'1px', 'border-top-style':'solid', 'border-top-color':'#FFF'});
	$(".ul_mnsp li:hover:first-child .mast_mnsp").css({'top':'0'});
	$(".ul_mnsp li:nth-child(1) ul.child_dmsp").css({'top':'0'});
	$(".ul_mnsp li:nth-child(2) ul.child_dmsp").css({'top':'-31px'});
	$(".ul_mnsp li:nth-child(3) ul.child_dmsp").css({'top':'-62px'});
	$(".ul_mnsp li:nth-child(4) ul.child_dmsp").css({'top':'-93px'});
	$(".ul_mnsp li:nth-child(5) ul.child_dmsp").css({'top':'-124px'});
	$(".ul_mnsp li:nth-child(6) ul.child_dmsp").css({'top':'-155px'});
	$(".ul_mnsp li:nth-child(7) ul.child_dmsp").css({'top':'-186px'});
	$(".ul_mnsp li:nth-child(8) ul.child_dmsp").css({'top':'-217px'});
	
	$(".ul_ti_footer li.li_tf:nth-child(1)").css({'width':'244px', 'border-right-width':'1px', 'border-right-style':'solid', 'border-right-color':'#FFF'});
	$(".ul_ti_footer li.li_tf:nth-child(2)").css({'width':'244px', 'border-right-width':'1px', 'border-right-style':'solid', 'border-right-color':'#FFF', 'border-left-width':'1px', 'border-left-style':'solid', 'border-left-color':'#e2e2e2'});
	$(".ul_ti_footer li.li_tf:nth-child(3)").css({'width':'244px', 'border-right-width':'1px', 'border-right-style':'solid', 'border-right-color':'#FFF', 'border-left-width':'1px', 'border-left-style':'solid', 'border-left-color':'#e2e2e2'});
	$(".ul_ti_footer li.li_tf:nth-child(4)").css({'width':'242px', 'border-left-width':'1px', 'border-left-style':'solid', 'border-left-color':'#e2e2e2'});	
	
	$(".breadcrumb ul li:first-child a").css({'padding-left':'0'});
	$(".breadcrumb ul li:last-child a").css({'padding-right':'0', 'background':'none'});	
	$(".kh_spkm_details:nth-child(4n)").css({'margin-right':'0'});
	$(".ul_k_prod li:nth-child(4n)").css({'margin-right':'0'});	
	$(".view_display a:last-child").css({'margin-right':'0'});
	$(".li_fspm:first-child").css({'margin-left':'1px'});
	$(".li_fspm:nth-child(5n)").css({'margin-right':'0'});	
	
	$(".form_dn ul li:nth-child(1n)").css({'float':'left'});
	$(".form_dn ul li:nth-child(2n)").css({'float':'right'});
});

$(document).ready(function() {
	setHeight('.li_tf');
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