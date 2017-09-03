<?php
session_start();

if (!isset($_SESSION["username"])) {
    echo "<script>alert('未登陆');window.location.href='/testcase/login/login.php'</script>";
}
include("../conn.php");

if(isset($_GET["ID"])&&$_GET["ID"]){
    $pageval=$_GET["ID"];
    $action = $_GET["action"];
    if ($action=="assignTo") {
    	$i = 0;
		$arr = array();
		$sql = "SELECT username FROM test " ;
		$result = $conn->query($sql);
		while($row = $result->fetch_assoc()){
     		$arr[] = $row["username"];
		}
    	$return_arr = array("action"=>$action,"id"=>$pageval)+$arr;
    	echo json_encode($return_arr);
    	$conn->close();
    }else{
    	$sql = "SELECT * FROM `case` WHERE id = $pageval ";
    	$result = $conn->query($sql);
    	$row = $result->fetch_assoc();
    	$return_arr = array("action"=>$action)+$row;
    	echo json_encode($return_arr);
    	$conn->close();
    	
    }
}

if (isset($_POST["test_result"])) {
    $test_result = $_POST["test_result"];
    $id=$_POST["id"];
    error_log($test_result, 3, '/Applications/MAMP/logs/php_error.log');
    $sql  = "UPDATE `case` SET `result`='$test_result' WHERE `id`='$id';";
    $result = $conn->query($sql);
    $conn->close();
    echo "操作成功";
}

if (isset($_POST["steps"])) {
	$title = $conn->real_escape_string($_POST["title"]);
	$steps = $conn->real_escape_string($_POST["steps"]);
    $expects = $conn->real_escape_string($_POST["expects"]);
    $remarks = $conn->real_escape_string($_POST["remarks"]);
    $id=$_POST["id"];
    $sql  = "UPDATE `case` SET `expects`='$expects',`remarks`='$remarks',`steps`='$steps',`casetitle`='$title' WHERE `id`='$id';";
    error_log($sql, 3, '/Applications/MAMP/logs/php_error.log');
    $result = $conn->query($sql);
    $conn->close();
    echo "操作成功";
}

if (isset($_POST["assignTo"])) {
    $assignTo = $_POST["assignTo"];
    $id=$_POST["id"];
    error_log($assignTo, 3, '/Applications/MAMP/logs/php_error.log');
    $sql  = "UPDATE `case` SET `assignTo`='$assignTo' WHERE `id`='$id';";
    $result = $conn->query($sql);
    $conn->close();
    echo "指派成功";
}

?>

