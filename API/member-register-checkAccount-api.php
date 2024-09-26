<?php
    $data = file_get_contents("php://input", "r");
    $mydata = array();
    $mydata = json_decode($data, true);

    if(isset($mydata["username"])){
        if($mydata["username"] != ""){
            $p_username = $mydata["username"];
            require_once("conn.php");
            $link = create_connection();
            $sql = "SELECT Username FROM member WHERE Username='$p_username'";
            $result = execute_sql($link, "myproject", $sql);
            if(mysqli_num_rows($result) > 0){
                    echo '{"state" : false, "message" : "帳號已重複不可以使用"}';
                }else{
                    echo '{"state" : true, "message" : "帳號可以使用"}';
                }
                mysqli_close($link);
        }else{
            echo '{"state" : false, "message" : "欄位不得為空白"}';
        }
    }else{
        echo '{"state" : false, "message" : "欄位名稱錯誤"}';
    }
?>