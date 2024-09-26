<?php
$data = file_get_contents("php://input", "r");
$mydata = array();
$photos = array();
$mydata = json_decode($data, true);

$p_id = $mydata['id'];

$sql = "SELECT Photo1, Photo2, Photo3, Photo4, Photo5 FROM work WHERE ID = $p_id";
require_once("conn.php");
$conn = create_connection();
$result = execute_sql($conn, "myproject", $sql);
$A = array();
while ($row = mysqli_fetch_assoc($result)) {
    array_push($photos, $row['Photo1']);
    array_push($photos, $row['Photo2']);
    array_push($photos, $row['Photo3']);
    array_push($photos, $row['Photo4']);
    array_push($photos, $row['Photo5']);
}
foreach($photos as $filename){
    if($filename != ""){
        $location = "../uploads/" . $filename;
        if (file_exists($location)){
            unlink($location);
        }
    }
}
$sql = "DELETE FROM work WHERE ID = '$p_id'";
if(execute_sql($conn, "myproject", $sql)){
    echo '{"state" : true, "message" : "刪除成功!"}';
}else{
    echo '{"state" : false, "message" : "刪除失敗!"}';
}
mysqli_close($conn);





