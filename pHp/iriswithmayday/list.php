<?php
header("Content-Type:text/html;charset=utf-8"); 
$hostname = SAE_MYSQL_HOST_M.':'.SAE_MYSQL_PORT;
$dbuser = SAE_MYSQL_USER;
$dbpass = SAE_MYSQL_PASS;
$dbname = SAE_MYSQL_DB;
//connect to db
$conn = mysql_connect($hostname, $dbuser, $dbpass)
    or die(mysql_error());

//select db
mysql_select_db($dbname, $conn) or die ('Can\'t use dbname : ' . mysql_error());

//mysql_close($conn);
?>

<!DOCTYPE HTML><!--5.14引入bootstrap-->
<html lang="zh-CN">
    <head>
        <meta charset="utf-8">
   		<meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
        <!--以上三行放在最前-->
        <meta content="text/html; charset=utf-8">
        <!--自动刷新-->
        <meta http-equiv="refresh" content="5" />
        <title>ZheBro</title>
        <!-- 新 Bootstrap 核心 CSS 文件 -->
		<link rel="stylesheet" href="http://cdn.bootcss.com/bootstrap/3.3.4/css/bootstrap.min.css">
    </head>
    <body onload="window.scrollTo(0,document.body.scrollHeight); ">
        <h2 class="masthead-brand">
            WeChat Wall By Zhe13
        </h2>
    <?php
    	$sqlstr = "select * from weixin order by id";
		$query = mysql_query($sqlstr) or die(mysql_error());
		//这里没有统一使用SAE封装类		
		$result = array();
		while($thread=mysql_fetch_assoc($query)){
    		$result[]=$thread;
        }

		if($result){
            echo '<table class="table table-striped">';
            echo '<th>NO</th><th>content</th><th>time</th>';
            foreach($result as $row){
                echo '<tr>';
                echo '<td>'.$row['id'].'</td>';
                //echo '<td>'.$row['FromUserName'].'</td>';
                echo '<td>'.$row['Content'].'</td>';
                echo '<td>'.$row['CreateTime'].'</td>';
                echo '</tr>';
            }
            echo '</table>';
        }
	?>          
        <!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
		<script src="http://cdn.bootcss.com/jquery/1.11.2/jquery.min.js"></script>
		<!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
		<script src="http://cdn.bootcss.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    </body>
</html>
