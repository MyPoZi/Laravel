<html>
<head>
    <meta charset="UTF-8">
</head>
<body>
こんにちは！！！！
@if(Auth::check())
    {{ \Auth::user()->name }}さん
@else
    ゲストさん<br/>
    <a href="/auth/register">会員登録</a>
@endif
</body>
</html>