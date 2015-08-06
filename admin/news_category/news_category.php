<?php
if(isset($frame)==true){
    check_permiss($_SESSION['kt_login_id'],1,'admin.php');
}else{
    header("location: ../admin.php");
}

if (isset($_POST['tim'])==true)//isset kiem tra submit
{
    if($_POST['tukhoa']!=NULL && $_POST['tukhoa'] != 'Từ khóa...'){$tukhoa=$_POST['tukhoa'];}else {$tukhoa=-1;}
    $_SESSION['kt_tukhoa_bignew']=$tukhoa;
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
    $_POST['ddCatch'] = -1;
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
                    data: 'id='+ id +'&table=tbl_shop_category',
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
                    data: 'id='+ id +'&table=tbl_shop_category',
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
        $r = getRecord("tbl_shop_category","id=".$id);
        $resultParent = mysql_query("select id from tbl_shop_category where parent='".$id."'",$conn);
        if (mysql_num_rows($resultParent) <= 0){
            @$result = mysql_query("delete from tbl_shop_category where id='".$id."'",$conn);
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
            $r = getRecord("tbl_shop_category","id=".$id);
            $resultParent = mysql_query("select id from tbl_shop_category where parent='".$id."'",$conn);
            if (mysql_num_rows($resultParent) <= 0){
                @$result = mysql_query("delete from tbl_shop_category where id='".$id."'",$conn);
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

$pageSize = 6;
$pageNum = 1;
$totalRows = 0;

if (isset($_GET['pageNum'])==true) $pageNum = $_GET['pageNum'];
if ($pageNum<=0) $pageNum=1;
$startRow = ($pageNum-1) * $pageSize;

if($parent!=-1 || $parent1!=-1) {
    if($parent1!='-1') $parenstrt="$parent1";
    else $parenstrt=getParent("tbl_shop_category",$parent);
    $where="1=1  and (id='{$tukhoa}' or name LIKE '%$tukhoa%' or '{$tukhoa}'=-1) and  (parent in ({$parenstrt}) or id=$parent1 or id=$parent)";
}
else $where="1=1  and (id='{$tukhoa}' or name LIKE '%$tukhoa%' or '{$tukhoa}'=-1)";

$where.=" AND ( status='{$anhien}' or '{$anhien}'=-1)  AND ( hot='{$noibat}' or '{$noibat}'=-1) AND cate=1";

$MAXPAGE=1;
$totalRows=countRecord("tbl_shop_category",$where);

if ($_REQUEST['cat']!='') $where="parent=".$_REQUEST['cat']; ?>
<form method="POST" action="#" name="frmForm" enctype="multipart/form-data">
    <input type="hidden" name="page" value="<?=$page?>">
    <input type="hidden" name="act" value="news_category">
<?
// $pageindex = createPage(countRecord("tbl_shop_category",$where),"./?act=shop_category&cat=".$_REQUEST['cat']."&page=",$MAXPAGE,$page)?>

<? if ($_REQUEST['code']==1) $errMsg = 'Cập nhật thành công.'?>



    <table width="100%"   class="admin_table">
    <thead>
    <tr align="center" >
        <td valign="middle"  colspan="10">
            <center>
                <div class="table_chu_tieude">
                    <strong>DANH MỤC TIN TỨC</strong>
                </div>
            </center>
        </td>
    </tr>
    <tr align="center" >
        <td valign="middle" style="background-color:#F0F0F0; height:40px; padding-left:20px" colspan="10">
            <? //comboCategory('ddCat',getArrayCategory('jbs_news_category'),'list_tim_loc',$parent,1)?>

            <select name="ddCat" id="ddCat" class="list_tim_loc table_list">
                <?php if($_POST['ddCat']!=NULL){ ?>
                    <option value="<?php echo $idtheloaic=$_POST['ddCat'] ; ?>"><?php echo get_field('tbl_shop_category','id',$parent,'name'); ?> </option>
                <?php }?>

                <option value="-1" <?php if($parent==-1) echo 'selected="selected"';?> > Chọn danh mục </option>
                <?php
                $gt=get_records("tbl_shop_category","parent=211 and status=0","name COLLATE utf8_unicode_ci"," "," ");
                while($row=mysql_fetch_assoc($gt)){?>
                    <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                <?php } ?>
            </select>
            <select name="ddCatch" id="ddCatch" class="list_tim_loc table_list">
                <?php if($_POST['ddCatch']!=NULL && $_POST['ddCatch']!=-1 ){ ?>
                    <option value="<?php echo $parent1=$_POST['ddCatch'] ; ?>"><?php echo get_field('tbl_shop_category','id',$parent1,'name'); ?> </option>
                <?php }?>
                <option value="-1"> Chọn danh mục con </option>
            </select>
            <input class="table_khungnho"  name="tukhoa" id="tukhoa" type="text" value="Từ khóa..." onfocus="if(this.value=='Từ khóa...') this.value='';" onblur="if(this.value=='') this.value='Từ khóa...';" />
            <input name="tim" type="submit" class="nut_table" id="tim" value="Tìm kiếm"/>
            <input type="submit" name="reset" class="nut_table" value="Reset" title=" Reset " />


        </td>
    </tr>
    <tr >
        <td valign="middle" align="left" style="background-color:#F0F0F0; height:40px; padding-left:20px" colspan="10">
            <div class="link_loc" style="width:80px;text-align:center; padding:3px; border:solid 1px #999; float:left; margin-right:5px;<?php if($noibat==0  &&  $anhien==0) echo 'background-color:#FF0; color:#000;';else echo 'background-color:#FFF; color:#FFF;"';?>">
                <a href="admin.php?act=news_category&tang=1&anhien=-1&noibat=-1">Tất cả</a>
            </div>
            <div class="link_loc" style="width:80px; text-align:center; padding:3px; border:solid 1px #999; float:left; margin-right:5px;<?php if($tang==1) echo 'background-color:#FF0; color:#000;';else echo 'background-color:#FFF; color:#FFF;"';?>" >
                <a href="admin.php?act=news_category&tang=1&anhien=<?php echo $_SESSION['kt_anhien'] ?>&noibat=<?php echo $_SESSION['kt_noibat']?>">Tăng dần</a>
            </div>
            <div class="link_loc" style="width:80px;text-align:center; padding:3px; border:solid 1px #999; float:left; margin-right:5px;<?php if($tang==0) echo 'background-color:#FF0; color:#000;';else echo 'background-color:#FFF; color:#FFF;"';?>">
                <a href="admin.php?act=news_category&tang=0&anhien=<?php echo $_SESSION['kt_anhien'] ?>&noibat=<?php echo $_SESSION['kt_noibat']?>">Giảm dần</a>
            </div>
            <div class="link_loc" style="width:80px;text-align:center; padding:3px; border:solid 1px #999; float:left; margin-right:5px;<?php if($anhien==1) echo 'background-color:#FF0; color:#000;';else echo 'background-color:#FFF; color:#FFF;"';?>">
                <a href="admin.php?act=news_category&tang=<?php echo $_SESSION['kt_tang'] ?>&anhien=1&noibat=<?php echo $_SESSION['kt_noibat'] ?>"> Ẩn </a>
            </div>
            <div class="link_loc" style="width:80px;text-align:center; padding:3px; border:solid 1px #999; float:left; margin-right:5px;<?php if($anhien==0) echo 'background-color:#FF0; color:#000;';else echo 'background-color:#FFF; color:#FFF;"';?>">
                <a href="admin.php?act=news_category&tang=<?php echo $_SESSION['kt_tang'] ?>&anhien=0&&noibat=<?php echo $_SESSION['kt_noibat'] ?>">Hiện</a>
            </div>
            <div class="link_loc" style="width:80px;text-align:center; padding:3px; border:solid 1px #999; float:left; margin-right:5px;<?php if($noibat==1) echo 'background-color:#FF0; color:#000;';else echo 'background-color:#FFF; color:#FFF;"';?>">
                <a href="admin.php?act=news_category&tang=<?php echo $_SESSION['kt_tang'] ?>&anhien=<?php echo $_SESSION['kt_anhien'] ?>&noibat=1">Nổi bật</a>
            </div>
            <div class="link_loc" style="width:80px;text-align:center; padding:3px; border:solid 1px #999; float:left; margin-right:5px;<?php if($noibat==0) echo 'background-color:#FF0; color:#000;';else echo 'background-color:#FFF; color:#FFF;"';?>">
                <a href="admin.php?act=news_category&tang=<?php echo $_SESSION['kt_tang'] ?>&anhien=<?php echo $_SESSION['kt_anhien'] ?>&noibat=0">ko nổi bật</a>
            </div>
        </td>
    </tr>
    <tr>
        <td align="center" colspan="2">
            <input type="submit" value="Xóa chọn" name="btnDel" onClick="return confirm('Bạn chắc chắn muốn xóa ?');" class="button">
        </td>
        <td align="center" class="PageNum" colspan="7">
            <?php echo pagesListLimit($totalRows,$pageSize);?>
        </td>

        <td width="80" align="center" colspan="1">
            <div><a href="admin.php?act=news_category_m">
                    <img width="48" height="48" border="0" src="images/them.png">
                </a></div></td>
    </tr>
    <tr class="admin_tieude_table">
        <td width="3%" align="center">
            <input name="chkall" id="chkall" type="checkbox"   onClick="chkallClick(this);"/>
        </td>
        <td width="4%" align="center">
            STT
        </td>
        <td width="22%" align="center">Hình</td>
        <td width="13%" align="center"><span class="title"><a class="title" href="<?=getLinkSortAdmin(3)?>">Tên danh mục</a></span></td>
        <td width="12%" align="center"><a class="title" href="<?=getLinkSortAdmin(4)?>">Thuộc danh mục</a></td>
        <td width="11%" align="center"><a class="title" href="<?=getLinkSortAdmin(10)?>">Thứ tự sắp xếp</a></td>
        <td width="7%" align="center"><a class="title" href="<?=getLinkSortAdmin(15)?>">Tiêu biểu</a></td>
        <td width="11%" align="center"><span class="title"><a class="title" href="<?=getLinkSortAdmin(11)?>">Không hiển thị</a></span></td>
        <td width="10%" align="center"><a class="title" href="<?=getLinkSortAdmin(12)?>">Ngày tạo lập</a></td>
        <td width="7%" align="center">
            Công cụ
        </td>
    </tr>
    </thead>
    <tbody>
    <?
    $sortby="order by sort $ks";
    if ($_REQUEST['sortby']!='') $sortby="order by ".(int)$_REQUEST['sortby'];
    $direction=($_REQUEST['direction']==''||$_REQUEST['direction']=='0'?"desc":"");

    $sql="select *,DATE_FORMAT(date_added,'%d/%m/%Y %h:%i') as dateAdd,DATE_FORMAT(last_modified,'%d/%m/%Y %h:%i') as dateModify from tbl_shop_category where $where $sortby   limit ".($startRow).",".$pageSize;
    $result=mysql_query($sql,$conn);
    $i=0;
    while($row=mysql_fetch_array($result)){
        $parent = getRecord('tbl_shop_category','id = '.$row['parent']);
        $color = $i++%2 ? "#d5d5d5" : "#e5e5e5";
        ?>
        <tr>
            <td align="center">
                <input type="checkbox" name="chk[]" value="<?=$row['id']?>"  class="tai_c" />
            </td>
            <td align="center">
                <?=$row['id']?>
            </td>
            <td align="center"><?php if($row['image']==true){ ?>
                    <a onclick="positionedPopup (this.href,'myWindow','500','400','100','400','yes');return false" href="<?=$row['image']?>" title="Click vào xem ảnh"> <img src="../web/<?=$row['image']?>" width="40" height="40" border="0" class="hinh" /></a>
                <?php }else{?>
                    <img src="../<?php echo $noimgs; ?>" width="40" height="40" border="0" class="hinh" />
                <?php }?></td>
            <td align="center">
                <?=$row['name']?>
            </td>
            <td align="center">
                <?=$parent['name']?>
            </td>
            <td align="center">
                <?=$row['sort']?>
            </td>
            <td align="center"><span class="smallfont"><img src="images/noibat_<?=$row['hot']?>.png" alt="" width="25" height="25" class="hot" title="Tiêu biểu" value="<?=$row['id']?>" /></span></td>
            <td align="center"><span class="smallfont"><img src="images/anhien_<?=$row['status']?>.png" width="25" height="25" class="anhien" title="Ẩn hiện" value="<?=$row['id']?>" /></span></td>
            <td align="center">
                <?=$row['dateAdd']?>
            </td>
            <td align="center">
                <a href="admin.php?act=news_category_m&cat=<?=$_REQUEST['cat']?>&page=<?=$_REQUEST['page']?>&id=<?=$row['id']?>"><img src="images/icon3.png"/></a>
                <a  title="Xóa" href="admin.php?act=news_category&action=del&page=<?=$_REQUEST['page']?>&id=<?=$row['id']?>" onclick="return confirm('Bạn chắc chắn muốn xoá?');" ><img src="images/icon4.png" width="20" border="0" /></a>
            </td>
        </tr>
    <?php }?>

    </tbody>
    <tr>
        <td  class="PageNext" colspan="10" align="center" valign="middle">
            <div style="padding:5px;">
                          <?php echo pagesLinks($totalRows,$pageSize); ?>
                          </div>
                          </td>  							  
                        </tr>
                        
                    </table>
                </form>
                
             
                </div>
            </div>
        </div>
    </div>
</div>