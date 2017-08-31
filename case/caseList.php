<?php
include("../conn.php");

session_start();

if (!isset($_SESSION["username"])) {
    echo "<script>alert('未登陆');window.location.href='/testcase/login/login.php'</script>";
}
$pagesize=10;
$url=$_SERVER["REQUEST_URI"];
$url=parse_url($url);
$url=$url["path"];
$page=0;
$pageval=0;

$numq=$conn->query("SELECT * FROM `case`");
$num = $numq->num_rows;
$p= $num/$pagesize;
if (!is_int($p)) {
    $p = ceil($num/$pagesize);
}


if(isset($_GET["page"])&&$_GET["page"]){
    $pageval=$_GET["page"];
    $page=($pageval-1)*$pagesize;

}
if(isset($_GET["orderBy"])&&$_GET["orderBy"]){
    $orderBy=$_GET["orderBy"];
   

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
                                                        <a href="" class="btn btn-primary btn-refresh" >刷新 </a> 
                                                        <a href="/testcase/case/buildcase.php" class="btn btn-danger btn-del " >新建用例</a> 
                                                        <div class="pull-right search"><input class="form-control" type="text" placeholder="搜索"></div>
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
                                                                    创建人
                                                                </th>
                                                                <th>
                                                                    处理人
                                                                    <?php  
                                                                    echo "<a href=$url?page=".$pageval."&orderBy=bdater".">||</a>";
                                                                    ?>
                                                                </th>
                                                                <th>
                                                                    更新时间
                                                                </th>
                                                                <th>
                                                                    操作
                                                                </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php 
                                                            

                                                                $sql  = "SELECT * FROM `case` order by id desc LIMIT $page ,$pagesize";
                                                                $result = $conn->query($sql);
                                                                if ($result->num_rows > 0) {
                                                                    while($row = $result->fetch_assoc()){
                                                                        echo "<tr>";
                                                                        echo "<th>".$row["id"]."</th>";
                                                                        echo "<th>".$row["casetitle"]."</th>";
                                                                        echo "<th>".$row["demand"]."</th>";
                                                                        echo "<th>".$row["result"]."</th>";
                                                                    
                                                                        echo "<th>".$row["builder"]."</th>";
                                                                        echo "<th>".$row["assignTo"]."</th>";
                                                                        echo "<th>".$row["updatetime"]."</th>";
                                                                        echo "<th>";
                                                                        echo "<a  href=\"\">执行</a>&nbsp&nbsp";
                                                                        echo "<a  href=\"\">修改</a>&nbsp&nbsp";
                                                                        echo "<a  href=\"\">指派</a>&nbsp&nbsp";
                                                                        echo "<a  href=\"\">删除</a>&nbsp&nbsp";
                                                                        echo "</th>";
                                                                        echo "</tr>";
                                                                    }
                                                                }
                                                                
                                                            ?>
                                                            <tr>
                                                                <div style="float:right; clear:none;" class="pager form-inline">
                                                                    <?php 
                                                                     if ($num>$pagesize) {
                                                                        if($pageval<=1)$pageval=1;
                                                                        $next=$pageval+1;
                                                                        if ($pageval>=$p) {
                                                                            $next=$p;
                                                                        }
                                                                        $Previous =$pageval-1;
                                                                        echo "共".$num."条&nbsp&nbsp每页".$pagesize."条&nbsp&nbsp"."&nbsp &nbsp".$pageval."/".$p."&nbsp &nbsp &nbsp"."<a href=$url>首页</a>
                                                                    <a href=$url?page=".$next.">下一页</a>
                                                                    <a href=$url?page=".$Previous.">上一页</a>
                                                                    <a href=$url?page=".$p.">末页</a>";

                                                                     }else{
                                                                         echo "共".$num."条&nbsp";
                                                                     }
                                                                    
                                                                    ?>
                                                                </div>
                                                                
                                                            </tr>
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