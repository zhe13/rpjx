<?php
//connect to db
$mysql = new SaeMysql();

//create table for Msg
$sql = "CREATE TABLE `weixin2` (\n"
    . " `id` int(10) unsigned NOT NULL auto_increment,\n"
    . " `ToUserName` varchar(20) NOT NULL,\n"
    . " `FromUserName` varchar(20) NOT NULL,\n"
    . " `CreateTime` datetime NOT NULL,\n"
    . " `MsgType` varchar(20) NOT NULL,\n"
    . " `Content` text COLLATE utf8_unicode_ci NOT NULL,\n"
    . " `FuncFlag` int(10) unsigned NOT NULL,\n"
    . " PRIMARY KEY (`id`)\n"
    . ") ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ";
$mysql->runSql($sql);
?>