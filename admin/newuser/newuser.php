<?php
if(isset($frame)==true){
	check_permiss($_SESSION['kt_login_id'],17,'admin.php');
}else{
	header("location: ../admin.php");
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

	if($_POST['ddCat']!=NULL){$parent=$_POST['ddCat'];}else {$parent=-1;}
	$_SESSION['kt_parent_bignew']=$parent;

	if($_POST['ddCat2']!=NULL){$idshop=$_POST['ddCat2'];}else {$idshop=-1;}
	$_SESSION['kt_idshop']=$idshop;

	if($_POST['ddCatch']!=NULL){$parent1=$_POST['ddCatch'];}else {$parent1=-1;}
	$_SESSION['kt_ddCatch_bignew']=$parent1;




}

if (isset($_POST['reset'])==true) {

	$_SESSION['kt_tukhoa_bignew']=-1;
	$_SESSION['kt_parent_bignew']=-1;
	$_SESSION['kt_ddCatch_bignew']=-1;
	$_SESSION['kt_idshop']=-1;

}
if($_SESSION['kt_tukhoa_bignew']==NULL){$tukhoa=-1;}
if($_SESSION['kt_tukhoa_bignew']!=NULL){$tukhoa=$_SESSION['kt_tukhoa_bignew'];}
if($_SESSION['kt_parent_bignew']==NULL){$parent=-1;}
if($_SESSION['kt_parent_bignew']!=NULL){$parent=$_SESSION['kt_parent_bignew'];}

if($_SESSION['kt_idshop']==NULL){$idshop=-1;}
if($_SESSION['kt_idshop']!=NULL){$idshop=$_SESSION['kt_idshop'];}

