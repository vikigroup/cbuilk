
<style>
	.sty_table_rv{
	border-right:1px solid #ccc;
		border-top:1px solid #ccc;
}
.sty_table_rv td{
	border-left:1px solid #ccc;
	border-bottom:1px solid #ccc;

	padding:5px;
}
</style>
<script type="text/javascript">  
	$(document).ready(function() {
		
		$(".click_cardt").click(function(){;
		alert(" Sửa giỏ hàng thành công");; 
		var a;
		a=$(this).attr("value");
		var idtin=$("#idtin"+a).val();;
		var sl=$("#qty"+a).val();;
		var pri=$("#price"+a).val();;
		$(".box_shop_2").load("<?php echo $host_link_full;?>/content/temp<?php echo $url;?>/add_ajax.php?idtin="+idtin+"&sl="+sl+"&update=1",function() {
				window.location.reload();
			});;
		});;
		$(".deletet").click(function(){;
		alert(" Xóa sản phẩm thành công");; 
		var a;
		a=$(this).attr("value");
		var idtin=$("#idtin"+a).val();;
		var sl=$("#qty"+a).val();;
		var pri=$("#price"+a).val();;
		$(".box_shop_2").load("<?php echo $host_link_full;?>/content/temp<?php echo $url;?>/delete_ajax.php?idtin="+idtin,function() {
				window.location.reload();
			});;
		});;		
		
	});
	
</script>
<div class="center_ct">

    <div class="frame_ndct">
        
        <h1 class="title_pdm">
            <span>Giỏ hàng </span>
        </h1><!-- End .title_pdm -->
        
        <div class="main_ndcc">
                
            <div class="news_frame">
                
                <div>
        	
            <? if (isset($_SESSION['daySoluong'])) { ?>
            <?
             reset($_SESSION['daySoluong']);
             reset($_SESSION['dayMaSP']);
             reset($_SESSION['dayDongia']);	
             reset($_SESSION['dayidsp']);		
             reset($_SESSION['dayurlsp']);	
             reset($_SESSION['dayloaisp']);
            $dem=1;
            while( key($_SESSION['daySoluong'])!= null)
            {
            $idSP=key($_SESSION['daySoluong']);
            $id=$_SESSION['dayidsp'][$idSP];
            $soluong=$_SESSION['daySoluong'][$idSP];
            $tongsoluong+=$soluong;
            $masp=$_SESSION['dayMaSP'][$idSP];
            $dongia=$_SESSION['dayDongia'][$idSP];
            $tien=$dongia*$soluong;
            $tongtien+=$tien; 
        //	$dongia=round(($dongia/($tl*1000)),2); // cap nhat ti gia
            $url_img=$_SESSION['dayurlsp'][$idSP];
            $type=$_SESSION['dayloaisp'][$idSP];
           
            next($_SESSION['daySoluong']);
            next($_SESSION['dayMaSP']);
            next($_SESSION['dayDongia']);	
            next($_SESSION['dayidsp']);		
            next($_SESSION['dayurlsp']);	
            next($_SESSION['dayloaisp'])
            ?>
        
            <table width="100%" cellspacing="0" cellpadding="3" class="sty_table_rv">
                <tr>
                    <td width="5%" scope="col">&nbsp;</td>
                    <td width="25%" scope="col" align="center"><b>Tên</b></td>
                    <td width="20%" scope="col" align="center"><b>Hình</b></td>
                    <td width="20%" scope="col" align="center"><b>Số lượng</b></td>
                    <td width="30%" scope="col" align="center"><b>Đơn giá</b></td>
                </tr>
                <tr>
                    <td align="center" valign="middle"><img id="delete<?=$dem?>" class="deletet" name="delete<?=$dem?>" src="<?php echo $host_link_full ;?>/skin/temp<?php echo $url;?>/imgs/layout/delete.png" value="<?=$dem;?>" alt="" /></td>
                    <td align="center" valign="middle"  class="productname"><a href="#" ><?=$masp;?></a>&nbsp;</td>
                    <td align="center"><img width="100"  height="100" src="<?php echo $host_link_full ;?>/<?=$url_img?>" alt=""> </td>
                    <td align="center" valign="middle">
            
                    <input id="idtin<?=$dem?>" name="idtin<?=$dem?>" type="hidden"  value="<?=$id;?>" />
                    <input type="number" name="qty<?=$dem;?>"  min="0" max="25" id="qty<?=$dem;?>" size="6" value="<? echo $soluong;?>" style="width:35px;height:25px; text-align:center;">
                    <input class="click_cardt" name="addcart<?=$dem;?>" type="image" id="addcart<?=$dem;?>" src="<?php echo $host_link_full ;?>/skin/<?php echo $template;?>/imgs/layout/edit.png"  width="24" height="24" value="<?=$dem;?>" align="top">
                    </td>
                    <td align="center">
                        <?php echo number_format($dongia,0)?> &nbsp;VND<? //$donvi?>
                    </td>
                </tr>
                <? 
                $dem++;
                }
                ?>
                <tr class="tongket">
                    <td align="center">&nbsp;</td>
                    <td height="35" align="center">Tổng cộng</td>
                    <td align="center">&nbsp;</td>
                    <td align="center"><? echo $tongsoluong;?>&nbsp;</td>
                    <td align="center">Giá : <? //number_format($tongtien,0)?><? echo number_format($tongtien,0);?>&nbsp; VND<? //$donvi?></td>
                </tr>
                    <tr class="tongket">
                    <td align="center">&nbsp;</td>
                    <td height="35" align="center">&nbsp;</td>
                    <td colspan="3" align="center"><a href="<?php echo $host_link_full?>/dat-hang"><img src="<?php echo $host_link_full ;?>/skin/temp<?php echo $url;?>/imgs/layout/btn-mua-hang.jpg" border="0" /></a> &nbsp;&nbsp;&nbsp;<a href="<?=$_SERVER['HTTP_REFERER'];?>"><img src="<?php echo $host_link_full ;?>/skin/temp<?php echo $url;?>/imgs/layout/btn-tiep-tuc-mua.jpg" alt=""/></a></td>
                </tr>
            </table>
            
              <? }
              else { ?>
              <br />
              <center>
              Chưa có sản phẩm nào trong giỏ!
              </center>
              <br />
              <br />
              <? } ?>         
                  
                    
                
        </div>
                
            </div><!-- End .news_frame -->
                
        </div><!-- End .main_ndcc -->
            
    
    </div><!-- End .frame_ndct -->

	<div class="clear2"></div>

</div>
