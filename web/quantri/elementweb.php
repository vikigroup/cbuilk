<?php 
$ghinho=0;
if(get_field("tbl_module","idshop",$idshop,"id")!="") {
	$mang1=get_field("tbl_module","idshop",$idshop,"list_title_module");
	$mang2=get_field("tbl_module","idshop",$idshop,"title_module1");
	if($mang1==""){
		$mang1=get_field("tbl_template","id",$row_shop['idtemplate'],"list_title_module");
		$mang2=get_field("tbl_template","id",$row_shop['idtemplate'],"title_module1");
	}
	$ghinho=1;
}else{
	$mang1=get_field("tbl_template","id",$row_shop['idtemplate'],"list_title_module");
	$mang2=get_field("tbl_template","id",$row_shop['idtemplate'],"title_module1");
}
	
	$mang11=explode(",", $mang1);
	$mang22=explode(",", $mang2);

function module_keyword($a,$b,$x){
	foreach($a as $key => $var){
		if($var==$x) return $b[$key];
	}
}

	function array_sort($array, $type='asc'){
    $result=array();
    foreach($array as $var => $val){
        $set=false;
        foreach($result as $var2 => $val2){
            if($set==false){
                if($val>$val2 && $type=='desc' || $val<$val2 && $type=='asc'){
                    $temp=array();
                    foreach($result as $var3 => $val3){
                        if($var3==$var2) $set=true;
                        if($set){
                            $temp[$var3]=$val3;
                            unset($result[$var3]);
                        }
                    }
                    $result[$var]=$val;   
                    foreach($temp as $var3 => $val3){
                        $result[$var3]=$val3;
                    }
                }
            }
        }
        if(!$set){
            $result[$var]=$val;
        }
    }
    return $result;
	}
	
	
	function find_module_inlist($name,$list){
		foreach($list as $key => $var){
			if($key==$name) if($var==1 || $list['name']==0)  return  $var;
				
		}	
		return 5;
	}
	
	function find_value_inlist($name,$list){
		$i=1;
		foreach($list as $key => $var){
			if($key==$name) {return $i;}
			else $i++;
				
		}	
	}
	
	function find_value_inlist2($name,$list){
		foreach($list as $key => $var){
			if($key==$name) return $var;
		}	
	}
	
	/*---------------------------------------------*/
	
	
	//$id=$_GET['id']; 	
	
	$id=$idshop;
	
	$sql="SELECT * FROM tbl_shop WHERE id='{$id}'";
	$gt=mysql_query($sql);
	$row=mysql_fetch_assoc($gt);
	
	if($row['css']=="") $content=get_field("tbl_template","id",$row['idtemplate'],"content");
	else $content=$row['css'];
	
	$box=get_field("tbl_template","id",$row['idtemplate'],"listname");
	$box=explode(",", $box);
	$demaa=count($box);
	//print_r($box);
	$b="";
	$ghinho_t=0;
	if(get_field("tbl_module","idshop",$idshop,"id")!="") {
		$b=get_field("tbl_module","idshop",$idshop,"boxarray");
		$b=unserialize($b);
		/*print_r($b);*/
		$ghinho_t=1;
	}
	
	/*----module home*/
	$module=get_field("tbl_template","id",$row['idtemplate'],"listmodule");
	$module=explode(",", $module);
	$dembb=count($module);
	
	if(get_field("tbl_module","idshop",$idshop,"id")!="") {
		$c=get_field("tbl_module","idshop",$idshop,"modulearray");
		$c=unserialize($c);
		/*print_r($c);*/
	}
	
	//echo print_r(unserialize('a:8:{s:9:"menu_left";s:1:"1";s:12:"good_product";s:1:"1";s:8:"box_cart";s:1:"1";s:6:"box_ad";s:1:"0";s:9:"box_video";s:1:"0";s:10:"box_search";s:1:"0";s:9:"box_total";s:1:"0";s:11:"box_support";s:1:"0";}'));
	
	$ttt=getRecord("tbl_module","idshop='".$idshop."'");
	$sl1=$ttt['sl1'];
	$sl2=$ttt['sl2'];
	$sl3=$ttt['sl3'];
	$sl5=$ttt['sl4'];
	$heso=$ttt['heso'];
	
	$total=get_field("tbl_count","idshop",$idshop,"total");
	

