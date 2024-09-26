<?php
    // $p_name   = $_POST["name"];
    // $p_num    = $_POST["num"];
    // $p_remark = $_POST["remark"];
    // $p_price  = $_POST["price"];


    $servername = "localhost";
    $username = "owner";
    $password = "123456";
    $dbname = "testdb";

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if(!$conn){
        die("連線失敗!" .mysqli_connect_error());
    }

    $sql = "INSERT INTO product(Name, Num, Remark, Price) VALUES(55, 55, 55, 55)";

    if(mysqli_query($conn, $sql)){
        echo '{"state" : "true", "message" : "新增成功"}';
    }else{
        echo '{"state" : "false", "message" : "新增失敗'.$sql.mysqli_error($conn).'"}';
    }

    mysqli_close($conn);
?>
