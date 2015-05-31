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

$action=$_GET[action]; 
$id=intval($_GET[id]); 
if($action=="getlink"){ 
    $query=mysql_query("select * from weixin where id=$id"); 
    $row=mysql_fetch_array($query); 
    $list=array("wx"=>$row[Content]); 
    echo json_encode($list); 
} 
?>