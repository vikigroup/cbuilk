<?php
$myArr1 = array('#DBA5EE', '#C14150', '#66E4E6', '#965BB9', '#FF8BCF', '#D3CFCA', '#619ECE', '#9AB554');
$myArr2 = array('#DDADEE', '#C65461', '#75E5E7', '#A06BBF', '#FE96D3', '#D6D3CE', '#70A7D2', '#A3BB65');
$myArr3 = array('#E1B6F0', '#CC6672', '#84E8EA', '#AA7BC6', '#FEA1D7', '#DBD7D3', '#80B0D7', '#ADC375');

$cate_floor = get_records("tbl_shop_category","status=0 AND  parent=2"," ","0,8"," ");
$myArrID = array();
$myArrName = array();
$myArrPrimarySubject = array();
$myArrPrimaryImage = array();
while($row_cate_floor=mysql_fetch_assoc($cate_floor)){
    array_push($myArrID, $row_cate_floor['id']);
    array_push($myArrName, $row_cate_floor['name']);
    array_push($myArrPrimarySubject, $row_cate_floor['subject']);
    array_push($myArrPrimaryImage, $row_cate_floor['image_large']);
}
for($i = 0; $i < 8; $i++){
    ?>
    <section class="Adv ads-floors">
        <?php
        $dt = date("Y-m-d");
        $adv_floor = "SELECT *, COUNT(id) AS amount FROM tbl_adv WHERE status = 0 AND start_banner <= '".$dt."' AND '".$dt."' <= finish_banner AND main_position = 2 AND sub_position = '".($i+1)."' ORDER BY date_added LIMIT 1";
        if ($result_floor = mysql_query($adv_floor,$conn)) {
            $row_floor=mysql_fetch_array($result_floor);
            if($row_floor['amount'] > 0){
                if($row_floor['image'] != ''){
                    echo '<a href="'.$row_floor['link'].'" target="_blank"><img src="../web/'.$row_floor['image'].'" alt="'.$row_floor['name'].'"></a>';
                }
                else{
                    echo '<a href="'.$row_floor['link'].'" target="_blank"><img src="http://placehold.it/190x330&text=No Image" alt="'.$row_floor['name'].'"></a>';
                }
            }
            else{
                echo '<a target="_blank"><img src="http://placehold.it/1210x60"></a>';
            }
        }
        ?>
    </section>
    <section class="Prod-nb clearfix ads-article">
        <article class="dmsp4-1">
            <div class="arrowLine" style="background-color: <?php echo $myArr1[$i]; ?>;">
                <span><?php echo $i+1; ?>c</span>
            </div>
            <div class="arrowCategory" style="background-color: <?php echo $myArr2[$i]; ?>;" id="divCategoryID<?php echo $i ?>">
                <a href="<?php echo $linkrootshop?>/<?php echo $myArrPrimarySubject[$i];?>.html" id="aCategoryName<?php echo $i ?>"><?php echo $myArrName[$i]; ?></a>
            </div>
            <div class="divCategory" style="background-color: <?php echo $myArr3[$i]; ?>; border-top: 1px solid <?php echo $myArr1[$i]; ?>">
                <?php
                $sub_cate_floor1=get_records("tbl_shop_category","status=0 AND parent='".$myArrID[$i]."' AND hot=1","date_added","2"," ");
                $myArrSubName = array();
                $myArrSubject = array();
                $myArrImage = array();
                while($row_sub_cate1=mysql_fetch_assoc($sub_cate_floor1)){
                    array_push($myArrSubName, $row_sub_cate1['name']);
                    array_push($myArrSubject, $row_sub_cate1['subject']);
                    array_push($myArrImage, $row_sub_cate1['image']);
                }

                $sub_cate_floor2=get_records("tbl_shop_category","status=0 AND parent='".$myArrID[$i]."' AND hot=0","date_added","6"," ");
                while($row_sub_cate2=mysql_fetch_assoc($sub_cate_floor2)){
                    array_push($myArrSubName, $row_sub_cate2['name']);
                    array_push($myArrSubject, $row_sub_cate2['subject']);
                    array_push($myArrImage, $row_sub_cate2['image']);
                }

                ?>
                <div class="divContent">
                    <?php if(isset($myArrImage[0])){ ?>
                        <img src="<?php echo $linkroot?>/<?php echo $myArrImage[0] ;?>" />
                    <?php }else{ ?>
                        <img src="<?php echo $linkroot?>/images/noimage.png" />
                    <?php } ?>
                    <p><a href="<?php echo $linkrootshop?>/<?php echo $myArrSubject[0];?>.html"><?php echo $myArrSubName[0]; ?></a></p>
                </div>
                <div class="sep"></div>
                <div class="divContent">
                    <?php if(isset($myArrImage[1])){ ?>
                        <img src="<?php echo $linkroot?>/<?php echo $myArrImage[1] ;?>" />
                    <?php }else{ ?>
                        <img src="<?php echo $linkroot?>/images/noimage.png" />
                    <?php } ?>
                    <p><a href="<?php echo $linkrootshop?>/<?php echo $myArrSubject[1];?>.html"><?php echo $myArrSubName[1]; ?></a></p>
                </div>
            </div>
            <div class="divSubCategory">
                <?php for($j = 2; $j < 8; $j++){ ?>
                    <p class="aSubCategory"><a href="<?php echo $linkrootshop?>/<?php echo $myArrSubject[$j];?>.html" class="a-subName"><?php echo $myArrSubName[$j] ?></a></p>
                <?php } ?>
            </div>
            <div class="slide"><a target="_blank"><img src="http://placehold.it/180x60"></a>
            <div class="slide"><a target="_blank"><img src="http://placehold.it/180x60"></a>
<!--                --><?php
//                $dt = date("Y-m-d");
//                $adv_floor1=get_records("tbl_adv","status = 0 AND start_banner <= '".$dt."' AND '".$dt."' <= finish_banner AND main_position = 0 AND sub_position = '".($i+1)."'","date_added"," "," ");
//                $total2 = 0;
//                while($row_floor1=mysql_fetch_assoc($adv_floor1)){
//                    if($row_floor1['image'] != ''){
//                        echo '<div class="slide"><a href="'.$row_floor1['link'].'" target="_blank"><img src="../web/'.$row_floor1['image'].'" alt="'.$row_floor1['name'].'"></a>';
//                    }
//                    else{
//                        echo '<div class="slide"><a href="'.$row_floor1['link'].'" target="_blank"><img src="http://placehold.it/180x60&text=No Image" alt="'.$row_floor1['name'].'"></a>';
//                    }
//                    $total2++;
//                }
//                if($total2 == 0){
//                    echo '<div class="slide"><a target="_blank"><img src="http://placehold.it/180x60"></a>';
//                    echo '<div class="slide"><a target="_blank"><img src="http://placehold.it/180x60"></a>';
//                }
                ?>
        </article>
        <article class="dmsp4-2">
            <?php
            $dt = date("Y-m-d");
            $adv_floor = "SELECT *, COUNT(id) AS amount FROM tbl_adv WHERE status = 0 AND start_banner <= '".$dt."' AND '".$dt."' <= finish_banner AND main_position = 1 AND sub_position = '".($i+1)."' ORDER BY date_added LIMIT 1";
            if ($result_floor = mysql_query($adv_floor,$conn)) {
                $row_floor=mysql_fetch_array($result_floor);
                if($row_floor['amount'] > 0){
                    if($row_floor['image'] != ''){
                        echo '<a href="'.$row_floor['link'].'" target="_blank"><img src="../web/'.$row_floor['image'].'" alt="'.$row_floor['name'].'"></a>';
                    }
                    else{
                        echo '<a href="'.$row_floor['link'].'" target="_blank"><img src="http://placehold.it/190x330&text=No Image" alt="'.$row_floor['name'].'"></a>';
                    }
                }
                else{
                    echo '<a target="_blank"><img src="http://placehold.it/390x420"></a>';
                }
            }
            ?>
            <!--        <img src="--><?php //echo $linkroot?><!--/--><?php //echo $myArrPrimaryImage[$i] ;?><!--" />-->
        </article>
        <article class="dmsp4-3">
            <?php
            $parent_floor=getParent("tbl_shop_category",$myArrID[$i]);
            $product_floor=get_records("tbl_item","status=0 AND type=0 AND parent1 in ({$parent_floor}) order by date_added limit 0,6"," "," "," ");

            while($row_floor=mysql_fetch_assoc($product_floor)){
                ?>
                <div class="divProductLine1" style="background-image: url('<?php echo $linkrootshop.'/web/'.$row_floor['image'] ?>'); background-size: cover" onmouseover="$('.img-rounded').attr('src', '<?php echo $linkrootshop.'/web/'.$row_floor['image'] ?>');">
                    <div class="divProductOverlay1" onmouseover="this.style.backgroundColor = '<?php echo $myArr3[$i] ?>'; $('.img-rounded').attr('src', '<?php echo $linkrootshop.'/web/'.$row_floor['image'] ?>');"
                         onmouseout="this.style.backgroundColor = 'white'" onclick="window.location.href = '<?php echo $linkrootshop;?>/<?php echo $row_floor['subject'];?>.html'">
                        <span onmouseover="$('.img-rounded').attr('src', '<?php echo $linkrootshop.'/web/'.$row_floor['image'] ?>');"><?php echo $row_floor['name'] ?></span><br/><br/>
                        <span onmouseover="$('.img-rounded').attr('src', '<?php echo $linkrootshop.'/web/'.$row_floor['image'] ?>');"><?php echo $row_floor['description'] ?></span><br/><br/>
                        <?php if($row_floor['price'] > 0 && $row_floor['pricekm'] > 0){ ?>
                            <span class="spanMoneyKM" onmouseover="$('.img-rounded').attr('src', '<?php echo $linkrootshop.'/web/'.$row_floor['image'] ?>');"><?php echo number_format($row_floor['pricekm'])."đ"; ?></span><br/>
                            <span class="spanMoney" onmouseover="$('.img-rounded').attr('src', '<?php echo $linkrootshop.'/web/'.$row_floor['image'] ?>');"><?php echo number_format($row_floor['price'])."đ"; ?></span>
                        <?php }else{ ?>
                            <span class="spanMoneyKM" onmouseover="$('.img-rounded').attr('src', '<?php echo $linkrootshop.'/web/'.$row_floor['image'] ?>');"><?php if($row_floor['pricekm'] > 0){echo number_format($row_floor['pricekm'])."đ";}else{echo number_format($row_floor['price'])."đ";} ?></span>
                        <?php } ?>
                    </div>
                </div>
            <?php } ?>
        </article>
    </section><!-- End .Prod-nb -->
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
        $('.bx-viewport').css('width', '180px');
        $('.bx-viewport').css('max-height', '120px');

        $('.bx-wrapper .bx-viewport').css('-webkit-box-shadow', 'none');
        $('.bx-wrapper .bx-viewport').css('box-shadow', 'none');
        $('.bx-wrapper .bx-viewport').css('border', '6px solid #fff');
        $('.bx-wrapper .bx-viewport').css('border-top', '8px solid #fff');
        $('.bx-wrapper .bx-viewport').css('border-bottom', '8px solid #fff');

        $container = $('<div/>').attr('id', 'imgPreviewWithStyles').append('<img/>').hide().css('position', 'absolute').appendTo('body'),

            $img = $('img', $container),
            $('.divProductLine1 .divProductOverlay1').mousemove(function (e) {
                var mac = navigator.platform.match(/(Mac|iPhone|iPod|iPad)/i) ? true : false;
//                alert(mac);
                if(mac == false){
                    $container.css({
                        top: e.pageY - 250 + 'px',
                        right: 1400 - e.pageX + 'px'
                    });
                }
                else{
                    $container.css({
                        top: e.pageY - 250 + 'px',
                        right: 1700 - e.pageX + 'px'
                    });
                }

            }).hover(function () {
                    var link = this;
                    $container.show();
                    $img.load(function () {
                        $img.addClass('img-rounded');
                        $img.show();
                    }).attr('src', 'imgs/loader.gif');
                }, function () {
                    $container.hide();
                    $img.unbind('load').attr('src', '').hide();
                });

        for(var i = 0; i < 8; i++){
            if($('#aCategoryName'+i).height() > 14){
                $('#divCategoryID'+i).css('padding', '5px 0 11px 0');
            }
        }
    });
</script>

