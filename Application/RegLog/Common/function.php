<?php

//定义产生激活码函数
function Check_actnum()
{
	$chars_for_actnum=array("A","B","C","D","E","F","G","H","I","J","K","L",
						"M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z","a","b","c","d",
						"e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v",
						"w","x","y","z","1","2","3","4","5","6","7","8","9","0"
						);
	for ($i=1;$i<=20;$i++){ //生成一个20个字符的激活码
	 	$actnum.=$chars_for_actnum[mt_rand(0,count($chars_for_actnum)-1)];
	}
	
	return $actnum;
}
//判断用户名函数
function Check_username($UserName)//参数为用户注册的用户名
{
	 //用户名三个方面检查
	 //是否为空   字符串检测   长度检测
	 $Max_Strlen_UserName=16;//用户名最大长度
	 $Min_Strlen_UserName=4;//用户名最短长度
	 $UserNameChars="^[A-Za-z0-9_-]";//字符串检测的正则表达式
	 $UserNameGood="用户名检测正确";//定义返回的字符串变量
	 if($UserName=="")
	 {
		  $UserNameGood="用户名不能为空";
		  return $UserNameGood;
	 }
	 if(!ereg("$UserNameChars",$UserName))//正则表达式匹配检查
	 {
		  $UserNameGood="用户名字符串检测不正确";
		  return $UserNameGood;
	 }
	 if (strlen($UserName)<$Min_Strlen_UserName || strlen($UserName)>$Max_Strlen_UserName)
	 {
		  $UserNameGood="用户名字长度检测不正确";
		  return $UserNameGood;
	 }
	 return $UserNameGood;
}
//判断密码是否合法函数
function Check_Password($Password)
{
	 //是否为空    字符串检测      长度检测
	 $Max_Strlen_Password=16;//密码最大长度
	 $Min_Strlen_Password=6;//密码最短长度
	 $PasswordChars="^[A-Za-z0-9_-]";//密码字符串检测正则表达式
	 $PasswordGood="密码检测正确";//定义返回的字符串变量
	 if($Password=="")
	 {
		  $PasswordGood="密码不能为空";
		  return $PasswordGood;
	 }
	 if(!ereg("$PasswordChars",$Password))
	 {
		  $PasswordGood="密码字符串检测不正确";
		  return $PasswordGood;
	 }
	 if(strlen($Password)<$Min_Strlen_Password || strlen($Password)>$Max_Strlen_Password)
	 {
		  $PasswordGood="密码长度检测不正确";
		  return $PasswordGood;
	 }
	 return $PasswordGood;
}
//判断邮箱是否合法函数
function Check_Email($Email)
{
	 $EmailChars="^[_a-z0-9-]+(.[_a-z0-9-]+)*@[a-z0-9-]+(.[a-z0-9-]+)*$";//正则表达式判断是否是合法邮箱地址
	 $EmailGood="邮箱检测正确";
	 if($Email=="")
	 {
		  $EmailGood="邮箱不能为空";
		  return $EmailGood;
	 }
	 if(!ereg("$EmailChars",$Email))//正则表达式匹配检查
	 {
		  $EmailGood="邮箱格式不正确";
		  return $EmailGood;
	 }
	 return $EmailGood;
}
//判断两次密码输入是否一致
function Check_ConfirmPassword($Password,$ConfirmPassword)
{
	$ConfirmPasswordGood="两次密码输入一致";
	if($Password<>$ConfirmPassword)
	{
		$ConfirmPasswordGood="两次密码输入不一致";
		return $ConfirmPasswordGood;
	}
	else
	 		return $ConfirmPasswordGood;
}