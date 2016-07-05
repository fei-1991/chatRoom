<?php if (!defined('THINK_PATH')) exit();?><html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>MyQQ</title>
    <script type="text/javascript" src="/myqq/js/my.js"></script>
    <script type="text/javascript"></script>
</head>
<body>
    <h2><font color="blue">欢迎登陆聊天室</font></h2>
		<form action="<?php echo U('Login/login');?>" method="post">
        用户名：<input type="text" id="username" name="username" />
        密码：  <input type="password" id="password" name="password" />
        <input type="submit" value="登陆">
		</form>
</body>
</body>
</html>