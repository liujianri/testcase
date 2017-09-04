<?php
session_start();
include("../conn.php");
if (isset($_SESSION["username"])) {
	if (isset($_POST["submit"])) {
		$casetitle=$conn->real_escape_string($_POST["title"]);

		$precondition = $conn->real_escape_string($_POST["precondition"]);
		$demand = $conn->real_escape_string($_POST["demand"]);
		$steps = $conn->real_escape_string($_POST["steps"]);
		$expects = $conn->real_escape_string($_POST["expects"]);
		$remarks = $conn->real_escape_string($_POST["remarks"]);
		$builder = $conn->real_escape_string($_SESSION["username"]);
		$dt = new DateTime();
		$dt->setTimezone(new DateTimeZone('PRC')); 
		$dts = $dt->format('Y-m-d H:i:s');
		$sql = "INSERT INTO `case` (`id`, `casetitle`, `precondition`, `demand`, `steps`, `expects`, `buildtime`, `updatetime`, `builder`, `updater`,`assignTo`, `result`, `remarks`) VALUES (NULL, '$casetitle', '$precondition', '$demand', '$steps', '$expects', '$dts', '$dts', '$builder', '$builder','$builder', '新建', '$remarks');";

		if ($conn->multi_query($sql) === TRUE) {
			$conn->close();
    		echo "<script>alert('保存成功');window.location.href='/testcase/case/caseList.php'</script>";
		}else {
    		echo "Error: " . $sql . "<br>" . $conn->error;
		}
		
	}
}else{
	echo "<script>alert('未登陆');window.location.href='/testcase/login/login.php'</script>";
	exit();
}

?>

<!DOCTYPE html>
<html lang="zh-cn">
    <head>
        <meta charset="utf-8">
        <title>Case List</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="renderer" content="webkit">

        <link rel="shortcut icon" href="assets/img/favicon.ico" />
        <!-- Loading Bootstrap -->
        <link href="../static/backend.css" rel="stylesheet">
        <script type="text/javascript" charset="utf-8">
		function CheckPosts(){
			if (document.getElementById("title").value=="") {
					document.getElementById("userTable").innerHTML ="标题不能为空";
					dataform.title.focus();
					return false;
			}
			if (document.getElementById("precondition").value=="") {
					document.getElementById("userTable").innerHTML ="前置条件不能为空";
					dataform.precondition.focus();
					return false;
			}
			if (document.getElementById("demand").value=="") {
					document.getElementById("userTable").innerHTML ="没有相关需求请填写 无";
					dataform.demand.focus();
					return false;
			}
			if (document.getElementById("steps").value=="") {
					document.getElementById("userTable").innerHTML ="步骤不能为空";
					dataform.steps.focus();
					return false;
			}
			return true;
		}
</script>
    </head>
    <body class="inside-header inside-aside ">
        <div id="main" role="main">
            <div class="tab-content tab-addtabs">
                <div id="content">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            
                            <!-- RIBBON -->
                            <div id="ribbon">
                                <ol class="breadcrumb pull-left">
                                    <li><a href="caseList.php" class="addtabsit">用例列表</a></li>
                                    
                                    <li><?php  echo "<a href=\"./aboutme.php?search=".$_SESSION["username"]."\">指派给我的</a>"?></li>
                                    <li><a href="statistics.php" class="addtabsit">统计</a></li>
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
                                                 </div>

                                             	<form id="dataform" data-type="ajax" class="form-condensed" method="post" action="" onsubmit="return CheckPosts();">
                                                    <table id="table" class="table table-striped table-bordered table-hover" width="100%">
                                                        <tbody>
                                                        	<tr>
                                                        		<th></th>
                                                        		<th></th>
                                                        	</tr>
                                                        	<tr>
                                                        		<th style="text-align:center;font-size: 16px;">用例标题</th>
                                                        		<td>
                                                        		<input type="text" name="title" id="title" value="" style="font-size: 15px" class="form-control" autocomplete="off">
                                                        		</td>
                                                        	</tr>
                                                        	<tr>
                                                        		<th style="text-align:center;font-size: 16px;">前置条件</th>
                                                        		<td>
                                                        			<textarea name="precondition" id="precondition" rows="2" style="font-size: 15px" class="form-control"></textarea>
                                                        		</td>
                                                        		<th style="text-align:center;font-size: 16px;">相关需求</th>
                                                        		<td>
                                                        			<input type="text" name="demand" id="demand" value="" style="font-size: 15px" class="form-control" autocomplete="off">
                                                        		</td>
                                                        	</tr>
                                                        	<tr>
                                                        		<th style="text-align:center;font-size: 16px;">操作步骤</th>
                                                        		<td>
                                                        			<textarea name="steps" id="steps" rows="10" style="font-size: 15px" class="form-control"></textarea>
                                                        		</td>
                                                        		<th style="text-align:center;font-size: 16px;">预期结果</th>
                                                        		<td>
                                                        			<textarea name="expects" id="expects" rows="10" style="font-size: 15px" class="form-control"></textarea>
                                                        		</td>
                                                        	</tr>
                                                        	<tr>
                                                        		<th style="text-align:center;font-size: 16px;">
                                                        			备注
                                                        		</th>
                                                        		<td>
                                                        			<textarea name="remarks" id="remarks" rows="3" style="font-size: 15px" class="form-control"></textarea>
                                                        		</td>
                                                        	</tr>
                                                        	<tr>
                                                        	</tr>
                                                        	<tr>
                                                        		<th></th>
                                                        		<th></th>
                                                        		<th></th>
                                                        		<th></th>
                                                        	</tr>

                                                        </tbody>
                                                    </table>
                                                    <div style="text-align:center;">
                                                    <button type="submit" name="submit" id="submit" class="btn btn-primary" data-loading="稍候..." style="">保存</button>
                                                    </div>
                                                </form>
                                                <h5 id=userTable style="color: red"></h5> 
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