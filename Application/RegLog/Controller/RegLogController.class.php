<?php
// 本类由系统自动生成，仅供测试用途
namespace RegLog\Controller;
use Think\Controller;


class RegLogController extends Controller {
    public function login(){
    	
			$this->display();
			
	  }
	  
	  public function register(){

			$this->display();

	  }
	  
	  public function add(){
			//用户注册以后的数据处理文件。需要先检查数据合法性，然后写入数据库
			//获取注册用户提交的数据
			header('Content-Type:text/html; charset=utf-8');//防止出现乱码
			
			$UserName1=$_POST["UserName"];//用户名
			$Password1=$_POST["Password"];//密码
			$ConfirmPassword1=$_POST["ConfirmPassword"];//确认密码
			$Email1=$_POST["Email"];//邮箱
			//定义保存激活码变量
			$actnum="";
			
			//调用函数，检测用户输入的数据
			$UserNameGood=Check_username($UserName1);
			$PasswordGood=Check_Password($Password1);
			$EmailGood=Check_Email($Email1);
			$ConfirmPasswordGood=Check_ConfirmPassword($Password1,$ConfirmPassword1);
			$error=false;//定义变量判断注册数据是否出现错误
			if($UserNameGood !="用户名检测正确")
			{
			  $error=true;//改变error的值表示出现了错误
			  echo $UserNameGood;//输出错误信息
			  echo "<br>";
			}
			if($PasswordGood !="密码检测正确")
			{
				 $$error=true;
				 echo $PasswordGood;
				 echo "<br>";
			}
			if($EmailGood !="邮箱检测正确")
			{
				 $error=true;
				 echo $EmailGood;
				 echo "<br>";
			}
			if ($ConfirmPasswordGood !="两次密码输入一致")
			{
				 $error=true;
				 echo $ConfirmPasswordGood;
				 echo "<br>";
			}
			//判断数据库中用户名和email是否已经存在
			$User = M('Customer');
			
			$map['userid'] = $UserName1;
			$map['email'] = $Email1;
			$map['_logic'] = 'OR';

			$row = $User->where($map)->find(); 


			if ($row["userid"]==$UserName1)
			{
				$error=true;
				echo "用户名已存在<br>";
			} elseif ($row["email"]==$Email1)
			{
				$error=true;
				echo "用户邮箱已经注册<br>";
			}

			//如果数据检测都合法，则将用户资料写进数据库表
			if ($error==false) //$error==false表示没有错误
			{
			 $actnum=Check_actnum();//调用激活码函数
			 $Datetime=date("d-m-y G:i");//获取注册时间，也就是数据写入到用户表的时间
			 
			 
			 $query=array('userid' 	=> $UserName1,
			 							'passwd' 	=> $Password1,
			 							'email'  	=> $Email1,
			 							'actnum' 	=> $actnum,
			 							'reg_time' => $Datetime
			 							);

			 $User->data($query)->add();
			 $to=$Email1;//用户注册的邮箱
		    $subject="激活码";
		    $message="您的激活码为$actnum";
		    $header="From:fengmozhui@163.com"."\r\n";//邮件头信息
		    if(mail($to,$subject,$message,$header))//php中mail()函数用来发送邮件，需要更改php.ini文件，最好安装SMTP服务器
		    {
			     //产生链接，链接到激活页面
			     ?>
			     请登陆邮箱获取激活码。然后点击<a href="/thinkphp/index.php/RegLog/RegLog/activate">这里</a>激活。
			     <?php
		    }
			}

	  }
	  
    public function activate(){

			$this->display();
			
    }
    
    public function ResendActnum(){
    	
    	$this->display();
			
    } 
    
    public function activeVerify(){
    	
    	$this->display();
			
    }  
    
}


