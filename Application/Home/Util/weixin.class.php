<?php
/**
  * wechat php test
  */

//define your token
define("TOKEN", "weixin");


class Weixin
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
      
			$postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
			$fromUsername = $postObj->FromUserName;
			$toUsername = $postObj->ToUserName;
			$keyword = trim($postObj->Content);
			$time = time();          
	      
	    	
	     
			$textTpl = "<xml>
					<ToUserName><![CDATA[%s]]></ToUserName>
					<FromUserName><![CDATA[%s]]></FromUserName>
					<CreateTime>%s</CreateTime>
					<MsgType><![CDATA[%s]]></MsgType>
					<Content><![CDATA[%s]]></Content>
					<FuncFlag>0</FuncFlag>
					</xml>";             
				
			$picTpl = "<xml>
				 <ToUserName><![CDATA[%s]]></ToUserName>
				 <FromUserName><![CDATA[%s]]></FromUserName>
				 <CreateTime>%s</CreateTime>
				 <MsgType><![CDATA[%s]]></MsgType>
				 <ArticleCount>1</ArticleCount>
				 <Articles>
				 <item>
				 <Title><![CDATA[%s]]></Title> 
				 <Description><![CDATA[%s]]></Description>
				 <PicUrl><![CDATA[%s]]></PicUrl>
				 <Url><![CDATA[%s]]></Url>
				 </item>
				 </Articles>
				 <FuncFlag>1</FuncFlag>
				 </xml> ";
 
			if(!empty( $keyword ))
	    	{ /*
		    	mysql_query('set names utf-8'); 
		    	
		    	$book = M('Book');
		
					$sub = 1;
					$data = $book->where("title=$keyword")->select();
					
					
					$data[$sub]['author'] = preg_replace("/[\/\n\t\r]/", '', $data[$sub]['author']);
					$data[$sub]['pic_name'] = 'http://123.53.213.182/thinkphp/Public/img/lpic/'.$data[$sub]['isbn'].'.jpg';
					*/
					
					/*
					$contentStr = '';
		    	foreach($data as $bo){
		    		$contentStr .= $bo['title'] . "\r\n";
		    	}
		    	*/
    	
    	
				$msgType = "text";
				$contentStr = 'sfhjsfjsdf';//$this->($keyword);
				$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
				echo $resultStr;
	 /*	
				$msgType = "news";
				$picUrl=$content['pic_name'];  //Í¼Æ¬Ô¶³ÌµØÖ·
				$title=$content['title'];
				$desc = "aaaaaaaaa" ; //Í¼Æ¬ÃèÊö
				$url = "http://123.53.213.182/thinkphp/index.php/Home/Index/detail?" . http_build_query($content); // µã»÷Í¼Æ¬Ìø×ªÁ´½Ó
				$resultStr = sprintf($picTpl, $fromUsername, $toUsername, $time,  $msgType , $title, $desc, $picUrl , $url);
				echo $resultStr;
*/		
    		} else {
      			echo "Input something...";
    		}

    	} else {
	    	echo "";
	    	exit;
    	}
  	}
		
	private function checkSignature()
	{
	    $signature = $_GET["signature"];
	    $timestamp = $_GET["timestamp"];
	    $nonce = $_GET["nonce"];	

		$token = TOKEN;
		$tmpArr = array($token, $timestamp, $nonce);
		sort($tmpArr);
		$tmpStr = implode( $tmpArr );
		$tmpStr = sha1( $tmpStr );
		
		if( $tmpStr == $signature ){
			return true;
		}else{
			return false;
		}
	}
}