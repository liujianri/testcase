<?php
include("../conn.php");
session_start();


if (!isset($_SESSION["username"])) {
    echo "<script>alert('未登陆');window.location.href='/testcase/login/login.php'</script>";
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
                                                        <a href="" class="btn btn-primary btn-refresh" >搜索 </a> 
                                                        <a href="/testcase/case/editcase.php" class="btn btn-danger btn-del " >新建用例</a> 
                                                        </div>
                                                    <table id="table" class="table table-striped table-bordered table-hover" width="100%">
                                                        <thead>
                                                            <tr>
                                                                <th>
                                                                    ID
                                                                </th>
                                                                <th>
                                                                    用例标题
                                                                </th>
                                                                <th>
                                                                    相关需求
                                                                </th>
                                                                <th>
                                                                    测试结果
                                                                </th>
                                                                <th>
                                                                    执行步骤
                                                                </th>
                                                                <th>
                                                                    创建人
                                                                </th>
                                                                <th>
                                                                    创建时间
                                                                </th>
                                                                <th>
                                                                    更新时间
                                                                </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php 
                                                                $sql  = 'SELECT * FROM `case` LIMIT 5';
                                                            ?>

                                                        </tbody>
                                                    </table>


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
        <script src="assets/js/require.min.js" data-main="assets/js/require-backend.min.js"></script>
    </body>
</html>