<div class="m-slider">
    <div id="slider">
        <?php
        $gt=get_records("tbl_slider","status=0 AND idshop=0","date_added DESC, sort","0,20"," ");
        $index = 0;
        while($row_slide=mysql_fetch_assoc($gt)){ ?>
            <a id="aSlider<?php echo $index ?>" target="_blank" href="<?php echo $row_slide['link']; ?>" style="background-color: <?php echo $row_slide['color']?>">
                <img class="nivo-main-image" src="<?php echo $linkroot ;?>/<?php echo $row_slide['image']?>" alt="<?php echo $row_slide['title']?>" data-transition="slideInLeft"/>
            </a>
        <?php $index++; } ?>
    </div>
</div>
<script>
    $(function() {
        $('#slider').css({'visibility':'visible'}).nivoSlider({
            effect: 'fade',
            slices: 20, // For slice animations
            boxCols: 8, // For box animations
            boxRows: 4, // For box animations
            animSpeed: 500, // Slide transition speed
            pauseTime: 6000, // How long each slide will show
            startSlide: 0, // Set starting Slide (0 index)
            controlNav: false,
            directionNav: false,
            control: false,
            afterChange: function(){
                var currentSlide = $('#slider').data('nivo:vars').currentSlide;
                $('.m-slider').css("background-color", $("#aSlider"+currentSlide).css('background-color'));
            }
        });
        $('.m-slider').css("background-color", $("#aSlider"+0).css('background-color'));
    });
</script>