?>
<?php 
if (isset($_POST['them'])==true)//isset kiem tra submit
	{
		$sl1=trim($_POST['sl1']);
		$sl2=trim($_POST['sl2']);
		$sl3=trim($_POST['sl3']);
		$sl5=trim($_POST['sl5']);
		$heso=trim($_POST['heso']);
		$total=trim($_POST['total']);
		
		$arrayboxs=array();
		$arrayboxa=array();
		$arrayboxv=array();
		$arraybox=array();

		for($i=0;$i<$demaa;$i++){
			$j=($i+1);
			$t=$_POST['bs'.$j];
			$arrayboxs[$box[$i]]=$t;
			
		}

		
		for($i=0;$i<$demaa;$i++){
			$j=($i+1);
			$t=$_POST['ba'.$j];
			$arrayboxa[$box[$i]]=$t;
		}
		
		for($i=0;$i<$demaa;$i++){
			$j=($i+1);
			$t=$_POST['bv'.$j];
			$arrayboxv[$box[$i]]=$t;
		}
		
		for($i=0;$i<$demaa;$i++){
			if($arrayboxa[$box[$i]]==1)  $arraybox[$box[$i]]=$arrayboxs[$box[$i]];
		}
		//print_r($arraybox); echo "<br>";
		
		$a=array_sort($arraybox, $type='asc');
		//print_r($a);echo "<br>";
		
		foreach($a as $key => $var){
			$a[$key]=$arrayboxv[$key];
		}
		
		//print_r($a);echo "<br>";
		
		$a=array_sort($a, $type='desc');
		//print_r($a);echo "<br>";
		
		$left=0; // so box ben trai
		foreach($a as $key => $var){
			if($a[$key]==1) $left++;
		}
		
		//echo "Có ".$left." bên trái";
		
		/*--- module */
		
		$arraymodule=array();

		for($i=0;$i<$dembb;$i++){
			$j=($i+1);
			$t=$_POST['ms'.$j];
			$arraymodules[$module[$i]]=$t;
			
		}
		
		for($i=0;$i<$dembb;$i++){
			$j=($i+1);
			$t=$_POST['ma'.$j];
			$arraymodulea[$module[$i]]=$t;
			
		}
		
		for($i=0;$i<$dembb;$i++){
			if($arraymodulea[$module[$i]]==1)  $arraymodule[$module[$i]]=$arraymodules[$module[$i]];
		}
		
		$b=array_sort($arraymodule, $type='asc');
		//print_r($b);
		
		$coloi=false;
		if($coloi==FALSE) 
		{	
			print_r($a);
			$chuoimang=serialize($a);
			$chuoimang2=serialize($b);
			
			if(get_field("tbl_module","idshop",$idshop,"id")==""){
				$arrField = array(
				"idshop"          => "'".$idshop."'",
				"boxarray"        => "'".$chuoimang."'",
				"countleft"       => "'".$left."'",
				"modulearray"     => "'".$chuoimang2."'",
				"sl1"             => "'".$sl1."'",
				"sl2"             => "'".$sl2."'",
				"sl3"             => "'".$sl3."'",
				"heso"             => "'".$heso."'"
				
				); 
				insert("tbl_module",$arrField);
			}
			else {  
				$arrField = array(
				"boxarray"        => "'".$chuoimang."'",
				"countleft"       => "'".$left."'",
				"modulearray"      => "'".$chuoimang2."'",
				"sl1"             => "'".$sl1."'",
				"sl2"             => "'".$sl2."'",
				"sl3"             => "'".$sl3."'",
				"heso"             => "'".$heso."'"
				);  
				update("tbl_module",$arrField,"idshop=".$idshop);
			}
			
			if(get_field("tbl_count","idshop",$idshop,"id")==""){
				$arrField = array(
				"total"          => "'".$total."'",
				"datenow"        => "now()"
				
				); 
				insert("tbl_count",$arrField);
			}
			else {
				$arrField = array(
				"total"        => "'".$total."'",
				);  
				update("tbl_count",$arrField,"idshop=".$idshop);
			}
			
			echo thongbao($linkroot."/quantri/index.php?act=elementweb",$thongbao='Bạn vừa cấu hình thành phần của web thành công..!');
			
		}
	}
