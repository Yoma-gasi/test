<?php
$data = file_get_contents("php://input", "r");
$mydata = array();
$mydata = json_decode($data, true);

$p_col = $mydata['col'];
$p_id = $mydata['id'];
$filename = $mydata['pname'];
$location = "../uploads/" . $filename;
if (!empty($filename)) {
    if (file_exists($location)) {
        unlink($location);
        $sql = "UPDATE work SET $p_col = '' WHERE ID = '$p_id'";
        require_once("conn.php");
        $conn = create_connection();
        if (execute_sql($conn, "myproject", $sql)) {
            echo '{"state" : true, "message" : "刪除成功"}';
        } else {
            echo '{"state" : false, "message" : "刪除失敗' . mysqli_error($conn) . '"}';
        }
        mysqli_close($conn);
    } else {
        echo '{"state" : false, "message" : "檔案不存在"}';
    }
} else {
    echo '{"state" : false, "message" : "檔案不存在"}';
}
