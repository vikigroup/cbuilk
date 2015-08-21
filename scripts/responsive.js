$(function(){
    $(".m-wrap, .container, header, .mini-bar, .content, .select_input_search").show();
    $(".m-slider, .dmsp, .ads-logo, .dmsp1, .divAds, .ads-floors, .dmsp4-2").on("contextmenu", "img", function(e) {
        return false;
    });
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
            ', .sli-fcon-1 .bx-wrapper .bx-viewport, .filter-Prod, .content, .menu, .f-list, .divMainSubCategoryName').css('width', windowSize);
        $('.search_top_header').css('width', windowSize - 2);
        $('.select_input_search').css('width', $('.search_top_header').width() - 130 - 40);
        $('.l-fcont, .r-fcont, table').css('width', windowSize - 10);
        $('.divProductLine1, .divProductOverlay1').css('width', windowSize/2 - 2);
        $('.sli-fcon-1 .bx-wrapper .bx-viewport').css('width', windowSize - 5);
        $('.li-Pc1').css('width', windowSize/2 - 10);
        $('.ul-ifoot li, .menu').css('width', '100%');
        $('.arrowCategory').css('width', windowSize - 54);
        $('.Prod-cate').css('width', windowSize - 10);
        $('.t-Pnb').css('width', windowSize - 10 - 8);
        $('.hotline').attr('style', 'margin: 0 0 0 5px !important;');
        $('.dmsp4-3').css('max-width', windowSize);
        $('.prod_row1').css('width', windowSize/2 - 20);

        for(var i = 0; i < 12; i++){
            if($('#aCategoryName'+i).height() > 14){
                $('#divCategoryID'+i).css('padding', '5px 0 0 0');
            }
        }

        $('#menu').slicknav({
            prependTo:'#container'
        });

        $('.r-list').width('100%');
        $('.divMainLastCategoryName').width((windowSize - 20) / 2 - 10);
        $('.divMainSubCategoryName').width(windowSize - 20);
        $('.r-contents').width(windowSize - 12);
        $('.divMainCategory').width(windowSize - 30);
    }

    if($(window).width() > 768 && $(window).width() < 992){
        $(".m-cate ul li").css("width", (windowSize - 20) / 2 - 2);
    }

    if($(window).width() >= 992){
        $('.m-wrap, .f-cont, .menu').css('max-width', 1210);
        $('.m-wrap, .container').css('width', 1210);
        $('.m-wrap, .f-cont').css('width', '100%');
        $('.mini-bar').css('width', '3%');
        $('.select_input_search').css('width', $('.search_top_header form').width() - 123);
        $('.form_dn').css('width', $('.m-wrap').width());
        $('.dmsp4-3').css('width', windowSize - 190 - 390 - 139);
        $('.ads-home').css('width', windowSize - 190 - 190 - 139);
        $('.btn-gh3').css('width', 190);
        $('.arrowCategory').css('width', 125);
        $('.primary-category, .btn-category').css('width', ($('.m-wrap').width() - 190 - 190) / 5);
        $('.form_dn ul li').css('width', $('.form_dn').width() / 2);
        $('.divProductLine1, .divProductOverlay1').css('width', 208);
        $('.ul-ifoot li').css('width', '25%');
        $('.news li, .yahoo li').css('width', '100%');
        $('.sli-fcon-1 .bx-wrapper .bx-viewport').css('width', '100%');
        $('.t-Pnb, .filter-Prod, .content').css('max-width', 1000);
        $('.li-Pc1').css('width', 173);
        $('.prod_row1').css('width', 'inherit');
        $('.Prod-cate, .m-Pnb').css('width', 183 * 4 + 10);
        $('.content, .filter-Prod').css('width', 183 * 4 + 10 + 10);
        $('.t-Pnb').css('width', 183 * 4 - 10 - 5);
        $('#slider').css('left', (windowSize - 1210) / 2);
        $('.l-fcont').css('width', '73%');
        $('.r-fcont').css('width', '23%');
        $('.search_top_header').css('width', $('.m-wrap').width() - 190 - 190 - 222);
        $('.select_input_search').css('width', $('.search_top_header').width() - 160 - 40);

        for(var i = 0; i < 12; i++){
            if($('#aCategoryName'+i).height() > 15){
                $('#divCategoryID'+i).css('padding', '5px 5px 11px');
            }
        }

        var numItems = $('.divMainCategory').length;
        $('.divMainCategory').width($(".list-cate").width()/numItems - 29);
        $('.divMainCategory:last-child').width($('.divMainCategory:last-child').width() - 4);
        $('.f-list').css('width', '80%');
        $('.r-list').width('20%');
        $('.divMainSubCategoryName').css('width', ($('.f-list').width() - 70 - 40)/2 - 10);
        $('.divMainLastCategoryName').width(($('.divMainSubCategoryName').width() - 35)/2);
        $('.r-contents').width($('.r-products').width()/5 - 20);
    }
}
