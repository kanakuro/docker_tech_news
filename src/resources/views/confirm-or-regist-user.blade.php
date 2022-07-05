<html lang="ja">
<head>
    <meta charset="UTF-8">
    @if($login_success)
      <meta http-equiv="refresh" content="0;URL=index">
    @elseif($create_user)
      <meta http-equiv="refresh" content="0;URL=login/1">
    @else
      <meta http-equiv="refresh" content="0;URL=login/">
    @endif
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Document</title>
</head>
<body>
  <input type="hidden" value="{{$errmessage}}">
</body>
</html>
