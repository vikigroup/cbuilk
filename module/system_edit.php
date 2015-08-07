<?php
include("../config.php");
include("../common_start.php");
include("../lib/func.lib.php");
?>

<label for="popSystemSelect" class="button-secondary">Chọn liên kết</label>
<select id="popSystemSelect" onchange="setValueSystem();">
    <?php
    $myArrSystemID = array();
    $myArrSystemName = array();
    $myArrSystemLink = array();
    $myArrSystemBackground = array();
    $myArrSystemColor = array();
    $myArrSystemDisplay = array();
    $system = get_records("tbl_system"," ","id"," "," ");
    while($row_system = mysql_fetch_assoc($system)){
        array_push($myArrSystemID, $row_system['id']);
        array_push($myArrSystemName, $row_system['module_name']);
        array_push($myArrSystemLink, $row_system['module_link']);
        array_push($myArrSystemBackground, $row_system['module_background']);
        array_push($myArrSystemColor, $row_system['module_color']);
        array_push($myArrSystemDisplay, $row_system['module_display']);
        ?>
        <option value="<?php echo $row_system['id']; ?>"><?php echo $row_system['module_name']; ?></option>
    <?php } ?>
</select>
<input type="hidden" id="hiddenSystemID" value='<?php echo json_encode($myArrSystemID); ?>'>
<input type="hidden" id="hiddenSystemName" value='<?php echo json_encode($myArrSystemName); ?>'>
<input type="hidden" id="hiddenSystemLink" value='<?php echo json_encode($myArrSystemLink); ?>'>
<input type="hidden" id="hiddenSystemBackground" value='<?php echo json_encode($myArrSystemBackground); ?>'>
<input type="hidden" id="hiddenSystemColor" value='<?php echo json_encode($myArrSystemColor); ?>'>
<input type="hidden" id="hiddenSystemDisplay" value='<?php echo json_encode($myArrSystemDisplay); ?>'>
