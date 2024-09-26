<?php

    $data = file_get_contents("php://input", "r");
    $mydata = array();
    $mydata = json_decode($data, true);
    
    $p_id = $mydata["id"];
        if(isset($mydata["level"]) && $mydata["level"] != ""){
            $p_level = $mydata["level"];

            require_once("conn.php");
            $link = create_connection();
            $sql = "UPDATE member SET Level = '$p_level' WHERE ID = '$p_id'";
            if(execute_sql($link, "myproject", $sql)){
                echo '{"state" : true, "message" : "更新會員等級成功!"}';
            }else{
                echo '{"state" : false, "message" : "更新會員等級失敗!'.mysqli_error(execute_sql($link, "myproject", $sql)).' "}';
            }
             mysqli_close($link);
        }else if(isset($mydata["active"]) && $mydata["active"] != ""){
            $p_active = $mydata["active"];

            require_once("conn.php");
            $link = create_connection();
            $sql = "UPDATE member SET Active = '$p_active' WHERE ID = '$p_id'";
            if(execute_sql($link, "myproject", $sql)){
                echo '{"state" : true, "message" : "更新會員狀態成功!"}';
            }else{
                echo '{"state" : false, "message" : "更新會員狀態失敗!'.mysqli_error(execute_sql($link, "myproject", $sql)).' "}';
            }
             mysqli_close($link);
        }
    
?>