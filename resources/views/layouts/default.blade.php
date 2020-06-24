<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF=8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('title')</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
        <link rel="stylesheet" href="{{ secure_asset('css/styles.css') }}">
    </head>
    <body>
        @yield('header')
        
        
        
        {{-- エラーメッセージを出力 --}}
        @foreach($errors->all() as $error)
            <p class="error">{{ $error }}</p>
        @endforeach
        
        
        
        {{-- 成功メッセージを出力 --}}
        @if(\Session::has('success'))
            <div class="success">
                {{ \Session::get('success') }}
            </div>
        @endif
        
        
        
        @yield('content')
    </body>
</html>