if($_SESSION['kt_idshop']==NULL){$parent1=-1;}
if($_SESSION['kt_idshop']!=NULL){$parent1=$_SESSION['kt_ddCatch_bignew'];}

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

		   data: 'id='+ id +'&table=tbl_item',

		   cache: false,

		   success: function(data){ //alert(idvnexpres);

			obj.src=data;

			if (data=="images/anhien_1.png") obj.title="Nhấp vào để ẩn";

			else obj.title="Nhấp vào để hiện";

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

			if (data=="images/noibat_1.png") obj.title="Nhấp vào để ẩn";

			else obj.title="Nhấp vào để hiện";

		  }

		});

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

                            $r = getRecord("tbl_item","id=".$id);

                            $resultParent = 0;



                                @$result = mysql_query("delete from tbl_item where id='".$id."'",$conn);

                                if ($result){

                                    if(file_exists('../web/'.$r['image'])) @unlink('../web/'.$r['image']);

                                    if(file_exists('../web/'.$r['image_large'])) @unlink('../web/'.$r['image_large']);

                                    $errMsg = "Đã xóa thành công.";

                                    echo '<script>window.location="admin.php?act=newuser&cat='.$_REQUEST['cat'].'&page='.$_REQUEST['page'].'&code=1"</script>';



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

                            echo '<script>window.location="admin.php?act=newuser&cat='.$_REQUEST['cat'].'&page='.$_REQUEST['page'].'&code=1"</script>';

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


					if($parent!=-1 || $parent1!=-1) {
						if($parent1!='-1') $parenstrt="$parent1";
						else $parenstrt=getParent("tbl_shop_category",$parent);
						$where="1=1 and type=0 and cate=1 and (id='{$tukhoa}' or name LIKE '%$tukhoa%' or '{$tukhoa}'=-1) and  ( parent1 in ({$parenstrt}) or id=$parent) and (idshop='{$idshop}'  or '{$idshop}'=-1)";
					}
                    else $where="1=1 and type=0 and cate=1 and (id='{$tukhoa}' or name LIKE '%$tukhoa%' or '{$tukhoa}'=-1) and (idshop='{$idshop}'  or '{$idshop}'=-1)";

					$where.=" AND ( status='{$anhien}' or '{$anhien}'=-1)  AND ( hot='{$noibat}' or '{$noibat}'=-1)";



                    $MAXPAGE=1;

                    $totalRows=countRecord("tbl_item",$where);



                    if ($_REQUEST['cat']!='') $where="parent=".$_REQUEST['cat']; ?>

                    <form method="POST" action="admin.php?act=newuser" name="frmForm" enctype="multipart/form-data">

                    <input type="hidden" name="page" value="<?=$page?>">

                    <input type="hidden" name="act" value="newuser">

                    <?

                   // $pageindex = createPage(countRecord("tbl_item",$where),"./?act=shop_category&cat=".$_REQUEST['cat']."&page=",$MAXPAGE,$page)?>


                    <? if ($_REQUEST['code']==1) $errMsg = 'Cập nhật thành công.'?>


                      <table width="100%"  class="admin_table">

                            <thead>

                                <tr align="center" >
                                  <td valign="middle"  colspan="10">
                                    <center>
                                        <div class="table_chu_tieude">
                                          <blockquote>
                                            <p><strong>TIN TỨC</strong>
                                            </p>
                                          </blockquote>
                                        </div>
                                    </center>
                                  </td>
                                </tr>
                                <tr align="center" >
                                  <td valign="middle" style="background-color:#F0F0F0; height:40px; padding-left:20px" colspan="10">
                                  		<? //comboCategory('ddCat',getArrayCategory('tbl_shop_category'),'list_tim_loc',$parent,1)?>
                                  		<select name="ddCat2" id="ddCat2" class="table_list">
                                          <?php if($_POST['ddCat']!=NULL){ ?>
                                          <option value="<?php echo $idtheloaic=$_POST['ddCat'] ; ?>"><?php echo get_field('tbl_shop_category','id',$parent,'name'); ?></option>
                                          <?php }?>
                                          <option value="-1" <?php if($parent==-1) echo 'selected="selected"';?> > Chọn danh mục </option>
                                          <?php
											$gt=get_records("tbl_shop_category","status=0 ","id DESC"," "," ");
                                            while($row=mysql_fetch_assoc($gt)){?>
                                          <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                                          <?php } ?>
                                        </select>
                                        <input class="table_khungnho"  name="tukhoa" id="tukhoa" type="text" value="Từ khóa..." onfocus="if(this.value=='Từ khóa...') this.value='';" onblur="if(this.value=='') this.value='Từ khóa...';" />
                                        <input name="tim" type="submit" class="nut_table" id="tim" value="Tìm kiếm"/>
                                        <input type="submit" name="reset" class="nut_table" value="Reset" title=" Reset " />


                                  </td>
                                </tr>
                                <tr >
                                  <td valign="middle" align="left" style="background-color:#F0F0F0; height:40px; padding-left:20px" colspan="10">
                                        <div class="link_loc" style="width:80px;text-align:center; padding:3px; border:solid 1px #999; float:left; margin-right:5px;<?php if($noibat==0  &&  $anhien==0) echo 'background-color:#FF0; color:#000;';else echo 'background-color:#FFF; color:#FFF;"';?>">
                                        	<a href="admin.php?act=newuser&tang=1&anhien=-1&noibat=-1">Tất cả</a>
                                        </div>
                                        <div class="link_loc" style="width:80px; text-align:center; padding:3px; border:solid 1px #999; float:left; margin-right:5px;<?php if($tang==1) echo 'background-color:#FF0; color:#000;';else echo 'background-color:#FFF; color:#FFF;"';?>" >
                                        	<a href="admin.php?act=newuser&tang=1&anhien=<?php echo $_SESSION['kt_anhien'] ?>&noibat=<?php echo $_SESSION['kt_noibat']?>">Tăng dần</a>
                                        </div>
                                        <div class="link_loc" style="width:80px;text-align:center; padding:3px; border:solid 1px #999; float:left; margin-right:5px;<?php if($tang==0) echo 'background-color:#FF0; color:#000;';else echo 'background-color:#FFF; color:#FFF;"';?>">
                                        	<a href="admin.php?act=newuser&tang=0&anhien=<?php echo $_SESSION['kt_anhien'] ?>&noibat=<?php echo $_SESSION['kt_noibat']?>">Giảm dần</a>
                                        </div>
                                        <div class="link_loc" style="width:80px;text-align:center; padding:3px; border:solid 1px #999; float:left; margin-right:5px;<?php if($anhien==1) echo 'background-color:#FF0; color:#000;';else echo 'background-color:#FFF; color:#FFF;"';?>">
                                        	<a href="admin.php?act=newuser&tang=<?php echo $_SESSION['kt_tang'] ?>&anhien=1&noibat=<?php echo $_SESSION['kt_noibat'] ?>"> Ẩn </a>
                                        </div>
                                         <div class="link_loc" style="width:80px;text-align:center; padding:3px; border:solid 1px #999; float:left; margin-right:5px;<?php if($anhien==0) echo 'background-color:#FF0; color:#000;';else echo 'background-color:#FFF; color:#FFF;"';?>">
                                        	<a href="admin.php?act=newuser&tang=<?php echo $_SESSION['kt_tang'] ?>&anhien=0&&noibat=<?php echo $_SESSION['kt_noibat'] ?>">Hiện</a>
                                        </div>
                                        <div class="link_loc" style="width:80px;text-align:center; padding:3px; border:solid 1px #999; float:left; margin-right:5px;<?php if($noibat==1) echo 'background-color:#FF0; color:#000;';else echo 'background-color:#FFF; color:#FFF;"';?>">
                                        	<a href="admin.php?act=newuser&tang=<?php echo $_SESSION['kt_tang'] ?>&anhien=<?php echo $_SESSION['kt_anhien'] ?>&noibat=1">Nổi bật</a>
                                        </div>
                                         <div class="link_loc" style="width:80px;text-align:center; padding:3px; border:solid 1px #999; float:left; margin-right:5px;<?php if($noibat==0) echo 'background-color:#FF0; color:#000;';else echo 'background-color:#FFF; color:#FFF;"';?>">
                                        	<a href="admin.php?act=newuser&tang=<?php echo $_SESSION['kt_tang'] ?>&anhien=<?php echo $_SESSION['kt_anhien'] ?>&noibat=0">ko nổi bật</a>
                                        </div>
                                  </td>
                                </tr>
                               <tr>
                                  <td align="center" colspan="2">
                                  <input type="submit" value="Xóa chọn" name="btnDel" onClick="return confirm('Bạn có chắc chắn muốn xóa ?');" class="button">
                                  </td>
                                  <td align="center" class="PageNum" colspan="7">
                                    	<?php echo pagesListLimit($totalRows,$pageSize);?>
                                  </td>

                                 <td width="81" align="center" colspan="1">
                                  <div><a href="admin.php?act=newuser_m">
                                  <img width="48" height="48" border="0" src="images/them.png">
                                  </a></div></td>
                              </tr>
                              <tr class="admin_tieude_table">

                                    <td align="center">

                                        <input type="checkbox" name="chkall" onClick="chkallClick(this);"/>

                                    </td>

                                    <td align="center">

                                        STT

                                    </td>

                                    <td align="center"><span class="title"><a class="title" >Hình</a></span></td>

                                    <td align="center"><a class="title" href="<?=getLinkSort(3)?>">Tên </a></td>
                                    <td align="center"><a class="title" href="<?=getLinkSort(3)?>">Shop</a></td>

                                    <td align="center"><a class="title" href="<?=getLinkSort(10)?>">Thành viên</a></td>

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

                            $sortby="order by id $ks";

                            if ($_REQUEST['sortby']!='') $sortby="order by ".(int)$_REQUEST['sortby'];

                            $direction=($_REQUEST['direction']==''||$_REQUEST['direction']=='0'?"desc":"");



                            $sql="select *,DATE_FORMAT(date_added,'%d/%m/%Y %h:%i') as dateAdd,DATE_FORMAT(last_modified,'%d/%m/%Y %h:%i') as dateModify from tbl_item where $where $sortby  limit ".($startRow).",".$pageSize;

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

                                    <td align="left">
										<?=$row['name']?><br />
                                        Thể loại:<?php echo get_field('tbl_shop_category','id',get_field('tbl_shop_category','id',$row['parent'],'parent'),'name');?> <br />
                                        Loại    :<?php echo get_field('tbl_shop_category','id',$row['parent'],'name');?>
                                    </td>
                                    <td align="center">
									<a href="http://<?php echo get_field('tbl_shop','id',$row['idshop'],'subject');?>.jbs.vn" target="_blank">	<?php echo get_field('tbl_shop','id',$row['idshop'],'name');?></a>
                                     </td>

                                    <td align="center">

                                        <?php echo get_field('tbl_customer','id',get_field('tbl_shop','id',$row['idshop'],'iduser'),'username');?>

                                    </td>

                                    <td align="center"><span class="smallfont"><img src="images/noibat_<?=$row['hot']?>.png" alt="" width="25" height="25" class="hot" title="Tiêu biểu" value="<?=$row['id']?>" /></span></td>

                                    <td align="center"><span class="smallfont"><img src="images/anhien_<?=$row['status']?>.png" width="25" height="25" class="anhien" title="Ẩn hiện" value="<?=$row['id']?>" /></span></td>

                                    <td align="center">

                                        <?=$row['dateAdd']?>

                                    </td>

                                    <td align="center">

                                        <a href="admin.php?act=newuser_m&cat=<?=$_REQUEST['cat']?>&page=<?=$_REQUEST['page']?>&id=<?=$row['id']?>"><img src="images/icon3.png"/></a>

                                        <a  title="Xóa" href="admin.php?act=newuser&action=del&page=<?=$_REQUEST['page']?>&id=<?=$row['id']?>" onclick="return confirm('Bạn có muốn xoá luôn không ?');" ><img src="images/icon4.png" width="20" border="0" /></a>

                                    </td>

                                </tr>

                             <?php }?>



                            </tbody>



                        </table>
                    </form>


                </div>
            </div>
        </div>
    </div>
</div>