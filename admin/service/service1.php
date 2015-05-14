<?php
if(isset($frame)==true){
	check_permiss($_SESSION['kt_login_id'],17,'index.php');
}else{
	header("location: ../index.php");
}

if (isset($_POST['tim'])==true)//isset kiem tra submit
{  
	if($_POST['tukhoa']!=""){$tukhoa=$_POST['tukhoa'];}else {$tukhoa=-1;}
	if($tukhoa=="Từ khóa...") $tukhoa="";
	$_SESSION['kt_tukhoa_bignew']=$tukhoa;
	echo $tukhoa = trim(strip_tags($tukhoa));
	if (get_magic_quotes_gpc()==false) 
	{
		$tukhoa = mysql_real_escape_string($tukhoa);
	}
	
	if($_POST['parent']!=NULL){$parent=$_POST['parent'];}else {$parent=-1;}
	$_SESSION['kt_parent_bignew']=$parent;
	
		
}

if (isset($_POST['reset'])==true) {

	$_SESSION['kt_tukhoa_bignew']=-1;
	$_SESSION['kt_parent_bignew']=-1;
}
if($_SESSION['kt_tukhoa_bignew']==NULL){$tukhoa=-1;}
if($_SESSION['kt_tukhoa_bignew']!=NULL){$tukhoa=$_SESSION['kt_tukhoa_bignew'];}
if($_SESSION['kt_parent_bignew']==NULL){$parent=-1;}
if($_SESSION['kt_parent_bignew']!=NULL){$parent=$_SESSION['kt_parent_bignew'];}
?>

<script>

