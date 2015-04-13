<?php
header("content-type: text/xml");

require("config.php");
require("common_start.php");
include("lib/func.lib.php");
	
$theloai=$_GET['theloai'];

if($theloai!="") {

$row_theloai_tin_index=getRecord('jbs_news_category', "subject='".$theloai."'"); 


if($row_theloai_tin_index['id']==""){

print '<?xml version="1.0" encoding="utf-8"?>
<rss version="2.0">
  <channel>
    <title>RSS news</title>
    <description>Thám tử tam long</description>
    <link>http://thamtutamlong.com</link>
    <copyright>www.thamtutamlong.com</copyright>
    <generator>thamtutamlong.com</generator>
    <pubDate>'.$ngay.'</pubDate>
    <lastBuildDate>'.$ngay.'</lastBuildDate>';

print '
           <item>
            <title>'.$rs['title'].'</title>
            <description>'.$rs['intro'].'</description>
            <link>http://phpbasic.com/?php=article&amp;basic=view&amp;id='.$rs['id'].'</link>
            <pubDate>'.$rs['date'].'</pubDate>
        </item>
';

print '
  </channel>
</rss>
';	
}
else {
$theloai_tincungloai_index=get_records("jbs_news","status=0 and parent='".$row_theloai_tin_index['id']."'","last_modified DESC","0,20"," ");

print '<?xml version="1.0" encoding="utf-8"?>
<rss version="2.0">
  <channel>
    <title>'.$row_theloai_tin_index['name'].'</title>
    <description>'.$row_theloai_tin_index['description'].'</description>
    <link>http://thamtutamlong.com</link>
    <copyright>www.thamtutamlong.com</copyright>
    <generator>thamtutamlong</generator>
    <pubDate>'.$ngay.'</pubDate>
    <lastBuildDate>'.$ngay.'</lastBuildDate>';
while($row=mysql_fetch_assoc($theloai_tincungloai_index)){
print '
           <item>
            <title>'.$row['name'].'</title>
            <description>'.catchuoi_tuybien($row['detail'],20).'</description>
            <link>http://thamtutamlong.com/chitiettin/'.$row['tenkodau'].'/</link>
            <pubDate>'.$row['ngay'].'</pubDate>
        </item>
';
}
print '
  </channel>
</rss>
';
}
}else {

print '<?xml version="1.0" encoding="utf-8"?>
<rss version="2.0">
  <channel>
    <title>RSS news</title>
    <description>Thám tử tam long</description>
    <link>http://thamtutamlong.com</link>
    <copyright>www.thamtutamlong.com</copyright>
    <generator>thamtutamlong.com</generator>
    <pubDate>'.$ngay.'</pubDate>
    <lastBuildDate>'.$ngay.'</lastBuildDate>';

print '
           <item>
            <title>'.$rs['title'].'</title>
            <description>'.$rs['intro'].'</description>
            <link>http://phpbasic.com/?php=article&amp;basic=view&amp;id='.$rs['id'].'</link>
            <pubDate>'.$rs['date'].'</pubDate>
        </item>
';

print '
  </channel>
</rss>
';
}
?>