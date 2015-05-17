<?php
require "conn.php";
$tempXml = 'temp.xml';
//get post data, May be due to the different environments
$postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
//extract post data
if (empty($postStr)){
    $postStr=file_get_contents('php://input');
}
file_put_contents($tempXml,$postStr,true);
libxml_disable_entity_loader(true);
$postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
$fromUsername = $postObj->FromUserName;
$toUsername = $postObj->ToUserName;
$contentStr = $postObj->Content;
$flag = $postObj->FuncFlag;
$msgType = $postObj->MsgType;
$time =  date('Y-m-d H:i:s');

$sqlStr = "insert into weixin(MsgType,ToUserName,FromUserName,CreateTime,Content,FuncFlag)values('$msgType','$toUsername','$fromUsername','$time','$contentStr','$flag')";
$mysql->runSql($sqlStr);
?>