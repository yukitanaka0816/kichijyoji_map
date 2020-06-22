@extends('layouts.default')

@section('header')
<header>
    <ul class="header_nav">
        <li>こんにちは、{{ Auth::user()->name }}さん！</li>
        <li><a href="{{ route('shop_items') }}">トップページ</a></li>
        <li><a href="{{ route('wants') }}">ルート作成</a></li>
        <li><a href="{{ route('inquiries') }}">お問い合わせ</a></li>
        <li>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <input type="submit" value="ログアウト">
            </form>
        </li>
    </ul>
</header>
@endsection