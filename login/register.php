<?php
include("../conn.php");

if(isset($_POST["submit"])){
	$reg_name = $conn->real_escape_string($_POST["username"]);
	$reg_pwd = $conn->real_escape_string($_POST["password"]);

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

<script type="text/javascript" charset="utf-8">
function CheckPost(){
	if (document.getElementById("user").value=="") {
		document.getElementById("userTable").innerHTML ="请输入帐号";
		registerForm.username.focus();
		return false;
	}
	if (document.getElementById("pwd").value=="") {
		document.getElementById("userTable").innerHTML ="请输入密码";
		registerForm.password.focus();
		return false;
	}
	return true;
}
</script>
</head>
<body>
<div style="height:800px;text-align:center;">
	<div style="height:100px;text-align:center;"></div>
	<div  >
	<form action="" method="post" name="registerForm" onsubmit="return CheckPost();">
	名字: <input type="text" name="username" id="user"><br><br>
	密码: <input type="password" name="password" id="pwd"><br><br>
	<input type="submit" name="submit" value="提交">
	</form>
	<h6 id=userTable style="color: red"></h6> 
	</div>
</div>
<br>
</body>
</html>