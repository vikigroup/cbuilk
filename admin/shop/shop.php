<?php

if(isset($frame)==true){

	check_permiss($_SESSION['kt_login_id'],2,'admin.php');

}else{

	header("location: ../admin.php");

}



if (isset($_POST['tim'])==true)//isset kiem tra submit

{

	if($_POST['tukhoa']!=NULL){$tukhoa=$_POST['tukhoa'];}else {$tukhoa=-1;}

	$_SESSION['kt_tukhoa_shop']=$tukhoa;

	$tukhoa = trim(strip_tags($tukhoa));

	if (get_magic_quotes_gpc()==false) 

		{

			$tukhoa = mysql_real_escape_string($tukhoa);

		}
		
	if($_POST['ddCat']!=NULL){$parent=$_POST['ddCat'];}else {$parent=-1;}
	$_SESSION['kt_parent_bignew']=$parent;
	
	if($_POST['ddCatch']!=NULL){$parent1=$_POST['ddCatch'];}else {$parent1=-1;}
	$_SESSION['kt_ddCatch_bignew']=$parent1;
	
 
	
		
}

if (isset($_POST['reset'])==true) {

	$_SESSION['kt_tukhoa_shop']=-1;
	$_SESSION['kt_parent_bignew']=-1;
	$_SESSION['kt_ddCatch_bignew']=-1; 
	
}
if($_SESSION['kt_tukhoa_shop']==NULL){$tukhoa=-1;}
if($_SESSION['kt_tukhoa_shop']!=NULL){$tukhoa=$_SESSION['kt_tukhoa_shop'];}
if($_SESSION['kt_parent_bignew']==NULL){$parent=-1;}
if($_SESSION['kt_parent_bignew']!=NULL){$parent=$_SESSION['kt_parent_bignew'];}

if($_SESSION['kt_ddCatch_bignew']==NULL){$parent1=-1;}
if($_SESSION['kt_ddCatch_bignew']!=NULL){$parent1=$_SESSION['kt_ddCatch_bignew'];}

if($_GET['anhien']==NULL){$anhien=-1;$_SESSION['kt_anhien']=$anhien;}
if($_GET['anhien']!=NULL){$anhien=$_GET['anhien'];$_SESSION['kt_anhien']=$anhien;}
settype($anhien,"int");

if($_GET['tang']==NULL){$tang=-1;$_SESSION['kt_tang']=$tang;}
if($_GET['tang']!=NULL){$tang=$_GET['tang'];$_SESSION['kt_tang']=$tang;}
settype($tang,"int");

if($_GET['noibat']==NULL){$noibat=-1;$_SESSION['kt_noibat']=$noibat;}
if($_GET['noibat']!=NULL){$noibat=$_GET['noibat'];$_SESSION['kt_noibat']=$noibat;}
settype($noibat,"int");
 
if($tang==0){$ks='ASC';}//0 tang
elseif($tang==1){$ks='DESC';}//1 giam
else $ks='DESC';

?>

<script>

$(document).ready(function() {	

		//dao trang thai an hien

	$("img.anhien").click(function(){

	id=$(this).attr("value");

	obj = this;

		$.ajax({

		   url:'status.php',

		   data: 'id='+ id +'&table=tbl_shop',

		   cache: false,

		   success: function(data){ //alert(idvnexpres);

			obj.src=data;

			if (data=="images/anhien_1.png") obj.title="Nhắp vào để ẩn";

			else obj.title="Nhắp vào để hiện";

		  }

		});

	});

	

	$("img.hot").click(function(){

	id=$(this).attr("value");

	obj = this;

		$.ajax({

		   url:'hot.php',

		   data: 'id='+ id +'&table=tbl_shop',

		   cache: false,

		   success: function(data){ //alert(idvnexpres);

			obj.src=data;

			if (data=="images/noibat_1.png") obj.title="Nhắp vào để ẩn";

			else obj.title="Nhắp vào để hiện";

		  }

		});

	});
	
	$("#chkall").click(function(){
		var status=this.checked;
		$("input[class='tai_c']").each(function(){this.checked=status;})
	});

	

});

