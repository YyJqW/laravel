<html>
<head>
    <meta charset="uft-8">
    <title>注册确认链接</title>
</head>
<body>
<h1>感谢你的注册</h1>
<p>
    点击下面的内容完成注册认证
    <a href="{{route('confirm',$user->activation_token)}}">
        {{route('confirm',$user->activation_token)}}
    </a>
</p>
<p>
    如果不是本人操作，请忽略此邮件
</p>
</body>
</html>
