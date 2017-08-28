<?php

$servername = "localhost:8889";
$user = "root";
$pwd = "root";
$dbname = "login";
$reg_name = $_POST["username"];
$reg_pwd = $_POST["password"];
// 创建连接
$conn = new mysqli($servername, $user, $pwd,$dbname);
 
// 检测连接
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
} 
echo "连接成功";

$sql = "INSERT INTO test (username,password,isVIP) VALUES ('$reg_name', '$reg_pwd', '1');";
if ($conn->multi_query($sql) === TRUE) {
    echo "新记录插入成功";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
 
$conn->close();


?>