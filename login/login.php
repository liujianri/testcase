<?php
session_start();

include("../conn.php");
if (isset($_POST["submit"])) 
{
$user_name =$conn->real_escape_string($_POST["username"]);
$pwd = $conn->real_escape_string($_POST["password"]);

$sql = "SELECT username,password,isVIP FROM test WHERE username = '$user_name' ";
$result = $conn->query($sql);

if($result->num_rows ==1) 
{
    $row = $result->fetch_assoc();
    if($row["password"]==$pwd){
    	
    	$_SESSION['username']=$row['username'];
    	$_SESSION['isVIP'] = $row['isVIP'];
    	header('Location: /testcase/case/caseList.php');

    }else{
    	echo "<script>alert('密码错误');</script>";
    }
} else {
	echo "<script>alert('该帐号没有注册');</script>";
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
		loginForm.username.focus();
		return false;
	}
	if (document.getElementById("pwd").value=="") {
		document.getElementById("userTable").innerHTML ="请输入密码";
		loginForm.password.focus();
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
		<form action="" method="post" name="loginForm" onsubmit="return CheckPost();">
		名字: <input type="text" name="username" id="user"><br><br>
		密码: <input type="password" name="password" id="pwd"><br><br>
		<input type="submit" name="submit"  value="登录">
		<input type="button" onclick="window.location.href='/testcase/login/register.php'" value="注册">
		</form>
		<h6 id=userTable style="color: red"></h6> 
	</div>

</div>
<br>
</body>
</html>