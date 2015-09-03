<?php
require("../database.php");
header('Content-Type: text/html; charset=utf-8');
session_start();
date_default_timezone_set('Asia/Ho_Chi_Minh');
$dt = date("Y-m-d H:i:s");

$functionName = filter_input(INPUT_POST, 'functionName');

if($functionName == "insertOrder"){
    insertOrder();
}

if($functionName == "updateBrand"){
    updateBrand();
}

if($functionName == "updateCustomerActive"){
    updateCustomerActive();
}

if($functionName == "selectUserEmail"){
    selectUserEmail();
}

if($functionName == "checkUserEmail"){
    checkUserEmail();
}

if($functionName == "checkCodeFP"){
    checkCodeFP();
}

if($functionName == "changePassWord"){
    changePassWord();
}

if($functionName == "checkRestorePassWord"){
    checkRestorePassWord();
}

if($functionName == "updateRandomKey"){
    updateRandomKey();
}

if($functionName == "checkLoginSocial"){
    checkLoginSocial();
}

if($functionName == "updateTimeView"){
    updateTimeView();
}

if($functionName == "loadMoreMainSubCategory"){
    loadMoreMainSubCategory();
}

if($functionName == "updateSystemEdit"){
    updateSystemEdit();
}

if($functionName == "emptySessionCategory"){
    emptySessionCategory();
}

if($functionName == "removeUnicode"){
    removeUnicode();
}

