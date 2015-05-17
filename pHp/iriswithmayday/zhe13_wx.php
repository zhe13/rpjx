<?php
/**
  * wechat php test
  */
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
//define your token
define("TOKEN", "zhe13_wx");
$wechatObj = new wechatCallbackapiTest();
$wechatObj->valid();
$wechatObj->responseMsg();


class wechatCallbackapiTest
{
	public function valid()
    {
        $echoStr = $_GET["echostr"];

        //valid signature , option
        if($this->checkSignature()){
        	echo $echoStr;
        	exit;
        }
    }

    public function responseMsg()
    {
		//get post data, May be due to the different environments
		$postStr = $GLOBALS["HTTP_RAW_POST_DATA"];

      	//extract post data
		if (!empty($postStr)){
                /* libxml_disable_entity_loader is to prevent XML eXternal Entity Injection,
                   the best way is to check the validity of xml by yourself */
                libxml_disable_entity_loader(true);
              	$postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
                $fromUsername = $postObj->FromUserName;
                $toUsername = $postObj->ToUserName;
                $keyword = trim($postObj->Content);
            	//$talkRob = new talk();
                $time = date('Y-m-d H:i:s');
                $textTpl = "<xml>
							<ToUserName><![CDATA[%s]]></ToUserName>
							<FromUserName><![CDATA[%s]]></FromUserName>
							<CreateTime>%s</CreateTime>
							<MsgType><![CDATA[%s]]></MsgType>
							<Content><![CDATA[%s]]></Content>
							<FuncFlag>0</FuncFlag>
							</xml>";             
        
            if(!empty( $keyword ))
                {
              		$msgType = "text";
                //$contentStr = talkRob->reply(keyword);
                $contentStr = $postObj->Content;
                	$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                	echo $resultStr;
                //my own code
            
                
                }else{
                	echo $textTpl;
                }
                

        }else {
        	echo "";
        	exit;
        }
    }
		
	private function checkSignature()
	{
        // you must define TOKEN by yourself
        if (!defined("TOKEN")) {
            throw new Exception('TOKEN is not defined!');
        }
        
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];
        		
		$token = TOKEN;
		$tmpArr = array($token, $timestamp, $nonce);
        // use SORT_STRING rule
		sort($tmpArr, SORT_STRING);
		$tmpStr = implode( $tmpArr );
		$tmpStr = sha1( $tmpStr );
		
		if( $tmpStr == $signature ){
			return true;
		}else{
			return false;
		}
	}
    /*
    //send Msg，主动发送功能，最后测试5.11日
    function reply_customer($touser,$content){
    
    //更换成自己的APPID和APPSECRET
    $APPID="wx862005e0d297b80d";
    $APPSECRET="2505aa6e56968d96825dcb1510a3bbea";
    
    $TOKEN_URL="https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$APPID."&secret=".$APPSECRET;
    
    $json=file_get_contents($TOKEN_URL);
    $result=json_decode($json);
    
    $ACC_TOKEN=$result->access_token;
    
    $data = '{
        "touser":"'.$touser.'",
        "msgtype":"text",
        "text":
        {
             "content":"'.$content.'"
        }
    }';
    
    $url = "https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token=".$ACC_TOKEN;
    
    $result = https_post($url,$data);
    $final = json_decode($result);
    return $final;
	}

	function https_post($url,$data){
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url); 
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $result = curl_exec($curl);
    if (curl_errno($curl)) {
       return 'Errno'.curl_error($curl);
    }
    curl_close($curl);
    return $result;
	}
    */
}

//自动聊天机器人,5.11测试失效
/*
class talk {
    public function reply($str) {
      $kv = new SaeKV ();
      $kv->init ();
      if ($str == 'help' || $str == '求助'){
        return "要教我读书，请英文下划线开头，接着问题，接着英文冒号，接着回答";
      }
      if (substr($str, 0,1) == '_'){
        $pos = strpos($str, ':');
        if ($pos > -1){
            $q = substr($str, 1,$pos - 1);
            $a = substr($str, $pos + 1);
            $ret = $kv->get('know_' . md5($q));
            if ($ret === false || !is_array($ret))
              $ret = array();
            $ret[] = $a;
            $kv->set('know_' . md5($q), $ret);
            return "known::" . $q . '/' . $a ;
        }
      }
      $ret = $kv->get('know_' . md5($str));
      if ($ret === false　|| !is_array($ret) || count($ret) == 0){
        return '我什么都不知道,输入"help"求助';
      }else{
        //随机一个
        while(count($ret) > 1){
            $re = array_shift($ret);
            if (rand(0, 1) == 0)
              return $re;
        }
        return array_shift($ret);
      }
    }
} 
*/
?>
