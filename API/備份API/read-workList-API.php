<?php
    require_once("conn.php");
    $link = create_connection();
    $sql = "SELECT * FROM work ORDER BY ID DESC";
    $result = execute_sql($link, "myproject", $sql);
    $mydata = array();
    while($row = mysqli_fetch_assoc($result)){
        $mydata[] = $row;
    }
        echo '{"state" : true, "message" : "讀取資料成功!", "data" : '. json_encode($mydata) .'}';
    mysqli_close($link);
?>