function connect(){
    // Create connection
    $conn = new mysqli($GLOBALS['hostname'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['databasename']);
    // Change character set to utf8
    mysqli_set_charset($conn,"utf8");
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    else{
        return $conn;
    }
}

function removeUnicode(){
    $id = filter_input(INPUT_POST, 'id');
    $string = filter_input(INPUT_POST, 'string');
    $subject = remove_unicode($string);
    $isPost = filter_input(INPUT_POST, 'isPost');
    $table = "tbl_shop_category";
    if($isPost == 1){
        $table = "tbl_item";
    }
    $check = selectCondition($table, "subject = '".$subject."' AND id != '".$id."'");
    if($check == 1){
        $idCate = maxID("id", $table)+1;
        $subject .= "-".$idCate;
    }
    echo $subject;
}

function updateSystemEdit(){
    $id = filter_input(INPUT_POST, 'id');
    $name = filter_input(INPUT_POST, 'name');
    $link = filter_input(INPUT_POST, 'link');
    $backGround = filter_input(INPUT_POST, 'backGround');
    $color = filter_input(INPUT_POST, 'color');
    $display = filter_input(INPUT_POST, 'display');
    $check = update("tbl_system", "module_name = '".$name."', module_link = '".$link."', module_background = '".$backGround."'
    , module_color = '".$color."', module_display = '".$display."'", "id = '".$id."'");
    echo $check;
}

function loadMoreMainSubCategory(){
    $id = filter_input(INPUT_POST, 'id');
    $start = filter_input(INPUT_POST, 'start');
    $result = selectData("tbl_shop_category", "parent = '".$id."' ORDER BY sort, name COLLATE utf8_unicode_ci LIMIT ".$start.",20");
    if($result != 0){
        $data = "";
        while($row = $result->fetch_assoc()) {
            $data .= $row['subject'].",".$row['name'].",".$row['target'].";";
        }
        $isMore = 0;
        $dataMore = selectData("tbl_shop_category", "parent = '".$id."' ORDER BY sort, name COLLATE utf8_unicode_ci LIMIT ".($start+20).",20");
        if($dataMore != 0){
            $isMore = 1;
        }
        $data .= $isMore;
        echo $data;
    }
    else{
        echo 0;
    }
}

function updateTimeView(){
    $id = filter_input(INPUT_POST, 'id');
    $totalSeconds = floor(filter_input(INPUT_POST, 'totalSeconds'));
    $check = update("tbl_item", "time_view = time_view + '".$totalSeconds."'", "id = '".$id."'");
    echo $check;
}

function checkLoginSocial(){
    $date = $GLOBALS['dt'];
    $name = filter_input(INPUT_POST, 'name');
    $image = filter_input(INPUT_POST, 'image');
    $userName = strtolower(preg_replace("/\s/", "", remove_unicode($name)));
    $id = filter_input(INPUT_POST, 'id');
    $userName .= $id;
    $email = filter_input(INPUT_POST, 'email');
    $gender = 0;
    if(filter_input(INPUT_POST, 'gender') == 1){
        $gender = 1;
    }
    $isExist = selectCondition("tbl_customer", "username = '".$userName."'");
    if($isExist == 0){
        $idCustomer = maxID("id", "tbl_customer")+1;
        $sql = "INSERT INTO tbl_customer VALUES ('$idCustomer', n'$name', '$gender', '', '$image', '$userName', '', '', '', '$email', '', '$date', '0', '$date', '1', '1', '', '', '')";
        $result = query($sql);
        if($result == 1){
            $_SESSION['kh_login_id'] = $idCustomer;
            $_SESSION['kh_login_username'] = $userName;
            echo 1;
        }
        else{
            echo 0;
        }
    }
    else{
        $_SESSION['kh_login_id'] = selectField("tbl_customer", "id", "email = '".$email."' AND image LIKE '%http%'");
        $_SESSION['kh_login_username'] = selectField("tbl_customer", "username", "email = '".$email."' AND image LIKE '%http%'");
        echo 1;
    }
}

function selectUserEmail(){
    $userName = filter_input(INPUT_POST, 'userName');
    $email = selectField("tbl_customer", "email", "username = '".$userName."'");
    echo $email;
}

function checkUserEmail(){
    $email = filter_input(INPUT_POST, 'email');
    $isExist = selectCondition("tbl_customer", "email = '".$email."' AND image NOT LIKE '%http%'");
    if($isExist == 1){
        $active = selectField("tbl_customer", "active", "email = '".$email."'");
        if($active == 0){
            echo 2;
        }
        else{
            $code = mt_rand(100000, 999999); //random 1 chuoi gom 6 ky tu so
            $check = update("tbl_customer", "randomcode = '".$code."', last_modified = '".$GLOBALS['dt']."'", "email = '".$email."'");
            if($check != 1){
                echo 0;
            }
            else{
                echo 1;
            }
        }
    }
    else{
        echo 0;
    }
}

function checkCodeFP(){
    $email = filter_input(INPUT_POST, 'email');
    $code = filter_input(INPUT_POST, 'code');
    $check = selectCondition("tbl_customer", "email = '".$email."' AND randomcode = '".$code."'");
    echo $check;
}

function changePassWord(){
    $email = filter_input(INPUT_POST, 'email');
    $pass = md5(md5(md5(filter_input(INPUT_POST, 'passWord'))));
    $result = update("tbl_customer", "password = '".$pass."'", "email = '".$email."'");
    if($result != 1){
        echo 0;
    }
    else{
        $key = substr(str_shuffle(implode(array_merge(range(0,9), range('A', 'Z'), range('a', 'z')))), 0, 50);
        $check = update("tbl_customer", "randomkey = '".$key."'", "email = '".$email."'");
        if($check != 1){
            echo 0;
        }
        else{
            echo $key;
        }
    }
}

function checkRestorePassWord(){
    $restoreKey = filter_input(INPUT_POST, 'restoreKey');
    $check = selectCondition("tbl_customer", "randomkey = '".$restoreKey."'");
    if($check == 0){
        echo 0;
    }
    else{
        $email = selectField("tbl_customer", "email", "randomkey = '".$restoreKey."'");
        echo $email;
    }
}

function updateRandomKey(){
    $email = filter_input(INPUT_POST, 'email');
    $key = substr(str_shuffle(implode(array_merge(range(0,9), range('A', 'Z'), range('a', 'z')))), 0, 50);
    $check = update("tbl_customer", "randomkey = '".$key."'", "email = '".$email."'");
    echo $check;
}

function insertOrder(){
    $dt = date("Y-m-d H:i:s");
    $name = filter_input(INPUT_POST, 'name');
    $phone = filter_input(INPUT_POST, 'phone');
    $address = filter_input(INPUT_POST, 'address');
    $email = filter_input(INPUT_POST, 'email');
    $idProduct = filter_input(INPUT_POST, 'idProduct');
    $amount = filter_input(INPUT_POST, 'amount');
    $unit = filter_input(INPUT_POST, 'unit');
    $idShop = filter_input(INPUT_POST, 'idShop');
    $total = filter_input(INPUT_POST, 'total');
    $idCustomer = filter_input(INPUT_POST, 'idCustomer');

    $idDH = maxID("id", "tbl_donhang")+1;

    $conn = connect();
    $sql1 = "INSERT INTO tbl_donhang VALUES ('$idDH', '$idShop', '$total', '$idCustomer', '$phone', '$dt', n'$name', n'$address', '$email', 0, 0, null)";

    if ($conn->query($sql1) === TRUE) {
        $sql2 = "INSERT INTO tbl_donhangchitiet(idDH, idSP, SoLuong, DonGia) VALUES ('$idDH', '$idProduct', '$amount', '$unit')";
        if ($conn->query($sql2) === TRUE) {
            echo 1;
        } else {
            echo "Error: " . $sql2 . "<br>" . $conn->error;
        }
    } else {
        echo "Error: " . $sql1 . "<br>" . $conn->error;
    }
    close($conn);
}

function maxID($id, $table){
    $conn = connect();
    $sql = "SELECT MAX(".$id.") AS maxID FROM ".$table;
    $result = $conn->query($sql);
    while($row = $result->fetch_assoc()) {
        return $row["maxID"];
    }
    close($conn);
}

function updateBrand(){
    $dt = date("Y-m-d H:i:s");
    $brandID = filter_input(INPUT_POST, 'popBrandID');
    $brandName = filter_input(INPUT_POST, 'popBrandName');
    $brandLink = filter_input(INPUT_POST, 'popBrandLink');
    $brandStyle = filter_input(INPUT_POST, 'popBrandStyle');
    echo update("tbl_item", "last_modified = '".$dt."', brand_name = n'".$brandName."', brand_link = '".$brandLink."', brand_style = '".$brandStyle."'", "id = '".$brandID."'");
}

function updateCustomerActive(){
    $key = filter_input(INPUT_POST, 'activeKey');
    $isExist = selectCondition("tbl_customer", "randomkey = '".$key."'");
    if($isExist == 1){
        $check = selectField("tbl_customer", "active", "randomkey = '".$key."'");
        if($check == 0){
            echo update("tbl_customer", "active = '1'", "randomkey = '".$key."'");
        }
        else{
            echo 0;
    }
    }
    else{
        echo 0;
    }
}

//------------------------ admin functions ------------------------//
function emptySessionCategory(){
    $_SESSION['kt_tukhoa_bignew']=-1;
    $_SESSION['kt_parent_bignew']=-1;
    $_SESSION['kt_ddCatch_bignew']=-1;
    unset($_SESSION['error']);
}
//------------------------ admin functions ------------------------//

function update($table, $field, $condition){
    $conn = connect();
    $sql = "UPDATE ".$table." SET ".$field." WHERE ".$condition;
    if ($conn->query($sql) === TRUE) {
        return 1;
    } else {
        return "Error updating record: " . $conn->error;
    }
    $conn->close();
}

//select data
function selectData($table, $condition){
    $conn = connect();
    $sql = "SELECT * FROM ".$table." WHERE ".$condition;
    if($condition == ''){
        $sql = "SELECT * FROM ".$table;
    }
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        return $result;
    } else {
        return 0;
    }
    close($conn);
}

//select with a specified field
function selectField($table, $field, $condition){
    $conn = connect();
    if($condition != ""){
        $sql = "SELECT * FROM ".$table." WHERE ".$condition;
    }
    else{
        $sql = "SELECT * FROM ".$table;
    }

    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            return $row[$field];
        }
    } else {
        return "0 results";
    }
    $conn->close();
}

//select with a specified condition (check existence)
function selectCondition($table, $condition){
    $conn = connect();
    $sql = "SELECT * FROM ".$table." WHERE ".$condition;
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        return 1;
    } else {
        return 0;
    }
    $conn->close();
}

function query($sql){
    $conn = connect();
    if ($conn->query($sql) === TRUE) {
        return 1;
    } else {
        return $conn->error;
    }
    $conn->close();
}

function close($conn){
    $conn->close();
}

function remove_unicode($str) {
$str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $str);
  $str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $str);
  $str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $str);
  $str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $str);
  $str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $str);
  $str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $str);
  $str = preg_replace("/(đ)/", 'd', $str);
  $str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'A', $str);
  $str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'E', $str);
  $str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $str);
  $str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'O', $str);
  $str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'U', $str);
  $str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'Y', $str);
  $str = preg_replace("/(Đ)/", 'D', $str);
  return $str;
}
?>