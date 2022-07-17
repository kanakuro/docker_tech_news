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
<body link="#000000" vlink="#ffffff" alink="#ffff00">
<x-header>
</x-header>
<div class="show_login_id">{{$login_id}}さん、ようこそ</div>

@include('news')
<x-footer>
</x-footer>
</body>
</html>