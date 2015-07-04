$('.mini-user').hover(function(){
    $('.mini-login').show();
    $('.mini-angle').show();
});

$('.mini-login').hover(
    function(){
        $('.mini-login').show(); $('.mini-angle').show();
    },
    function(){
        $('.mini-login').hide(); $('.mini-angle').hide();
    });

$(function(){
    autoHome();
    $(window).resize(function () {
        autoHome();
    });
});

function autoHome(){
    var windowSize = $(window).width();
    if($(window).width() < 992){
        $('.m-wrap, .dmsp4-3, .ads-home, .btn-gh3, .form_dn, .form_dn ul li, .l-fcont, .r-fcont' +
            ', .sli-fcon-1 .bx-wrapper .bx-viewport, .filter-Prod, .content').css('width', windowSize);
        $('.divProductLine1, .divProductOverlay1').css('width', windowSize/2 - 2);
        $('.sli-fcon-1').css('width', windowSize - 2);
        $('.li-Pc1').css('width', windowSize/2 - 23);
        $('.ul-ifoot li, .menu').css('width', '100%');
        $('.select_input_search').css('width', $('.search_top_header form').width() - 130);
        $('.arrowCategory').css('width', windowSize - 54);
        $('.t-Pnb').css('max-width', windowSize - 2);
        $('.hotline').attr('style', 'margin: 0 0 0 5px !important;');
        $('.dmsp4-3').css('max-width', windowSize);
        $('.prod_row1').css('width', windowSize/2 - 20);

        for(var i = 0; i < 8; i++){
            if($('#aCategoryName'+i).height() > 14){
                $('#divCategoryID'+i).css('padding', '5px 0 0 0');
            }
        }

        $('#menu').slicknav({
            prependTo:'#container'
        });

        $(".nivo-main-image, .m-slider").attr("style", "height: auto !important; margin: 50px 0;");
    }

    if($(window).width() >= 992){
        $('.m-wrap, .f-cont').css('max-width', 1210);
        $('.m-wrap, .f-cont').css('width', '100%');
        $('.menu').css('width', '97%');
        $('.mini-bar').css('width', '3%');
        $('.select_input_search').css('width', $('.search_top_header form').width() - 123);
        $('.form_dn').css('width', windowSize - 139);
        $('.dmsp4-3').css('width', windowSize - 190 - 390 - 139);
        $('.ads-home').css('max-width', windowSize - 190 - 190 - 139);
        $('.btn-gh3').css('width', 190);
        $('.arrowCategory').css('width', 135);
        $('.primary-category, .btn-category').css('width', 140);
        $('.primary-category:nth-child(5)').css('width', 110);
        $('.form_dn ul li').css('width', 480);
        $('.divProductLine1, .divProductOverlay1').css('width', 208);
        $('.ul-ifoot li').css('width', '25%');
        $('.news li, .yahoo li').css('width', '100%');
        $('.sli-fcon-1 .bx-wrapper .bx-viewport').css('width', '100%');
        $('.t-Pnb, .filter-Prod, .content').css('max-width', 1000);
        $('.li-Pc1').css('width', 173);
        $('.prod_row1').css('width', 'inherit');
        $('.t-Pnb').css('width', windowSize - 412);
        $('.content').css('width', windowSize - 350);
        $('#slider').css('left', (windowSize - 1210) / 2);

        for(var i = 0; i < 8; i++){
            if($('#aCategoryName'+i).height() > 14){
                $('#divCategoryID'+i).css('padding', '5px 0 11px 0');
            }
        }
    }
}

function addhttp(id, url) {
    var pattern = /^((http|https):\/\/)/;
    if(!pattern.test(url)) {
        url = "http://" + url;
    }
    $('#'+id).val(url);
}

