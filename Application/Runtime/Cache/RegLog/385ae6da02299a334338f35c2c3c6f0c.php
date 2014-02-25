<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">  
<html>  
<head>  
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">  
<title>请登录</title>  
</head>  
<style type="text/CSS">  
    .div  
    {  
        height:1000px;  
        width:700px;  
        text-align:center;  
        margin:20px;  
          
    }  
    .text  
    {  
          
          
    }  
    .button  
    {  
        font-size:10px;  
          
    }  
  
    </style>  
<body>  
<form method="post" action="/thinkphp/index.php/RegLog/RegLog/check">  
<div class="div">  
    用户名<input type="text" name="name" >  
    密码:<input type="password" name="password">  
    <div class="button">  
    <input type="submit" value="提交">  
    <input type="reset" value="清除">  
    <a href="/thinkphp/index.php/RegLog/RegLog/register" >注  册</a>  
</div>  
</div>
</form>
</body>  
</html>