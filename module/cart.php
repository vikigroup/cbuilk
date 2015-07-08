<?php include("module/addcart.php") ?>
<div class="form_dn">
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
                $(".main_card").load("<?php echo $host_link_full;?>/content/temp<?php echo $url;?>/add_ajax.php?idtin="+idtin+"&sl="+sl+"&update=1",function() {
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
                $(".main_card").load("<?php echo $host_link_full;?>/content/temp<?php echo $url;?>/delete_ajax.php?idtin="+idtin,function() {
                    window.location.reload();
                });;
            });;

        });

    </script>
    <div class="content_w">

        <div class="title_frame_main_text">
            <!--            --><?php //echo module_keyword($mang11,$mang22,"viewcart");?>
        </div><!-- End .title_frame_main_text -->

        <div class="main_frame_main_text">

            <div class="frame_details_nd_info">

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
                            Chua co san pham nao trong gio hang!
                        </center>
                        <br />
                        <br />
                    <? } ?>



                </div>

                <div class="clear2"></div>
            </div><!-- End .frame_details_nd_info -->

            <div class="tools_share_num">
                <!-- <img src="imgs/layout/img_demo/share_bg.jpg" alt=""/>-->
            </div>

        </div><!-- End .main_frame_text -->

    </div>

    <div class="clear"></div>

</div>