<?php
$photoName = array();
$p_name = $_POST['workName'];
$p_type = $_POST['type'];
$p_remark = $_POST['remark'];
foreach ($_FILES["file"]["error"] as $key => $error) {
    if($error == 0){
    $fileName = date("YmdHis") . "_" . $_FILES["file"]["name"][$key];
    $location = "../uploads/" . $fileName;
        move_uploaded_file( $_FILES["file"]["tmp_name"][$key], $location);
    }
    array_push($photoName, $fileName);
}
$length = count($photoName);
if($length == 1){
    $sql = "INSERT INTO work(WorkName, Type, Remark, Photo1) VALUES('$p_name', '$p_type', '$p_remark', '$photoName[0]' )";
}else if($length == 2){
    $sql = "INSERT INTO work(WorkName, Type, Remark, Photo1, Photo2) VALUES('$p_name', '$p_type', '$p_remark', '$photoName[0]', '$photoName[1]' )";
}else if($length == 3){
    $sql = "INSERT INTO work(WorkName, Type, Remark, Photo1, Photo2, Photo3) VALUES('$p_name', '$p_type', '$p_remark', '$photoName[0]', '$photoName[1]', '$photoName[2]' )";
}else if($length == 4){
    $sql = "INSERT INTO work(WorkName, Type, Remark, Photo1, Photo2, Photo3, Photo4) VALUES('$p_name', '$p_type', '$p_remark', '$photoName[0]', '$photoName[1]', '$photoName[2]', '$photoName[3]' )";
}else if($length == 5){
    $sql = "INSERT INTO work(WorkName, Type, Remark, Photo1, Photo2, Photo3, Photo4, Photo5) VALUES('$p_name', '$p_type', '$p_remark', '$photoName[0]', '$photoName[1]', '$photoName[2]', '$photoName[3]', '$photoName[4]' )";
}

require_once("conn.php");
$conn = create_connection();
if(execute_sql($conn, "myproject", $sql)){
    echo '{"state" : true, "message" : "新增成功"}';
}else{
    echo '{"state" : false, "message" : "新增失敗'.mysqli_error($conn).'"}';
}
mysqli_close($conn);
?>