<?php
// ������ϵͳ�Զ����ɣ�����������;
namespace Home\Controller;
use Think\Controller;
class EmptyController extends Controller {
    public function index(){
    	$cityname = CONTROLLER_NAME;
    	$this->hello($cityname);
	  }
    public function hello($name){
    	echo "name is " .$name;
    }
}