$(document).ready(function() {	

		//dao trang thai an hien

	$("img.anhien").click(function(){

	id=$(this).attr("value");

	obj = this;

		$.ajax({

		   url:'status.php',

		   data: 'id='+ id +'&table=tbl_item',

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

		   data: 'id='+ id +'&table=tbl_item',

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
            <div class="widget-head overview-chart clearfix">
                <span class="h-icon"><i class="gray-icons graph"></i></span>
                <h4 class="pull-left">Tin tức</h4>
                <div id="reportrange" class="pull-right tai_form">
                <form method="POST" action="index.php?act=service" name="frmForm" enctype="multipart/form-data"  style="margin:0;">
                        <input type="hidden" name="page" value="<?=$page?>">
                        <input type="hidden" name="act" value="service">
                        <input type="submit" name="reset" class="nut_table" value="Reset" title="Reset" />
                    </form>
                </div>
                <div id="reportrange" class="pull-right tai_form">
                    <form method="POST" action="index.php?act=service" name="frmForm" enctype="multipart/form-data"  style="margin:0;">
                        <input type="hidden" name="page" value="<?=$page?>">
                        <input type="hidden" name="act" value="service">
                        <input class="btn_search"  name="tukhoa" id="tukhoa" type="text" value="Từ khóa..." onfocus="if(this.value=='Từ khóa...') this.value='';" onblur="if(this.value=='') this.value='Từ khóa...';" />
                        <input name="tim" type="submit" class="nut_table" id="tim" value="Tìm kiếm"/>
                    </form>
                     
                </div>
                
                <div id="reportrange" class="pull-right tai_form">
                 <a href="?act=service_m"><input type="submit" name="reset" class="nut_table" value=" Thêm mới danh mục" title="Reset" /></a>&nbsp; | &nbsp;
                </div>
            </div>
            <div class="widget-container">
                <div class="widget-block">
                    
                    
					<?
    
                    
    
                    switch ($_GET['action']){
    
                        case 'del' :
    
                            $id = $_GET['id'];
    
                            $r = getRecord("tbl_item","id=".$id);
    
                            $resultParent = 0;
    
                            
    
                                @$result = mysql_query("delete from tbl_item where id='".$id."'",$conn);
    
                                if ($result){
    
                                    if(file_exists('../web/'.$r['image'])) @unlink('../web/'.$r['image']);
    
                                    if(file_exists('../web/'.$r['image_large'])) @unlink('../web/'.$r['image_large']);
    
                                    $errMsg = "Đã xóa thành công.";
    
                                    echo '<script>window.location="index.php?act=service&cat='.$_REQUEST['cat'].'&page='.$_REQUEST['page'].'&code=1"</script>';
    
                                    
    
                                }else $errMsg = "Không thể xóa dữ liệu !";
    
                            
    
                            break;
    
                    }
    
                    
    
                    if (isset($_POST['btnDel'])){
    
                        $cntDel=0;
    
                        $cntNotDel=0;
    
                        $cntParentExist=0;
    
                        if($_POST['chk']!=''){
    
                            foreach ($_POST['chk'] as $id){
    
                                $r = getRecord("tbl_item","id=".$id);
    
                                $resultParent = 0;

                                    @$result = mysql_query("delete from tbl_item where id='".$id."'",$conn);
    
                                    if ($result){
    
                                        if(file_exists('../web/'.$r['image'])) @unlink('../web/'.$r['image']);
    
                                        if(file_exists('../web/'.$r['image_large'])) @unlink('../web/'.$r['image_large']);
    
                                        $cntDel++;
    
                                    }else $cntNotDel++;

                            }
    
                            $errMsg = "Đã xóa ".$cntDel." phần tử.<br><br>";
    
                            $errMsg .= $cntNotDel>0 ? "Không thể xóa ".$cntNotDel." phần tử.<br>" : '';
    
                            $errMsg .= $cntParentExist>0 ? "Đang có danh mục con sử dụng ".$cntParentExist." phần tử." : '';
    
                            echo '<script>window.location="index.php?act=service&cat='.$_REQUEST['cat'].'&page='.$_REQUEST['page'].'&code=1"</script>';
    
                        }else{
    
                            $errMsg = "Hãy chọn trước khi xóa !";
    
                        }
    
                    }
    
                    
    
                    $pageSize = 50;
    
                    $pageNum = 1;
    
                    $totalRows = 0;
    
                    
    
                    if (isset($_GET['pageNum'])==true) $pageNum = $_GET['pageNum'];
    
                    if ($pageNum<=0) $pageNum=1;
    
                    $startRow = ($pageNum-1) * $pageSize;
    
                
    
                    $where="1=1 and (id='{$tukhoa}' or name LIKE '%$tukhoa%' or '{$tukhoa}'=-1) and type=1";
    
                    
    
                    $MAXPAGE=1;
    
                    $totalRows=countRecord("tbl_item",$where);
    
                    
    
                    if ($_REQUEST['cat']!='') $where="parent=".$_REQUEST['cat']; ?>
    
                    <form method="POST" action="index.php?act=service" name="frmForm" enctype="multipart/form-data">
    
                    <input type="hidden" name="page" value="<?=$page?>">
    
                    <input type="hidden" name="act" value="service">
    
                    <?
    
                   // $pageindex = createPage(countRecord("tbl_item",$where),"./?act=shop_category&cat=".$_REQUEST['cat']."&page=",$MAXPAGE,$page)?>
    
    
                    <? if ($_REQUEST['code']==1) $errMsg = 'Cập nhật thành công.'?>
    
    					<div class="page_t" > <?php echo pagesLinks($totalRows,$pageSize);// Trang đầu,  Trang kế, tang trước, trang cuối ??></div>
                        <table width="100%"  class="data-tbl-boxy table table-striped table-well responsive">

                            <thead>
    
                                <tr class="bold_t">
    
                                    <td align="center">
    
                                        <input type="checkbox" name="chkall" onClick="chkallClick(this);"/>
    
                                    </td>
    
                                    <td align="center">
    
                                        STT
    
                                    </td>
    
                                    <td align="center"><span class="title"><a class="title" >Hình</a></span></td>
    
                                    <td align="center"><a class="title" href="<?=getLinkSort(3)?>">Tên </a></td>
                                    <td align="center"><a class="title" href="<?=getLinkSort(3)?>">Tên danh mục</a></td>
    
                                    <td align="center"><a class="title" href="<?=getLinkSort(10)?>">Thứ tự sắp xếp</a></td>
    
                                    <td align="center"><a class="title" href="<?=getLinkSort(15)?>">Tiêu biểu</a></td>
    
                                    <td align="center"><span class="title"><a class="title" href="<?=getLinkSort(11)?>">Không hiển thị</a></span></td>
    
                                    <td align="center"><a class="title" href="<?=getLinkSort(12)?>">Ngày tạo lập</a></td>                                        
    
                                    <td align="center">
    
                                        Công cụ
    
                                    </td>
    
                                </tr>
    
                            </thead>
    
                            <tbody>
    
                            <?
    
                            $sortby="order by date_added";
    
                            if ($_REQUEST['sortby']!='') $sortby="order by ".(int)$_REQUEST['sortby'];
    
                            $direction=($_REQUEST['direction']==''||$_REQUEST['direction']=='0'?"desc":"");
    
                            
    
                           $sql="select *,DATE_FORMAT(date_added,'%d/%m/%Y %h:%i') as dateAdd,DATE_FORMAT(last_modified,'%d/%m/%Y %h:%i') as dateModify from tbl_item where  $where $sortby $direction limit ".($startRow).",".$pageSize;
    
                            $result=mysql_query($sql,$conn);
    
                            $i=0;
    
                            while($row=mysql_fetch_array($result)){
    
                            $parent = getRecord('tbl_item','id = '.$row['parent']);
    
                            $color = $i++%2 ? "#d5d5d5" : "#e5e5e5";
    
                            ?>
    
                                <tr>
    
                                    <td align="center">
    
                                        <input type="checkbox" name="chk[]" value="<?=$row['id']?>"/>
    
                                    </td>
    
                                    <td align="center">
    
                                        <?=$row['id']?>
    
                                    </td>
    
                                    <td align="center">
    
                                         <?php if($row['image']==true){ ?>
    
                                        <a onclick="positionedPopup (this.href,'myWindow','500','400','100','400','yes');return false" href="<?=$row['hinh1']?>" title="Click vào xem ảnh">
    
                                        <img src="../web/<?=$row['image']?>" width="80" height="80" border="0" class="hinh" />
    
                                        </a>
    
                                      <?php }else{?>
    
                                        <img src="../<?php echo $noimgs; ?>" width="80" height="80" border="0" class="hinh" />
    
                                      <?php }?>
    
                                    </td>
    
                                    <td align="center"><?=$row['name']?></td>
                                    <td align="center"><?php echo get_field('tbl_shop_category','id',$row['parent1'],'name');?></td>
    
                                    <td align="center">
    
                                        <?=$row['sort']?>
    
                                    </td>
    
                                    <td align="center"><span class="smallfont"><img src="images/noibat_<?=$row['hot']?>.png" alt="" width="25" height="25" class="hot" title="Tiêu biểu" value="<?=$row['id']?>" /></span></td>
    
                                    <td align="center"><span class="smallfont"><img src="images/anhien_<?=$row['status']?>.png" width="25" height="25" class="anhien" title="Ẩn hiện" value="<?=$row['id']?>" /></span></td>
    
                                    <td align="center">
    
                                        <?=$row['dateAdd']?>
    
                                    </td>                                        
    
                                    <td align="center">
    
                                        <a href="index.php?act=item_m&cat=<?=$_REQUEST['cat']?>&page=<?=$_REQUEST['page']?>&id=<?=$row['id']?>"><img src="images/icon3.png"/></a>
    
                                        <a  title="Xóa" href="index.php?act=service&action=del&page=<?=$_REQUEST['page']?>&id=<?=$row['id']?>" onclick="return confirm('Bạn có muốn xoá luôn không ?');" ><img src="images/icon4.png" width="20" border="0" /></a>
    
                                    </td>
    
                                </tr>
    
                             <?php }?>  
    
                               
    
                            </tbody>
    
                            
    
                        </table>
    
                     
    
                        <input type="submit" value="Xóa chọn" name="btnDel" onClick="return confirm('Bạn có chắc chắn muốn xóa ?');" class="button">
    
                    </form>
                
             
                </div>
            </div>
        </div>
    </div>
</div>