<?php if (!defined('THINK_PATH')) exit();?><html>
<head>
	<meta http-equiv="content-type" content="text/html;charset=utf-8">
	<title>查询结果</title>
</head>	
	
<body>

	<img src="<?php echo ($book["pic_name_small"]); ?>" />
	书名：<?php echo ($book["title"]); ?><br />
	作者：<?php echo ($book["author"]); ?><br />
	译者：<?php echo ($book["translator"]); ?><br />
	出版社：<?php echo ($book["publisher"]); ?><br />
	出版时间：<?php echo ($book["publish_time"]); ?><br />
	定价：<?php echo ($book["price"]); ?><br />
	页数：<?php echo ($book["page_num"]); ?><br />
	装帧：<?php echo ($book["zhuangzhen"]); ?><br />
	ISBN: <?php echo ($book["isbn"]); ?><br />
	简介：<?php echo ($book["introduct"]); ?><br />
	<br />

</body>
</html>