<?php
include("../conn.php");

$user_name =$_POST["username"];
$pwd = $_POST["password"];

$sql = "SELECT username,password,isVIP FROM test WHERE username = '$user_name'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // 输出数据
    while($row = $result->fetch_assoc()) {
    	if($row["password"]==$pwd){
    		echo "username: " . $row["username"]. "  "."ISvip: " . $row["isVIP"]. "<br>";
    	}else{
    		echo "密码错误";
    	}
    }
} else {
    echo "0 结果";
}
$conn->close();

?>