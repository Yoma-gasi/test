<?php
$p_col = $_POST['col'];
$p_id = $_POST['id'];
$filename = date("YmdHis") . "_" . $_FILES['file']['name'];
$location = "../uploads/" . $filename;
move_uploaded_file($_FILES['file']['tmp_name'], $location);

$sql = "UPDATE work SET $p_col = '$filename' WHERE ID = '$p_id'";

require_once("conn.php");
$conn = create_connection();
if(execute_sql($conn, "test", $sql)){
    echo '{"state" : true, "message" : "新增成功"}';
}else{
    echo '{"state" : false, "message" : "新增失敗'.mysqli_error($conn).'"}';
}
mysqli_close($conn);
?>