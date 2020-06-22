{{--@extends('layouts.logged_in')

@section('title', $title)

@section('content')--}}
    <h1>{{$title}}</h1>
    <form methos="post" action="{{ url('/comments') }}">
        @csrf
        <div>
            <label>名前：<input type="text" name="name" class="name_field" placeholder="名前を入力"></label>
        </div>
        <div>
            <label>コメント：<input type="text" name="body" class="comment_field" placeholder="コメントを入力"></label>
        </div>
        <div>
            <input type="submit" value="投稿">
        </div>
    </form>
    