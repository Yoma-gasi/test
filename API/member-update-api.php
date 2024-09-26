<?php
// {"id":"xxx", "email" : "xxxx"}

// {"state" : true, "message" : 更新成功!"}
// {"state" : false, "message" : "更新失敗!"}
// {"state" : false, "message" : "欄位不得為空白"}
// {"state" : false, "message" : "欄位命名錯誤"}

$data = file_get_contents("php://input", "r");
$mydata = array();
$mydata = json_decode($data, true);


$p_id = $mydata["id"];
$p_surname = $mydata["name"];
$p_tel = $mydata["tel"];
$p_region = $mydata["region"];
$p_town = $mydata["town"];

require_once("conn.php");
$link = create_connection();
$sql = "UPDATE member SET Surname = '$p_surname', Tel = '$p_tel', Region = '$p_region', Town = '$p_town' WHERE ID = '$p_id'";
if (execute_sql($link, "myproject", $sql)) {
    echo '{"state" : true, "message" : "更新成功!"}';
} else {
    echo '{"state" : false, "message" : "更新失敗!"}';
}

mysqli_close($link);
