<?php
$data = file_get_contents("php://input", "r");
$mydata = array();
$mydata = json_decode($data, true);

$p_username = $mydata["username"];
$p_password = password_hash($mydata["password"], PASSWORD_DEFAULT);
$p_surname = $mydata["name"];
$p_tel = $mydata["tel"];
$p_region = $mydata["region"];
$p_town = $mydata["town"];

require_once "conn.php";
$link = create_connection();
$sql = "INSERT INTO member(Username, Password, Surname, Tel, Region, Town) VALUES('$p_username', '$p_password', '$p_surname', '$p_tel', '$p_region', '$p_town')";
if (execute_sql($link, "myproject", $sql)) {
    echo '{"state" : true, "message" : "註冊成功"}';
} else {
    echo '{"state" : false, "message" : "註冊失敗"}';
}
mysqli_close($link);

