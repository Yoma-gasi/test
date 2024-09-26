<?php
function create_connection()
{
    $conn = mysqli_connect("localhost", "owner", "123456") or die("連線失敗" . mysqli_connect_error());
    mysqli_query($conn, "SET NAMES UTF8");//強制設定編碼為UTF8
    return $conn;
}

function execute_sql($link, $database, $sql)
{
    mysqli_select_db($link, $database) or die("連線失敗" . mysqli_connect_error());

    $result = mysqli_query($link, $sql);
    return $result;
}
