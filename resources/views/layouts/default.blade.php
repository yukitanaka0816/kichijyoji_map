<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF=8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('title')</title>
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