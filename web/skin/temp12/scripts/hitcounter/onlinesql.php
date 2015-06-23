<style type="text/css">
<!--
.count {
	font-size: 12px;
	font-weight: bold;
	color: #900;
	float: left;
	height: auto;
	width: 200px;
	text-align: left;
}

.count_bao {
	clear: both;
	float: none;
	width: 100%;
	height: auto;
	padding-left: 20px;
}

.chu {
	float: left;
	height: 25px;
	width: 70px;
	text-align: left;
	margin-top: 2px;
	margin-left: 2px;
}

.so {
	float: left;
	height: 25px;
	width: 75px;
	text-align: left;
	margin-top: 2px;
}

.hinh_count {
	float: left;
	width: 20px;
	margin-right: 5px;
}
-->
</style>

<?php
/*
Tao table: 
CREATE TABLE `users_online` (
`visitor` VARCHAR( 15 ) NOT NULL ,
`lastvisit` INT( 14 ) NOT NULL,
`username` VARCHAR( 100 ) NOT NULL );
*/
$uo_sessionTime = 5; //length in **minutes** to keep the user online before deleting
error_reporting(E_ERROR | E_PARSE);
mysql_select_db($uo_sqlbase);
$uo_ip = $_SERVER['REMOTE_ADDR'];

//cleanup part
$uo_query = "DELETE FROM users_online WHERE unix_timestamp() - lastvisit >= $uo_sessionTime * 60";
mysql_query($uo_query);

//check/insert part
$uo_query = "SELECT lastvisit FROM users_online WHERE visitor = '$uo_ip'";
$un=$_SESSION['kt_login_user'];
$uo_result = mysql_query($uo_query) or die (mysql_error());

if(mysql_num_rows($uo_result) == 0) { //no match
	$uo_query = "INSERT INTO users_online VALUES('$uo_ip', unix_timestamp(),'$un' )";
	mysql_query($uo_query) or die(mysql_error());
} else { //matched, update them
	$uo_query = "UPDATE users_online SET lastvisit = unix_timestamp(), username='$un' WHERE visitor = '$uo_ip'";
	mysql_query($uo_query);
}

//count part
if($uo_keepquiet == FALSE) {
	$uo_query = "SELECT count(*) FROM users_online";
	$uo_result = mysql_query($uo_query);
	$uo_count = mysql_fetch_row($uo_result);

/////////////////kiem tra trinh duyet/////////////////////

function getBrowser()

{
    $u_agent = $_SERVER['HTTP_USER_AGENT'];
    $bname = 'Unknown';
    $platform = 'Unknown';
    $version= "";
	
    //First get the platform?
    if (preg_match('/linux/i', $u_agent)) {
        $platform = 'linux';
    }

    elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
        $platform = 'mac';
    }

    elseif (preg_match('/windows|win32/i', $u_agent)) {
        $platform = 'windows';
    }

    // Next get the name of the useragent yes seperately and for good reason
    if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent))
    {
        $bname = 'Explorer';
        $ub = "MSIE";
    }

    elseif(preg_match('/Firefox/i',$u_agent))
    {
        $bname = 'Firefox';
        $ub = "Firefox";
    }
    elseif(preg_match('/Chrome/i',$u_agent))
    {
        $bname = 'Chrome';
        $ub = "Chrome";
    }
    elseif(preg_match('/Safari/i',$u_agent))
    {
        $bname = 'Safari';
        $ub = "Safari";
    }
    elseif(preg_match('/Opera/i',$u_agent))
    {
        $bname = 'Opera';
        $ub = "Opera";
    }
    elseif(preg_match('/Netscape/i',$u_agent))
    {
        $bname = 'Netscape';
        $ub = "Netscape";
    }

    // finally get the correct version number
    $known = array('Version', $ub, 'other');
    $pattern = '#(?<browser>' . join('|', $known) .
    ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
    if (!preg_match_all($pattern, $u_agent, $matches)) {
        // we have no matching number just continue
    }
	
    // see how many we have
    $i = count($matches['browser']);
    if ($i != 1) {
        //we will have two since we are not using 'other' argument yet
        //see if version is before or after the name
        if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){
            $version= $matches['version'][0];
        }
        else {
            $version= $matches['version'][1];
        }
    }
    else {
        $version= $matches['version'][0];
    }

    // check if we have a number
    if ($version==null || $version=="") {$version="?";}
    	return array(
        'userAgent' => $u_agent,
        'name'      => $bname,
        'version'   => $version,
        'platform'  => $platform,
        'pattern'    => $pattern
    );
}

