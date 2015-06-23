<? $errMsg =''?>
<?php 
 	$id=$_GET['id']; 	
	settype($id,"int");
	$sql="SELECT * FROM  tbl_donhang WHERE id=".$id;
	
    $quantri=mysql_query($sql) or die(mysql_error());
	$row_quantri=mysql_fetch_assoc($quantri);
	
	$iduser=get_field('tbl_shop','id',$row_quantri['idshop'],'iduser');
	
	if($iduser!=$_SESSION['kh_login_id']) header("location:".$host_link_full."/quantri/");

?>
<div class="main_cont_body">
    
    <h1 class="title_menu_admin">Chi tiết đơn hàng</h1><!-- End .title_menu_admin -->
    
    <div class="frame_cont_body">    
    
        <div class="note">Lưu ý: Những ô có dấu * là bắt buộc</div>                
    
    
        <div class="frm_tbl">
        	<table>
                
                    <tr>
                        <th><span class="table_chu">Tên người đặt</span><span class="star_color">*</span></th>
                        <td>
                            <div class="pdd1">
                                <input class="ipt_txt1" type="text" id="ten" name="ten" title="Nhập tên"  value="<?php echo $row_quantri['TenNguoiNhan']?>" />
                                <div class="coloi_hien"><?=$coloi_hien_ten ?></div>
                            </div>
                        </td>
                    </tr>                                
                    <tr>
                        <th><span class="table_chu">Số điện thoại </span></th>
                      <td>
                            <div class="pdd1">
                                <input class="ipt_txt1" type="text" id="ten" name="ten" title="Nhập tên"  value="<?php echo $row_quantri['soDT']?>" />
                                <div class="coloi_hien"><?=$coloi_hien_ten ?></div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                        <th><span class="table_chu">Địa chỉ </span></th>
                      <td>
                            <div class="pdd1">
                                <input class="ipt_txt1" type="text" id="ten" name="ten" title="Nhập tên"  value="<?php echo $row_quantri['DiaChi']?>" />
                                <div class="coloi_hien"><?=$coloi_hien_ten ?></div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                        <th><span class="table_chu">Yahoo, email </span></th>
                        <td>
                            <div class="pdd1">
                                <input class="ipt_txt1" type="text" id="thutu" name="thutu" title="Nhập thứ tự" size="70" value="<?php echo $row_quantri['yahoo']?>" />
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th><span class="table_chu">Tình trạng xử lí</span><span class="star_color">*</span></th>
                        <td>
                            <div class="pdd1">
                                <input type="radio" name="anhien" id="anhien" value="0" {ko} />
                                chưa
                                &nbsp;
                                <input type="radio" name="anhien" id="anhien" value="1" {co} />
                                <span class="table_khung"> Đã xử lý</span><br /><div class="coloi_hien"><?=$coloi_hien_anhien ?></span> 
                            </div>
                        </td>
                    </tr>
                  <tr>
                      <th>&nbsp;</th>
                      <td>&nbsp;</td>
                    </tr>
                    <tr align="center">
                      <th colspan="2">
                            <table border="1" bordercolor="#C9C9C9">
                                <tr align="center" class="qt_user_sp_nen_td">
                                    <th width="45" height="26" class="title"><a class="title" href="">idDH</a></th>
                                    <th width="170" class="title"><a class="title" href="">Hình</a></th>
                                    <th width="164" class="title"><a class="title" href="">Tên</a></th>
                                    <th width="111" class="title"><a class="title" href="">Số lượng</a></th>
                                    <th width="158" class="title">Đơn giá</th>
                              </tr>
                                <?
                                $tongcong=0;
                                $where=" idDH=".$id;
                                $sortby="order by id";
                                if ($_REQUEST['sortby']!='') $sortby="order by ".(int)$_REQUEST['sortby'];
                                $direction=($_REQUEST['direction']==''||$_REQUEST['direction']=='0'?"desc":"");
                                
                                $sql="select * from tbl_donhangchitiet where $where $sortby $direction ";//echo $sql;
                                $result=mysql_query($sql);//echo $sql;
                                $i=0;
                                while($row=mysql_fetch_array($result)){
                                $kq=get_records('tbl_item','id='.$row['idSP'],' ',' ',' ');
                                $row1=mysql_fetch_array($kq);
                                ?>
                                
                                <tr>
                                    <td height="59" align="center" bgcolor="<?=$color?>" class="smallfont"><?=$row['idDH']?></td>
                                    <td align="center" bgcolor="<?=$color?>" class="smallfont"><img  src="../<?php echo $row1['image']?>" height="40" width="40" style="padding:3px; border:solid 1px #CCCCCC;"></td>
                                    <td align="center" bgcolor="<?=$color?>" class="smallfont"><?=$row1['name']?></td>
                                    <td align="center" bgcolor="<?=$color?>" class="smallfont"><?=$row['SoLuong']?></td>
                                    <td bgcolor="<?=$color?>" class="smallfont"><?=number_format($row['DonGia'],0);?>&nbsp;VND</td>
                              </tr>
                                <? $tongcong=$tongcong+$row['SoLuong']*$row['DonGia'];?> 
                                <?
                                }
                                ?>
                                <tr>
                                    <td bgcolor="<?=$color?>" class="smallfont" align="center">&nbsp;</td>
                                    <td bgcolor="<?=$color?>" class="smallfont">&nbsp;</td>
                                    <td bgcolor="<?=$color?>" class="smallfont">Tổng cộng:</td>
                                    <td bgcolor="<?=$color?>" class="smallfont">&nbsp;&nbsp;<?=number_format($tongcong,0);?>&nbsp; VND</td>
                                    <td bgcolor="<?=$color?>" class="smallfont" align="center">&nbsp;</td>
                                </tr>
                        </table>
                      
                      </th>
                  </tr>
                    <tr>
                      <th>&nbsp;</th>
                      <td>&nbsp;</td>
                  </tr>
                    <tr>
                        <th>&nbsp;</th>
                        <td>
                            <div class="pdd1">&nbsp;</div>
                        </td>
                    </tr>
                                                 
                </table>   
        </div><!-- End .frm_tbl -->
    
    </div><!-- End .frame_cont_body -->
    
</div>