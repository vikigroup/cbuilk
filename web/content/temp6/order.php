<?php 
	// require_once("librarys/funs/check_login.php"); 
	
	if($_SESSION['tongso']<1) { 
	//	location($host_link_full);
	}
	
	 function Luu1ChiTietDonHang($idDH,$idSP, $SoLuong,$Gia,$lang,$tl) //Lưu 1 sản phẩm vào database
	{
		$vale1='idDH,idSP,Soluong,DonGia';
		$vale2="'".$idDH."','".$idSP."','".$SoLuong."','".$Gia."'";
		$id1=insert_table('tbl_donhangchitiet',$vale1,$vale2,$hinh);
	}

	// xu li phan oder
	

	
	if(isset($_REQUEST['order'])) {

		// them vao gio hang khi server tra lai
		$idKH=$_SESSION['kh_login_id'];
		$name= isset($_REQUEST['name']) ? trim($_REQUEST['name']) : '';
		$dt= isset($_REQUEST['phone']) ? trim($_REQUEST['phone']) : '';
		$dc= isset($_REQUEST['addr']) ? trim($_REQUEST['addr']) : '';
		$yahoo= isset($_REQUEST['yahoo']) ? trim($_REQUEST['yahoo']) : '';
		$total= isset($_REQUEST['total']) ? trim($_REQUEST['total']) : '';
		
		 
		if ($total == NULL){$coloi=true; $coloi_hien_total = "<br />Giá chưa có";}
		if ($name == NULL){$coloi=true; $coloi_hien_name = "<br />Bạn chưa nhập tên";}
		if($name!=NULL){
			if (strlen($name)<2 ){$coloi=true; $coloi_hien_name = "<br />Tên phải nhiều hơn 2 ký tự";}
		}
		if ($dt == NULL){$coloi=true; $coloi_hien_dt = "<br />Bạn chưa nhập số điện thoại";}
		if ($dc == NULL){$coloi=true; $coloi_hien_dc = "<br />Bạn chưa nhập địa chỉ";}
		if ($yahoo == NULL){$coloi=true; $coloi_hien_dt = "<br />Bạn chưa nhập yahoo hoặc địa chỉ mail";}
		
		$_SESSION['kh_name']=$name;
		$_SESSION['kh_dt']=$dt;
		$_SESSION['kh_dc']=$dc;
		$_SESSION['kh_yahoo']=$total;
		$_SESSION['kh_total']=$yahoo;
			
		if($coloi==FALSE) {  
			
			$_SESSION['price']=$total; 
			$vale1='idgh,price,idKH,soDT,ThoiDiemDatHang,TenNguoiNhan,DiaChi,yahoo,TinhTrang,thanhtoan,GhiChu';
			$vale2="'".$idgh."','".$total."','".$idKH."','".$dt."','".$ngay."','".$name."','".$dc."','".$yahoo."','','','Giohang_".$tenmien."'";
			$hinh="";
			
			if(!isset($_SESSION['id_DH'])) {
				$id1=insert_table('tbl_donhang',$vale1,$vale2,$hinh);
				$_SESSION['id_DH']=$id1;
			}else{
				// ko them vao DB nữa
				$id1=$_SESSION['id_DH'];
			}

			   if($id1>0){
				 $lastID =$id1;
				 $_SESSION['id_DH']=$lastID;
				 $dayid="id:";
				  if(isset($_SESSION['daySoluong']))
					while( key($_SESSION['daySoluong'])!= null)
					{
						$idSP=key($_SESSION['daySoluong']);
						$id=$_SESSION['dayidsp'][$idSP];
						$masp=$_SESSION['dayMaSP'][$idSP];
						$soluong=$_SESSION['daySoluong'][$idSP];
						$tongsoluong+=$soluong;
						//$_SESSION['tongsoluong']=$tongsoluong;
						$dongia=$_SESSION['dayDongia'][$idSP];
						$tien=$dongia*$soluong;
						$tongtien+=$tien; 
						$dayid.=$id.",";
						
						if($_SESSION['id_DH']!="") {
							Luu1ChiTietDonHang($lastID,$id,$soluong,$dongia,$lang,$tl); // insert chi tiet don hang
						}
						
						next($_SESSION['daySoluong']);
						next($_SESSION['dayDongia']);
						next($_SESSION['dayMaSP']);	
					}
					
					// huy cac bien dat hang
					
					session_destroy();
					
					echo '<script>window.location="'.$host_link_full.'/dat-hang-thanh-cong/" </script>';

					
				}
		
		}
	
	}
