@extends('layouts.logged_in')

@section('title', $title)

@section('content')
    <h1>【{{$shop_item->name}}の口コミ】</h1>
    <p>基本情報</p>
    <p>店舗名：{{$shop_item->name}}</p>
    <p>営業時間：{{$shop_item->business_hours}}</p>
    <img src="{{ asset('storage/photos/' . $shop_item->image) }}">
    
    <form method="post" action="{{ route('comments.store', $shop_item->id) }}">
        @csrf
        <input type="hidden" name="shop_id" value="{{$shop_item->id}}">
        {{--<input type="hidden" name="status" value="1">--}}
        {{--<div>
            <label>名前：<input type="text" name="name" class="name_field" value="{{Auth::user()->name}}"></label>
        </div>--}}
        <div>
            <label>この場所の口コミを投稿：<input type="text" name="comments" class="comment_field" placeholder="500文字以内で入力"></label>
        </div>
        <div>
            <input type="submit" value="投稿">
        </div>
    </form>
    <ul>
        @forelse($reviews as $review)
        <li>{{$review->user->name}}<br>
            {{$review->comments}}<br>
            {{$review->created_at}}
        </li>
        @empty
        <li>口コミはありません</li>
        @endforelse
    </ul>
@endsection
    