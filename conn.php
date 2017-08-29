<?php
$servername = "localhost:8889";
$user = "root";
$pwd = "root";
$dbname = "login";

// 创建连接
$conn = new mysqli($servername, $user, $pwd,$dbname);
 
// 检测连接
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
} 
$conn->set_charset('utf8');
return $conn ;

?>