<?php
$data = file_get_contents("php://input", "r");
$mydata = array();
$mydata = json_decode($data, true);

$p_username = $mydata["username"];
$p_password = $mydata["password"];

require_once "conn.php";
$link = create_connection();
$sql = "SELECT Username, Password FROM member WHERE Username='$p_username'";
$result = execute_sql($link, "myproject", $sql);
if (mysqli_num_rows($result) == 1) {

    $row = mysqli_fetch_assoc($result);

    if (password_verify($p_password, $row["Password"])) {

        $uid01 = substr(hash('sha256', uniqid(time())), 0, 8);
        $sql = "UPDATE member SET Uid01 = '$uid01' WHERE Username='$p_username'";
        if (execute_sql($link, "myproject", $sql)) {
            $sql = "SELECT Username, Uid01, Level, Active FROM member WHERE Username='$p_username'";
            $result = execute_sql($link, "myproject", $sql);
            $row = mysqli_fetch_assoc($result);
            echo '{"state" : true, "message" : "登入成功", "data" : ' . json_encode($row) . '}';
        } else {
            echo '{"state" : false, "message" : "uid更新失敗"}';
        }
    } else {
        //密碼錯誤
        echo '{"state" : false, "message" : "登入失敗"}';
    }
} else {
    //帳號錯誤
    echo '{"state" : false, "message" : "登入失敗"}';
}
mysqli_close($link);
