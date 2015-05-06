<?php
    $servername = "cpcmart.com";
    $username = "cpcmart";
    $password = "12345678P";
    $dbname = "cpcmart_1811";

    $functionName = filter_input(INPUT_POST, 'functionName');

    if($functionName == "getStatus"){
        getStatus();
    }

    if($functionName == "insertBooking"){
        insertBooking();
    }

    if($functionName == "updateBooking"){
        updateBooking();
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

    function getStatus(){
        $paymentCode = filter_input(INPUT_POST, 'paymentCode');
        $conn = connect();
        $sql = "SELECT payment_status FROM payment WHERE payment_code = '$paymentCode'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                echo $row["payment_status"];
            }
        } else {
            echo 0;
        }
        close($conn);
    }

    function insertBooking(){
        $paymentCode = filter_input(INPUT_POST, 'paymentCode');
        $paymentAmount = filter_input(INPUT_POST, 'total');
        $paymentStatus = "InProgress";
        $paymentDateTime = date("Y-m-d H:i:s");
        $bookerName = filter_input(INPUT_POST, 'firstName');
        $toursName = filter_input(INPUT_POST, 'tours');
        $emailAddress = filter_input(INPUT_POST, 'emailAddress');

        $conn = connect();
        $sql = "INSERT INTO payment VALUES ('$paymentCode', '$paymentAmount', '$paymentStatus', '$paymentDateTime', null, '$bookerName', '$emailAddress', '$toursName')";

        if ($conn->query($sql) === TRUE) {
            echo 1;
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        close($conn);
    }

    function updateBooking(){
        $paymentCode = filter_input(INPUT_POST, 'paymentCode');
        if(checkPaymentCode($paymentCode) == 1){
            $paymentStatus = filter_input(INPUT_POST, 'paymentStatus');
            $transactionID = filter_input(INPUT_POST, 'transactionID');
            $conn = connect();
            $sql = "UPDATE payment SET payment_status = '$paymentStatus', transaction_id = '$transactionID' WHERE payment_code = '$paymentCode'";
            if ($conn->query($sql) === TRUE) {
                echo 1;
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
            close($conn);
        }
        else{
            echo 0;
        }
    }

    function checkPaymentCode($paymentCode){
        $conn = connect();
        $sql = "SELECT * FROM payment WHERE payment_code = '$paymentCode'";
        $result = $conn->query($sql);
        return $result->num_rows;
        close($conn);
    }

    function close($conn){
        $conn->close();
    }
?>