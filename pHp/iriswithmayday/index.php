<?php
header("Content-Type:text/html;charset=utf-8"); 
echo '<strong>Hello, SAE!</strong><br>';
echo "UserName".SAE_MYSQL_USER."<br>";
echo "密码：".SAE_MYSQL_PASS."<br>";
echo "端口：".SAE_MYSQL_PORT."<br>";
echo "数据库名".SAE_MYSQL_DB."<br>";

$sql = "CREATE TABLE IF NOT EXISTS `cuc` (\n"
    . " `id` int(10) NOT NULL AUTO_INCREMENT,\n"
    . " `content` text COLLATE utf8_unicode_ci NOT NULL,\n"
    . " `timeline` datetime NOT NULL,\n"
    . " PRIMARY KEY (`id`)\n"
    . ") ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;";

//SAE封装好的链接类
$mysql = new SaeMysql();
$mysql->runSql($sql);
for($i =1;$i<13;$i++)
{
    $timeline = date('Y-M-D H:I:S');
    $content = 'This num is'.$i;
    $sqlstr = "insert into cuc(content,timeline)values('$content','$timeline')";
    $mysql->runSql($sqlstr);
}
//disconnect db
//$mysql->closeDb()
?>


