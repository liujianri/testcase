<?php 
session_start();
if(isset($_GET['action'])&&$_GET['action'] == "logout"){
	if (isset($_SESSION["username"])) {
		session_unset();
		session_destroy();
    	echo "<script>alert('注销成功');window.location.href='login.php'</script>";
	} 
}
?>