// now try it
$ua=getBrowser();
$yourbrowser=$ua['name'] . " " . $ua['version'];
?>	

<div class=count>
	<div style="float:none; clear:both; width:100%; height:1px">&nbsp;</div> 
    <div class="count_bao">
        <img class="hinh_count" src="<?php echo $host_link_full ;?>/scripts/hitcounter/hitcounter/dangxem.png" align=baseline />
  	  <div class=chu>Đang xem </div>
  	  <div class=so>: <?php echo  $uo_count[0] ?></div>
        <div style="float:none; clear:both; width:100%; height:1px">&nbsp;</div>
  </div>
<?php	
	$uo_query = "SELECT count(*) FROM users_online where username <>''";
	$uo_result = mysql_query($uo_query);
	$uo_count = mysql_fetch_row($uo_result);
?>	

    <div class="count_bao"> 
        <img class="hinh_count" src="<?php echo $host_link_full ;?>/scripts/hitcounter/hitcounter/thanhvien.png" align=baseline />
  	  <div class=chu>Thành viên</div>
        <div class=so>: <?php echo $uo_count[0] ?></div>
        <div style="float:none; clear:both; width:100%; height:1px">&nbsp;</div>
  </div>



<?php
	$uo_query = "SELECT count(*) FROM users_online where username =''";
	$uo_result = mysql_query($uo_query);
	$uo_count = mysql_fetch_row($uo_result);
?>

    <div class="count_bao">
   	  	<img class="hinh_count" src="<?php echo $host_link_full ;?>/scripts/hitcounter/hitcounter/khach.png" align=baseline />
  	  <div class=chu>Khách </div>
        <div class=so>: <?php echo $uo_count[0] ?></div>
        <div style="float:none; clear:both; width:100%; height:1px">&nbsp;</div>
  </div>
     <div class="count_bao">
   	  	<img class="hinh_count" src="<?php echo $host_link_full ;?>/scripts/hitcounter/hitcounter/trinhduyet.png" align=baseline />
		<div style="margin-top:2px; height:25px; float:left"><?php echo $yourbrowser ?></div>
        <div style="float:none; clear:both; width:100%; height:1px">&nbsp;</div>
  	</div>   

    <div class="count_bao">
  	  <img class="hinh_count" src="<?php echo $host_link_full ;?>/scripts/hitcounter/hitcounter/ip.png" align=baseline />
  	  	<div style="margin-top:2px; height:25px; float:left">Địa chỉ IP : <? echo getenv('REMOTE_ADDR'); ?></div>
        <div style="float:none; clear:both; width:100%; height:1px">&nbsp;</div>
  	</div> 

     <div class="count_bao">
  	  	<img class="hinh_count" src="<?php echo $host_link_full ;?>/scripts/hitcounter/hitcounter/gio.png" align=baseline />
        <div style="margin-top:2px; height:25px; float:left">Ngày : <? echo date('d-m-y H:i:s'); ?></div>
        <div style="float:none; clear:both; width:100%; height:1px">&nbsp;</div>
  	</div> 

   <div class="count_bao">
  	  	<img class="hinh_count" src="<?php echo $host_link_full ;?>/scripts/hitcounter/hitcounter/hdh.png" align=baseline />
        <div style="margin-top:2px; height:25px; float:left">Hệ điều hành : <? echo $ua['platform'] ?></div>
        <div style="float:none; clear:both; width:100%; height:1px">&nbsp;</div>
  	</div> 
             <br />
    <div class="count_bao">
    	<img src="<?php echo $host_link_full ;?>/scripts/hitcounter/hitcounter/counter.php" height="20">
   </div> 
</div>
<?php }?>