<!doctype html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="/css/style.css" rel="stylesheet" type="text/css">
    <title>@yield('title')</title>
</head>
<body>
<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <a class="navbar-brand" href="#">Gistアプリ</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"
            aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="/home">ホーム</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/gists">公開されているGist</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/gists/my-gists">自分のGist</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/gists/send">Gistを作る</a>
            </li>
        </ul>
        <span class="navbar-text">
            @if(Auth::check())
                <img src="https://avatars.githubusercontent.com/{{ Auth::user()->name }}" style="border-radius: 16px; width: 32px;">
                <a href="/auth/logout">ログアウト</a>
            @else
                ゲストさん<br/>
                <a href="/auth/login">ログイン</a>
                <a href="/auth/login/github/" class="btn btn-github">Sign in using Github</a>
                <a href="/auth/register">会員登録</a>
            @endif    </span>
    </div>
</nav>
@yield('body')


<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
</body>
</html>