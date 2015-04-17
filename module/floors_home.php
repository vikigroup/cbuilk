<section class="Prod-nb clearfix ads-article">
    <article class="dmsp4-1">
        <div class="arrowLine">
            <span>1c</span>
        </div>
        <div class="arrowCategory">
            <span>Điện tử, máy tính</span>
        </div>
        <div class="divCategory">
            <div class="divContent">
                <i class="fa fa-mobile fa-3x"></i>
                <p><span>Điện thoại</span></p>
            </div>
            <div class="sep"></div>
            <div class="divContent">
                <i class="fa fa-laptop fa-3x"></i>
                <p><span>laptop</span></p>
            </div>
        </div>
        <div class="divSubCategory">
            <p class="aSubCategory"><a href="#">1</a></p>
            <p class="aSubCategory"><a href="#">2</a></p>
            <p class="aSubCategory"><a href="#">3</a></p>
            <p class="aSubCategory"><a href="#">4</a></p>
            <p class="aSubCategory"><a href="#">5</a></p>
            <p class="aSubCategory"><a href="#">6</a></p>
        </div>
        <div class="divAds">
            <div class="slide"><img src="http://placehold.it/300x100&text=FooBar1"></div>
            <div class="slide"><img src="http://placehold.it/300x100&text=FooBar2"></div>
            <div class="slide"><img src="http://placehold.it/300x100&text=FooBar3"></div>
            <div class="slide"><img src="http://placehold.it/300x100&text=FooBar4"></div>
            <div class="slide"><img src="http://placehold.it/300x100&text=FooBar5"></div>
            <div class="slide"><img src="http://placehold.it/300x100&text=FooBar6"></div>
            <div class="slide"><img src="http://placehold.it/300x100&text=FooBar7"></div>
            <div class="slide"><img src="http://placehold.it/300x100&text=FooBar8"></div>
            <div class="slide"><img src="http://placehold.it/300x100&text=FooBar9"></div>
            <div class="slide"><img src="http://placehold.it/300x100&text=FooBar10"></div>
        </div>
    </article>
    <article class="dmsp4-2">
        <img src="http://placehold.it/390x420">
    </article>
    <article class="dmsp4-3">
        <div class="divProductLine1"><a href="#"><img src="http://placehold.it/210x256"></a></div>
        <div class="divProductLine1"><a href="#"><img src="http://placehold.it/210x256"></a></div>
        <div class="divProductLine1"><a href="#"><img src="http://placehold.it/210x256"></a></div>
        <div class="divProductLine2"><a href="#"><img src="http://placehold.it/210x164"></a></div>
        <div class="divProductLine2"><a href="#"><img src="http://placehold.it/210x164"></a></div>
        <div class="divProductLine2"><a href="#"><img src="http://placehold.it/210x164"></a></div>
    </article>
</section><!-- End .Prod-nb -->

<script>
    $(document).ready(function(){
        $('.divAds').bxSlider({
            mode: 'vertical',
            slideWidth: 300,
            minSlides: 2,
            slideMargin: 2,
            auto: true,
            pager: false
        });

        $('.bx-wrapper').css('max-width', '180px');
        $('.bx-viewport').css('width', '180px');
    });
</script>