<?php 
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
        <script src="https://cdn.bootcss.com/jquery/2.1.1/jquery.min.js"></script>
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="../static/bootstrap/css/bootstrap.min.css" type="text/css">
        <script src="../static/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <link rel="shortcut icon" href="assets/img/favicon.ico" />
        <!-- Loading Bootstrap -->
        <link href="../static/backend.css" rel="stylesheet">
        <script src="../static/echarts.common.min.js"></script>
    </head>
    <body class="inside-header inside-aside ">
        <div id="main" role="main">
            <div class="tab-content tab-addtabs">
                <div id="content">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            
                            <div id="ribbon">
                                <ol class="breadcrumb pull-left">
                                    <li><a href="/testcase/case/buildcase.php" class="addtabsit" >新建用例</a></li>
                                    <li><?php  echo "<a href=\"./aboutme.php?search=".$_SESSION["username"]."\">指派给我的</a>"?></li>
                                    <li><a href="/testcase/case/caseList.php" class="addtabsit">用例列表</a></li>
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
                                                        <div>
                                                        	<div class="pull-right ">
                                                        		<label class="control-label">用例创建时间:</label>
                                                        		<span class="relative_time_tip" rel="#during_tip"></span>
                                                        		&nbsp;&nbsp;<div id="between_time" style="display: inline;">从&nbsp&nbsp<input type="date"  id="begintime"><span style="margin-left:10px;margin-right:10px;">到</span><input type="date" id="stoptime" >&nbsp&nbsp</div>
                                                        		<button id="btncret" class="btn btn-danger  " >生成报表</button>
                                                        	</div>
                                                        </div>
                                                        <div >
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                	</div>
                                	<div  class="tab-content">
                                        	<div id="op" style="width: 800px;height:500px;">
                                        	</div>
                                    </div>
                                </div>
                            </div>    
                        </div>
                    </div>
                </div>
            </div>
        </div>
<script type="text/javascript">
        	

$("#btncret").click(function(event){

	if ($("#begintime").val()=="" || $("#stoptime").val()=="") {
		alert("请设置时间段");
		return false;
	}
	var url = "./getdata.php?begintime="+$("#begintime").val()+"&stoptime="+$("#stoptime").val()
	$.getJSON(url,function(datas,status){
	var myChart = echarts.init(document.getElementById('op'));
	var option = {
	title: {
        text: '需求用例测试结果分布'
    },
    tooltip : {
    	trigger: 'axis',
    	axisPointer : {            // 坐标轴指示器，坐标轴触发有效
            type : 'shadow'        // 默认为直线，可选为：'line' | 'shadow'
        }
    },
    legend: {
    	data:['失败','阻塞','通过','忽略','新建']
    },
    grid: {
    	left: '3%',
    	right: '4%',
    	bottom: '3%',
    	containLabel: true
    },
    xAxis : [
    {	

    	type : 'value'
    }
    ],
    yAxis : [
    {
    	type : 'category',
    	data : datas.demand
    	
    }
    ],
    series : [
    {
    	name:'失败',
    	type:'bar',
    	stack: '失败',
    	data:datas.fail
    },
    {
    	name:'阻塞',
    	type:'bar',
    	stack: '失败',
    	data:datas.na
    },
    {
    	name:'通过',
    	type:'bar',
    	stack: '失败',
    	data:datas.pass
    },
    {
    	name:'忽略',
    	type:'bar',
    	stack: '忽略',
    	data:datas.nt
    },
    {
    	name:'新建',
    	type:'bar',
    	stack: '失败',
    	data:datas.new
    }
    ]
	};
	myChart.setOption(option);

	});
	return false;
});

</script>
	</body>
</html>