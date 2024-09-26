<?php
$photoName = array();
$p_name = $_POST['workName'];
$p_type = $_POST['type'];
$p_remark = $_POST['remark'];
$p_id = $_POST['id'];
if(isset($_FILES["file"])){
    foreach ($_FILES["file"]["error"] as $key => $error) {
    if ($error == 0) {
        $fileName = date("YmdHis") . "_" . $_FILES["file"]["name"][$key];
        $location = "../uploads/" . $fileName;
        move_uploaded_file($_FILES["file"]["tmp_name"][$key], $location);
    }
    array_push($photoName, $fileName);
}
}

$length = count($photoName);
if ($length == 0) {
    $sql = "UPDATE work SET WorkName = '$p_name', Type = '$p_type', Remark = '$p_remark' WHERE ID = '$p_id'";
} else if ($length == 1) {
    $sql = "UPDATE work SET WorkName = '$p_name', Type = '$p_type', Remark = '$p_remark', Photo1 = '$photoName[0]' WHERE ID = '$p_id'";
} else if ($length == 2) {
    $sql = "UPDATE work SET WorkName = '$p_name', Type = '$p_type', Remark = '$p_remark', Photo1 = '$photoName[0]', Photo2 = '$photoName[0]' WHERE ID = '$p_id'";
} else if ($length == 3) {
    $sql = "UPDATE work SET WorkName = '$p_name', Type = '$p_type', Remark = '$p_remark', Photo1 = '$photoName[0]', Photo2 = '$photoName[1]', Photo3 = '$photoName[2]' WHERE ID = '$p_id'";
} else if ($length == 4) {
    $sql = "UPDATE work SET WorkName = '$p_name', Type = '$p_type', Remark = '$p_remark', Photo1 = '$photoName[0]', Photo2 = '$photoName[1]', Photo3 = '$photoName[2]', Photo4 = '$photoName[3]' WHERE ID = '$p_id'";
} else if ($length == 5) {
    $sql = "UPDATE work SET WorkName = '$p_name', Type = '$p_type', Remark = '$p_remark', Photo1 = '$photoName[0]', Photo2 = '$photoName[1]', Photo3 = '$photoName[2]', Photo4 = '$photoName[3]', Photo5 = '$photoName[4]' WHERE ID = '$p_id'";
}

require_once("conn.php");
$conn = create_connection();
if (execute_sql($conn, "myproject", $sql)) {
    echo '{"state" : true, "message" : "修改成功"}';
} else {
    echo '{"state" : false, "message" : "修改失敗' . mysqli_error($conn) . '"}';
}
mysqli_close($conn);
