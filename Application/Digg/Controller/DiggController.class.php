<?php
// 本类由系统自动生成，仅供测试用途
namespace Digg\Controller;
use Think\Controller;

import('@.Util.cURL');
import('@.Util.digg');
import('Org.Net.Http');

class DiggController extends Controller {
    public function digg(){
    	mysql_query('set names utf-8'); 
    	$page_num = 1;
			$item = ($page_num -1 ) * 20;
			$url_arr = getUrl("http://book.douban.com/tag/%E7%BC%96%E7%A8%8B?start={$item}&type=T");

			$i = 0;
			
			$book = M('Book');
			
			foreach($url_arr as $url) {
				
				$page = new \Analyse_Url($url);
				
				$value = array(
					'title' => $page->getTitle(),
					'author' => $page->getZuoZhe(),
					'translator' => $page->getYiZhe(),
					'price' => $page->getSimpleInfo("定价"),
					'publisher' => $page->getSimpleInfo("出版社"),
					'publish_time' => $page->getSimpleInfo("出版年"),
					'page_num' => $page->getSimpleInfo("页数"),
					'zhuangzhen' => $page->getSimpleInfo("装帧"),
					'isbn' => $page->getSimpleInfo("ISBN"),
					'introduct' => $page->getIntro(),
					'pic_name_big' => __ROOT__ . '/Public/img/lpic/'.$page->getSimpleInfo("ISBN") . '.jpg',
					'pic_name_small' => __ROOT__ . '/Public/img/mpic/'.$page->getSimpleInfo("ISBN") . '.jpg',
				);
				$pic_url = $page->getPic();
				$big_pic_url = preg_replace('/mpic/','lpic', $pic_url);
				
		
				\Org\Net\Http::curlDownload($pic_url, './Public/img/mpic/'.$page->getSimpleInfo("ISBN").'.jpg');
				\Org\Net\Http::curlDownload($big_pic_url, './Public/img/lpic/'.$page->getSimpleInfo("ISBN").'.jpg');	

				$book->data($value)->add();
			
				$i++;
				if($i > 10 )
					break;
				
			}
			
		}
   

}
?>