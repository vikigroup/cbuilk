<?php

if (isset($_POST['tim'])==true)//isset kiem tra submit
{
	if($_POST['tukhoa']!=NULL){$tukhoa=$_POST['tukhoa'];}else {$tukhoa=-1;}
	$_SESSION['kt_tukhoa_cates']=$tukhoa;
	$tukhoa = trim(strip_tags($tukhoa));
	if (get_magic_quotes_gpc()==false) 
		{
			$tukhoa = mysql_real_escape_string($tukhoa);
		}
}
if (isset($_POST['reset'])==true) {

	$_SESSION['kt_tukhoa_cates']=-1;
}
if($_SESSION['kt_tukhoa_cates']==NULL){$tukhoa=-1;}
if($_SESSION['kt_tukhoa_cates']!=NULL){$tukhoa=$_SESSION['kt_tukhoa_cates'];}
?>
<script>
$(document).ready(function() {	
		//dao trang thai an hien
	$("img.anhien").click(function(){
	id=$(this).attr("value");
	obj = this;
		$.ajax({
		   url:'status.php',
		   data: 'id='+ id +'&table=tbl_item_category',
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
		   data: 'id='+ id +'&table=tbl_item_category',
		   cache: false,
		   success: function(data){ //alert(idvnexpres);
			obj.src=data;
			if (data=="images/noibat_1.png") obj.title="Nhắp vào để ẩn";
			else obj.title="Nhắp vào để hiện";
		  }
		});
	});
	
});
</script>
<div class="main_cont_body">
    
    <h1 class="title_menu_admin">Sản phẩm</h1><!-- End .title_menu_admin -->
    
    <div class="frame_cont_body">    
    
        <div class="filter_num">
        
            <div class="filter_search">
            
                <div class="fils1">
                    <select class="slt_txt2">
                        <option>Chọn thể loại</option>
                        <option>Chọn thể loại</option>
                        <option>Chọn thể loại</option>
                    </select>
                    <select class="slt_txt2">
                        <option>Chọn thể loại</option>
                        <option>Chọn thể loại</option>
                        <option>Chọn thể loại</option>
                    </select>
                </div><!-- End .fils1 -->
                
                <div class="fils2">
                
                    <input class="ipt_fils2" type="text" value="Tìm kiếm..." onfocus="if(this.value=='Tìm kiếm...') this.value='';" onblur="if(this.value=='') this.value='Tìm kiếm...';" />
                    <input class="btn_fils2" type="submit" value="&nbsp;"/>
                
                </div><!-- End .fils2 -->
                
                <div class="clear"></div>
                
            </div><!-- End .filter_search -->
            
            <div class="filter_btn">
            
                <div class="filter_l">
                    
                    <div class="clear"></div>
                </div><!-- End .filter_l -->
                
                <div class="add_news_all">                                
                    <a href="index.php?act=item_category_m" title=""><span class="icon_add_news_all"></span>Thêm mới sản phẩm</a>
                   <!-- <a href="#" title=""><span class="icon_delete_news_all"></span>Xóa nhiều</a>-->
                </div><!-- End .add_news_all -->
                
                <div class="clear"></div>
                
            </div><!-- End .filter_btn -->
            
        </div><!-- End .filter_s -->
        
        <div class="data_gid">
        <? $errMsg =''?>
		<?
        
        switch ($_GET['action']){
            case 'del' :
                $id = $_GET['id'];
                $r = getRecord("tbl_item_category","id=".$id);
				if($r['idshop']==$idshop){
					$resultParent = mysql_query("select id from tbl_item_category where parent='".$id."'",$conn);
					if (mysql_num_rows($resultParent) <= 0){
						@$result = mysql_query("delete from tbl_item_category where id='".$id."'",$conn);
						if ($result){
							if(file_exists('../'.$r['image'])) @unlink('../'.$r['image']);
							if(file_exists('../'.$r['image_large'])) @unlink('../'.$r['image_large']);
							$errMsg = "Đã xóa thành công.";
						}else $errMsg = "Không thể xóa dữ liệu !";
					}else{
						$errMsg = "Đang có danh mục sử dụng. Bạn không thể xóa !";	
					}
				}
                break;
        }
        
        if (isset($_POST['btnDel'])){
            $cntDel=0;
            $cntNotDel=0;
            $cntParentExist=0;
            if($_POST['chk']!=''){
                foreach ($_POST['chk'] as $id){
                    $r = getRecord("tbl_item_category","id=".$id);
					if($r['idshop']==$idshop){
						$resultParent = mysql_query("select id from tbl_item_category where parent='".$id."'",$conn);
						if (mysql_num_rows($resultParent) <= 0){
							@$result = mysql_query("delete from tbl_item_category where id='".$id."'",$conn);
							if ($result){
								if(file_exists('../'.$r['image'])) @unlink('../'.$r['image']);
								if(file_exists('../'.$r['image_large'])) @unlink('../'.$r['image_large']);
								$cntDel++;
							}else $cntNotDel++;
						}else{
							$cntParentExist++;
						}
					}
                }
                $errMsg = "Đã xóa ".$cntDel." phần tử.<br><br>";
                $errMsg .= $cntNotDel>0 ? "Không thể xóa ".$cntNotDel." phần tử.<br>" : '';
                $errMsg .= $cntParentExist>0 ? "Đang có danh mục con sử dụng ".$cntParentExist." phần tử." : '';
            }else{
                $errMsg = "Hãy chọn trước khi xóa !";
            }
        }
        
        $pageSize = 5;
        $pageNum = 1;
        $totalRows = 0;
        
        if (isset($_GET['pageNum'])==true) $pageNum = $_GET['pageNum'];
        if ($pageNum<=0) $pageNum=1;
        $startRow = ($pageNum-1) * $pageSize;
    
        $where="1=1 and cate=0 and (id='{$tukhoa}' or name LIKE '%$tukhoa%' or '{$tukhoa}'=-1) and (idshop='{$idshop}')";
        
        $MAXPAGE=1;
        $totalRows=countRecord("tbl_item_category",$where);
        
        if ($_REQUEST['cat']!='') $where="parent=".$_REQUEST['cat']; ?>
        <form method="POST" action="#" name="frmForm" enctype="multipart/form-data">
        <input type="hidden" name="page" value="<?=$page?>">
        <input type="hidden" name="act" value="item_category">
        <?
       // $pageindex = createPage(countRecord("tbl_item_category",$where),"./?act=shop_category&cat=".$_REQUEST['cat']."&page=",$MAXPAGE,$page)?>
        <?php //echo pagesLinks($totalRows,$pageSize);// Trang đầu,  Trang kế, tang trước, trang cuối ??>
        <? if ($_REQUEST['code']==1) $errMsg = 'Cập nhật thành công.';echo $errMsg;?>
            <table width="100%" border="1">
                <thead>
                    <tr>
                        <td align="center"><input type="checkbox" name="chkall" onClick="chkallClick(this);"/></td>
                        <td>ID</td>
                        <td>Thông tin</td>
                        <td align="center">Nổi bật</td>
                        <td align="center">Ẩn Hiện</td>
                        <td align="center">Công cụ</td>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <td align="center"></td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                </tfoot>
                <tbody>
				<?
                $sortby="order by date_added";
                if ($_REQUEST['sortby']!='') $sortby="order by ".(int)$_REQUEST['sortby'];
                $direction=($_REQUEST['direction']==''||$_REQUEST['direction']=='0'?"desc":"");
                
                $sql="select *,DATE_FORMAT(date_added,'%d/%m/%Y %h:%i') as dateAdd,DATE_FORMAT(last_modified,'%d/%m/%Y %h:%i') as dateModify from tbl_item_category where parent<>0 and $where $sortby $direction limit ".($startRow).",".$pageSize;
                $result=mysql_query($sql,$conn);
                $i=0;
                while($row=mysql_fetch_array($result)){
                $parent = getRecord('tbl_item_category','id = '.$row['parent']);
                $color = $i++%2 ? "#d5d5d5" : "#e5e5e5";
                ?>
                    <tr>
                        <td align="center"><input type="checkbox" name="chk[]" value="<?=$row['id']?>" /></td>
                        <td><?=$row['id']?></td>
                        <td><?=$row['name']?></td>
                        <td align="center"><img src="imgs/layout/noibat_<?=$row['hot']?>.png" class="hot" title="Tiêu biểu"   value="<?=$row['id']?>" alt=""/></td>
                        <td align="center"><img src="imgs/layout/anhien_<?=$row['status']?>.png" class="anhien" title="Ẩn hiện"value="<?=$row['id']?>" alt=""/></td>
                        <td align="center">
                            <a href="index.php?act=item_category&action=del&page=<?=$_REQUEST['page']?>&id=<?=$row['id']?>" title="Xóa"  onclick="return confirm('Bạn có muốn xoá luôn không ?');" ><img src="imgs/layout/xoa.png" alt=""/></a>
                            &nbsp;
                            <a href="index.php?act=item_category_m&cat=<?=$_REQUEST['cat']?>&page=<?=$_REQUEST['page']?>&id=<?=$row['id']?>" title="Sửa"><img src="imgs/layout/sua.png" alt=""/></a>
                        </td>
                    </tr>
                   <?php }?>
                   
                    
                </tbody>
            </table>
            
            <input type="submit" value="Xóa chọn" name="btnDel" onClick="return confirm('Bạn có chắc chắn muốn xóa ?');" class="button">
				</form>
                
                <script language="JavaScript">
				function chkallClick(o) {
					var form = document.frmForm;
					for (var i = 0; i < form.elements.length; i++) {
						if (form.elements[i].type == "checkbox" && form.elements[i].name!="chkall") {
							form.elements[i].checked = document.frmForm.chkall.checked;
						}
					}
				}
				</script>
            
            <div class="phantrang_num">
            
                <div class="PageNum">
                    <?php echo pagesLinks($totalRows,$pageSize);;?>
                </div>
                                                
            </div><!-- End .phantrang_num -->
            
        </div><!-- End .data_gid -->
    
    </div><!-- End .frame_cont_body -->
    
</div>