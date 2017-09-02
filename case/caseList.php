<?php
session_start();
include("../conn.php");
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

$orderBy = "updatetime";
$sort="desc";

if(isset($_GET["orderBy"])&&$_GET["orderBy"]){
    $orderBy=$_GET["orderBy"];
    $sort = $_GET["sort"];

    $ar = array("id" ,"demand","result","builder","assignTo","updatetime", "desc","asc");
    if (!in_array($orderBy, $ar)) {
        $orderBy = "updatetime";

    }
    if (!in_array($sort, $ar)) {
        $sort="desc";
    }
    if ($sort=="desc") {
        $sort="asc";
    }else{
        $sort="desc";
    }
}
$sql  = "SELECT * FROM `case` order by $orderBy $sort LIMIT $page ,$pagesize";

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
                            <section class="content-header hide">
                                <h1>
                                 <small>Control panel</small>
                                </h1>
                            </section>
                            <!-- RIBBON -->
                            <div id="ribbon">
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
                                                        <a href="javascript:location.reload();" class="btn btn-primary btn-refresh" >刷新 </a> 
                                                        <a href="/testcase/case/buildcase.php" class="btn btn-danger btn-del " >新建用例</a> 
                                                        <div class="pull-right search"><input class="form-control" type="text" placeholder="搜索"></div>
                                                        </div>

                                                    <table id="table" class="table table-striped table-bordered table-hover" width="100%">
                                                        <thead>
                                                            <tr>
                                                                <th>
                                                                    ID
                                                                    <?php  
                                                                    echo "<a href=$url?page=".$pageval."&orderBy=ID&sort=".$sort.">&#8595&#8593</a>";
                                                                    ?>
                                                                </th>
                                                                <th>
                                                                    用例标题
                                                                </th>
                                                                <th>
                                                                    相关需求
                                                                    <?php  
                                                                    echo "<a href=$url?page=".$pageval."&orderBy=demand&sort=".$sort.">&#8595&#8593</a>";
                                                                    ?>
                                                                </th>
                                                                <th>
                                                                    测试结果
                                                                    <?php  
                                                                    echo "<a href=$url?page=".$pageval."&orderBy=result&sort=".$sort.">&#8595&#8593</a>";
                                                                    ?>
                                                                </th>
                                                                <th>
                                                                    创建人
                                                                    <?php  
                                                                    echo "<a href=$url?page=".$pageval."&orderBy=builder&sort=".$sort.">&#8595&#8593</a>";
                                                                    ?>
                                                                </th>
                                                                <th>
                                                                    处理人
                                                                    <?php  
                                                                    echo "<a href=$url?page=".$pageval."&orderBy=assignTo&sort=".$sort.">&#8595&#8593</a>";
                                                                    ?>
                                                                </th>
                                                                <th>
                                                                    更新时间
                                                                    <?php  
                                                                    echo "<a href=$url?page=".$pageval."&orderBy=updatetime&sort=".$sort.">&#8595&#8593</a>";
                                                                    ?>
                                                                </th>
                                                                <th>
                                                                    操作
                                                                </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php 
                                                            
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
                                                                        echo "<a href=\"\" data-toggle=\"modal\" data-target=\"#exampleModal\" data-whatever=".$row["id"]."&action=runCase".">执行</a>&nbsp&nbsp";
                                                                        echo "<a  href=\"\"  data-toggle=\"modal\" data-target=\"#exampleModal\" data-whatever=".$row["id"]."&action=reviseCase".">修改</a>&nbsp&nbsp";
                                                                        echo "<a  href=\"\" data-toggle=\"modal\" data-target=\"#exampleModal\" data-whatever=".$row["id"]."&action=assignTo".">指派</a>&nbsp&nbsp";
                                
                                                                        echo "</th>";
                                                                        echo "</tr>";
                                                                    }
                                                                }
                                                                
                                                            ?>
                                                            <tr>
                                                                <div style="float:right; clear:none;" class="pager form-inline">
                                                                    <?php 
                                                                     if ($num>$pagesize) {

                                                                        if ($sort=="desc") {
                                                                            $sort="asc";
                                                                        }else{
                                                                            $sort="desc";
                                                                        }
                                                                        if($pageval<=1)$pageval=1;
                                                                        $next=$pageval+1;
                                                                        if ($pageval>=$p) {
                                                                            $next=$p;
                                                                        }
                                                                        $Previous =$pageval-1;
                                                                        echo "共".$num."条&nbsp&nbsp每页".$pagesize."条&nbsp&nbsp"."&nbsp &nbsp".$pageval."/".$p."&nbsp &nbsp &nbsp"."<a href=$url"."?orderBy=".$orderBy."&sort=".$sort.">首页</a>
                                                                    <a href=$url?page=".$next."&orderBy=".$orderBy."&sort=".$sort.">&nbsp&nbsp下一页</a>
                                                                    <a href=$url?page=".$Previous."&orderBy=".$orderBy."&sort=".$sort.">&nbsp&nbsp上一页</a>
                                                                    <a href=$url?page=".$p."&orderBy=".$orderBy."&sort=".$sort.">&nbsp&nbsp末页</a>";

                                                                     }else{
                                                                         echo "共".$num."条&nbsp";
                                                                     }
                                                                    $conn->close();
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
        
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" >
<div class="modal-dialog" role="document" style="margin: auto;width: 700px;max-width: 700px;">
<div id="di1" class="modal-content" style="width: 700px; max-width:700px">
      <form >
        <div class="modal-body" >
        <div id="di" > 
        </div>
        </div>
        <div class="modal-footer">
            <div id="sel" style="width: 20%">  
            </div>
            <button type="submit" id="reset1" class="btn btn-primary">保存</button>
            <button type="button"  class="btn btn-default" data-dismiss="modal">关闭</button>
        </div>
    </form>
