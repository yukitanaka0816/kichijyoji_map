@extends('layouts.default')

@section('title', $title)

@section('content')
    <h1>{{ $title }}</h1>
    
    <a href="{{ url('/shop_items') }}">トップページに戻る</a>
    <form method="post" action="{{ url('/inquiries') }}">
         @csrf
        <div>
            <label>名前: <input type="text" name="name" class="name_field" placeholder="名前を入力"></label>
        </div>
        <div>
            <label>メールアドレス: <input type="email" name="email" class="email_field" placeholder="メールアドレスを入力"></label>
        </div>
        <div>
            <textarea name="content" class="content_field" placeholder="お問い合わせ内容を入力"></textarea>
        </div>
        <div>
            <input type="submit" value="送信">
        </div>
    </form>
    
@endsection