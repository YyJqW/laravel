<html>
<head>
    <meta charset="uft-8">
    <title>找回密码</title>
</head>
<body>
<h1>您的账号正在通过邮箱找回密码</h1>
<p>
    点击下面的内容完成密码重置
    <a href="{{route('pwd.reset',$token)}}">
        {{route('pwd.reset',$token)}}
    </a>
</p>
<p>
    如果不是本人操作，请忽略此邮件
</p>
</body>
</html>
