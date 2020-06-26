@extends('layouts.not_logged_in')

@section('style')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('content')
<div class="form-wrapper">
  <h1>サインアップ</h1>
  <form method="POST" action="{{ route('register') }}">
    @csrf
    <div class="form-item">
      <label for="name"></label>
      <input type="text" name="name" required="required" placeholder="ユーザー名">
    </div>

    <div class="form-item">
      <label for="email"></label>
      <input type="email" name="email" required="required" placeholder="メールアドレス">
    </div>

    <div class="form-item">
      <label for="password"></label>
      <input type="password" name="password" required="required" placeholder="パスワード">
    </div>

    <div class="form-item">
      <label for="password_confirmation"></label>
      <input type="password" name="password_confirmation" required="required" placeholder="パスワード(確認用)">
    </div>

    <div class="button-panel">
        <input type="submit" class="button" title="Sign Up" value="登録"></input>
    </div>
  </form>
  <div class="form-footer">
    <p><a href="{{ route('login') }}">ログイン</a></p>
  </div>
</div>
@endsection
