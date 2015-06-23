<?php

if (isset($_POST['tim'])==true)//isset kiem tra submit
{ 
	if($_POST['tukhoa']!=NULL){$tukhoa=$_POST['tukhoa'];}else {$tukhoa=-1;}
	$_SESSION['kt_tukhoa_item']=$tukhoa;
	$tukhoa = trim(strip_tags($tukhoa));
	if (get_magic_quotes_gpc()==false) 
		{
			$tukhoa = mysql_real_escape_string($tukhoa);
		}
}
if (isset($_POST['reset'])==true) {

	$_SESSION['kt_tukhoa_item']=-1;
}
if($_SESSION['kt_tukhoa_item']==NULL){$tukhoa=-1;}
if($_SESSION['kt_tukhoa_item']!=NULL){$tukhoa=$_SESSION['kt_tukhoa_item'];}
?>
<script>
$(document).ready(function() {	
		//dao trang thai an hien
	$("img.anhien").click(function(){
	id=$(this).attr("value");
	obj = this;
		$.ajax({
		   url:'status.php',
		   data: 'id='+ id +'&table=tbl_video',
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
		   data: 'id='+ id +'&table=tbl_video',
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
    
    <h1 class="title_menu_admin">Video</h1><!-- End .title_menu_admin -->
    
    <div class="frame_cont_body">    
    
        <div class="filter_num">
            <form method="POST" action="#" name="frmForm" enctype="multipart/form-data">
            <input type="hidden" name="page" value="<?=$page?>">
            <input type="hidden" name="act" value="video">
            <div class="filter_search">
          
              <div class="fils1">

                

                </div><!-- End .fils1 -->
                
                <div class="fils2">
                
                    <input name="reset" type="submit" class="btn_fils22" id="reset" value=" Reset "/>
                    <input name="tukhoa" type="text" class="ipt_fils2" id="tukhoa" onfocus="if(this.value=='Tìm kiếm...') this.value='';" onblur="if(this.value=='') this.value='Tìm kiếm...';" value="Tìm kiếm..." />
                    <input name="tim" type="submit" class="btn_fils2" id="tim" value="&nbsp;"/>
                    
                
                </div><!-- End .fils2 -->
                
                <div class="clear"></div>
                
            </div><!-- End .filter_search -->
            </form>
            <div class="filter_btn">
            
                <div class="filter_l">
                    
                    <div class="clear"></div>
                </div><!-- End .filter_l -->
                
                <div class="add_news_all">                                
                    <a href="index.php?act=video_m" title=""><span class="icon_add_news_all"></span>Thêm mới sản phẩm</a>
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
                $r = getRecord("tbl_video","id=".$id);
				if($r['idshop']==$idshop){
					$resultParent = mysql_query("select id from tbl_video where parent='".$id."'",$conn);
					if (mysql_num_rows($resultParent) <= 0){
						@$result = mysql_query("delete from tbl_video where id='".$id."'",$conn);
						if ($result){
							if(file_exists('../'.$r['hinh'])) @unlink('../'.$r['hinh']);
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
                    $r = getRecord("tbl_video","id=".$id);
					if($r['idshop']==$idshop){
						$resultParent = mysql_query("select id from tbl_video where parent='".$id."'",$conn);
						if (mysql_num_rows($resultParent) <= 0){
							@$result = mysql_query("delete from tbl_video where id='".$id."'",$conn);
							if ($result){
								if(file_exists('../'.$r['hinh'])) @unlink('../'.$r['hinh']);
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
    
        $where="1=1 and (id='{$tukhoa}' or name LIKE '%$tukhoa%' or '{$tukhoa}'=-1) and (idshop='{$idshop}')";
        
        $MAXPAGE=1;
        $totalRows=countRecord("tbl_video",$where);
        
        if ($_REQUEST['cat']!='') $where="parent=".$_REQUEST['cat']; ?>
        <form method="POST" action="#" name="frmForm" enctype="multipart/form-data">
        <input type="hidden" name="page" value="<?=$page?>">
        <input type="hidden" name="act" value="video">
        <?
       // $pageindex = createPage(countRecord("tbl_video",$where),"./?act=shop_category&cat=".$_REQUEST['cat']."&page=",$MAXPAGE,$page)?>
        <?php //echo pagesLinks($totalRows,$pageSize);// Trang đầu,  Trang kế, tang trước, trang cuối ??>
        <? if ($_REQUEST['code']==1) $errMsg = 'Cập nhật thành công.';echo $errMsg;?>
            <table width="100%" border="1">
                <thead>
                    <tr>
                        <td width="3%" align="center"><input type="checkbox" name="chkall" onClick="chkallClick(this);"/></td>
                        <td width="3%">ID</td>
                        <td width="14%">Hình ảnh</td>
                        <td width="23%" align="center"><a class="title" href="<?=getLinkSort(4)?>">Tên</a></td>
                        <td width="7%" align="center"><a class="title" href="<?=getLinkSort(13)?>">Ẩn Hiện</a></td>
                        <td width="16%" align="center">Công cụ</td>
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
                
                $sql="select *,DATE_FORMAT(date_added,'%d/%m/%Y %h:%i') as dateAdd,DATE_FORMAT(last_modified,'%d/%m/%Y %h:%i') as dateModify from tbl_video where   $where $sortby $direction limit ".($startRow).",".$pageSize;
                $result=mysql_query($sql,$conn);
                $i=0;
                while($row=mysql_fetch_array($result)){
                $parent = getRecord('tbl_video','id = '.$row['parent']);
                $color = $i++%2 ? "#d5d5d5" : "#e5e5e5";
                ?>
                    <tr>
                        <td align="center"><input type="checkbox" name="chk[]" value="<?=$row['id']?>" /></td>
                        <td><?=$row['id']?></td>
                        <td> 
							<?=$row['name']?>
                        </td>
                        <td>
							 <br />
                              <iframe width="250" height="200" src="<?php echo get_video_youtobe($row['link']); ?>" frameborder="0" allowfullscreen>
                              </iframe>
                              <br /><br />
                        
                        </td>
                        <td align="center"><img src="imgs/layout/anhien_<?=$row['status']?>.png" class="anhien" title="Ẩn hiện"value="<?=$row['id']?>" alt=""/></td>
                        <td align="center">
                            <a href="index.php?act=video&action=del&page=<?=$_REQUEST['page']?>&id=<?=$row['id']?>" title="Xóa"  onclick="return confirm('Bạn có muốn xoá luôn không ?');" ><img src="imgs/layout/xoa.png" alt=""/></a>
                            &nbsp;
                            <a href="index.php?act=video_m&cat=<?=$_REQUEST['cat']?>&page=<?=$_REQUEST['page']?>&id=<?=$row['id']?>" title="Sửa"><img src="imgs/layout/sua.png" alt=""/></a>
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