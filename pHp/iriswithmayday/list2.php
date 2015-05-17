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

<!DOCTYPE HTML>
<html lang="zh-CN">
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="@keyframes myfirst.css">
	<title>CSS3_Animations</title>
</head>
<body>
    
<div class=danmu width=100% height=100%>
    <?php
    	$sqlstr = "select * from weixin order by id";
		$query = mysql_query($sqlstr) or die(mysql_error());
		//这里没有统一使用SAE封装类		
		$result = array();
		while($thread=mysql_fetch_assoc($query)){
    		$result[]=$thread;
        }

		if($result){
            foreach($result as $row){
                
                //echo '<td>'.$row['id'].'</td>';
                //echo '<td>'.$row['FromUserName'].'</td>';
                echo '<p class="changecolor">'.$row['Content'].'</p>';
                //echo '<td>'.$row['CreateTime'].'</td>';
                
            }
           
        }
	?> 

</div>

<video src="http://zhe13.qiniudn.com/WebSitewood.webm" controls="controls" loop="loop" autoplay="autoplay" width="100%" height="100%">您的浏览器不支持vedio标签</video>
</body>
</html>