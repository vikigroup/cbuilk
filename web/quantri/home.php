<div class="main_cont_body">
    
    <h1 class="title_menu_admin">Trang chủ</h1><!-- End .title_menu_admin -->
    
    <div class="frame_cont_body">                    
    
        <div class="block_prod">
        
            <h1>
                Thông tin nhanh
                <span class="click_show_hide"></span>
            </h1>
            
            <div class="frm01" tk="0">
                
                <div class="frm02">
                
                    <table>
                        <tr>
                            <td>
                                <div class="frm_m">
                                    <h2 class="frm02_title">
                                        <span class="icon_title_frm1"></span>
                                        Sản phẩm                                                    
                                    </h2>
                                    <div class="frm_min">
                                        <ul>
                                          <li><span class="icon_frm3"></span><a href="#" title="">Tổng sản phẩm : <?php echo countRecord("tbl_item","parent >=2 AND idshop=".$idshop)?></a></li>
                                          <li><span class="icon_frm3"></span><a href="#" title="">Tổng Đơn hàng : <?php $dh= countRecord("tbl_donhang"," idshop=".$idshop);if($dh>0) echo $dh;else echo "0";?></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="frm_m">
                                    <h2 class="frm02_title">
                                        <span class="icon_title_frm2"></span>
                                        Tin tức
                                    </h2>
                                    <div class="frm_min">
                                        <ul>
                                            <li><span class="icon_frm4"></span><a href="#" title="">Thêm tin</a></li>
                                            <li><span class="icon_frm5"></span><a href="#" title="">Tổng số tin đã đăng : <?php echo countRecord("tbl_news","parent >=2 AND idshop=".$idshop)?></a></li>
                                        </ul>
                                    </div>
                                </div>                                                
                            </td>
                            <td>
                                <div class="frm_m">
                                    <h2 class="frm02_title">
                                        <span class="icon_title_frm3"></span>
                                        Đơn hàng
                                    </h2>
                                    <div class="frm_min">
                                        <ul>
                                            <li><span class="icon_frm6"></span><a href="#" title="">Tổng đơn hàng : 1000</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="frm_m">
                                    <h2 class="frm02_title">
                                        <span class="icon_title_frm4"></span>
                                        Thống kê truy cập
                                    </h2>
                                    <div class="frm_min">
                                        <ul>
                                        <?php
										$guest=countRecord("tbl_visitor","idshop=".$idshop)+$heso;
										$rConfig = getRecord('tbl_count',"idshop =".$idshop);
										?>
                                        	<li><span class="icon_frm7"></span>Đang truy cập: <?php echo $guest;?></li>
                                            <li><span class="icon_frm7"></span>Hôm nay: <?php echo $rConfig['today']?></li>
                                            <li><span class="icon_frm8"></span>Tổng lượt truy cập: <?php echo $rConfig['total'];;?></li>
                                        </ul>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </table>
                    
                </div><!-- End .frm02 -->
                
            </div><!-- End .frm01 -->
            
        </div><!-- End .block_prod -->
        
        <div class="block_prod">
        
            <h1>
                Thông tin website
                <span class="click_show_hide1"></span>
            </h1>
            
          <div class="frm011" tk="0">
                
                <div  style="padding:5px;">
                
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tbody>
                        <?
						$row=$row_shop;
						$parent = getRecord('tbl_shop','id = '.$row['parent']);
						$color = $i++%2 ? "#d5d5d5" : "#e5e5e5";
						?>
                            <tr>
                                <td align="center">
                                 <?php if($row['logo']==true){ ?>
                                    <a onclick="positionedPopup (this.href,'myWindow','500','400','100','400','yes');return false" href="<?=$row['hinh1']?>" title="Click vào xem ảnh">
                                    <img src="../<?=$row['logo']?>" width="80" height="80" border="0" class="hinh" />
                                    </a>
                                  <?php }else{?>
                                    <img src="../<?php echo $noimgs; ?>" width="80" height="80" border="0" class="hinh" />
                                  <?php }?>
                                </td>
                                <td align="left">
                                	 <div style="float:none; clear:both; color:#000; margin-bottom:5px">
                                            <strong>ID :</strong> <?=$row['id']?> / <strong>Tên miền:</strong> <a href="<?php echo $linkroot ;?>/" target="_blank" title="<?=$row['subject']?>"><?=$row['subject']?></a> / <strong>GH:</strong> <?php if($row['intro']==0) echo "Intro";else echo "Shop";?> / <strong>Thành viên:</strong> <?php echo get_field('tbl_customer','id',$row['iduser'],'username');?></div> 
                                           <div style="float:none; clear:both; color:#C00; margin-bottom:5px">
                                            <strong>Loại :</strong>
                                            <?php echo get_field('tbl_shop_category','id',$row['parent'],'name');?>
                                           </div> 
                                            <div style="float:none; clear:both; color:#C00; margin-bottom:5px">
                                            <strong>Layout :</strong> <?php echo get_field('tbl_template','id',$row['idtemplate'],'name');?>
                                            </div>
                                            <div style="float:none; clear:both; color:#C00; margin-bottom:5px">
                                            <strong>Chỉnh giao diện theo mẫu :</strong> <a  href="index.php?act=styleweb">Chỉnh </a>
                                            </div>
                                            
                                            <div style="float:none; clear:both; color:#C00; margin-bottom:5px">
                                            <strong>Chỉnh các thành phẩn của web :</strong> <a href="index.php?act=elementweb&id=<?=$row['id']?>">Chỉnh </a>
                                            </div>
                                            
                                            <div style="float:none; clear:both; color:#C00; margin-bottom:5px">
                                            <strong>Chỉnh cấu hình seo :</strong> <a href="index.php?act=seoweb&id=<?=$row['id']?>">Chỉnh </a>
                                            </div>
                                            <div style="float:none; clear:both; color:#C00; margin-bottom:5px">
                                            <strong> Từ ngữ trong website :</strong> <a href="index.php?act=title_module">Chỉnh </a>
                                            </div>
                                            
                                  
                                            <br />  
                                            <hr />
                                            <br />                         
                                            <div style="float:none; clear:both; color:#609; margin-bottom:5px" class="link">Tên GH:	<a   href="<?php echo $$linkroot ;?>/"title="Click vào xem chi tiết tin" target="_blank"><?=$row['name']?></a> 
                                            <br />
                                            <br />
                                             Domain: <?=$row['domain']?>
                                             <br />
                                            </div> 
                                            <div style="float:none; clear:both; margin-top:5px; font-size:12px; color:#000">
                                            <strong>Email:</strong> <?=$row['email']?>  -  Số điện thoại: <?=$row['telephone']?>  -  Hotline: <?=$row['address']?>   -Fax: <?=$row['fax']?>   <br /><br /> Ngày sửa chữa: <?=$row['last_modified']?>  
                                            <br />
                                            <br />
                                             Banner:&nbsp;&nbsp; <a href="index.php?act=delelte_banner">Xóa</a> &nbsp;&nbsp; - Background: &nbsp;&nbsp;<a href="index.php?act=delete_background">Xóa</a> <br />
                                            <hr />
                                            
                                            </div>
                                </td>
                                 <td align="center"><span class="smallfont"><img src="imgs/layout/anhien_<?=$row['status']?>.png" width="25" height="25" class="anhien" title="Ẩn hiện" value="<?=$row['id']?>" /></span></td>
                                <td align="center"><span class="smallfont">
                                <a href="index.php?act=config_shop"><img src="imgs/layout/sua.png"/></a>
                                </td>
                               
                                <td align="center">
                                    <?=$row['dateAdd']?>
                                </td>                                        
                            </tr>
                     		<tr>
                            	<td colspan="4" align="center" >
                                    <div style="padding:5px;">
										<center>
											<?php   
                                            if($row['banner']!="") {             
                                            $k=$row['banner'];
                                            $GT = explode(".",$k);
                                            $ten=$GT[0];
                                            $kieu=$GT[1];
                                                        
                                            if($kieu=='swf' || $kieu=='SWF'){
                                                $chuoi = explode("-",$row['banner_info']);
                                            ?>
                                            <OBJECT
                                                CLASSID="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"
                                                WIDTH="1000px"
                                                HEIGHT="<?php echo $chuoi['1'];?>"
                                                CODEBASE="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab">
                                            
                                                <PARAM NAME="MOVIE" VALUE="..//<?php echo $row['banner']?>">
                                                <PARAM NAME="PLAY" VALUE="true">
                                                <PARAM NAME="LOOP" VALUE="true">
                                                <PARAM NAME="QUALITY" VALUE="high">
                                                <param value="transparent" name="wmode" />
                                                <PARAM NAME="SCALE" VALUE="EXACTFIT">
                                            
                                                <EMBED
                                                SRC="..//<?php echo $row['banner']?>"
                                                WIDTH="1000px"
                                                HEIGHT="<?php echo $chuoi['1'];?>"
                                                PLAY="true" 
                                                LOOP="true"
                                                QUALITY="high"
                                                wmode="transparent"
                                                SCALE="EXACTFIT" 
                                                PLUGINSPAGE="http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=Shockwaveflash">
                                                </EMBED>
                                            </OBJECT>
                                            
                                            <?php } else {?>
                                            <img src="../<?php echo $row['banner']; ?>"  title=" " />
                                            <?php }
                                            }
                                            ?>
                                        </center> 
                                       </div>
                                </td>
                        </tr>
                           
                        </tbody>
                    </table>
					<script language="javascript">
						var popupWindow = null;
						function positionedPopup(url,winName,w,h,t,l,scroll){
							settings ='height='+h+',width='+w+',top='+t+',left='+l+',scrollbars='+scroll+',resizable'
							popupWindow = window.open(url,winName,settings)
						}
					</script> 
                    
              </div><!-- End .frm02 -->
                
          </div><!-- End .frm01 -->
            
        </div>
    
    </div><!-- End .frame_cont_body -->
    
</div><!-- End .main_cont_body -->