</script>
<script>
$(document).ready(function() {
	$("#ddCat").change(function(){ 
		var id=$(this).val();//val(1) gan vao gia tri 1 dung trong form
		var table="tbl_shop_category";
		$("#ddCatch").load("getChild.php?table="+ table + "&id=" +id); //alert(idthanhpho)
	});
});
</script>
<style>
.table th, .table td {
padding: 8px;
line-height: 20px;
text-align: left;
vertical-align: middle;
border-top: 1px solid #dddddd;
}
</style>
<?php
	if( $errMsg !=""){ 
?>
<div class="alert alert-block no-radius fade in">
    <button type="button" class="close" data-dismiss="alert"><span class="mini-icon cross_c"></span></button>
    <h4>Warning!</h4>
     <? $errMsg =''?>
</div>
<?php }?>
<div class="row-fluid">
    <div class="span12">
        <div class="box-widget">
             
            <div class="widget-container">
                <div class="widget-block">
                    
                    
					<?
					switch ($_GET['action']){
						case 'del' :
							$id = $_GET['id'];
							$r = getRecord("tbl_shop","id=".$id);
							$resultParent = mysql_query("select id from tbl_shop where parent='".$id."'",$conn);
							if (mysql_num_rows($resultParent) <= 0){
								@$result = mysql_query("delete from tbl_shop where id='".$id."'",$conn);
								if ($result){
									if(file_exists('../'.$r['image'])) @unlink('../'.$r['image']);
									if(file_exists('../'.$r['image_large'])) @unlink('../'.$r['image_large']);
									$errMsg = "Đã xóa thành công.";
								}else $errMsg = "Không thể xóa dữ liệu !";
							}else{
								$errMsg = "Đang có danh mục sử dụng. Bạn không thể xóa !";	
							}
							break;
					}               
	
					if (isset($_POST['btnDel'])){
	
						$cntDel=0;
						$cntNotDel=0;
						$cntParentExist=0;
						if($_POST['chk']!=''){
	
							foreach ($_POST['chk'] as $id){
								$r = getRecord("tbl_shop","id=".$id);
								$resultParent = mysql_query("select id from tbl_shop where parent='".$id."'",$conn);
								if (mysql_num_rows($resultParent) <= 0){
									@$result = mysql_query("delete from tbl_shop where id='".$id."'",$conn);
									if ($result){
										if(file_exists('../'.$r['image'])) @unlink('../'.$r['image']);
										if(file_exists('../'.$r['image_large'])) @unlink('../'.$r['image_large']);
										$cntDel++;
									}else $cntNotDel++;
								}else{
									$cntParentExist++;
								}
							}
	
							$errMsg = "Đã xóa ".$cntDel." phần tử.<br><br>";
							$errMsg .= $cntNotDel>0 ? "Không thể xóa ".$cntNotDel." phần tử.<br>" : '';
							$errMsg .= $cntParentExist>0 ? "Đang có danh mục con sử dụng ".$cntParentExist." phần tử." : '';
						}else{
							$errMsg = "Hãy chọn trước khi xóa !";
						}
	
					}
	
					
	
					$pageSize = 15;
					$pageNum = 1;
					$totalRows = 0;
					
	
					if (isset($_GET['pageNum'])==true) $pageNum = $_GET['pageNum'];
					if ($pageNum<=0) $pageNum=1;
					$startRow = ($pageNum-1) * $pageSize;
	
				 
					
					if($parent!=-1 || $parent1!=-1) {
						if($parent1!='-1') $parenstrt="$parent1";
						else $parenstrt=getParent("tbl_shop_category",$parent);
						$where="1=1  and (id='{$tukhoa}' or name LIKE '%$tukhoa%' or '{$tukhoa}'=-1 or subject LIKE '%$tukhoa%'  or domain LIKE '%$tukhoa%') and  ( parent in ({$parenstrt}))";
					}
                    else $where="1=1  and (id='{$tukhoa}' or name LIKE '%$tukhoa%' or '{$tukhoa}'=-1 or subject LIKE '%$tukhoa%'  or domain LIKE '%$tukhoa%')";
					
					$where.=" AND ( status='{$anhien}' or '{$anhien}'=-1)  AND ( hot='{$noibat}' or '{$noibat}'=-1) ";
	
					$MAXPAGE=1;
	
					$totalRows=countRecord("tbl_shop",$where);
	
					if ($_REQUEST['cat']!='') $where="parent=".$_REQUEST['cat']; ?>
	
					<form method="POST" action="admin.php?act=shop" name="frmForm" enctype="multipart/form-data">
					<input type="hidden" name="page" value="<?=$page?>">
					<input type="hidden" name="act" value="shop">
	
					<? if ($_REQUEST['code']==1) $errMsg = 'Cập nhật thành công.'?>
						
                      
						<table width="100%"  class="admin_table">

							<thead>
                            	<tr align="center" >
                                  <td valign="middle"  colspan="10">
                                    <center>
                                        <div class="table_chu_tieude">
                                        <strong>DANH SÁCH SHOP</strong>
                                        </div>
                                    </center>
                                   </td>
                                </tr>
                                <tr align="center" >
                                  <td valign="middle" style="background-color:#F0F0F0; height:40px; padding-left:20px" colspan="10">  
                                  		<? //comboCategory('ddCat',getArrayCategory('tbl_shop_category'),'list_tim_loc',$parent,1)?>
                                        
                                        <select name="ddCat" id="ddCat" class="list_tim_loc"> 
											<?php if($_POST['ddCat']!=NULL){ ?>
                                            <option value="<?php echo $idtheloaic=$_POST['ddCat'] ; ?>"><?php echo get_field('tbl_shop_category','id',$parent,'name'); ?> </option> 
                                            <?php }?>
                                            
                                            <option value="-1" <?php if($parent==-1) echo 'selected="selected"';?> > Chọn danh mục </option> 
                                            <?php   
											$gt=get_records("tbl_shop_category","parent=2 and status=0 ","id DESC"," "," ");
                                            while($row=mysql_fetch_assoc($gt)){?>
                                            <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option> 
                                            <?php } ?>
                                        
                                        </select>
                                        <select name="ddCatch" id="ddCatch" class="list_tim_loc"> 
											<?php if($_POST['ddCatch']!=NULL && $_POST['ddCatch']!=-1 ){ ?>
                                            <option value="<?php echo $parent1=$_POST['ddCatch'] ; ?>"><?php echo get_field('tbl_shop_category','id',$parent1,'name'); ?> </option> 
                                            <?php }?>
                                        	<option value="-1"> Chọn danh mục con </option> 
                                        </select>
                                        <input class="table_khungnho" placeholder="Từ khóa..."  name="tukhoa" id="tukhoa" type="text" value="" />
                                        <input name="tim" type="submit" class="nut_table" id="tim" value="Tìm kiếm"/>
                                        <input type="submit" name="reset" class="nut_table" value="Reset" title=" Reset " />
                                 
                                  
                                  </td>
                                </tr>
                                <tr >
                                  <td valign="middle" align="left" style="background-color:#F0F0F0; height:40px; padding-left:20px" colspan="10"> 
                                        <div class="link_loc" style="width:80px;text-align:center; padding:3px; border:solid 1px #999; float:left; margin-right:5px;<?php if($noibat==0  &&  $anhien==0) echo 'background-color:#FF0; color:#000;';else echo 'background-color:#FFF; color:#FFF;"';?>">
                                        	<a href="admin.php?act=shop&tang=1&anhien=-1&noibat=-1">Tất cả</a>
                                        </div>
                                        <div class="link_loc" style="width:80px; text-align:center; padding:3px; border:solid 1px #999; float:left; margin-right:5px;<?php if($tang==1) echo 'background-color:#FF0; color:#000;';else echo 'background-color:#FFF; color:#FFF;"';?>" >
                                        	<a href="admin.php?act=shop&tang=1&anhien=<?php echo $_SESSION['kt_anhien'] ?>&noibat=<?php echo $_SESSION['kt_noibat']?>">Tăng dần</a>
                                        </div>
                                        <div class="link_loc" style="width:80px;text-align:center; padding:3px; border:solid 1px #999; float:left; margin-right:5px;<?php if($tang==0) echo 'background-color:#FF0; color:#000;';else echo 'background-color:#FFF; color:#FFF;"';?>">
                                        	<a href="admin.php?act=shop&tang=0&anhien=<?php echo $_SESSION['kt_anhien'] ?>&noibat=<?php echo $_SESSION['kt_noibat']?>">Giảm dần</a>
                                        </div>
                                        <div class="link_loc" style="width:80px;text-align:center; padding:3px; border:solid 1px #999; float:left; margin-right:5px;<?php if($anhien==1) echo 'background-color:#FF0; color:#000;';else echo 'background-color:#FFF; color:#FFF;"';?>">
                                        	<a href="admin.php?act=shop&tang=<?php echo $_SESSION['kt_tang'] ?>&anhien=1&noibat=<?php echo $_SESSION['kt_noibat'] ?>"> Ẩn </a>
                                        </div>
                                         <div class="link_loc" style="width:80px;text-align:center; padding:3px; border:solid 1px #999; float:left; margin-right:5px;<?php if($anhien==0) echo 'background-color:#FF0; color:#000;';else echo 'background-color:#FFF; color:#FFF;"';?>">
                                        	<a href="admin.php?act=shop&tang=<?php echo $_SESSION['kt_tang'] ?>&anhien=0&&noibat=<?php echo $_SESSION['kt_noibat'] ?>">Hiện</a>
                                        </div>
                                        <div class="link_loc" style="width:80px;text-align:center; padding:3px; border:solid 1px #999; float:left; margin-right:5px;<?php if($noibat==1) echo 'background-color:#FF0; color:#000;';else echo 'background-color:#FFF; color:#FFF;"';?>">
                                        	<a href="admin.php?act=shop&tang=<?php echo $_SESSION['kt_tang'] ?>&anhien=<?php echo $_SESSION['kt_anhien'] ?>&noibat=1">Nổi bật</a>
                                        </div>
                                         <div class="link_loc" style="width:80px;text-align:center; padding:3px; border:solid 1px #999; float:left; margin-right:5px;<?php if($noibat==0) echo 'background-color:#FF0; color:#000;';else echo 'background-color:#FFF; color:#FFF;"';?>">
                                        	<a href="admin.php?act=shop&tang=<?php echo $_SESSION['kt_tang'] ?>&anhien=<?php echo $_SESSION['kt_anhien'] ?>&noibat=0">ko nổi bật</a>
                                        </div>
                                  </td>
                                </tr>
                               <tr>
                                  <td align="center" colspan="2">
                                  <input type="submit" value="Xóa chọn" name="btnDel" onClick="return confirm('Bạn có chắc chắn muốn xóa ?');" class="button">
                                  </td>
                                  <td align="center" class="PageNum" colspan="5">
                                    	<?php echo pagesListLimit($totalRows,$pageSize);?>   
                                  </td>
                                  
                                 <td width="87" align="center" >
                                  <div></div></td>
                                </tr>
								<tr class="admin_tieude_table">
									<td width="20" align="center">
										<input type="checkbox" name="chkall" onClick="chkallClick(this);"/>
									</td>
									<td width="66" align="center">
										STT
									</td>
									<td width="136" align="center">Logo</td>
									<td width="465" align="center"><a href="#"> Thông tin shop </a></td>
									<td width="99" align="center"><a class="title" href="<?=getLinkSort(15)?>">Tiêu biểu</a></td>
									<td width="109" align="center"><span class="title"><a class="title" href="<?=getLinkSort(11)?>">Không hiển thị</a></span></td>
									<td width="76" align="center"><a class="title" href="<?=getLinkSort(12)?>">Ngày tạo lập</a></td>                                        
									<td width="87" align="center">
										Công cụ
									</td>
								</tr>
							</thead>
							<tbody>
							<?
	
							$sortby="order by id $ks";
							if ($_REQUEST['sortby']!='') $sortby="order by ".(int)$_REQUEST['sortby'];
							$direction=($_REQUEST['direction']==''||$_REQUEST['direction']=='0'?"desc":"");
						
							 $sql="select *,DATE_FORMAT(date_added,'%d/%m/%Y %h:%i') as dateAdd,DATE_FORMAT(last_modified,'%d/%m/%Y %h:%i') as dateModify from tbl_shop where parent<>0 and $where $sortby  limit ".($startRow).",".$pageSize;
	
							$result=mysql_query($sql,$conn);
							$i=0;
	
							while($row=mysql_fetch_array($result)){
							$parent = getRecord('tbl_shop','id = '.$row['parent']);
							$color = $i++%2 ? "#d5d5d5" : "#e5e5e5";
							?>
	
								<tr  >
									<td align="center">
										<input type="checkbox" name="chk[]" value="<?=$row['id']?>"/>
									</td>
									<td align="center">
										<?=$row['id']?>
									</td>
									<td align="center" valign="middle">
									 <?php if($row['logo']==true){ ?>
										<a onclick="positionedPopup (this.href,'myWindow','500','400','100','400','yes');return false" href="<?=$row['hinh1']?>" title="Click vào xem ảnh">
										<img src="../web/<?=$row['logo']?>" width="80" height="80" border="0" class="hinh" />
										</a>
									  <?php }else{?>
										<img src="../<?php echo $noimgs; ?>" width="80" height="80" border="0" class="hinh" />
									  <?php }?>
									</td>
									<td align="left">
                                         <div style="float:none; clear:both; color:#000; margin:5px;">
                                                <strong>ID :</strong> <?=$row['id']?> / <strong>Tên miền:</strong> <a href="http://<?=$row['subject']?>.<?php echo $sub;?>" target="_blank" title="<?=$row['subject']?>"><?=$row['subject']?></a> / <strong>GH:</strong> <?php if($row['intro']==0) echo "Intro";else echo "Shop";?> / <strong>Thành viên:</strong> <?php echo get_field('tbl_customer','id',$row['iduser'],'username');?></div> 
                                               <div style="float:none; clear:both; color:#C00; margin:5px;">	
                                                 <strong>Loại :</strong>	
                                                 <?php echo get_field('tbl_shop_category','id',$row['parent'],'name');?>
                                               </div> 
	
												<div style="float:none; clear:both; color:#C00; margin:5px">	
												  <strong>Layout :</strong> <?php echo get_field('tbl_template','id',$row['idtemplate'],'name');?>	
												</div>
	
												<div style="float:none; clear:both; margin-top:1px; font-size:14px; color:#000">
												 <?php if($row_quantri['banner']!="") { ?> <strong> Banner :</strong> <a onclick="positionedPopup (this.href,'myWindow','1000','300','100','100','yes');return false" href="librarys/incs/gh_gianhang/flash_xem.php?idgianhang=<?php echo $row_quantri['id']?>&ktflash=<?php echo $row_quantri['banner']?>" target="_blank" >Xem </a>    - <a href="librarys/incs/gh_gianhang/gh_xoa_banner.php?idtin={id}&kthinh=<?php echo $row_quantri['banner'] ?>" onclick="return confirm('Bạn có chắc muốn xoá banner này không ?');" > <?php if($row_quantri['banner']!="") echo "Xóa"?>   </a>  <?php } ?>    <?php if($row_quantri['hinh2']!="") { ?> &nbsp; -:- &nbsp;Hình nền:<a onclick="positionedPopup (this.href,'myWindow','677','429','100','300','yes');return false" title="Bấm vào xem hình" href="../<?php echo $row_quantri['hinh2'] ?>" target="_blank"> Xem </a> - <a href="librarys/incs/gh_gianhang/gh_xoa_hinh.php?idtin={id}&kthinh=<?php echo $row_quantri['hinh2'] ?>" onclick="return confirm('Bạn có chắc muốn xoá hình này không ?');" > <?php if($row_quantri['hinh2']!="") echo "Xóa"?>   </a>  <?php } ?>
                                                 </div> 
												
												<hr />                         
	
												<div style="float:none; clear:both; color:#609; margin:5px" class="link">
                                                	Tên Website:	<a   href="http://<?=$row['subject']?>.<?php echo $sub;?>"title="Click vào xem chi tiết tin" target="_blank"><?=$row['name']?></a> 	
                                                    <br />	
                                                     Domain: <?=$row['domain']?>	
                                                     <br />
												</div> 
	
												<div style="float:none; clear:both; margin:5px; font-size:12px; color:#000">	
												  <strong>Email:</strong> <?=$row['email']?>  -  Số điện thoại: <?=$row['telephone']?>  -  Hotline: <?=$row['address']?>   -Fax: <?=$row['fax']?>   <br /><br /> Ngày sửa chữa: <?=$row['last_modified']?>  &nbsp;&nbsp; Ngày hết hạn: <?=$row['date_out']?> 
                                                </div>
	
									</td>
	
									<td align="center" valign="middle"> 
	
									<img src="images/noibat_<?=$row['hot']?>.png" alt="" width="25" height="25" class="hot" title="Tiêu biểu" value="<?=$row['id']?>" />
	
									</td>
	
									<td align="center"> <img src="images/anhien_<?=$row['status']?>.png" width="25" height="25" class="anhien" title="Ẩn hiện" value="<?=$row['id']?>" /></span></td>
	
									<td align="center">
	
										<?=$row['dateAdd']?>
	
									</td>                                        
	
									<td align="center">
	
										<a href="admin.php?act=shop_m&cat=<?=$_REQUEST['cat']?>&page=<?=$_REQUEST['page']?>&id=<?=$row['id']?>"><img src="images/icon3.png"/></a>
	
										<a  title="Xóa" href="shop/delete_shop.php?id=<?=$row['id']?>" onclick="return confirm('Bạn có muốn xoá luôn không ?');" ><img src="images/icon4.png" width="20" border="0" /></a><!--./?act=shop_category&action=del&page=<?=$_REQUEST['page']?>&id=<?=$row['id']?>-->
	
									</td>
	
								</tr>
	
							 <?php }?>  
	
							 <tr>
                              <td  class="PageNext" colspan="10" align="center" valign="middle">
							  <div style="padding:5px;">
							  <?php echo pagesLinks($totalRows,$pageSize);// Trang đầu,  Trang kế, tang trước, trang cuối ??>
                              </div>
                              </td>  							  
                            </tr>  
	
							</tbody>
							
							
	
							
	
						</table>
	
					 
	
						
	
					</form>                
             
                </div>
            </div>
        </div>
    </div>
</div>