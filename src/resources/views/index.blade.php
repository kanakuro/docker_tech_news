<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <script type="text/javascript" src="{{ asset('js/app.js')}}"></script>
</head>
<body>
<header>
    <h1>tech-news</h1>
</header>
<div class="header_menu">
    <div class="fav_list">
        <button class="to_fav_list">お気に入り</button>
    </div>
    <div class="news_list">
        <button class="to_news_list">ニュース一覧</button>
    </div>
</div>
@include('news')
<footer>
</footer>
</body>
</html>