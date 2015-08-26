<?php
$myArr1 = array('#68284E', '#C14150', '#0D9799', '#965BB9', '#D85885', '#181818', '#619ECE', '#9AB554', '#BB5A0E', '#4B3029', '#2C9E7A', '#C9213D');
$myArr2 = array('#7C325C', '#C65461', '#12ACB4', '#A06BBF', '#E66492', '#242424', '#70A7D2', '#A3BB65', '#C5671C', '#5A4439', '#3CB38D', '#E83052');
$myArr3 = array('#873865', '#CC6672', '#17B4BB', '#AA7BC6', '#FF649D', '#2D2D2D', '#80B0D7', '#ADC375', '#D06716', '#674941', '#3CB38D', '#E93052');

$cate_floor = get_records("tbl_shop_category","status=0 AND parent=457 AND sort != 0","sort, date_added DESC","0,12"," ");
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
for($i = 0; $i < 12; $i++){
?>
<section class="Adv ads-floors">
    <?php
    $dt = date("Y-m-d");
    $adv_floor = "SELECT *, COUNT(id) AS amount FROM tbl_adv WHERE status = 0 AND start_banner <= '".$dt."' AND '".$dt."' <= finish_banner AND main_position = 2 AND sub_position = '".($i+1)."' ORDER BY sort, date_added DESC LIMIT 1";
    if ($result_floor = mysql_query($adv_floor,$conn)) {
        $row_floor = mysql_fetch_array($result_floor);
        if($row_floor['amount'] > 0){
            if($row_floor['image'] != ''){
                echo '<a href="'.$row_floor['link'].'" target="_blank"><img src="../web/'.$row_floor['image'].'" alt="'.$row_floor['name'].'"></a>';
            }
            else{
                echo '<a href="'.$row_floor['link'].'" target="_blank"><img src="http://placehold.it/1210x60&text=No Image" alt="'.$row_floor['name'].'"></a>';
            }
        }
        else{
            echo '<a target="_blank"><img src="http://placehold.it/1210x60"></a>';
        }
    }
    ?>
</section>
<section class="Prod-nb clearfix ads-article">
    <article class="dmsp4-1" style="background-color: <?php echo $myArr2[$i]; ?>;">
        <div class="arrowLine" style="background-color: <?php echo $myArr1[$i]; ?>;">
            <span><?php echo $i+1; ?>c</span>
        </div>
        <div class="arrowCategory" style="background-color: <?php echo $myArr2[$i]; ?>;" id="divCategoryID<?php echo $i; ?>" onclick="window.location.href = '<?php echo $root; ?>/<?php echo $myArrPrimarySubject[$i]; ?>.html'">
            <a href="<?php echo $root; ?>/<?php echo $myArrPrimarySubject[$i]; ?>.html" id="aCategoryName<?php echo $i ?>"><?php echo $myArrName[$i]; ?></a>
        </div>
        <div class="divCategory" style="background-color: <?php echo $myArr3[$i]; ?>; border-top: 1px solid <?php echo $myArr1[$i]; ?>">
            <?php
            $sub_cate_floor1 = get_records("tbl_shop_category","status=0 AND parent='".$myArrID[$i]."' AND hot=1","sort, date_added DESC","2"," ");
            $myArrSubName = array();
            $myArrSubject = array();
            $myArrImage = array();
            while($row_sub_cate1 = mysql_fetch_assoc($sub_cate_floor1)){
                array_push($myArrSubName, $row_sub_cate1['name']);
                array_push($myArrSubject, $row_sub_cate1['subject']);
                array_push($myArrImage, $row_sub_cate1['image']);
            }

            $sub_cate_floor2 = get_records("tbl_shop_category","status=0 AND parent='".$myArrID[$i]."' AND hot=0","sort, date_added DESC","6"," ");
            while($row_sub_cate2 = mysql_fetch_assoc($sub_cate_floor2)){
                array_push($myArrSubName, $row_sub_cate2['name']);
                array_push($myArrSubject, $row_sub_cate2['subject']);
                array_push($myArrImage, $row_sub_cate2['image']);
            }

            ?>
            <div class="divContent" style="background-color: <?php echo $myArr3[$i]; ?>" onclick="window.location.href = '<?php echo $root; ?>/<?php echo $myArrSubject[0]; ?>.html'">
                <?php if(isset($myArrImage[0])){ ?>
                    <img class="hvr-pop" src="<?php echo $linkroot; ?>/<?php echo $myArrImage[0]; ?>"/>
                <?php }else{ ?>
                    <img class="hvr-pop" src="<?php echo $linkroot; ?>/images/noimage.png"/>
                <?php } ?>
                <p><?php echo $myArrSubName[0]; ?></p>
            </div>
            <div class="sep"></div>
            <div class="divContent" style="background-color: <?php echo $myArr3[$i]; ?>" onclick="window.location.href = '<?php echo $linkrootshop?>/<?php echo $myArrSubject[1]; ?>.html'">
                <?php if(isset($myArrImage[1])){ ?>
                    <img class="hvr-pop" src="<?php echo $linkroot; ?>/<?php echo $myArrImage[1]; ?>" />
                <?php }else{ ?>
                    <img class="hvr-pop" src="<?php echo $linkroot; ?>/images/noimage.png" />
                <?php } ?>
                <p><?php echo $myArrSubName[1]; ?></p>
            </div>
        </div>
        <div class="divSubCategory">
            <?php for($j = 2; $j < 8; $j++){ ?>
                <?php if($myArrSubName[$j] != ''){ ?>
                <p class="aSubCategory"><a href="<?php echo $root; ?>/<?php echo $myArrSubject[$j]; ?>.html" class="a-subName"><?php echo $myArrSubName[$j]; ?></a></p>
            <?php } } ?>
        </div>
        <div class="divAds">
            <?php
            $adv_floor1 = get_records("tbl_adv","status = 0 AND start_banner <= '".$dt."' AND '".$dt."' <= finish_banner AND main_position = 0 AND sub_position = '".($i+1)."'","sort, date_added DESC"," "," ");
            $total_adv1 = 0;
            while($row_floor1 = mysql_fetch_assoc($adv_floor1)){
                if($row_floor1['image'] != ''){
                    echo '<div class="slide"><a href="'.$row_floor1['link'].'" target="_blank"><img src="../web/'.$row_floor1['image'].'" alt="'.$row_floor1['name'].'"></a></div>';
                }
                else{
                    echo '<div class="slide"><a href="'.$row_floor1['link'].'" target="_blank"><img src="http://placehold.it/187x67&text=No Image" alt="'.$row_floor1['name'].'"></a></div>';
                }
                $total_adv1++;
            }
            if($total_adv1 == 0){
                echo '<div class="slide"><a target="_blank"><img src="http://placehold.it/187x67"></a></div>';
                echo '<div class="slide"><a target="_blank"><img src="http://placehold.it/187x67"></a></div>';
            }
            else if($total_adv1 == 1){
                echo '<div class="slide"><a target="_blank"><img src="http://placehold.it/187x67"></a></div>';
            }
            ?>
        </div>
    </article>
    <article class="dmsp4-2">
        <?php
        $adv_floor = "SELECT *, COUNT(id) AS amount FROM tbl_adv WHERE status = 0 AND start_banner <= '".$dt."' AND '".$dt."' <= finish_banner AND main_position = 1 AND sub_position = '".($i+1)."' ORDER BY sort, date_added DESC LIMIT 1";
        if ($result_floor = mysql_query($adv_floor,$conn)) {
            $row_floor = mysql_fetch_array($result_floor);
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
    </article>
    <article class="dmsp4-3">
        <?php
        $parent_floor = parentString($myArrID[$i]);
        if($parent_floor != ''){
            $parent_floor = $myArrID[$i].",".$parent_floor;
        }
        else{
            $parent_floor = $myArrID[$i];
        }
        $product_floor = get_records("tbl_item","status=0 AND parent1 in ({$parent_floor}) AND set_time <= '$ngay'","top DESC, sort, date_added DESC","0,6"," ");
        $total_product = countRecord("tbl_item","status=0 AND parent1 in ({$parent_floor}) AND set_time <= '$ngay'");
        if($total_product > 0){
            while($row_floor = mysql_fetch_assoc($product_floor)){ ?>
            <div class="divProductLine1 hvr-float-shadow" style="background-image: url('<?php echo $linkrootshop.'/web/'.$row_floor['image'] ?>'); background-size: cover;" onclick="window.location.href = '<?php echo $linkrootshop;?>/<?php echo $row_floor['subject'];?>.html';">
                <div class="divProductOverlay1" onclick="window.location.href = '<?php echo $linkrootshop;?>/<?php echo $row_floor['subject'];?>.html';">
                    <span class="spanName"><?php echo $row_floor['name'] ?></span>
                    <?php if($row_floor['price'] == 0 && $row_floor['pricekm'] == 0){ ?>
                    <span class="spanMoneyKM">Giá liên hệ</span>
                    <?php }else if($row_floor['price'] > 0 && $row_floor['pricekm'] > 0){ ?>
                        <span class="spanMoneyKM"><?php if($row_floor['currency'] == 0){echo number_format($row_floor['pricekm'])."đ";}else{echo "$".number_format($row_floor['pricekm']);} ?></span>
                        <span class="spanMoney"><?php if($row_floor['currency'] == 0){echo number_format($row_floor['price'])."đ";}else{echo "$".number_format($row_floor['price']);}; ?></span>
                        <span class="spanUnitHome">/ <?php echo ucfirst($row_floor['unit']); ?></span>
                    <?php }else{ ?>
                        <span class="spanMoneyKM">
                            <?php if($row_floor['pricekm'] > 0){
                                if($row_floor['currency'] == 0){
                                    echo number_format($row_floor['pricekm'])."đ";
                                }else{
                                    echo "$".number_format($row_floor['price']);};
                            }else{
                                if($row_floor['currency'] == 0){
                                    echo number_format($row_floor['price'])."đ";
                                }else{
                                    echo "$".number_format($row_floor['price']);};
                            } ?>
                        </span>
                        / <?php echo ucfirst($row_floor['unit']); ?>
                    <?php } ?>
                </div>
            </div>
        <?php } } ?>
    </article>
</section><!-- End .Prod-nb -->
<?php } ?>
<div class="clear"></div>
<script>
    $(function() {
        $('.divAds').bxSlider({
            mode: 'vertical',
            slideWidth: 300,
            minSlides: 2,
            slideMargin: 2,
            auto: true,
            pager: false
        });

        $('.bx-wrapper').css('max-width', '180px');
        $('.bx-viewport').css('width', '190px');
        $('.bx-wrapper .bx-viewport').css('-webkit-box-shadow', 'none');
        $('.bx-wrapper .bx-viewport').css('box-shadow', 'none');
        $('.bx-wrapper .bx-viewport').css('border', '0');
        $('.bx-wrapper .bx-viewport').css('padding-right', '0');
    });
</script>
