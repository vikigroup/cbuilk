<?php
    $servername = "localhost";
    $username = "cbuilk_2015";
    $password = "123456P";
    $dbname = "cbuilk_2015";

    $functionName = filter_input(INPUT_POST, 'functionName');

    if($functionName == "insertOrder"){
        insertOrder();
    }

    function connect(){
        // Create connection
        $conn = new mysqli($GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        else{
            return $conn;
        }
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

    function close($conn){
        $conn->close();
    }
?>