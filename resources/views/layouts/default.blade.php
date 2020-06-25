<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF=8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script> 
        <title>@yield('title')</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
        <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
        @yield('style')
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
        
        {{-- フッター --}}
        <div class="container-fruid">
            <footer class="footer">
                <div class="container">
                    <a class="contact" href="{{ route('inquiries') }}">お問い合わせ</a>
                    <p class="text-center">&copy; A TEAM</p>
                </div>
            </footer>
        </div>
        
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.bundle.min.js"></script>
    </body>
</html>