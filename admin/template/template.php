<?php
if(isset($frame)==true){
	check_permiss($_SESSION['kt_login_id'],1,'admin.php');
}else{
	header("location: ../admin.php");
}

if (isset($_POST['tim'])==true)//isset kiem tra submit
{
	if($_POST['tukhoa']!=NULL){$tukhoa=$_POST['tukhoa'];}else {$tukhoa=-1;}
	$_SESSION['kt_tukhoa_temp']=$tukhoa;
	$tukhoa = trim(strip_tags($tukhoa));
	if (get_magic_quotes_gpc()==false) 
		{
			$tukhoa = mysql_real_escape_string($tukhoa);
		}
}
if (isset($_POST['reset'])==true) {

	$_SESSION['kt_tukhoa_bignew']=-1;
	$_SESSION['kt_parent_bignew']=-1;
	$_SESSION['kt_ddCatch_bignew']=-1; 
	
}
if($_SESSION['kt_tukhoa_bignew']==NULL){$tukhoa=-1;}
if($_SESSION['kt_tukhoa_bignew']!=NULL){$tukhoa=$_SESSION['kt_tukhoa_bignew'];}
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
		   data: 'id='+ id +'&table=tbl_template',
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
		   data: 'id='+ id +'&table=tbl_template',
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
<style>
.table th, .table td {
padding: 8px;
line-height: 20px;
text-align: left;
vertical-align: middle;
border-top: 1px solid #dddddd;
}
</style>
<? if ($_REQUEST['code']==1) $errMsg = 'Cập nhật thành công.'?>
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
                            $r = getRecord("tbl_template","id=".$id);
    
                            @$result = mysql_query("delete from tbl_template where id='".$id."'",$conn);
                            if ($result){
                                if(file_exists('../'.$r['image'])) @unlink('../'.$r['image']);
                                $errMsg = "Đã xóa thành công.";
                            }else $errMsg = "Không thể xóa dữ liệu !";
             
                            break;
                    }
                    
                    if (isset($_POST['btnDel'])){
                        $cntDel=0;
                        $cntNotDel=0;
                        $cntParentExist=0;
                        if($_POST['chk']!=''){
                            foreach ($_POST['chk'] as $id){
                                $r = getRecord("tbl_template","id=".$id);
    
                                @$result = mysql_query("delete from tbl_template where id='".$id."'",$conn);
                                if ($result){
                                    if(file_exists('../'.$r['image'])) @unlink('../'.$r['image']);
                                    $cntDel++;
                                }else $cntNotDel++;
                                
                            }
                            $errMsg = "Đã xóa ".$cntDel." phần tử.<br><br>";
                            $errMsg .= $cntNotDel>0 ? "Không thể xóa ".$cntNotDel." phần tử.<br>" : '';
                            $errMsg .= $cntParentExist>0 ? "Đang có danh mục con sử dụng ".$cntParentExist." phần tử." : '';
                        }else{
                            $errMsg = "Hãy chọn trước khi xóa !";
                        }
                    }
                    
                    $pageSize = 33;
                    $pageNum = 1;
                    $totalRows = 0;
                    
                    if (isset($_GET['pageNum'])==true) $pageNum = $_GET['pageNum'];
                    if ($pageNum<=0) $pageNum=1;
                    $startRow = ($pageNum-1) * $pageSize;
                
                    $where="1=1 and (id='{$tukhoa}' or name LIKE '%$tukhoa%' or '{$tukhoa}'=-1)";
					$where.=" AND ( status='{$anhien}' or '{$anhien}'=-1)   ";
                    
                    $MAXPAGE=1;
                    $totalRows=countRecord("tbl_template",$where);
                    
                    if ($_REQUEST['cat']!='') $where="parent=".$_REQUEST['cat']; ?>
                    <form method="POST" action="#" name="frmForm" enctype="multipart/form-data">
                    <input type="hidden" name="page" value="<?=$page?>">
                    <input type="hidden" name="act" value="template">
                    <?
                   // $pageindex = createPage(countRecord("tbl_template",$where),"./?act=shop_category&cat=".$_REQUEST['cat']."&page=",$MAXPAGE,$page)?>
                    
                   
                    
                   
                    	 
                      <table width="100%"  class="admin_table">
                            <thead>
                                <tr align="center" >
                                  <td valign="middle"  colspan="10">
                                    <center>
                                        <div class="table_chu_tieude">
                                        <strong>GIAO DIỆN</strong>
                                        </div>
                                    </center>
                                  </td>
                                </tr>
                                <tr align="center" >
                                  <td valign="middle" style="background-color:#F0F0F0; height:40px; padding-left:20px" colspan="10">  
                                  		<? //comboCategory('ddCat',getArrayCategory('jbs_news_category'),'list_tim_loc',$parent,1)?>
                                  		<input class="table_khungnho"  name="tukhoa" id="tukhoa" type="text" value="Từ khóa..." onfocus="if(this.value=='Từ khóa...') this.value='';" onblur="if(this.value=='') this.value='Từ khóa...';" />
                                        <input name="tim" type="submit" class="nut_table" id="tim" value="Tìm kiếm"/>
                                        <input type="submit" name="reset" class="nut_table" value="Reset" title=" Reset " />
                                 
                                  
                                  </td>
                                </tr>
                                <tr >
                                  <td valign="middle" align="left" style="background-color:#F0F0F0; height:40px; padding-left:20px" colspan="10"> 
                                        <div class="link_loc" style="width:80px;text-align:center; padding:3px; border:solid 1px #999; float:left; margin-right:5px;<?php if($noibat==0  &&  $anhien==0) echo 'background-color:#FF0; color:#000;';else echo 'background-color:#FFF; color:#FFF;"';?>">
                                        	<a href="admin.php?act=jbsnews&tang=1&anhien=-1&noibat=-1">Tất cả</a>
                                        </div>
                                        <div class="link_loc" style="width:80px; text-align:center; padding:3px; border:solid 1px #999; float:left; margin-right:5px;<?php if($tang==1) echo 'background-color:#FF0; color:#000;';else echo 'background-color:#FFF; color:#FFF;"';?>" >
                                        	<a href="admin.php?act=jbsnews&tang=1&anhien=<?php echo $_SESSION['kt_anhien'] ?>&noibat=<?php echo $_SESSION['kt_noibat']?>">Tăng dần</a>
                                        </div>
                                        <div class="link_loc" style="width:80px;text-align:center; padding:3px; border:solid 1px #999; float:left; margin-right:5px;<?php if($tang==0) echo 'background-color:#FF0; color:#000;';else echo 'background-color:#FFF; color:#FFF;"';?>">
                                        	<a href="admin.php?act=jbsnews&tang=0&anhien=<?php echo $_SESSION['kt_anhien'] ?>&noibat=<?php echo $_SESSION['kt_noibat']?>">Giảm dần</a>
                                        </div>
                                        <div class="link_loc" style="width:80px;text-align:center; padding:3px; border:solid 1px #999; float:left; margin-right:5px;<?php if($anhien==1) echo 'background-color:#FF0; color:#000;';else echo 'background-color:#FFF; color:#FFF;"';?>">
                                        	<a href="admin.php?act=jbsnews&tang=<?php echo $_SESSION['kt_tang'] ?>&anhien=1&noibat=<?php echo $_SESSION['kt_noibat'] ?>"> Ẩn </a>
                                        </div>
                                         <div class="link_loc" style="width:80px;text-align:center; padding:3px; border:solid 1px #999; float:left; margin-right:5px;<?php if($anhien==0) echo 'background-color:#FF0; color:#000;';else echo 'background-color:#FFF; color:#FFF;"';?>">
                                        	<a href="admin.php?act=jbsnews&tang=<?php echo $_SESSION['kt_tang'] ?>&anhien=0&&noibat=<?php echo $_SESSION['kt_noibat'] ?>">Hiện</a>
                                        </div>
                                        <div class="link_loc" style="width:80px;text-align:center; padding:3px; border:solid 1px #999; float:left; margin-right:5px;<?php if($noibat==1) echo 'background-color:#FF0; color:#000;';else echo 'background-color:#FFF; color:#FFF;"';?>">
                                        	<a href="admin.php?act=jbsnews&tang=<?php echo $_SESSION['kt_tang'] ?>&anhien=<?php echo $_SESSION['kt_anhien'] ?>&noibat=1">Nổi bật</a>
                                        </div>
                                         <div class="link_loc" style="width:80px;text-align:center; padding:3px; border:solid 1px #999; float:left; margin-right:5px;<?php if($noibat==0) echo 'background-color:#FF0; color:#000;';else echo 'background-color:#FFF; color:#FFF;"';?>">
                                        	<a href="admin.php?act=jbsnews&tang=<?php echo $_SESSION['kt_tang'] ?>&anhien=<?php echo $_SESSION['kt_anhien'] ?>&noibat=0">ko nổi bật</a>
                                        </div>
                                  </td>
                                </tr>
                               <tr>
                                  <td align="center" colspan="2">
                                  <input type="submit" value="Xóa chọn" name="btnDel" onClick="return confirm('Bạn có chắc chắn muốn xóa ?');" class="button">
                                  </td>
                                  <td align="center" class="PageNum" colspan="4">
                                    	<?php echo pagesListLimit($totalRows,$pageSize);?>   
                                  </td>
                                  
                                 <td width="81" align="center" colspan="1">
                                  <div><a href="admin.php?act=jbsnews_m">
                                  <img width="48" height="48" border="0" src="images/them.png">
                                  </a></div></td>
                              </tr>
                              <tr class="admin_tieude_table">
                                <td width="4%" align="center">
                                        <input type="checkbox" name="chkall" onClick="chkallClick(this);"/>
                                    </td>
                                    <td width="5%" align="center">
                                        STT
                                    </td>
                                    <td width="32%" align="center">Hình </td>
                                    <td width="17%" align="center"><span class="title"><a class="title" href="<?=getLinkSort(3)?>">Tên giao diện</a></span></td>
                                    <td width="11%" align="center"><span class="title"><a class="title" href="<?=getLinkSort(11)?>">Không hiển thị</a></span></td>
                                    <td width="12%" align="center"><a class="title" href="<?=getLinkSort(12)?>">Ngày tạo lập</a></td>                                        
                                    <td width="9%" align="center">
                                        Công cụ
                                    </td>
                                </tr>
                            </thead>
                            <tbody>
                            <?
                            $sortby="order by id $ks";
                            if ($_REQUEST['sortby']!='') $sortby="order by ".(int)$_REQUEST['sortby'];
                            $direction=($_REQUEST['direction']==''||$_REQUEST['direction']=='0'?"desc":"");
                            
                            $sql="select *,DATE_FORMAT(date_added,'%d/%m/%Y %h:%i') as dateAdd,DATE_FORMAT(last_modified,'%d/%m/%Y %h:%i') as dateModify from tbl_template where  $where $sortby   limit ".($startRow).",".$pageSize;
                            $result=mysql_query($sql,$conn);
                            $i=0;
                            while($row=mysql_fetch_array($result)){
                            $parent = getRecord('tbl_template','id = '.$row['parent']);
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
                                        <img src="../<?=$row['image']?>" width="80" height="80" border="0" class="hinh" />
                                        </a>
                                      <?php }else{?>
                                        <img src="../<?php echo $noimgs; ?>" width="80" height="80" border="0" class="hinh" />
                                      <?php }?>
                                    </td>
                                    <td align="center">
                                        <?=$row['name']?>
                                    </td>
                                    <td align="center"><span class="smallfont"><img src="images/anhien_<?=$row['status']?>.png" width="25" height="25" class="anhien" title="Ẩn hiện" value="<?=$row['id']?>" /></span></td>
                                    <td align="center">
                                        <?=$row['dateAdd']?>
                                    </td>                                        
                                    <td align="center">
                                        <a href="admin.php?act=template_m&cat=<?=$_REQUEST['cat']?>&page=<?=$_REQUEST['page']?>&id=<?=$row['id']?>"><img src="images/icon3.png"/></a>
                                        <a  title="Xóa" href="admin.php?act=template&action=del&page=<?=$_REQUEST['page']?>&id=<?=$row['id']?>" onclick="return confirm('Bạn có muốn xoá luôn không ?');" ><img src="images/icon4.png" width="20" border="0" /></a>
                                    </td>
                                </tr>
                             <?php }?>  
                               
                            </tbody>
                            <thead>
                                <tr>
                                    <td colspan="9"> <center> <div class="PageNum"> <?php echo pagesListLimit($totalRows,$pageSize);?> </div> </center></td>
                                </tr>
                            </thead>
                            
                        </table>
                    </form>
                
             
                </div>
            </div>
        </div>
    </div>
</div>