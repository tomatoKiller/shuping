<?php
// 本类由系统自动生成，仅供测试用途
namespace Home\Controller;
use Think\Controller;
import('@.Util.weixin');


class IndexController extends Controller {
    public function index(){
    	
    		//echo __ROOT__;
    		//echo __APP__;
			$this->display();
			
	  }
	  
	  public function detail(){
			$isbn = I('get.isbn','');
			if(bookname == '')
			{
				echo " 请选择图书";
				exit;
			} else {
				mysql_query('set names utf-8');  	
				
	    		$book = M('Book');
				
				$map['isbn'] = $isbn;
				$data = $book->where($map)->find();

			 	$this->assign('book',$data);
				$this->display();
			}	  
	  }
	  
	  public function comment(){
	  		$tmp = I('post.comment','');
	  		$tmp = json_decode($tmp);

	  		$comment = $tmp['bookmark']['comment'];
	  		$score = $tmp['bookmark']['score'];
	  		$isbn = $tmp['bookmark']['isbn'];

	  		mysql_query('set names utf-8');  	
				
	    	$book = M('Book');

	    	$data['score']=$score;
	    	$book->where("isbn=$isbn")->data($data)->save();

	  }
	  public function search(){
			$bookname = I('post.bookname','');
			if(bookname == '')
			{
				echo " 请输入书名";
				exit;
			} else {
				mysql_query('set names utf-8');  	
				
	    		$book = M('Book');
				
				$map['title'] = array('like', "%{$bookname}%");
				$data = $book->where($map)->select();

				$var = array('books' => $data, );

				echo json_encode($var);
				/*
			 	$this->assign('data',$data);
				$this->display();
				*/
			}	  

	  }
	  
    public function hello(){

			$this->assign('data', 'aaa');
			$this->display();
			
    }
    
    public function weixin(){
    	//file_put_contents('./content.txt', 'sjfsdf');
    	$wechatObj = new \Weixin();

    	$wechatObj->responseMsg();
			//$wechatObj->valid();
			
			
    }  
    
}


