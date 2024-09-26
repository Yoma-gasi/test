<?php

$data = file_get_contents("php://input", "r");
$mydata = array();
$mydata = json_decode($data, true);

$p_uid01 = $mydata["uid01"];
require_once("conn.php");
$link = create_connection();
$sql = "SELECT Username, Uid01, Level, Active FROM member WHERE Uid01='$p_uid01'";
$result = execute_sql($link, "myproject", $sql);
if (mysqli_num_rows($result) == 1) {
    $row = json_encode(mysqli_fetch_assoc($result));
    echo '{"state" : true, "message" : "驗證成功，已登入", "data" : ' . $row . '}';
} else {
    echo '{"state" : false, "message" : "驗證失敗, 未登入!"}';
}
mysqli_close($link);
