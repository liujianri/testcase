<?php 
session_start();
if (!isset($_SESSION["username"])) {
    echo "<script>alert('未登陆');window.location.href='/testcase/login/login.php'</script>";
}
include("../conn.php");

$sql = "SELECT `demand` FROM `case`";
$result = $conn->query($sql);

 ?>

 <!DOCTYPE html>
<html lang="zh-cn">
    <head>
        <meta charset="utf-8">
        <title>Case List</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="renderer" content="webkit">
        <script src="https://cdn.bootcss.com/jquery/2.1.1/jquery.min.js"></script>
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="../static/bootstrap/css/bootstrap.min.css" type="text/css">
        <script src="../static/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <link rel="shortcut icon" href="assets/img/favicon.ico" />
        <!-- Loading Bootstrap -->
        <link href="../static/backend.css" rel="stylesheet">
    </head>
    <body class="inside-header inside-aside ">
        <div id="main" role="main">
            <div class="tab-content tab-addtabs">
                <div id="content">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            
                            <div id="ribbon">
                                <ol class="breadcrumb pull-left">
                                    <li><a href="/testcase/case/caseList.php" class="addtabsit">用例列表</a></li>
                                    <li><?php  echo "<a href=\"./aboutme.php?search=".$_SESSION["username"]."\">指派给我的</a>"?></li>
                                </ol>
                                <ol class="breadcrumb pull-right">
                                    <li><a  ><?php if(isset($_SESSION["username"])){echo $_SESSION["username"];} ?></a></li>
                                    <li><a  href="/testcase/login/logout.php?action=logout">退出</a></li>
                                </ol>
                            </div>
                            <!-- END RIBBON -->
                            <div class="content">
                                <div class="panel panel-default panel-intro">
                                    <div class="panel-body">
                                        <div id="myTabContent" class="tab-content">
                                            <div class="tab-pane fade active in" id="one">
                                                <div class="widget-body no-padding">
                                                    <div id="toolbar" class="toolbar">
                                                        <a href="javascript:location.reload();" class="btn btn-primary btn-refresh" >刷新</i></a> 
                                                        <a href="/testcase/case/buildcase.php" class="btn btn-danger btn-del " >新建用例</a>
                                                    </div>
                                                    <div>
                                                    	<?php 
                                                    	while ( $row = $result->fetch_assoc()) {	
                                                    		$de = $conn->real_escape_string($row['demand']);
                                    						$sql = "select `result`,count(`result`) from `case` WHERE `demand`='$de' group by `result`";
                                                    		$results = $conn->query($sql);
                                                    		echo "<p style=\"color: red\">".$row['demand']."<p>";
                                                    		while ( $rows = $results->fetch_assoc()) {
                                                    			echo $rows['result']."  ".$rows["count(`result`)"];
                                                    		}
                                                    	}

                                                    	 ?>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
	</body>
</html>