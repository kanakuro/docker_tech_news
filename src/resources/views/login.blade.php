<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <script type="text/javascript" src="{{ asset('js/login.js')}}"></script>
</head>
<body>
    <form name="login_form" action="{{url('/confirm_or_regist_user')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="login_form_top">
            <h1>ログイン画面</h1>
            @if(!$create_user)
                <p>ユーザID、パスワードをご入力の上、「ログイン」ボタンをクリックしてください。</p>
            @else
                <p>必要事項をご入力の上、「アカウント作成」ボタンをクリックしてください。</p>
            @endif
        </div>
        @if(isset($errmessage))
        <div class="error">{{$errmessage}}</div>
        @endif
        <div class="login_form_btm">
            <input type="id" name="login_id" placeholder="ユーザーIDを入力してください">
            <input type="password" name="password"placeholder="パスワードを入力してください">
            @if($create_user)
                <input type="password_confirm" name="password_confirm"placeholder="パスワードを再入力してください">
                <input type="email" name="email"placeholder="メールアドレスを入力してください">
            @endif
            <input type="hidden" name="create_user_flg" value="{{$create_user}}">
        </div>
        @if(!$create_user)
            <button type="submit" name="login">ログイン</button>
        @else
            <button type="submit" name="create_user">アカウント作成</button>
        @endif
        @if(!$create_user)
            <div>アカウントをお持ちでない方は<a href="{{ route('login', ['create_user'=>true]) }}">こちら</a></div>
        @else
            <div>アカウントをお持ちの方は<a href="{{ route('login', ['create_user'=>false]) }}">こちら</a></div>
        @endif

      </form>

</body>
</html>
