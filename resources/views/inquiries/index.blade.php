@extends('layouts.default')

@section('title', $title)

@section('style')
<link rel="stylesheet" href="{{ asset('css/inquiries.css') }}">
@endsection

@section('content')
    <div class="inquiries">
    <h1>{{ $title }}</h1>
    
    <a href="{{ url('/shop_items') }}">トップページに戻る</a>
    <form method="post" action="{{ url('/inquiries') }}">
         @csrf
        <div>
            <label>お名前: <input type="text" name="name" class="name_field" placeholder="半角英数字2字以上30文字以内"></label>
        </div>
        <div>
            <label>メールアドレス: <input type="email" name="email" class="email_field" placeholder="例)a-team@zenrin.com"></label>
        </div>
        <div>
            <textarea name="content" class="content_field" placeholder="お問い合わせ内容をご入力ください"></textarea>
        </div>
        <div>
            <input type="submit" value="送信" class="submit">
        </div>
    </form>
    </div>
    
@endsection