</div>
</div>
</div>
<script type="text/javascript">
  $('#exampleModal').on('show.bs.modal', function (event) {

    var button = $(event.relatedTarget) // Button that triggered the modal
    var recipient = button.data('whatever') 
    var modal = $(this)
    var url = "./getdata.php?ID="+recipient
    var ht = ""
    var htsel = ""
    //modal.find("modal-body").load("./getdata")
    //initView(); 
    $.getJSON(url,function(datas,status){

        switch (datas.action) {
            case 'runCase':
                ht = "<input type=\"hidden\" id=\"getid\" value="+datas.id+" ></input><label>步骤:</label><h6>"+datas.steps+"</h6><label>预期结果:</label><h6 >"+datas.expects+"</h6><label>备注:</label><h6 >"+datas.remarks+"</h6>"
                htsel = "<select name=\"test_result\" id=\"test_result\"  class=\"form-control\"><option value=\"忽略\" data-keys=\"hulue hl\">忽略</option><option value=\"通过\" selected=\"selected\" data-keys=\"tongguo\">通过</option><option value=\"失败\" data-keys=\"shibai\">失败</option><option value=\"阻塞\" data-keys=\"zusai\">阻塞</option></select>"
                break;
            case 'reviseCase':
                ht = "<input type=\"hidden\" id=\"getid\" value="+datas.id+" ></input><label style=\"width: 65px\">标题:</label><input id=\"tit\" style=\"width: 100%\" value="+datas.casetitle+"></input><br><label style=\"width: 65px\">步骤:</label><textarea id=\"ste\" rows = \"5\" style=\"width: 100%\">"+datas.steps+"</textarea><br><label style=\"width: 65px\">预期结果:</label><textarea  id=\"ex\" rows = \"5\" style=\"width: 100%\" >"+datas.expects+"</textarea><label style=\"width: 65px\">备注:</label><textarea  id=\"rema\" rows = \"5\" style=\"width: 100%\" >"+datas.remarks+"</textarea>"
                break;
            case 'assignTo':
                ht = "<input type=\"hidden\" id=\"getid\" value="+datas.id+" ></input><label style=\"width: 65px;font: 18px;\">重新指派</label><select id=\"assign\" style=\"width: 50%\" name=\"steps\" id=\"steps\" class=\"form-control\">";
                for(var i=0; i<getJsonLength(datas)-2; i++){
                    ht =ht+"<option value="+datas[i]+" data-keys="+datas[i]+">"+datas[i]+" </option>";
                }
                ht+= "</select>"
                break;
            default:
                break;
        }

        modal.find('#di').html(ht)
        modal.find('#sel').html(htsel)
        //modal.find('#steps').text(datas.steps)
        //modal.find('#expects').text(datas.expects)
    });

});

$('#reset1').click(function(event){
    var jsonD ="";
    var getid = document.getElementById("getid").value;
    
    if ($('#test_result').length>0) {
        var test_result = document.getElementById("test_result").value;
        jsonD = {"id":getid,"test_result":test_result};
    }
    if ($('#tit').length>0) {
        var title = document.getElementById("tit").value;
        var steps = document.getElementById("ste").value;
        var expects = document.getElementById("ex").value;
        var remarks = document.getElementById("rema").value;
        var jsonD = {"title":title,"steps":steps,"id":getid,"expects":expects,"remarks":remarks};
    }
    if ($('#assign').length>0) {
        var assignTo = document.getElementById("assign").value;
        jsonD = {"id":getid,"assignTo":assignTo};
        
    }
    
    $.ajax({
            type:"POST",
            url:"./getdata.php",
            data:jsonD,
            datatype: "json",
            beforeSend:function(){},            
            success:function(data){   

            },
            error: function(){
            }         
         });
    return true;
});

function getJsonLength(jsonData){

    var jsonLength = 0;

    for(var item in jsonData){

        jsonLength++;

    }

    return jsonLength;
}

$("#exampleModal").on("hidden.bs.modal", function(event) {  
    $(this).removeData("modal");  
}); 
</script>
</body>
</html>