<?php

	//require_once	('./cURL.php');
	
	set_time_limit(0);

	function getUrl($url) {
		$mycurl = new Curl();
		$content = $mycurl->get($url);
		preg_match_all('/class="nbg" href="([\s\S]+)"/iU',$content, $result);
		
		return $result[1];
		
	}
	

	
	class Analyse_Url{
		
		protected $url = NULL;
		protected $result = NULL;
		
		function __construct($url){
			
			$this->url = $url;
			$mycurl = new Curl();
			$this->result = $mycurl->get($this->url);
			
		}
		
		
		function getZuoZhe() {
			
			if(!preg_match('/<span class="pl">([ ]*)作者([\s\S]*)<\/a>([\s\S]*)<span class="pl">([\s\S]*)出版社/iU', 
				$this->result, $matches))
				return '';
			$str2= $matches[0];
			
			preg_match('/<a[\s\S]+>([\s\S]+)<\/a>/i', $str2, $matches);
			$str3=$matches[0];
	
			$str3=preg_rePlace('/<[\/]?a[\s\S]*>/U','', $str3);

			$order = array("'\r\n'", "'\n'", "'\r'","'\s+'");
			$replace = array('','','',' ');
			$str3 = preg_replace($order,$replace,$str3);
			return $str3;
			
		}
		
		function getYiZhe() {
			
			if(!preg_match('/<span class="pl">([ ]*)译者([\s\S]*)<\/a>([\s\S]*)<span class="pl">([\s\S]*)出版年/iU', 
				$this->result, $matches))
				return '';
			$str2= $matches[0];
	
			preg_match('/<a[\s\S]+>([\s\S]+)<\/a>/i', $str2, $matches);
			$str3=$matches[0];
	
			$str3=preg_replace('/<[\/]?a[\s\S]*>/U','', $str3);

			$order = array("'\r\n'", "'\n'", "'\r'","'\s+'");
			$replace = array('','','',' ');
			$str3 = preg_replace($order,$replace,$str3);
			//$str3=preg_rePlace('/\n/U','', $str3);
			
			//return explode('/',$str3);
			//return addslashes($str3);
			//echo 'success';
			return $str3;
			
		}
		
		function getSimpleInfo($name){
			
			if(preg_match("/<span class=\"pl\">([ ]*)$name([\s\S]*)<\/span>([ ]*)([\s\S]*)<br\/>/iU", 
				$this->result, $matches))
				return addslashes(trim($matches[4]));
			else
			 	return '';
			 	
		}
		
		
		public function getTitle(){
			
			preg_match('/<span property="v:itemreviewed">([\s\S]*)<\/span>/iU', $this->result, $matches);
			return addslashes(trim($matches[1]));
			
		}
	
		public function getIntro(){
			
			if(preg_match_all("/<div class=\"intro\">([\s\S]*)<\/div>/uU", $this->result, $matches))
			{
				//return $matches[1][0];
				if(!preg_match_all("/(展开全部)/u", $matches[1][0], $str1))
				{
					return $matches[1][0];
				} else {
					return $matches[1][1];
				}
				
				
			}
			else
				return '';
			
		}
		
		function getPic(){
			
			if(preg_match('/<img src="([\s\S]*)" title="点击看大图/iU', $this->result, $matches))
				return addslashes(trim($matches[1]));
			else 
				return '';
				
		}
		
		
	}