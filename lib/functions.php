<?php
require("../database.php");

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

function connect(){
    // Create connection
    $conn = new mysqli($GLOBALS['hostname'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['databasename']);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    else{
        return $conn;
    }
}

function selectUserEmail(){
    $userName = filter_input(INPUT_POST, 'userName');
    $email = selectField("tbl_customer", "email", "username='".$userName."'");
    echo $email;
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
    $isExist = selectCondition("tbl_customer", "randomkey='".$key."'");
    if($isExist == 1){
        $check = selectField("tbl_customer", "active", "randomkey='".$key."'");
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

function close($conn){
    $conn->close();
}
?>