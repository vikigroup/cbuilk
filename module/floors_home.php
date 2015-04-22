<?php
$myArr1 = array('#DBA5EE', '#C14150', '#66E4E6', '#965BB9', '#FF8BCF', '#D3CFCA', '#619ECE', '#9AB554');
$myArr2 = array('#DDADEE', '#C65461', '#75E5E7', '#A06BBF', '#FE96D3', '#D6D3CE', '#70A7D2', '#A3BB65');
$myArr3 = array('#E1B6F0', '#CC6672', '#84E8EA', '#AA7BC6', '#FEA1D7', '#DBD7D3', '#80B0D7', '#ADC375');

$cate_floor = get_records("tbl_shop_category","status=0 AND  parent=2"," ","0,8"," ");
$myArrID = array();
$myArrName = array();
$myArrPrimarySubject = array();
while($row_cate_floor=mysql_fetch_assoc($cate_floor)){
    array_push($myArrID, $row_cate_floor['id']);
    array_push($myArrName, $row_cate_floor['name']);
    array_push($myArrPrimarySubject, $row_cate_floor['subject']);
}
for($i = 0; $i < 8; $i++){
?>
<section class="Prod-nb clearfix ads-article">
    <article class="dmsp4-1">
        <div class="arrowLine" style="background-color: <?php echo $myArr1[$i]; ?>;">
            <span><?php echo $i+1; ?>c</span>
        </div>
        <div class="arrowCategory" style="background-color: <?php echo $myArr2[$i]; ?>;">
            <a href="<?php echo $linkrootshop?>/<?php echo $myArrPrimarySubject[$i];?>.html"><?php echo $myArrName[$i]; ?></a>
        </div>
        <div class="divCategory" style="background-color: <?php echo $myArr3[$i]; ?>; border-top: 1px solid <?php echo $myArr1[$i]; ?>">
            <?php
            $sub_cate_floor=get_records("tbl_shop_category","status=0 AND parent='".$myArrID[$i]."'","hot","8"," ");
            $myArrSubName = array();
            $myArrSubject = array();
            while($row_sub_cate=mysql_fetch_assoc($sub_cate_floor)){
                array_push($myArrSubName, $row_sub_cate['name']);
                array_push($myArrSubject, $row_sub_cate['subject']);
            }
            ?>
            <div class="divContent">
                <i class="fa fa-mobile fa-2x"></i>
                <p><a href="<?php echo $linkrootshop?>/<?php echo $myArrSubject[0];?>.html"><?php echo $myArrSubName[0]; ?></a></p>
            </div>
            <div class="sep"></div>
            <div class="divContent">
                <i class="fa fa-laptop fa-2x"></i>
                <p><a href="<?php echo $linkrootshop?>/<?php echo $myArrSubject[1];?>.html"><?php echo $myArrSubName[1]; ?></a></p>
            </div>
        </div>
        <div class="divSubCategory">
            <?php for($j = 2; $j < 8; $j++){ ?>
                <p class="aSubCategory"><a href="<?php echo $linkrootshop?>/<?php echo $myArrSubject[$j];?>.html" class="a-subName"><?php echo $myArrSubName[$j] ?></a></p>
            <?php } ?>
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

<section class="Adv ads-floors">
    <a href="#" target="_blank">
        <img src="http://cpcmart.com/web/images/adv/advs2.png" alt="">
    </a>
</section>
<?php } ?>

<script>
    $(document).ready(function(){
        $('.divAds').bxSlider({
            mode: 'vertical',
            slideWidth: 300,
            minSlides: 2,
            slideMargin: 2,
            auto: true,
            pager: false
//            controls: false
        });

        $('.bx-wrapper').css('max-width', '185px');
        $('.bx-viewport').css('width', '185px');
    });
</script>