?>
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
<div class="content_w">

    <div class="title_frame_main_text">
         <?php echo module_keyword($mang11,$mang22,"order");?>
    </div><!-- End .title_frame_main_text -->
    
    <div class="main_frame_main_text">
    
        <div class="frame_details_nd_info">
            
          	<div style="margin-left:5px; text-align:center;">
            
                <?php  
                if($_REQUEST['code']==1){
					
					
					//
					
                    unset($_SESSION['daySoluong']);
                    unset($_SESSION['dayDongia']);
                    unset($_SESSION['dayidd']);	
                    unset($_SESSION['dayurll']);	
                    unset($_SESSION['tongso']);		
                    unset($_SESSION['idDH']);	
                    unset($_SESSION['price']);
					
					unset($_SESSION['kh_name']);	
                    unset($_SESSION['kh_dt']);		
                    unset($_SESSION['kh_dc']);	
                    unset($_SESSION['kh_yahoo']);
					unset($_SESSION['kh_total']);
                ?>
                <br />
                <br />
                <br />
                <p style="width:100%;text-align:center">    Bạn đã đặt hàng thành công</p>
                <br />
                <!--  <p style="width:100%;text-align:center"> <a href="?p=home"><?=_RETURN_HOME?></a></p>-->
                <p style="width:100%;text-align:center"> <a href="<?php echo $host_link_full;?>">Quay lại</a></p>
                <br />
                 <script>
                s=10; 
                setTimeout("document.location='<?php echo $host_link_full;?>'",s*1000); 
                setInterval("document.getElementById('sogiay').innerHTML=s--;",1000);
                </script> 
                <br />   
                <p style="width:100%;text-align:center">  Quay về trang chủ <span id=sogiay></span> s!</p>
                <br />
                <br />
                <br />  <br />
                
                
                <?php    }else { 
               // $a1=lap_table('khachhang','id='.$_SESSION['kh_login_id'],' ',' ',' ');
               // $a2=mysql_fetch_assoc($a1);  
                
                if (isset($_SESSION['daySoluong'])) {
                ?>
                <form method="post" action="<?php echo $_SERVER['REQUEST_URI'];?>" >
                    <table width="100%" border="0" cellspacing="0" cellpadding="0" >
                        <tr>
                            <td height="20" colspan="2" scope="col">Thông tin khách hàng
                            <br /> <? 
                            echo $coloi_hien_total;
                            echo $coloi_hien_name;
                            echo $coloi_hien_dt;
                            echo $coloi_hien_dc;
                            echo $coloi_hien_yahoo;
                            ?>
                            </td>
                        </tr>
                            <td width="26%" height="39" align="right" valign="middle"><label for="label">Tên người nhận</label>
                            &nbsp;&nbsp;:&nbsp;</td>
                            <td width="27%" align="left" valign="middle"><input style="height:25px;" class="textbox" type="text" name="name"  value="<?=$a2['ten'];?>"  size="40" /></td>
                        </tr>
                        <tr>
                            <td height="46" align="right" valign="middle"><label for="label">Điện thoại&nbsp;(*)&nbsp;</label>
                            &nbsp;:&nbsp;</td>
                            <td align="left" valign="middle"><input style="height:25px;" class="textbox" size="40" type="text" name="phone" id="phone" value="<? echo $a2['dienthoai'];?>" /></td>
                        </tr>
                        <tr>
                            <td height="33" align="right" valign="middle"><label for="label">Địa chỉ&nbsp;:&nbsp; </label></td>
                            <td align="left" valign="middle"><input style="height:25px;" class="textbox" size="40" type="text" name="addr"   id="addr" value="<? echo $a2['diachi'];?>" /></td>
                        </tr>
                        <tr>
                            <td height="32" align="right" valign="middle">Email (*)&nbsp; :&nbsp;</td>
                            <td align="left" valign="middle"><input style="height:25px;" class="textbox" size="40" type="text" name="yahoo"   id="yahoo" value="<? echo $a2['email'];?>" /></td>
                        </tr>
                        <tr>
                            <td height="19" align="center" valign="baseline">&nbsp;</td>
                            <td align="center" valign="middle">&nbsp;</td>
                        </tr>
                        <tr>
                            <td height="54" align="center" valign="baseline">&nbsp;</td>
                            <td align="left" valign="top"><input name="order" type="submit" id="order" value="" style="width:91px; height:24px; border:none; background:url(<?php echo $host_link_full ;?>/skin/<?php echo $template;?>/imgs/layout/btn_buy_now_1.png)" />
                            <input name="idKH" type="hidden" value="1" />
                            <input name="frame" type="hidden" value="order" />
                            </td>
                        </tr>
                    </table>
                
                    <hr>
                    <br>
                    
                    <table width="100%" cellspacing="0" class="sty_table_rv">
                        <tr>
                            <td width="25%" scope="col"><b>Tên</b></td>
                            <td width="25%" scope="col"><b>Hình</b></td>
                            <td width="25%" scope="col"><b>Số lượng</b></td>
                            <td width="25%" scope="col"><b>Đơn giá</b></td>
                        </tr>
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
                        $url=$_SESSION['dayurlsp'][$idSP];
                        $type=$_SESSION['dayloaisp'][$idSP];
                        
                        next($_SESSION['daySoluong']);
                        next($_SESSION['dayMaSP']);
                        next($_SESSION['dayDongia']);	
                        next($_SESSION['dayidsp']);		
                        next($_SESSION['dayurlsp']);	
                        next($_SESSION['dayloaisp'])
                        ?>
                        <tr>
                            <td align="center" valign="middle"  class="productname"><a href="#" ><?=$masp;?></a>&nbsp;</td>
                            <td align="center"><img width="100"  height="100" src="<?php echo $host_link_full ;?>/<?=$url?>" alt=""> </td>
                            <td align="center"> 
                            <input name="total" type="hidden" value="<?= $tongtien?>" />
                            <input id="idtin<?=$dem?>" name="idtin<?=$dem?>" type="hidden"  value="<?=$id;?>" />
                            <input type="number" name="qty<?=$dem;?>"  min="0" max="25" id="qty<?=$dem;?>" size="6" value="<? echo $soluong;?>" style="width:30px;height:25px; text-align:center;" disabled="disabled">
                             </td>
                            <td align="center"><?php echo number_format($dongia,0);?> &nbsp;VND</td>
                        </tr>
                        <? 
                        $dem++;
                        }
                        ?>
                        <tr class="tongket">
                            <td height="35" align="center">Tổng cộng</td>
                            <td align="center">&nbsp;</td>
                            <td align="center"><? echo $tongsoluong;?>&nbsp;</td>
                            <td align="center">Giá : <? //number_format($tongtien,0)?><? echo number_format($tongtien,0);?>&nbsp; VND<? //$donvi?></td>
                        </tr>
                    </table>
                </form>
                <? } else {?>
               Hiện tại không có sản phẩm nào trong giở hàng!
                <?
                 } 
                }
                ?>
            </div>
        
            <div class="clear2"></div>               
        </div><!-- End .frame_details_nd_info -->         
        
        <div class="tools_share_num">
           <!-- <img src="imgs/layout/img_demo/share_bg.jpg" alt=""/>-->
        </div>
                
    </div><!-- End .main_frame_text -->
        
</div>