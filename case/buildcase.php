<?php
include("../conn.php");
session_start();

if (isset($_SESSION["username"])) {
	if (isset($_POST["submit"])) {
		$casetitle=$_POST["title"];
		$precondition = $_POST["precondition"];
		$demand = $_POST["demand"];
		$steps = $_POST["steps"];
		$expects = $_POST["expects"];
		$remarks = $_POST["remarks"];
		$builder = $_SESSION["username"];
		$dt = new DateTime();
		$dts = $dt->format('Y-m-d H:i');
		$sql = "INSERT INTO `case` (`id`, `casetitle`, `precondition`, `demand`, `steps`, `expects`, `buildtime`, `updatetime`, `builder`, `updater`, `result`, `remarks`) VALUES (NULL, '$casetitle', '$precondition', '$demand', '$steps', '$expects', '$dts', '$dts', '$builder', '$builder', '新建', '$remarks');";

		if ($conn->multi_query($sql) === TRUE) {
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
                            <section class="content-header hide">
                                <h1>
                                                                     <small>Control panel</small>
                                </h1>
                            </section>
                            <!-- RIBBON -->
                            <div id="ribbon">
                                <ol class="breadcrumb pull-right">
                                    <li><a  ><?php if(isset($_SESSION["username"])){echo $_SESSION["username"];} ?></a></li>
                                    <li><a  href="/testcase/login/login.php?action=logout">退出</a></li>
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
                                                        		<th style="text-align:center;">用例标题</th>
                                                        		<td>
                                                        		<input type="text" name="title" id="title" value="" class="form-control" autocomplete="off">
                                                        		</td>
                                                        	</tr>
                                                        	<tr>
                                                        		<th style="text-align:center;">前置条件</th>
                                                        		<td>
                                                        			<textarea name="precondition" id="precondition" rows="2" class="form-control"></textarea>
                                                        		</td>
                                                        		<th style="text-align:center;">相关需求</th>
                                                        		<td>
                                                        			<input type="text" name="demand" id="demand" value="" class="form-control" autocomplete="off">
                                                        		</td>
                                                        	</tr>
                                                        	<tr>
                                                        		<th style="text-align:center;">操作步骤</th>
                                                        		<td>
                                                        			<textarea name="steps" id="steps" rows="5" class="form-control"></textarea>
                                                        		</td>
                                                        		<th style="text-align:center;">预期结果</th>
                                                        		<td>
                                                        			<textarea name="expects" id="expects" rows="5" class="form-control"></textarea>
                                                        		</td>
                                                        	</tr>
                                                        	<tr>
                                                        		<th style="text-align:center;">
                                                        			备注
                                                        		</th>
                                                        		<td>
                                                        			<textarea name="remarks" id="remarks" rows="3" class="form-control"></textarea>
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