<?php
	$tenchuyenmuc=$_GET['tenchuyenmuc'];
    $sql="select * FROM tbl_news WHERE subject='".$tenchuyenmuc."' and status=0";
	$rs=mysql_query($sql);
	$dem=mysql_num_rows($rs);
	$rowtin=mysql_fetch_assoc($rs);
	if($dem<= 0) echo  '<script>window.location="'.$linkroot.'/404-page-not-found.html" </script>';
?>
<div class="content">
    <div class="frame_nd">
    
        <h1 class="title_fnd">
           <?php echo  $rowtin['name'] ?>
        </h1><!-- End .title_fnd -->
        
        <div class="main_fnd">
        
            <table>
                <tr>
                    <td>                                
            
                        <h1 class="text_title_news">  <?php echo  $rowtin['name'] ?></h1>
                        
                        <p>
                            <b>
                                <?php echo  $rowtin['detail_short'] ?>
                            </b>
                        </p>
                        
                        <div>
            
                            <?php echo  $rowtin['detail'] ?>
                            
                        </div>
            
                    </td>                            
                </tr>                            
            </table>
        
            <div class="clear2"></div>
        
        </div><!-- End .main_fnd -->
        
        
        <div class="main_frame_text">
            <div class="title_mft">&bull; Các tin khác</div>
            <div class="main_news_other">                    
                
                <ul>
                        <?php
                        $parent=$rowtin['parent'];
                        $id1=$rowtin['id']-5;
                        $id2=$rowtin['id']+5;
                        $new=get_records("tbl_news","status=0 AND parent='{$parent}' AND idshop='{$idshop}' AND id > '{$id1}' AND id < '{$id2}' ","id DESC","0,10"," ");
                        while($row_new=mysql_fetch_assoc($new)){
                        ?>
                        <li>
                             <a href="thong-tin-chuyen-muc/<?php echo $row_new['subject']?>.html" title="">-:- <?php echo $row_new['name']?> </a>
                        </li>
                        <?php }?> 
                    </ul>
                                
            </div><!-- End .main_news_other -->
        
        </div><!-- End .main_frame_text -->
    
    </div>
</div>