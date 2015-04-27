<article class="dmsp ads-top ads-article">
    <?php
    $dt = date("Y-m-d");
    $adv_top_left = "SELECT *, COUNT(id) AS amount FROM tbl_adv WHERE status = 0 AND start_banner <= '".$dt."' AND '".$dt."' <= finish_banner AND main_position = 0 AND sub_position = 0 ORDER BY date_added LIMIT 1";
    if ($result0 = mysql_query($adv_top_left,$conn)) {
        $row0=mysql_fetch_array($result0);
        if($row0['amount'] > 0){
            if($row0['image'] != ''){
                echo '<a href="'.$row0['link'].'" target="_blank"><img class="ads-top-left-right" src="../web/'.$row0['image'].'" alt="'.$row0['name'].'"></a>';
            }
            else{
                echo '<a href="'.$row0['link'].'" target="_blank"><img class="ads-top-left-right" src="http://placehold.it/190x330&text=No Image" alt="'.$row0['name'].'"></a>';
            }
        }
        else{
            echo '<a class="ads-logo" target="_blank"><img class="ads-top-left-right" src="http://placehold.it/190x330"></a>';
        }
    }
    ?>
</article>
<article class="ads-home ads-top ads-article">
    <!-- line 1 -->
    <?php
    $adv_top_center1=get_records("tbl_adv","status = 0 AND start_banner <= '".$dt."' AND '".$dt."' <= finish_banner AND main_position = 1 AND sub_position = 9","date_added","6"," ");
    $total1 = 0;
    while($row1=mysql_fetch_assoc($adv_top_center1)){
        if($row1['image'] != ''){
            echo '<a class="ads-logo push" href="'.$row1['link'].'" target="_blank"><img src="../web/'.$row1['image'].'" alt="'.$row1['name'].'"></a>';
        }
        else{
            echo '<a class="ads-logo push" href="'.$row1['link'].'" target="_blank"><img src="http://placehold.it/90x45&text=No Image" alt="'.$row1['name'].'"></a>';
        }
        $total1++;
    }
    if($total1 < 6){
        for($i1 = 0; $i1 < (6 - $total1); $i1++){
            echo '<a class="ads-logo push" target="_blank"><img src="http://placehold.it/90x45"></a>';
        }
    }
    ?>

    <!-- line 2 -->
    <?php
    $adv_top_center1=get_records("tbl_adv","status = 0 AND start_banner <= '".$dt."' AND '".$dt."' <= finish_banner AND main_position = 1 AND sub_position = 10","date_added","6"," ");
    $total1 = 0;
    while($row1=mysql_fetch_assoc($adv_top_center1)){
        if($row1['image'] != ''){
            echo '<a class="ads-logo push" href="'.$row1['link'].'" target="_blank"><img src="../web/'.$row1['image'].'" alt="'.$row1['name'].'"></a>';
        }
        else{
            echo '<a class="ads-logo push" href="'.$row1['link'].'" target="_blank"><img src="http://placehold.it/90x45&text=No Image" alt="'.$row1['name'].'"></a>';
        }
        $total1++;
    }
    if($total1 < 6){
        for($i1 = 0; $i1 < (6 - $total1); $i1++){
            echo '<a class="ads-logo push" target="_blank"><img src="http://placehold.it/90x45"></a>';
        }
    }
    ?>

    <!-- line 3 -->
    <?php
    $adv_top_center1=get_records("tbl_adv","status = 0 AND start_banner <= '".$dt."' AND '".$dt."' <= finish_banner AND main_position = 1 AND sub_position = 11","date_added","6"," ");
    $total1 = 0;
    while($row1=mysql_fetch_assoc($adv_top_center1)){
        if($row1['image'] != ''){
            echo '<a class="ads-logo push" href="'.$row1['link'].'" target="_blank"><img src="../web/'.$row1['image'].'" alt="'.$row1['name'].'"></a>';
        }
        else{
            echo '<a class="ads-logo push" href="'.$row1['link'].'" target="_blank"><img src="http://placehold.it/90x45&text=No Image" alt="'.$row1['name'].'"></a>';
        }
        $total1++;
    }
    if($total1 < 6){
        for($i1 = 0; $i1 < (6 - $total1); $i1++){
            echo '<a class="ads-logo push" target="_blank"><img src="http://placehold.it/90x45"></a>';
        }
    }
    ?>

    <!-- line 4 -->
    <?php
    $adv_top_center1=get_records("tbl_adv","status = 0 AND start_banner <= '".$dt."' AND '".$dt."' <= finish_banner AND main_position = 1 AND sub_position = 12","date_added","6"," ");
    $total1 = 0;
    while($row1=mysql_fetch_assoc($adv_top_center1)){
        if($row1['image'] != ''){
            echo '<a class="ads-logo push" href="'.$row1['link'].'" target="_blank"><img src="../web/'.$row1['image'].'" alt="'.$row1['name'].'"></a>';
        }
        else{
            echo '<a class="ads-logo push" href="'.$row1['link'].'" target="_blank"><img src="http://placehold.it/90x45&text=No Image" alt="'.$row1['name'].'"></a>';
        }
        $total1++;
    }
    if($total1 < 6){
        for($i1 = 0; $i1 < (6 - $total1); $i1++){
            echo '<a class="ads-logo push" target="_blank"><img src="http://placehold.it/90x45"></a>';
        }
    }
    ?>
</article>
<article class="dmsp1 ads-top ads-article">
    <?php
    $adv_top_right = "SELECT *, COUNT(id) AS amount FROM tbl_adv WHERE status = 0 AND start_banner <= '".$dt."' AND '".$dt."' <= finish_banner AND main_position = 3 AND sub_position = 0 ORDER BY date_added LIMIT 1";
    if ($result = mysql_query($adv_top_right,$conn)) {
        $row=mysql_fetch_array($result);
        if($row['amount'] > 0){
            if($row['image'] != ''){
                echo '<a href="'.$row['link'].'" target="_blank"><img class="ads-top-left-right" src="../web/'.$row['image'].'" alt="'.$row['name'].'"></a>';
            }
            else{
                echo '<a href="'.$row['link'].'" target="_blank"><img class="ads-top-left-right" src="http://placehold.it/190x330&text=No Image" alt="'.$row['name'].'"></a>';
            }
        }
        else{
            echo '<a target="_blank"><img class="ads-top-left-right" src="http://placehold.it/190x330"></a>';
        }
    }
    ?>
</article>
