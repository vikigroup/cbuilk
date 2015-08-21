$(document).ready(function(){
	$(".f-sty-P1").click(function () {
		$(".li-Pc2").removeClass( "li-Pc2" ).addClass( "li-Pc1" );
		$(".f-sty-P1").addClass('atc');
		$(".f-sty-P2").removeClass('atc');
        $(".s-Pnb").hide();
		$.cookie("luu_mn", "1", { path: '/' });
        if($('#hiddenSearchProd').val() == 1){
            $('.li-Pc1').css('height', 239);
        }
	});
	$(".f-sty-P2").click(function () {
		$(".li-Pc1").removeClass( "li-Pc1" ).addClass( "li-Pc2" );
		$(".f-sty-P2").addClass('atc');
		$(".f-sty-P1").removeClass('atc');
        $(".s-Pnb").show();
		$.cookie("luu_mn", "2", { path: '/' });
        if($('#hiddenSearchProd').val() == 1){
            $('.li-Pc2').css('height', 'auto');
        }
	});
	
	var bien = $.cookie("luu_mn");

	if(bien == null || bien == 1) {bien = 1;}
	else if(bien == 2) bien = 2;
	
	$.cookie("luu_mn", bien, { path: '/' });

	if(bien == 1){
		$(".li-Pc2").removeClass( "li-Pc2" ).addClass( "li-Pc1" );
		$(".f-sty-P1").addClass('atc');
		$(".f-sty-P2").removeClass('atc');											
	}else{
		$(".li-Pc1").removeClass( "li-Pc1" ).addClass( "li-Pc2" );
		$(".f-sty-P2").addClass('atc');
		$(".f-sty-P2").removeClass('atc');											
	}
});