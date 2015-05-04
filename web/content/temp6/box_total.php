<? 
$humnay=date("Y-m-d");
$heso=get_field("tbl_module","idshop",$idshop,"heso");
if($heso=="") $heso=0;
if(!isset($_SESSION['online'])){ 
	mysql_query("insert into tbl_visitor (session_id, idshop , activity, ip_address, url, user_agent) values ('".session_id()."','$idshop', now(), '{$_SERVER['REMOTE_ADDR']}', '{$_SERVER['HTTP_REFERER']}', '{$_SERVER['HTTP_USER_AGENT']}')"); 
	$_SESSION['online']=true;
	if(get_field("tbl_count","idshop",$idshop,"total")=="") mysql_query("insert into tbl_count (idshop , total ,datenow) values ('$idshop', ".$heso." ,'".$humnay."')");
	else mysql_query("update tbl_count set total=total+1*".$heso." where idshop=".$idshop); 
	
	if(get_field("tbl_count","idshop",$idshop,"datenow")==$humnay) mysql_query("update tbl_count set today=today+".$heso." where idshop=".$idshop);
	else { 
		mysql_query("update tbl_count set today=".$heso." where idshop=".$idshop);
		mysql_query("update tbl_count set datenow='".$humnay."' where idshop=".$idshop);
	}

} else { 
if(isset($_SESSION['member']))
	mysql_query("update tbl_visitor set activity=now(), member='y' where session_id='".session_id()."'"); 
else
	mysql_query("update tbl_visitor set activity=now(), member='n' where session_id='".session_id()."'"); 
}
$visitorTimeout=60*5;
$maxtime = $visitorTimeout; // 5 Minute time out. 60 * 5 = 300 
mysql_query("delete from tbl_visitor where UNIX_TIMESTAMP(activity) < UNIX_TIMESTAMP(now())-$maxtime"); 


//$guest  = countRecord("tbl_visitor","member='n'");
//$members = countRecord("tbl_visitor","member='y'");
//$members = countRecord("tbl_visitor","member='y'");
//$guest=dem_table("tbl_visitor"," "," ");
$guest=countRecord("tbl_visitor","idshop=".$idshop)+$heso;
$rConfig = getRecord('tbl_count',"idshop =".$idshop);
$total_visits = $rConfig['total'];
$total_visits_today = $rConfig['today'];

//$total_visits = ten_table('tbl_config','code',"total_visits",'detail');
?>
<div class="qc_tai">
	<div class="title_cate_w">
       <?php echo module_keyword($mang11,$mang22,"box_total");?>
    </div><!-- End .title_cate_w -->
    <div>
    	  <div style="padding:5px;">
            Số người đang online:  <?php if ($guest<=0) { echo "1"; } else { echo $guest +$heso;} ?><br>
            Số truy cập hôm nay: <?php echo $total_visits_today;?> <br />
            Tổng số người truy cập: <?php echo $total_visits;?>
        </div>
    </div>
</div>