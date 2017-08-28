<?php
 echo $_POST["username"];
 echo "<br>";
 echo $_POST["password"];

$servername = "localhost:8889";
$username = "root";
$password = "root";
 
// 创建连接
$conn = mysqli_connect($servername, $username, $password);
 
// 检测连接
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "连接成功";



?>