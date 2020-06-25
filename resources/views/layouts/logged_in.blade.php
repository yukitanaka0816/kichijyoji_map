@extends('layouts.default')

@section('header')
<header>
    <div class="container-fruid">
        <nav class="navbar navbar-expand-sm navbar-light">
            <!--ロゴ画像(ホームにリンク)-->
            <a href="{{ route('shop_items') }}"><img class="navbar-logo" src="{{ asset('img/logo.png') }}"></a>
            <button class="navbar-toggler ml-auto" data-toggle="collapse" data-target="#mainNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="mainNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a href="{{ route('shop_items') }}" class="nav-link"><img class="nav_icon" src="{{ asset('img/nav_icon.png') }}"> ホーム</a></li>
                    <li class="nav-item"><a href="{{ route('wants') }}" class="nav-link"><img class="nav_icon" src="{{ asset('img/nav_icon.png') }}"> ルート</a></li>
                    <li class="nav-item"><a href="#" class="nav-link"><img class="nav_icon" src="{{ asset('img/nav_icon.png') }}"> 投稿  </a></li>
                    <li>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <input type="submit" value="ログアウト">
                        </form>
                    </li>
                </ul>
                <button class="navbar-nav ml-auto how_to" data-toggle="modal" data-target="#modal1">使い方ガイド</button>
                <div class="modal fade" id="modal1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button class="close" data-dismiss="modal">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <img src="{{ asset('img/HowToUse.png') }}" class="img-fluid">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</header>
@endsection