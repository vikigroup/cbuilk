<?php if(isset($_SESSION['tongso'])) {?>
<div class="block_ct">                    

    <div class="main_adv">
        
        <h1 class="title_adv">
            Giỏ hàng
        </h1><!-- End .title_adv -->
        
        <div class="box_shop_2">
            <div class="icon_shop_2">
            <span id="cart_21"><?php if(isset($_SESSION['tongso'])) echo $_SESSION['tongso'];else echo "0";?></span>
            </div>
        	<a href="xem-gio-hang">  Có <?php if(isset($_SESSION['tongso'])) echo $_SESSION['tongso'];else echo "0";?> sản phẩm trong giỏ hàng </a>
        </div>
    </div><!-- End .main_adv -->

</div><!-- End .block_ct -->

<?php } else { ?>
<div class="block_ct" style="display:none">
    <div class="box_shop_2">
        
    </div>
</div>
<?php } ?>