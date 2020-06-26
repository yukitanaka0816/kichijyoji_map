@extends('layouts.not_logged_in')

@section('style')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('content')
<div class="form-wrapper">
  <h1>ログイン</h1>
  <form method="POST" action="{{ route('login') }}">
      @csrf
      <div class="form-item">
          <label for="email"></label>
          <input id="email" type="email" name="email"  required="required" placeholder="メールアドレス">
      </div>

      <div class="form-item">
          <label for="password"></label>
          <input id="password" type="password" name="password" required="required" placeholder="パスワード">
      </div>
      <div class="button-panel">
        <input type="submit" class="button" title="Sign In" value="ログイン"></input>
      </div>
  </form>
  <div class="form-footer">
    <p><a href="#">新規登録</a></p>
  </div>
</div>
@endsection


    
      
