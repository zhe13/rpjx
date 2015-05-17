<?php
$hostname = SAE_MYSQL_HOST_M.':'.SAE_MYSQL_PORT;
$dbuser = SAE_MYSQL_USER;
$dbpass = SAE_MYSQL_PASS;
$dbname = SAE_MYSQL_DB;
//connect to db
$conn = mysql_connect($hostname, $dbuser, $dbpass)
    or die(mysql_error());
echo 'Connected successfully<br/>';
//select db
mysql_select_db($dbname, $conn) or die ('Can\'t use dbname : ' . mysql_error());
echo 'Select db '.$dbname.' successfully';
//mysql_close($conn);
?>

<!DOCTYPE HTML>
<html>
    <head>
        <meta content="text/html; charset=utf-8">
        <title>demo</title>
    </head>
    <body>
    <?php
    	$sqlstr = "select * from mysqldemo2 order by id";
		$query = mysql_query($sqlstr) or die(mysql_error());
		$result = array();
		while($thread=mysql_fetch_assoc($query)){
    		$result[]=$thread;
        }

		if($result){
            echo '<table>';
            echo '<th>NO</th><th>content</th><th>time</th>';
            foreach($result as $row){
                echo '<tr>';
                echo '<td>'.$row['id'].'</td>';
                echo '<td>'.$row['content'].'</td>';
                echo '<td>'.$row['timeline'].'</td>';
                echo '</tr>';
            }
            echo '</table>';
        }
	?>
    </body>
</html>
