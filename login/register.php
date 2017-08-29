<?php
include("../conn.php");

if($_POST["submit"]){
	$reg_name = $_POST["username"];
	$reg_pwd = $_POST["password"];

	$sqls = "SELECT username FROM test WHERE username = '$reg_name'";
	$result = $conn->query($sqls);
	if ($result->num_rows > 0) {
    	echo "<script>alert('帐号已存在');</script>";
	} else {
    	$sql = "INSERT INTO test (username,password,isVIP) VALUES ('$reg_name', '$reg_pwd', '1');";
		if ($conn->multi_query($sql) === TRUE) {
    		echo "<script>alert('注册成功！去登陆');window.location.href='login.php'</script>";
		}else {
    		echo "Error: " . $sql . "<br>" . $conn->error;
		}
	}
	$conn->close();
}
?>

<html>
<head>
<meta charset="utf-8">
<title>login</title>
</head>
<body>
<form action="" method="post">
名字: <input type="text" name="username"><br>
密码: <input type="password" name="password"><br>
<input type="submit" name="submit" value="提交">
</form>
<br>
</body>
</html>