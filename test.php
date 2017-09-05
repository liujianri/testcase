<?php

include("conn.php");

$sql = "SELECT `demand` FROM `case` group by `demand`";
$resul = $conn->query($sql);
$i = 0;
while ( $row = $resul->fetch_assoc()) {
	$de= $conn->real_escape_string($row["demand"]);
	$demand[] = $de;
	$sql = "select * from `case` WHERE `demand`='$de'";
	$fail[] = cont($conn,$sql,"'失败'") ;
	$pass[] = cont($conn,$sql,"'通过'") ;
	$new[] = cont($conn,$sql,"'新建'") ;
	$nt[] = cont($conn,$sql,"'忽略'") ;
	$na[] = cont($conn,$sql,"'阻塞'") ;
}

function cont($conn,$sq,$str){
	$sql = $sq." AND `result` =".$str;
	$results = $conn->query($sql);
	$rows = $results->num_rows;
	return $rows; 
}
print_r($demand);
print_r($fail);
print_r($pass);
print_r($new);
print_r($nt);
print_r($na);

?>