?>
<div class="cauhinh_tt" style=" height:530px;">
<form action="index.php?act=elementweb" method="post" name="frmForm" enctype="multipart/form-data">
<input type="hidden" name="act" value="elementweb">
<table border="0"  style="width:510px; float:left;">
          <tr>
            <td width="160" align="right" valign="top">&nbsp;</td>
            <td width="6" align="left" valign="top">&nbsp;</td>
            <td width="104" align="left" valign="top">Module trai - phải</td>
            <td width="46" align="left" valign="top">&nbsp;</td>
            <td width="70" align="center" valign="top"></td>
            <td width="126" align="left" valign="top"><span class="table_khung">Ẩn/hiện</span></td>
          </tr>
          <?php
		  	$i=1;
			$dem=count($box);
          	foreach ($box as $k=>$v){
				$ddk=$ddk.",".$v;
		  ?>
        <tr class="table_admin_tr">
           	  <td align="right" valign="middle" class="table_chu"><span class="sao"><?php if($v=="box_auto") echo "Phần tự soạn thảo";else echo module_keyword($mang11,$mang22,$v); ?></span>: </td>
           	  <td align="left" valign="top" class="table_khung">&nbsp;</td>
           	  <td align="left" valign="middle" class="table_khung"><input type="radio" name="bv<?php echo $i;?>" id="bv<?php echo $i;?>" value="1"   <?php if($ghinho==1 && find_module_inlist($v,$b)==1) echo 'checked="checked"';elseif($ghinho==0) echo 'checked="checked"';?> />
           	    Trái
                  <input type="radio" name="bv<?php echo $i;?>" id="bv<?php echo $i;?>" value="0" <?php if($ghinho==1 && find_module_inlist($v,$b)==0) echo 'checked="checked"';?>  />
                  Phải
                  <br />
                  <span class="coloi_hien">
                  <?=$coloi_hien_anhien ?>
              </span></td>
           	  <td align="left" valign="middle" class="table_khung">Thứ tự</td>
           	  <td align="left" valign="middle" class="table_khung">
   	      			<input style="width:40px;" type="text" name="bs<?php echo $i;?>" id="bs<?php echo $i;?>"  value="<?php if($ghinho==1 && find_module_inlist($v,$b)!=5) echo find_value_inlist($v,$b);else echo $i;?>" />
                    </td>
           	  <td align="left" valign="middle" class="table_khung">
                    <input type="radio" name="ba<?php echo $i;?>" id="ba<?php echo $i;?>" value="1"  <?php if($ghinho==1 && find_module_inlist($v,$b)!=5) echo 'checked="checked"';elseif($ghinho==0)echo 'checked="checked"'; ?> />
                Hiện
                <input type="radio" name="ba<?php echo $i;?>" id="ba<?php echo $i;?>" value="0" <?php if($ghinho==1 && find_module_inlist($v,$b)==5) echo 'checked="checked"';?>  />
                Ẩn <br />
                <span class="coloi_hien">
                <?=$coloi_hien_anhien ?>
                </span>&nbsp;
                </td>
          </tr>
          <?php $i++;if($i==13) break;}?>
         
  </table>
  <table border="0"  style="width:510px; float:left;">
          <tr>
            <td width="160" align="right" valign="top">&nbsp;</td>
            <td width="6" align="left" valign="top">&nbsp;</td>
            <td width="104" align="left" valign="top">Module trái - phải</td>
            <td width="46" align="left" valign="top">&nbsp;</td>
            <td width="70" align="center" valign="top"> </td>
            <td width="126" align="left" valign="top"><span class="table_khung">Ẩn/hiện</span></td>
          </tr>
          <?php
		  	$j=1; 
          	foreach ($box as $k=>$v){
				if($j>=$i){
				$ddk=$ddk.",".$v;
		  ?>
        <tr class="table_admin_tr">
           	  <td align="right" valign="middle" class="table_chu"><span class="sao"><?php if($v=="box_auto") echo "Phần tự soạn thảo";else echo module_keyword($mang11,$mang22,$v); ?></span>: </td>
           	  <td align="left" valign="top" class="table_khung">&nbsp;</td>
           	  <td align="left" valign="middle" class="table_khung"><input type="radio" name="bv<?php echo $i;?>" id="bv<?php echo $i;?>" value="1"   <?php if($ghinho==1 && find_module_inlist($v,$b)==1) echo 'checked="checked"';elseif($ghinho==0)echo 'checked="checked"';?> />
           	    Trái
                  <input type="radio" name="bv<?php echo $i;?>" id="bv<?php echo $i;?>" value="0" <?php if($ghinho==1 && find_module_inlist($v,$b)==0) echo 'checked="checked"';?>  />
                  Phải
                  <br />
                  <span class="coloi_hien">
                  <?=$coloi_hien_anhien ?>
              </span></td>
           	  <td align="left" valign="middle" class="table_khung">Thứ tự</td>
           	  <td align="left" valign="middle" class="table_khung">
   	      			<input style="width:40px;" type="text" name="bs<?php echo $i;?>" id="bs<?php echo $i;?>"  value="<?php if($ghinho==1 && find_module_inlist($v,$b)==1) echo find_value_inlist($v,$b);else echo $i;?>" />
                    </td>
           	  <td align="left" valign="middle" class="table_khung">
                    <input type="radio" name="ba<?php echo $i;?>" id="ba<?php echo $i;?>" value="1"  <?php if($ghinho==1 && find_module_inlist($v,$b)!=5) echo 'checked="checked"';elseif($ghinho==0)echo 'checked="checked"';?> />
                Hiện
                <input type="radio" name="ba<?php echo $i;?>" id="ba<?php echo $i;?>" value="0" <?php if($ghinho==1 && find_module_inlist($v,$b)==5) echo 'checked="checked"';?>  />
                Ẩn <br />
                <span class="coloi_hien">
                <?=$coloi_hien_anhien ?>
                </span>&nbsp;
                </td>
          </tr>
          <?php $i++;$j++;}else $j++;}?>
           <tr class="table_admin_tr">
           	  <td align="right" valign="middle" class="table_chu">Module</td>
              <td align="right" valign="middle" class="table_chu"> </td>
           	  <td align="left" valign="middle" class="table_khung">Trang chu</td>
           	  <td align="left" valign="middle" class="table_khung">&nbsp;</td>
           	  <td align="left" valign="middle" class="table_khung">&nbsp;</td>
              <td align="left" valign="middle" class="table_khung">&nbsp;</td>
          </tr>
         <?php
		  	$i=1;
          	foreach ($module as $k=>$v){
		  ?>
          <tr class="table_admin_tr">
           	  <td align="right" valign="middle" class="table_chu"><?php if($v=="auto") echo "Phần tự soạn thảo";else echo module_keyword($mang11,$mang22,$v); ?></td>
              <td align="right" valign="middle" class="table_chu"> </td>
           	  <td align="left" valign="middle" class="table_khung"> <div style="width:80px;"> </div></td>
           	  <td align="left" valign="middle" class="table_khung">Thứ tự</td>
           	  <td align="left" valign="middle" class="table_khung">
   	      			<input style="width:40px;" type="text" name="ms<?php echo $i;?>" id="ms<?php echo $i;?>"  value="<?php if($ghinho==1 && find_module_inlist($v,$c)!="") echo find_value_inlist2($v,$c);else echo $i;?>"  />
            </td>
              <td align="left" valign="middle" class="table_khung">
                  <input type="radio" name="ma<?php echo $i;?>" id="ma<?php echo $i;?>" value="1" <?php if($ghinho==1 && find_module_inlist($v,$c)!=5) echo 'checked="checked"';elseif($ghinho==0)echo 'checked="checked"';?> />
                Hiện
                <input type="radio" name="ma<?php echo $i;?>" id="ma<?php echo $i;?>" value="0" <?php if($ghinho==1 && find_module_inlist($v,$c)==5) echo 'checked="checked"';?>  />
                Ẩn <br />
                <span class="coloi_hien">
                <?=$coloi_hien_anhien ?>
                </span>&nbsp;
            </td>
          </tr>
          <?php $i++;}?>
  </table>
  <div  style="clear:both; float:none;"> </div>
  <div>
  <table width="966">
  	<tr class="table_admin_tr">
  	  <td height="37" colspan="3" align="center" valign="middle" class="table_chu">Số sản phẩm</td>
  	  <td align="left" valign="middle" class="table_khung">Số lượng</td>
  	  <td align="center" valign="middle" class="table_khung">&nbsp;</td>
  	  <td align="left" valign="middle" class="table_khung">Phần tự <a href="<?php echo $linkroot;?>/quantri/index.php?act=conauto">Soạn thào</a></td>
  	  <td align="center" valign="middle" class="table_khung"><span style="width:100px; margin:0 auto;">
  	    <input type="submit" name="them" class="nut_table" value="Chấp nhận" title="Chấp nhận hoàn thành "  style="z-index:9999;"/>
  	  </span></td>
	  </tr>
  	<tr class="table_admin_tr">
           	  <td height="24" colspan="3" align="center" valign="middle" class="table_chu">Ở trang chủ<br /></td>
           	  <td width="144" align="left" valign="middle" class="table_khung">
   	      			<input type="text" name="sl1" id="sl1"  value="<?php if($sl1!="") echo $sl1;else echo "10";?>"  />
            </td>
           	  <td width="186" align="center" valign="middle" class="table_khung"><span class="table_chu">Hệ số nhân truy cập web</span></td>
           	  <td width="160" align="left" valign="middle" class="table_khung"><input type="text" name="heso" id="heso"  value="<?php if($heso!="") echo $heso;else echo "0";?>"  /></td>
              <td width="144" align="center" valign="middle" class="table_khung">                &nbsp;Lượt truy cập</td>
          </tr>
          <tr class="table_admin_tr">
           	  <td height="31" colspan="3" align="center" valign="middle" class="table_chu">Danh mục sản phẩm<br /></td>
           	  <td align="left" valign="middle" class="table_khung">
   	      			<input type="text" name="sl2" id="sl2"  value="<?php if($sl2!="") echo $sl2;else echo "10";?>"  />
            </td>
           	  <td align="center" valign="middle" class="table_khung"><span class="table_chu">Số tin tức ở trang hiện nhiều tin</span></td>
           	  <td align="left" valign="middle" class="table_khung"><input type="text" name="sl3" id="sl3"  value="<?php if($sl3!="") echo $sl3;else echo "10";?>"  /></td>
              <td align="left" valign="middle" class="table_khung">        
              <input type="text" name="total" id="total"  value="<?php if($total!="") echo $total;else echo "0";?>"  /></td>
          </tr>
          <tr class="table_admin_tr">
           	  <td colspan="3" align="center" valign="middle" class="table_chu"><br /></td>
           	  <td align="left" valign="middle" class="table_khung">&nbsp;</td>
           	  <td align="center" valign="middle" class="table_khung">&nbsp;</td>
           	  <td align="left" valign="middle" class="table_khung">&nbsp;</td>
              <td align="left" valign="middle" class="table_khung"><br />                &nbsp;
            </td>
          </tr>
  </table>
  </div>
  <div style="width:100px; margin:0 auto;">&nbsp;&nbsp;
  </div>
</form>
</div>
 
